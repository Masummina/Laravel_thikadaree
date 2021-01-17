  @extends('layouts.app')

@section('content')


   <section id="main-container" class="main-container">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

					<div class="sidebar sidebar-left">
					

						<div class="widget">
							<h3 class="widget-title">Categories</h3>
							<ul class="arrow nav nav-tabs nav-stacked">
								@foreach($categories as $val)

								@php
									$cattTitle = $val->title;
									$result = str_replace(" ", "-", $val->title);
								@endphp
									<li><a href="{{url('category')}}/{{$result}}-{!! $val->id !!}">{!! $val->title !!}</a></li>
								@endforeach						 
							</ul>
						</div><!-- Categories end -->

						<div class="widget">
							<h3 class="widget-title">Archives </h3>
							<ul class="arrow nav nav-tabs nav-stacked">
			              	<li><a href="#">Feburay 2016</a></li>
		                  <li><a href="#">January 2016</a></li>
		                  <li><a href="#">December 2015</a></li>
		                  <li><a href="#">November 2015</a></li>
		                  <li><a href="#">October 201s5</a></li>
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
							<div class="widget recent-posts">
							<h3 class="widget-title">Recent Posts</h3>
							<ul class="unstyled clearfix">
		               	<li>
		                    <div class="posts-thumb pull-left"> 
		                    		<a href="news-single.html"><img alt="img" src="images/news/news1.jpg"></a>
		                    </div>
		                    <div class="post-info">
		                        <h4 class="entry-title">
		                        	<a href="news-single.html">We Just Completes $17.6 Million Medical Clinic In Mid-missouri</a>
		                        </h4>
		                    </div>
		                    <div class="clearfix"></div>
		                  </li><!-- 1st post end-->

		                  <li>
		                    <div class="posts-thumb pull-left"> 
		                    		<a href="news-single.html"><img alt="img" src="images/news/news2.jpg"></a>
		                    </div>
		                    <div class="post-info">
		                        <h4 class="entry-title">
		                        	<a href="news-single.html">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
		                        </h4>
		                    </div>
		                    <div class="clearfix"></div>
		                  </li><!-- 2nd post end-->

		                  <li>
		                    <div class="posts-thumb pull-left"> 
		                    		<a href="news-single.html"><img alt="img" src="images/news/news3.jpg"></a>
		                    </div>
		                    <div class="post-info">
		                        <h4 class="entry-title">
		                        	<a href="news-single.html">Silicon Bench And Cornike Begin Construction Solar Facilities</a>
		                        </h4>
		                    </div>
		                    <div class="clearfix"></div>
		                  </li><!-- 3rd post end-->

		               </ul>
							
						</div><!-- Recent post end -->

					</div><!-- Sidebar end -->
				</div><!-- Sidebar Col end -->

				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 post-all-content-right">
					<div class="post-search">
						<div class="row">
							<div class="left col-md-9 col-sm-9">
							  <form action="" method="get">
								<span class="search">
									<i class="fa fa-search"></i>							
									<input type="text" name="search" value="{!! @$_GET['search'] !!}" placeholder="Search.." >
								 </span>
								<span class="total-result">3,252 Results</span>
							  </form>
							</div>
							<div class="right col-md-3 col-sm-3 text-right">
								<div class="dropdown">
								  <button class="dropdown-toggle" type="button" data-toggle="dropdown">Sort by:
								  <span class="caret"></span></button>
								  <ul class="dropdown-menu">
								    <li><a href="#">Latest</a></li>
								    <li><a href="#">Lowest Price</a></li>
								    <li><a href="#">Oldest</a></li>
								    <li><a href="#">Highest Price</a></li>
								    <li><a href="#">Most Bids</a></li>
								    <li><a href="#">Most Bids</a></li>
								    <li><a href="#">Fewest Bids</a></li>
								  </ul>
								</div>
							</div>
						</div>
					</div>
                
					@foreach($projects as $val)	
					<div class="post">
						<div class="post-body">
							<div class="left-content">
                               @php
									$projectTitle = $val->title;
									$result = str_replace(" ", "-", $val->title);
								@endphp
								<a href="{{url('projects')}}/{{$result}}-{!! $val->id !!}">
		                        <h5 class="title">

		                        <div class="job-list" style="max-width: 40px">
		                          <img src="images/project/monitor.png">
		                        </div> 

		                        	
									{!! $val->title !!}
								
                                </h5>
                                
		                        <p>
		                        
									{!! $val->discription !!}
								

		                        </p>
		                        <div class="open-status">
		                          <div class="open op-st">
		                            <p class="con"><img src="images/project/open.png"><span class="op-close">Open</span> less then a minute age - <span class="bids">0 bids</span></p>
		                          </div>
		                          <div class="status op-st">
		                            <p><img src="images/project/completed.png"> No jobs completed yet</p>
		                          </div>
		                        </div>
		                        <div class="skills">
		                          <p><img src="images/project/skills.png"> 

		                          	{!! $val->skills !!}

		                        </p>
		                        </div>
		                        </a>
		                      </div>
								<div class="entry-header text-right">
					 			 <div class="right-content">
			                        <span class="max-min-price"><strong>Price:</strong> <span class="max-price">${!! $val->fixed_budget !!}</span> USD</span>
			                      </div>
								</div><!-- header end -->

						</div><!-- post-body end -->
					</div><!-- 1st post end -->

					@endforeach 

					<div class="paging">
			            <ul class="pagination">
			              <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
			              <li class="active"><a href="#">1</a></li>
			              <li><a href="#">2</a></li>
			              <li><a href="#">3</a></li>
			              <li><a href="#">4</a></li>
			              <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
			            </ul>
		          	</div>

				</div><!-- Content Col end -->

			</div><!-- Main row end -->

		</div><!-- Container end -->
	</section><!-- Main container end -->
	
	
@endsection
