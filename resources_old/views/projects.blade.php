  @extends('layouts.app')

@section('content')


   <section id="main-container" class="main-container">
		<div class="container">
			<div class="row">

			 
				@if(session('error'))
					<div class="alert alert-success" role="alert">
						{{ session('error') }}
					</div>
				@endif 

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

					<div class="sidebar sidebar-left">
					

						<div class="widget">
							<h3 class="widget-title">Categories</h3>
							<ul class="arrow nav nav-tabs nav-stacked">
								@foreach($categories as $val) 
									<li><a href="{{url('jobs')}}/{{$val->seo_title}}">{!! $val->title !!}</a></li>
								@endforeach						 
							</ul>
						</div><!-- Categories end -->
							<div class="widget recent-posts">
							<h3 class="widget-title">Recent Posts </h3>
							<ul class="unstyled clearfix">
								@foreach($recent_project as $value)
								  @php 
								  	$seo_title = strtolower(str_replace([' ','/','&'], "-", $value->title)).'-'.$value->id;
								  @endphp
					               	<li>
					                    <div class="post-info">
					                        <h4 class="entry-title">
												<a href="{{url('jobs')}}/{{$seo_title}}">
												{!! substr($value->title, 0, 40) !!}
										{!! strlen($value->title) > 40 ? "..." : "" !!}
											</a>
											</h4>
											<p class="recent_post">
											{!! substr($value->discription, 0, 80) !!}
										{!! strlen($value->discription) > 80 ? "..." : "" !!}<a href="{{url('jobs')}}/{{$seo_title}}">Read more</a>
											</p>
					                    </div>
					                    <div class="clearfix"></div>
					                </li><!-- 1st post end-->
					            @endforeach

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

								<span class="total-result"> {!! count($projects) !!} Results</span>

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
									$seo_title = strtolower(str_replace([' ','/','&'], "-", $val->title)).'-'.$val->id;
								@endphp
								<a href="{{url('job-details')}}/{!!$seo_title!!}">
		                        <h5 class="title">

		                        <div class="job-list" style="max-width: 40px">
		                          <img src="{!! asset ('images/project/monitor.png') !!}">
		                        </div>
								{{ substr($val->title, 0, 80) }}
										{{ strlen($val->title) > 80 ? "..." : "" }}
                                </h5>
                                
									<p class="ArticleBody">{{ substr($val->discription, 0, 220) }}
										{{ strlen($val->discription) > 220 ? "..." : "" }}
									</p>
		                        <div class="open-status">
		                          <div class="open op-st">
		                            <p class="con"><img src="{!! asset ('images/project/open.png') !!}"><span class="op-close">Open Date:</span>  {!! @$val->open_date !!} <span class="bids"></span></p>
		                          </div>
		                          <div class="status op-st">
		                            <p><img src="{!! asset ('images/project/completed.png') !!}"> No jobs completed yet</p>
		                          </div>
		                        </div>
		                        <div class="skills">
		                          <p><img src="{!! asset ('images/project/skills.png') !!}"> 

		                          	{!! @$val->skills !!}

		                        </p>
		                        </div>
		                        </a>
		                      </div>
								<div class="entry-header text-right">
					 			 <div class="right-content">
			                        <span class="max-min-price"><strong>Price:</strong> <span class="max-price">${!! $val->min_budget !!} - {!! $val->max_budget !!}</span> USD</span>
			                      </div>
								</div><!-- header end -->

						</div><!-- post-body end -->
					</div><!-- 1st post end -->

					@endforeach 

					<div class="paging">
			            <ul class="pagination">
			              {!! $projects->render() !!}
			            </ul>
		          	</div>



				</div><!-- Content Col end -->

			</div><!-- Main row end -->

		</div><!-- Container end -->
	</section><!-- Main container end -->
	
	
@endsection
