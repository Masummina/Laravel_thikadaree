@extends('layouts.app')

@section('content')
 	
	<div class="bidder-dashboard">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="container">
					<div class="topnav" id="myTopnav">
					  <a href="{{url('dashboard')}}">Dashboard</a>
					  <a href="#news">Inbox</a>
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
            	
               <div class="post-content post-single post-details">
                  <div class="post-body">
                  
                     <div class="entry-header">
                     	<div class="row">
                     		<div class="col-md-6 col-sm-6 left">
                     			<h4>Details</h4>
                     		</div>
                     	</div>
                     </div><!-- header end -->
                      
                     <div class="entry-content">
                        <h3 class="title-post">
                          {!! $neesomething->title !!}
                          
									       
                        </h3>
                        <p>
                        {!! $neesomething->discription !!}
                        </p>
                     </div>
                 </div><!-- post-body end -->
               </div><!-- post content end -->

            </div><!-- Content Col end -->


            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

               <div class="sidebar sidebar-right">


                  <div class="widget recent-posts">
                     <h3 class="widget-title">Recent Posts</h3>
                     <ul class="unstyled clearfix">
                        <li>
                          <div class="posts-thumb pull-left"> 
                              <a href="#"><img alt="img" src="{{ asset('images/news/news1.jpg')}}"></a>
                          </div>
                          <div class="post-info">
                              <h4 class="entry-title">
                                 <a href="#">We Just Completes $17.6 Million Medical Clinic In Mid-missouri</a>
                              </h4>
                          </div>
                          <div class="clearfix"></div>
                        </li><!-- 1st post end-->

                        <li>
                          <div class="posts-thumb pull-left"> 
                              <a href="#"><img alt="img" src="{{ asset('images/news/news2.jpg')}}"></a>
                          </div>
                          <div class="post-info">
                              <h4 class="entry-title">
                                 <a href="#">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                              </h4>
                          </div>
                          <div class="clearfix"></div>
                        </li><!-- 2nd post end-->

                        <li>
                          <div class="posts-thumb pull-left"> 
                              <a href="#"><img alt="img" src="{{ asset('images/news/news3.jpg')}}"></a>
                          </div>
                          <div class="post-info">
                              <h4 class="entry-title">
                                 <a href="#">Silicon Bench And Cornike Begin Construction Solar Facilities</a>
                              </h4>
                          </div>
                          <div class="clearfix"></div>
                        </li><!-- 3rd post end-->

                     </ul>
                     
                  </div><!-- Recent post end -->

                  <div class="widget">
                     <h3 class="widget-title">Categories</h3>
                     <ul class="arrow nav nav-tabs nav-stacked">
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Commercial</a></li>
                        <li><a href="#">Building</a></li>
                        <li><a href="#">Safety</a></li>
                        <li><a href="#">Structure</a></li>
                     </ul>
                  </div><!-- Categories end -->

                  <div class="widget">
                     <h3 class="widget-title">Archives </h3>
                     <ul class="arrow nav nav-tabs nav-stacked">
                        <li><a href="#">Feburay 2016</a></li>
                        <li><a href="#">January 2016</a></li>
                        <li><a href="#">December 2015</a></li>
                        <li><a href="#">November 2015</a></li>
                        <li><a href="#">October 2015</a></li>
                     </ul>
                  </div><!-- Archives end -->

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
