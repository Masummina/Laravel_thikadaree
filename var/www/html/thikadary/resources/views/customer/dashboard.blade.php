@extends('layouts.app')

@section('content')
 	
	<div class="bidder-dashboard">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="container">
					<div class="topnav" id="myTopnav">
					  <a href="#home">Dashboard</a>
					  <a href="#news">Index</a>
					  <a href="#contact">Feedback</a>
					  <a href="#about">Free Credit</a>
					</div>
				</div>
			</div>
		</nav>
  	</div>

   <section id="main-container" class="main-container">
      <div class="container">
         <div class="row">

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                
               <div class="post-content post-single post-details bidder-login">
                  <div class="post-body">
                     <div class="entry-header">
                     	<div class="row">
                     		<div class="running-project-header">
                     			<h4>Running Project</h4>
                     		</div>
                     	</div>
                     </div><!-- header end -->
                     
                     <div class="entry-content">
                        @foreach($projects as $val)  
                     	<div class="left-content">
                           @php
                              $result = str_replace(" ", "-", $val->title);
                           @endphp
<!--                            //{{url('project')}}/{{$result}}-{!!$val->id!!}
 -->                       <a href="{{url('projects')}}/{{$result}}-{!! $val->id !!}">

   		                        <h5 class="title"><div class="job-list" style="max-width: 40px">
   		                          <img src="images/project/monitor.png">
   		                        </div> {!! $val->title !!} </h5>
   		                        <p>{!! $val->discription !!}</p>
   		                        <div class="skills">
   		                          <p><img src="{{ asset('images/project/skills.png') }}"> 
                                       {!! $val->skills !!}

                                   </p>
   		                        </div>
   	                        </a>
	                     </div>

                        @endforeach
	                    </div>
	                    <div class="bidAds">
	                    	<a href=""><img src="images/ads/bidsAds_01.jpg"></a> 
	                    </div>
                     
                  </div><!-- post-body end -->
               </div><!-- post content end -->

               

               <!-- Post comment start -->

       
         

            </div><!-- Content Col end -->


            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

               <div class="sidebar sidebar-right">



                  <div class="widget">
                     <h3 class="widget-title">Bid Summery</h3>
                     <ul class="arrow nav nav-tabs nav-stacked">
                   		<li><a href="#">Total Bids</a></li>
                        <li><a href="#">Pending</a></li>
                        <li><a href="#">On going Project</a></li>
                     </ul>
                  </div><!-- Categories end -->

                  <div class="widget">
                     <h3 class="widget-title">Pool</h3>
                     <strong>Our Query</strong>
                     <ul class="arrow nav nav-tabs nav-stacked">
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Commercial</a></li>
                        <li><a href="#">Building</a></li>
                     </ul>
                     <div class="skip-sub"><a class="btn btn-info" href="#">Skip Submit</a></div>
                     <a href=""></a>
                  </div><!-- Categories end -->

                  <div class="widget widget-tags">
                     <h3 class="widget-title">Tags </h3>

                     <ul class="unstyled clearfix">
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Project</a></li>
                        <li><a href="#">Building</a></li>
                        <li><a href="#">Finance</a></li>
                        <li><a href="#">Safety</a></li>
                        <li><a href="#">Contracting</a></li>
                        <li><a href="#">Planning</a></li>
                     </ul>
                  </div><!-- Tags end -->


               </div><!-- Sidebar end -->
            </div><!-- Sidebar Col end -->

         </div><!-- Main row end -->

      </div><!-- Conatiner end -->
   </section><!-- Main container end -->

	
@endsection
