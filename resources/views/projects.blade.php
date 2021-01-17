@extends('layouts.app')

@section('content')


   <section id="main-container" class="main-container jobs">
		<div class="container">
			<div class="row">

			 
				@if(session('error'))
					<div class="alert alert-success" role="alert">
						{{ session('error') }}
					</div>
				@endif 

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

					<div class="sidebar sidebar-left ">
					

						<div class="widget">
							<div class="district_search">
								<div class="form-group">
								<div class="dropdown">
									<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter By District
									<span class="caret"></span></button>
									<div class="dropdown-menu">
										@if(isset($all_district[0]))
											@foreach($all_district as $row)
											<?php 
												$string = trim(preg_replace('/\s+/', ' ', $row->district));
											  	$district = ucfirst(strtolower(strip_tags(str_replace(" ",'',$string))));
											  if(isset($_GET['location'])){
												$locations = explode(',',$_GET['location']);
												if(in_array($district,$locations)){
													$checked = 'checked';
												} else { 
													$checked = '';
												}
											  }
											?>
											<div class="checkbox">
												<label><input type="checkbox" {{ @$checked }} name="discrict[]" value="{!! $district !!} "> {!! $district !!} </label>
											</div>
											@endforeach
										@endif

									</div>
								</div>


								<script>
									var origin   = window.location.href;
									var url ="{{ url('jobs') }}";
										$('input').change(function(){
											var first = 0;
											var parms = '';
											$('input[name="discrict[]"]').each(function(i){
												var discrict = '';
												console.log($(this).is(':checked'));
												if( $(this).is(':checked')){
													var str = $(this).attr('value');
													var res = str.replace(" ", "");
													discrict = ((first==0) ? '?location='+ res : "," + res);
													first = 1;
												}
												parms += discrict;	
											});
											//alert(url+parms);
											window.location.href = url+parms;
										});
								</script>




								</div>
							</div>
							<div class="left_par_category">
								<h3 class="widget-title">Categories</h3>
								<ul class="arrow nav nav-tabs nav-stacked">
									<h5 class="all_categories"><a href="{{url('jobs')}}">All Categories</a></h5>
									@foreach($categories as $val) 
										<li><a href="{{url('jobs')}}/{{$val->seo_title}}">{!! $val->title !!}</a></li>
									@endforeach						 
								</ul>
							</div>
						<!-- mobile category responsive -->
						<div class="mobile-container">
							<div class="topnav" id="mobile_caegory">
								<a href="#home" class="active">All Categories</a>
								<div id="myLinks">
								<ul class="arrow nav nav-tabs nav-stacked">
									@foreach($categories as $val) 
									<li><a href="{{url('jobs')}}/{{$val->seo_title}}">{!! $val->title !!}</a></li>
									@endforeach
								</ul>
								</div>
								<a href="javascript:void(0);" class="icon" onclick="myFunction()">
									<i class="fa fa-bars"></i>
								</a>
							</div>
						</div>




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
		                            <p class="con"><i class="fa fa-clock-o" aria-hidden="true"></i> <span class="op-close"><b>Open Date:</b> {!! date("F j, Y", strtotime(@$val->open_date)) !!} | <b> <i class="fa fa-clock-o" aria-hidden="true"></i> Close Date:</b> {!! date("F j, Y", strtotime(@$val->close_date)) !!} | <b class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> Location:</b> {!! ucfirst(strtolower($val->district)) !!} </span></p>
		                          </div>
		                        </div>
								@if(isset($val->skills))
		                        <div class="skills">
		                          <p><i class="fa fa-tags" aria-hidden="true"></i>

		                          	{!! @$val->skills !!}

		                        </p>
		                        </div>
								@endif
		                        </a>
		                      </div>
								<div class="entry-header text-right">
					 			 <div class="right-content">
			                        <span class="max-min-price"><span class="max-price">BDT {!! @$val->min_budget !!}-{!! @$val->max_budget !!}</span></span>
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

					  <script>
							function myFunction() {
							var x = document.getElementById("myLinks");
							if (x.style.display === "block") {
								x.style.display = "none";
							} else {
								x.style.display = "block";
							}
							}
						</script>


				</div><!-- Content Col end -->

			</div><!-- Main row end -->

		</div><!-- Container end -->
	</section><!-- Main container end -->
	
	
@endsection
