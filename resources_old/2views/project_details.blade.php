@extends('layouts.app')

@section('content')
 	
	<div class="bidder-dashboard">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="container">
					<div class="topnav" id="myTopnav">
					  <a href="#home">Dashboard</a>
					  <a href="#news">Inbox</a>
					  <a href="#contact">Feedback</a>
					  <a href="#about">Free Credit</a>
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
                                 <p><b>Work location: </b>@if(isset($project_info->joblocatio)) {!! $project_info->joblocatio !!}   @endif </p>
                               </div>
                               <!-- Job Location feild -->
                               @if(isset($project_info->joblocatio))
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
                             </div>
                           </div>
                         </div>
                     </div>

                     <div class="project_image" style="max-width: 25%; padding: 20px;">
                       <img id="myImg" src="{{url('images/upload')}}/{!! @$project_info->images !!}" alt="Snow" style="width:100%;max-width:300px">

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
                        <div class="tab-pane" id="tabs-1" role="tabpanel">
                          <!-- Apply Now Start-->
                            <form action="" method="POST">
                             @csrf
                               <div class="post-content post-single post-details bid-project">
                                  <div class="post-body">
                                     <div class="entry-header">
                                      <div class="row">
                                        <div class="col-md-12 col-sm-12 left">
                                          <h4>Place a Bid on this Project</h4>
                                        </div>
                                      </div>
                                     </div><!-- header end -->
                                     <div class="entry-content">
                                      <div class="title">Bid Details</div>
                                        <div class="bit-amount">
                                          <div class="row">
                                                <div class="col-md-6 col-sm-6 min-rate">
                                                  <div class="form-group">
                                                     <label for="pwd"><h5>Bid Amount:</h5> </label>
                                                      <input type="number" class="form-control" id="pwd" name="money">
                                                  </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 max-rate">
                                                  <div class="form-group">
                                                    <label for="pwd"><h5>This project will be delivered in:</h5></label>
                                                    <input type="number" id="start" name="days" placeholder="delivary time" class="form-control">
                                                  </div>
                                                </div>
                                                <div class="col-md-12 sug-milestone">
                                                  
                                                  <div class="form-group">
                                                    <label for="comment"> <h5>Suggest a milestone:</h5></label>
                                                    <p>Define the tasks that you will complete for this</p>
                                                    <textarea class="form-control" placeholder="What makes you the best candidate for this project?" rows="7" id="comment" name="discription"></textarea>

                                                  </div>
                                                  <div class="pull-right">
                                                       <input type="submit" name="submit" value="submit" class="btn btn-primary btn-lg">
                                                  </div>
                                                </div>
                                          </div>
                                        </div>
                                     </div>
                                  </div><!-- post-body end -->
                               </div><!-- post content end -->
                              </form>
                          <!-- Apply Now End -->

                        </div>

                        <div class="tab-pane active" id="tabs-2" role="tabpanel">
                          <div class="row">
                          <div class="comments-form border-box">
                              <h3 class="title-normal">Your Question</h3>
                            <form action="" method="POST">
                               @csrf
                               <div class="row">
                                  <div class="col-md-12">
                                     <div class="form-group">
                                        <textarea class="form-control required-field" id="question" placeholder="Your Question" rows="6" required="" name="comment"></textarea>
                                     </div>
                                  </div><!-- Col 12 end -->
                                 </div><!-- Form row end -->
                                 <div class="clearfix">
                                    <button class="btn btn-primary" name="submit" type="submit">Post Question</button> 
                                 </div>
                              </form><!-- Form end -->
                           </div>
                         </div>
                        </div>


                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                          <div class="row">
                          <div class="comments-form border-box">
                              <h3 class="title-normal">This content for E-Aggriment </h3>
                              
                           </div>
                         </div>
                        </div>

                        <div class="tab-pane" id="tabs-5" role="tabpanel">
                          <div class="row">
                          <div class="comments-form border-box">
                              <h3 class="title-normal">This content for Project photo </h3>
                              
                           </div>
                         </div>
                        </div>


                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                          <!-- bid list start -->
                      <div class="tags-area bidlist clearfix">
                        <div>
                          @if(isset($bid_list[0]))
                            @php
                              $proTitle =  strtolower(str_replace(" ", "-", $project_info->title));
                              $bid_permission = 1;
                              if(@Auth::user()->id == $project_info->user_id)
                              {
                                  $bid_permission = 0;
                              }
                            @endphp


                           @foreach($bid_list as $bidval) 
                              @php
                               //$result = str_replace(" ", "-", $bidval->name);
                               //$result = strtolower($result);
                                if(@Auth::user()->id == $bidval->user_id )
                                {
                                    $bid_permission = 0;
                                }
                              @endphp


                              @php 

                                $userName = DB::table('users')->join('userprofile', 'users.id','=','userprofile.user_id')->select('users.name', 'users.id','userprofile.images')->where('users.id', $bidval->user_id)->first();


                                @endphp

                           <div class="post bidlist">
                                <div class="post-body">
                                    <div class="left-content">
                                        <a href="projectDetails.html">
                                            <h5 class="title">
                                                <div class="job-list" style="max-width: 64px; padding: 10px;">
                                                  @if(isset($userName->images) && $userName->images != '')
                                                    <img class="images" alt="" src="{{asset('images/upload/profile')}}/{!! $userName->images !!} ">
                                                  @else
                                                    <img src="{{url('images/upload/profile/1607600694.png')}}">
                                                  @endif
                                                </div>
                                                <a href="{{url('users')}}-{!! $bidval->user_id !!}?pid={{$projectId}}&prouid={!! $project_info->user_id !!}">{!! $bidval->name !!}</a>
                                              </h5>  

                                              @php 
                          
                                                $seo_title = strtolower(str_replace(" ", "-", $project_info->title).'-'.$project_info->id);
                                                $seo_name = strtolower(str_replace(" ", "-", $bidval->name).'-'.$bidval->user_id);
                                                
                                                if(strlen($seo_name)>4)
                                                  $url = url('message/'.$seo_name.'/'.$seo_title);
                                                else 
                                                  $url = url('message');  
                                                
                                              @endphp

                                              <a class="btn btn-primary btn-sm" href="{!! $url !!} ">Sent message</a>

                                            <p>{!! $bidval->discription !!}
                                            </p>
                                            
                                        
                                    </div>

                                      <div class="entry-header text-right good">
                                          <div class="right-content">
                                              <span class="max-min-price"><strong>Price:</strong> <span
                                                      class="min-prc">${!! $bidval->money !!} USD
                                                  </span> <span class="max-price"></span> <br> in  {!! $bidval->days !!} days
                                              </span>
                                          </div>
                                          <div class="button_classs">
                                              @if(@Auth::user()->id == $project_info->user_id)
                                                @if($project_info->win_bid_id == 0)
                                                <a href="{!! url('project-win/?project_id='.$project_info->id.'&bid_id='.$bidval->id) !!}" class="btn btn-info btn-sm goodness" > Hiring</a>
                                                @endif
                                                 @if($bidval->win != 0) <b style="color: blue" > Hired </b>  @endif 
                                                @else

                                                <p class=" btn-sm btn-info goodness">Running</p>@if($bidval->user_id == @Auth::user()->id) <a class="btn-sm btn-danger" href="{{url('projects'.'/'.$proTitle.'-'.$project_info->id)}}?userid={!! $bidval->user_id; !!}#updatebid">edit</a>@endif
                                             @endif  

                                              </span>
                                          </div> 
                                      </div>
                                  </div>
                              </div>
                                @endforeach 
                              @endif
                            </div>
                         </div>




                              <!-- bid list End -->
                            </div>
                          </div>
                        </div>


            <!-- Project Comment start -->

                @php
                if(isset($project_info->comment)){
                $commnets = $project_info->comment;
                  $result = json_decode($commnets);
                }
                @endphp
            <!-- Project Comment End -->
                
                
                <div id="comments" class="comments-area">
                  <ul class="comments-list">

                    @php 
                      $seo_title = strtolower(str_replace(" ", "-", $project_info->title)).'-'.$project_info->id;


                    @endphp
                    @if(isset($result))
                      @foreach($result as $cid=>$value)
                      <li @if(isset($value->reply)) class="comments-reply"  @endif>
                        <div class="comment">

                        @php 

                          $userName = DB::table('users')->join('userprofile', 'users.id','=','userprofile.user_id')->select('users.name', 'users.id','userprofile.images')->where('users.id', $value->user_id)->first();
                          if(isset($userName->name) && $userName->name != '')
                          {
                            $seo_name = strtolower(str_replace(" ", "-", $userName->name)).'-'.$userName->id;
                          }  else {
                              $seo_name = '';
                          }
                          if(strlen($seo_name)>4)
                            $url = url('message/'.$seo_name.'/'.$seo_title);
                          else 
                          $url = url('message');  

                          if(isset($userName->images) && $userName->images !=''){
                            $profile_image = $userName->images;
                          } else {
                            $profile_image = '1607600694.png';
                          }

                          @endphp
 
                           <img class="comment-avatar pull-left" alt="" src="{{asset('images/upload/profile')}}/{!! $profile_image !!} ">
                           <div class="comment-body">
                              <div class="meta-data">
                                 <span class="comment-author">
                                  @if(isset($value->user_id))
                                    <a href="user/{!! $value->user_id !!}">
                                       @if(isset($userName->name))
                                         {!! $userName->name !!}  
                                         
                                      @endif
                                    </a>
                                    <br>                    
                                    <a class="btn btn-primary btn-sm" href="{!! $url !!} ">Sent message</a>
                                  @endif  
                                 </span>
                                 <span class="comment-date pull-right"> 
                                    @if(isset($value->time)) {!! $value->time; !!} @endif
                                  </span>
                              </div>
                              <div class="comment-content">
                              <p> 
                                @if(isset($value->comments)) 
                                  {!! $value->comments; !!} 
                                @elseif(isset($value->reply)) 
                                  {!! $value->reply; !!}  
                                @endif 
                              </p>
                            </div>
                              
                           
                              @if( isset($value->comments) && @Auth::user()->id == $project_info->user_id)
                                <div class="text-right">
                                   <a class="comment-reply btn btn-info" onclick="showReplyForm('{!! $cid !!}')"  >Reply</a>
                                </div>
                                <br>
                                <div class="comt_reply" id="reply-form-{!! $cid !!}" >
                                   <form method="POST" action="">
                                    @csrf
                                     <div class="row">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                              <textarea class="form-control required-field" id="message" name="reply" placeholder="Your Comment" rows="4" required=""></textarea>
                                              <input type="hidden" name="cid" value="{!! $cid !!}">
                                           </div>
                                        </div><!-- Col 12 end -->

                                     </div><!-- Form row end -->
                                     <div class="clearfix">
                                        <button class="btn btn-primary" type="submit">submit</button> 
                                     </div>
                                  </form>
                                </div>
                              @endif



                           </div>
                          </div><!-- Comments end -->
                        </li>
                      @endforeach
                      @endif

                     </li><!-- Comments-list li end -->
                  </ul><!-- Comments-list ul end -->
               </div>
               <!-- comment section end -->

               <!-- Update Bid -->
               @php 

                if(isset($_GET['userid'])){

                @endphp

                  <div class="apply_now_from-update" name="updatebid">
                <form action="" method="POST">
                   @csrf
                     <div class="post-content post-single post-details bid-project">
                        <div class="post-body">
                           <div class="entry-header">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 left">
                                <h4>Update Your Bid</h4>
                              </div>
                            </div>
                           </div><!-- header end -->

                           <div class="entry-content">
                              <div class="bit-amount">
                                <div class="row">

                                      <div class="col-md-6 col-sm-6 min-rate">
                                        <div class="form-group">
                                           <label for="pwd"><h5>Bid Amount:</h5> </label>
                                            <input type="number" class="form-control" value="{!! $bidval->money !!}" id="pwd" name="updatemoney">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-sm-6 max-rate">
                                        <div class="form-group">
                                          <label for="pwd"><h5>This project will be delivered in:</h5></label>
                                          <input type="number" id="start" value="{!! $bidval->days !!}" name="days" placeholder="delivary time" class="form-control">
                                        </div>
                                      </div>
                                      <div class="col-md-12 sug-milestone">
                                        
                                        <div class="form-group">
                                          <label for="comment"> <h5>Suggest a milestone:</h5></label>
                                          <p>Define the tasks that you will complete for this</p>
                                          <textarea class="form-control" placeholder="What makes you the best candidate for this project?" rows="7" id="comment" name="discription">{!! $bidval->discription !!}</textarea>

                                        </div>
                                        <div class="pull-right">
                                             <input type="submit" name="submit" value="Update" class="btn btn-primary btn-lg">
                                        </div>
                                        
                                      </div>

                                  
                                </div>
                              </div>
                           </div>
                           
                        </div><!-- post-body end -->
                     </div><!-- post content end -->
                    </form>
                  </div>

                  @php
                
                }

               @endphp


                            

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
