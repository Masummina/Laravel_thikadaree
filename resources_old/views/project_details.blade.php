@extends('layouts.app')

@section('content')
 	
	<div class="bidder-dashboard">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="container">
					<div class="topnav" id="myTopnav">
					  <a href="{!! url('dashboard') !!}">Dashboard</a>
					  <a href="{!! url('message') !!}">Inbox</a>
					  <a href="{!! url('profile') !!}">Profile</a>					  
					</div>
				</div>
			</div>
		</nav>
  	</div>

 <section id="main-container" class="main-container">

      @if (Session::has('msg'))
        <div class="alert alert-danger">
          <strong> {{ Session::get('msg') }} </strong>
        </div>
      @endif

      <div class="container">
         <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            	
               <div class="post-content post-single post-details">
                  <div class="post-body">
                  
                     <div class="entry-header">
                     	<div class="row">

                        @php 
                          $user_id = @Auth::user()->id;
                        @endphp

                        @if($project_info->security_deposit == 0 && $project_info->user_id == $user_id && $project_info->status == 0 )

                        @php 
                          
                          $status = App\User::ChargeSecurityDeposit($project_info->id); 
                          $deposit_amount = 0;

                          if(isset($status['charge_amount']) && $status['charge_amount']>0 )
                          {
                              $deposit_amount = $status['charge_amount'];
                          }
                        @endphp  

                        <div class="alert alert-warning">
                          @php
                          $notice_data = DB::table('settings')
                              ->where('title_key','security_deposit_notice_message')
                              ->first();

                          if(isset($notice_data->value) && $notice_data->value) {
                              $notice = $notice_data->value;
                          } else {
                              $notice = '';
                          }
                          @endphp 
                          <strong>Note!</strong>  {!! $notice !!} (Security deposit amount is {!! number_format($deposit_amount) !!}) 
                        </div> 
                        @endif


                     		<div class="col-md-6 col-sm-6 left">
                     			<h4>Project Details</h4>
                     		</div>
                     		<div class="col-md-6 col-sm-6 right text-right">
                     			<strong class="detaile-price"><span class="rate">Taka:  {!! @$project_info->project_budget  !!}<b></b> </span></strong>
                     		</div>
                     	</div>
                     </div><!-- header end -->
                      
                     <div class="entry-content">
                      <div class="pro_status float-right">
                        @if(isset($project_info->status)) 
                          @if($project_info->status==0)
                            <button class="btn btn-sm btn-success">Running</button>
                            @else
                            <button class="btn btn-sm btn-danger">Awared</button>
                          @endif
                        @endif
                      </div>

                        <h3 class="title-post">
                          {!! $project_info->title !!}
                        </h3>
                        <p>
                        	{!! $project_info->discription !!}  
                        </p>

                        <div class="project_info">
                           <div class="row">
                             <div class="col-md-12">
                               <div class="feild">
                                 <p><b>Project ID: </b>N{!! $project_info->id !!}   </p>
                               </div>
                               <div class="feild">
                                 <p><b>Opening Date: </b>@if(isset($project_info->open_date)) {!! $project_info->open_date !!} @endif  </p>
                               </div>
                               <div class="feild">
                                 <p><b>Close Date: </b>@if(isset($project_info->close_date)) {!! $project_info->close_date !!}  @endif </p>
                               </div>
                               <div class="feild">
                                <p><b>Work location: </b>
 
                                  @if(isset($project_info->joblocation)) {!! $project_info->joblocation !!}   @endif , 
                                  @if(isset($project_info->district)) {!! $project_info->district !!}   @endif , 
                                  @if(isset($project_info->district)) {!! $project_info->area !!}   @endif

                                </p>
                               </div>
                               <!-- Job Location feild -->
                               @if(isset($project_info->experience))
                               <div class="feild">
                                 <p><b>Experience & required: </b>{!! $project_info->experience !!}   </p>
                               </div>
                               @endif

                               <!-- Job liquid_asset feild -->

                               @if(isset($project_info->liquid_asset))
                               <div class="feild">
                                 <p><b>Liquid Asset: </b>{!! $project_info->liquid_asset !!}   </p>
                               </div>
                               @endif

                               @if(isset($project_info->items))
                               <div class="feild">
                                 
                                <?php
                                  $item_list = json_decode($project_info->items);
                                 
                                  if(isset($item_list->items))
                                  {
                                    echo '<b> Discription of items :  </b> <br>';
                                    foreach ($item_list->items as $key => $value) {
                                       echo '<b>'.$value.': '.@$item_list->quantity[$key].' - '.@$item_list->units[$key].' </b>  , ';
                                    }
                                  }
                                ?>
 
                               </div>
                               @endif

                             </div>
                           </div>
                         </div>
                     </div>

                     <div class="project_image" style="max-width: 25%; padding: 20px;">

                        @php

                          $images = json_decode($project_info->images);
                          if(isset($images[0]))
                          {
                            foreach ($images as $key => $filename) 
                            {
                              $ext = pathinfo($filename, PATHINFO_EXTENSION);
                              if($ext=='docx' || $ext=='doc')
                              {
                                  $src = 'docx.png';
                              } 
                              else if($ext=='pdf')
                              {
                                  $src = 'pdf.png';                              
                              } else {
                                $src = $filename;
                              }
                              echo '<img src="'.url('images/tor/'.$src).'" alt="tor" style="width:100%;max-width:300px">';                         
                            }
                          } else {
                            $src = 'no-file.png';   
                            echo '<img src="'.url('images/tor/'.$src).'" alt="tor" style="width:100%;max-width:300px">';                
                          }
                        @endphp    

              
                        <!-- The Modal -->
                        <div id="imageModal" class="modal">
                          <span class="close2">&times;</span>
                          <img class="modal-content" id="imageview">
                          <div id="caption2"></div>
                        </div>
                      
                     </div>
                     <div class="tags-area clearfix">
                     	<h5>Skills Required</h5>
                        <div class="post-tags pull-left">
                           {!! $project_info->skills !!}
                        </div>
                       
                     </div>
                     @php
                        $bid_permission = 1;
                        if(@Auth::user()->id == $project_info->user_id )
                        {
                            $bid_permission = 0;
                        }
                      @endphp

                    @if(@Auth::user()->id)
                        @if($bid_permission == 1) 
                       <div class="tags-area clearfix">
                        <div class="pull-left ">
                          <button class="user_comment btn btn-success btn-lg">Comment</button>
                         </div>
                      </div>
                      @endif
                    @endif
                    <div class="projectTab row">
                     <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item active">
                          <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Ask a quary</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">Place a Bid</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Show bid list</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">E-Aggriment</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Projects Photo</a>
                        </li>
                      </ul><!-- Tab panes -->
                    </div>
                 </div><!-- post-body end -->
               </div><!-- post content end -->
              

               <div class="Product_detils_tab">
                  <div class="tab-content">                        
                        @include('projectDetails.your-question')
                        @include('projectDetails.place-a-bid')
                        @include('projectDetails.bidlist')
                        @include('projectDetails.e-aggriment')
                        @include('projectDetails.project-photo')                           
                  </div>
                </div>

              @include('projectDetails.comments')   
               
              <!-- Update Bid -->
              @include('projectDetails.update-bid')  
              
 
            </div><!-- Content Col end -->


            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

               <div class="sidebar sidebar-right">


                  <div class="widget recent-posts">
                     <h3 class="widget-title">
                        @if(isset($client_name->name)) 
                        {!! $client_name->name !!}
                        @endif
                       </h3>
                     <p>
                      @if(isset($project_client->district)) 
                        {!! $project_client->district !!} , Bangladesh
                        @else
                        <p>No address added</p>
                      @endif 

                     </p>
                       <div class="view_rating">
                       <span class="review-stars" style="color: #1e88e5;">
                        @php
                          $review = 2;
                        @endphp
                      <!-- ////////////// STAR RATE CHECKER ////////////// -->
                          @if($review <= 0)
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review === 1)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review === 2)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review === 3)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review === 4)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review >= 5)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                          @endif
                          <!-- ///////////////////////////////////////////// -->
                      </span>
                     </div>
                     <h5 class="widget-titles">Verification</h5>
                    <ul class="unstyled details-pro clearfix">
                        <li><p><b>Payment: </b></p></li>
                        <li><p><b>Deposit: </b></p></li>
                        <li><p><b>Email: </b>{!! $client_name->email !!}</p></li>
                        <li><p><b>Phone: </b>
                            @if(isset($project_client->phone))
                              {{!! $project_client->phone !!}
                              @else
                              No number
                            @endif
                        </p></li>
                        <li><p><b>Profile: </b></p></li>
                    </ul>
                     
                  </div>


                  <!-- Recent post start -->
                  <div class="widget recent-posts">
                     <h3 class="widget-title other">Other job of this employer</h3>
                    <ul class="unstyled clearfix">
                        @foreach($recent_project as $value)

                        @php 

                          $recent_post = $value->title;
                          $reResult = strtolower(str_replace(" ", "-", $recent_post));

                        @endphp
                                <li>
                                    <div class="posts-thumb pull-left"> 
                                        <a href="{{url('jobs')}}/{{$reResult}}-{!! $value->id !!}"><img alt="img" src="{{url('images/upload')}}/{!! $value->images !!} "></a>
                                    </div>
                                    <div class="post-info">
                                        <h4 class="entry-title">
                                          <a href="{{url('jobs')}}/{{$reResult}}-{!! $value->id !!}">{!! $value->title !!}</a>
                                        </h4>
                                    </div>

                            <div class="clearfix"></div>
                        </li><!-- 1st post end-->
                        @endforeach

                      </ul>
                     
                  </div><!-- Recent post end -->

                <!--   Related project start -->

                  <!-- project category list -->



                <div class="widget recent-posts">
                     <h3 class="widget-title other">Similar Jobs</h3>
                    <ul class="unstyled clearfix">
                        @foreach($related_project as $related)

                        @php 

                          $related_post = $related->title;
                          $reResult = strtolower(str_replace(" ", "-", $related_post));

                        @endphp
                                <li>
                                    <div class="posts-thumb pull-left"> 
                                        <a href="{{url('jobs')}}/{{$reResult}}-{!! $related->id !!}"><img alt="img" src="{{url('images/upload')}}/{!! $related->images !!} "></a>
                                    </div>
                                    <div class="post-info">
                                        <h4 class="entry-title">
                                          <a href="{{url('jobs')}}/{{$reResult}}-{!! $related->id !!}">{!! $related->title !!}</a>
                                        </h4>
                                    </div>

                            <div class="clearfix"></div>
                        </li><!-- 1st post end-->
                        @endforeach
                      </ul>
                  </div>

                <!--   Related project End -->



               </div><!-- Sidebar end -->


            </div><!-- Sidebar Col end -->

         </div><!-- Main row end -->

      </div><!-- Conatiner end -->

   </section><!-- Main container end -->




@endsection
