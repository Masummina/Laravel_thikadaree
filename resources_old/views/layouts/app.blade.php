<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title>Constra - Construction Html5 Template</title>

	<!-- Mobile Specific Metas
	================================================== -->

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">


	<!-- CSS
	================================================== -->

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<!-- Template styles-->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<!-- Responsive styles-->
	<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
	<!-- FontAwesome -->
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
	<!-- Animation -->
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
	<!-- Colorbox -->
	<link rel="stylesheet" href="{{ asset('css/colorbox.css') }}">
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

	<!-- initialize jQuery Library -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>


<script>
	function searchCategory(cat_name) 
	{ 
		if(cat_name.length>2)
		{
			// Find category by Ajax
			var ajax_data = cat_name; // 
			if(ajax_data.length > 2)
			{
				$("#search-result").show();	
				$("#search-result").html(ajax_data);
				$("#default-category").hide();
			} else {		 
				$("#search-result").hide();
				$("#default-category").show();
			}

		}  else {		 
			$("#search-result").hide();
			$("#default-category").show();
		}
		 
	}
</script>

	<div class="body-inner">
		<!-- Header start -->
		<header id="header" class="header-one">
			<div class="container">
				<div class="row">
					<div class="logo-area clearfix">
						<div class="logo col-xs-12 col-md-5 logo-left">
							<a href="{{url('/')}}" >
								<img src="{{asset ('images/home/thikadari.png')}}" alt="">
							</a>
							<div class="browse btn-lg" data-toggle="modal" data-target="#myModal">
								<a href="#"><i class="fa fa-search"></i>Job Browse</a>
							</div>
							<div class="browse work">
								<a href="{!! url('how-it-works') !!}">How It Works?</a>
							</div>
						</div>
						
						<!-- logo end -->

						<!-- job  model start -->
							<div id="myModal" class="modal fade" role="dialog">
							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							      	<!-- <div class="top-header-content">
						              <form class="form-search">
						                  <input placeholder="Type something" onkeyup="searchCategory(this.value)" type="text" class="input-medium search-query">
						                  <button type="submit" class="btn btn-square btn-theme">Search</button>
						                </form>
						            </div> -->
							      </div>
							      <div class="modal-body">
							        <div class="brows-job">

										<div id="search-result">

										</div>	

										<div id="default-category">
											<div class="jobtitle"> <h6>SEARCH BY TYPE</h6> </div>
											<div class="row">
												<div class="col-md-3 col-sm-4">
													<a href="{{url('jobs')}}">
													<div class="img-left">
													<img src="{{ asset('images/icon-image/projects.png')}}">
													</div>
													<div class="con-right">
														<p class="title">Project</p>
														<p> Browse available projects to work on </p>
													</div>
													</a>
												</div>	
												<div class="col-md-3 col-sm-4">
													<a href="{{url('users')}}">
													<div class="img-left">
													<img src="{{ asset('images/icon-image/contarctor.png')}} ">
													</div>
													<div class="con-right">
														<p class="title">Contractors</p>
														<p> Browse available contractors to work on </p>
													</div>
													</a>
												</div>
												<div class="col-md-3 col-sm-4">
													<a href="projects.html">
													<div class="img-left">
													<img src="{{ asset('images/icon-image/supplier.jpg')}}">
													</div>
													<div class="con-right">
														<p class="title">Supplier</p>
														<p> Browse available supplier to work on </p>
													</div>
													</a>
												</div>
												<div class="col-md-3 col-sm-4">
													<a href="projects.html">
													<div class="img-left">
													<img src="{{ asset('images/icon-image/labour.jpg')}}">
													</div>
													<div class="con-right">
														<p class="title">Labour</p>
														<p> Browse available labour to work on </p>
													</div>
													</a>
												</div>
											</div>

											<!-- Benefits start -->

											<div class="jobtitle"> <h6>Benefits</h6> </div>
											<section id="benefits-area" class="benefits-area">
											<div class="row">
											@php
												$homeinfo4 = DB::table('posts')                     
												->where('post_type', 'benefit' )
												->get();
		      								@endphp
												@if(isset($homeinfo4))
													@foreach(@$homeinfo4 as $benefit)
														@if(@$benefit->post_type == 'benefit')
													<div class="col-md-4 col-sm-4">
														<div class="ts-service-box text-center">
															<div class="ts-service-box-img">
																<img src="images/home/{!! $benefit->image; !!}" alt="" />
																<h3 class="service-box-title">
																<a href="#">
																	{!! @$benefit->title; !!}
																</a>
																</h3>
															</div>
															<div class="ts-service-box-info">
																<p class="ArticleBody">
																{!! @$benefit->discription; !!}
																</p>
															</div>
														</div><!-- Service 1 end -->
													</div><!-- Col end -->
													@endif
													@endforeach 
												@endif
											</div>
											<!--/ Container end -->
										</section>
										<!-- Benefits End -->
										</div>

							        	

							        </div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>

							  </div>
							</div>
						<!-- job  model End -->

						<div class="col-xs-12 col-md-7 header-right">
							@guest
							<ul class="top-info-box">
								<li class="user">
									<div class="info-box">
										<div class="info-box-content">
											<a href="{{ route('login') }}">Log In</a>
										</div>
									</div>
								</li>
								<li class="user">
									<div class="info-box">
										<div class="info-box-content">
											<a href="{{ url('register') }}">Sign Up</a>
										</div>
									</div>
								</li>
								<li class="header-get-a-quote">
									<a class="btn btn-primary" href="{!! url('post-a-project'); !!}">Post a Project</a>
								</li>
							</ul><!-- Ul end -->
							@else
							<ul class="top-info-box">
								<li class="notifications">
									<a href="{{ url('bem-notifications') }}" class="dropdown-toggle"  >

									@php									 
										$user_id = Auth::user()->id;
										 
										$notification_count = DB::table('notifications')
											->selectRaw("count(`id`) as total")                       
											->where('user_id', $user_id )
											->where('status','0')
											->first();
									 

										if(isset($notification_count->total) && $notification_count->total>0)
											$NC_total ='<i class="fa fa-bell-o"></i> <span class="label label-warning" >'.$notification_count->total.'</span>';
										else
											$NC_total = '';
											
									@endphp

										<span id="header-noti-count">{!! $NC_total !!}</span>

									</a>

								</li>



						<script type="text/javascript">

							var ajax_call = function() {
								$.ajax({
									type:'GET',
									url:'{!! url('/get-notification-count/?pos=head') !!}',
									success:function(data){
										$('#header-noti-count').html(data);
									}
								});
							};

							var interval = 1000 * 60 * 0.5; // where X is your every X minutes
							setInterval(ajax_call, interval);

							var ajax_call_left = function() {
								$.ajax({
									type:'GET',
									url:'{!! url('/get-notification-count') !!}',
									success:function(data){
										$('#left-noti-count').html(data);
									}
								});
							};

							var interval2 = 1000 * 60 * 0.5; // where X is your every X minutes
							setInterval(ajax_call_left, interval2);

						</script>


								<li class="user balance">
									<div class="info-box">
										<div class="info-box-content">
										My balance: ( {{ App\User::GetCurrentBalance() }} )
										</div>
									</div>
								</li>
								<li class="user message">
									<div class="info-box">
										<div class="info-box-content">
											@if(Auth::user()->name)
											<i class="fa fa-envelope-o" aria-hidden="true"></i>
											@endif 
										</div>
									</div>
								</li>
								<li class="user info">
									<ul class=" ml-auto">
										<li class="nav-item dropdown">
											<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
											<span class="welcom_auth"> Welcome {{ Auth::user()->name }}<span class="caret"></span></span> <span class="nav_icon_mobile"><i class="fa fa-bars" aria-hidden="true"></i></span> 
											</a>

											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
										 
												<a class="dropdown-item" href="{{ url('profile') }}" >
													My Profile
												</a>
												<br/>
												<a class="dropdown-item" href="{{ url('dashboard') }}" >
													My Projects
												</a>
												<br/>
												<a class="dropdown-item" href="{{ url('transaction') }}" >
													My Transactions
												</a>
											 
												<br/>
												<a class="dropdown-item" href="{{ route('logout') }}"
												   onclick="event.preventDefault();
																 document.getElementById('logout-form').submit();">
													{{ __('Logout') }}
												</a>

												<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
													@csrf
												</form>
												
												
											</div> 
										</li>
									</ul>	
								</li>
								<li class="header-get-a-quote">
									<a class="btn btn-primary" href="{!! url('post-a-project'); !!}">Post a Project</a>
								</li>								
							</ul>	
							@endguest	
						</div><!-- header right end -->
					</div><!-- logo area end -->

				</div><!-- Row end -->
			</div><!-- Container end -->

			<!-- here is menu -->


			<!--/ menu Navigation end -->
		</header>

		
		<!--/ Header end -->
		<div class="bidder-dashboard">
			@include('layouts.message')
		</div>
		
 
        @yield('content')
                 




		<footer id="footer" class="footer bg-overlay">
			<div class="footer-main">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-12 footer-widget footer-about">
							<h3 class="widget-title">About Us</h3>
							<a href="{{url('/')}}" >
							
							<!-- Footer left content start -->
							@php
								$footer_left = DB::table('posts')->where('post_type', 'footer_left')->first();
 
							@endphp
								<img style="max-width: 140px;" src="{{ asset('images/post/'.$footer_left->image) }}" alt="">
							</a>
							<p>{!!  $footer_left->discription  !!}</p>
							<div class="footer-social">
								<ul>
									<li><a href="https://facebook.com"><i class="fa fa-facebook"></i></a></li>
									<li><a href="https://twitter.com"><i class="fa fa-twitter"></i></a></li>
									<li><a href="https://instagram.com"><i class="fa fa-instagram"></i></a></li>
									<li><a href="https://github.com"><i class="fa fa-github"></i></a></li>
								</ul>
							</div><!-- Footer social end -->
						</div><!-- Col end -->

						<div class="col-md-4 col-sm-12 footer-widget">

							@php
							 $footer_middle =  DB::table('posts')->where('post_type', 'footer_middle')->first();
							@endphp

							<h3 class="widget-title">Working Hours</h3>
							<div class="working-hours">

							
							<!-- Footer middle start-->

									{!!  @$footer_middle->discription !!}

							<!-- Footer middle End-->

								<br><br> Monday - Friday: <span class="text-right">10:00 - 16:00 </span>
								<br> Saturday: <span class="text-right">12:00 - 15:00</span>
								<br> Sunday and holidays: <span class="text-right">09:00 - 12:00</span>
							</div>
						</div><!-- Col end -->

						<div class="col-md-4 col-sm-12 footer-widget">
							<h3 class="widget-title">Services</h3>
							@php 
								$services =  DB::table('posts')->where('post_type', 'service')->limit(4)->get();
							@endphp
							<ul class="list-arrow">
								@foreach($services as $val)
								 <li><a href="#">{!! $val->title !!}</a></li>
								@endforeach
							</ul>
						</div><!-- Col end -->


					</div><!-- Row end -->
				</div><!-- Container end -->
			</div><!-- Footer main end -->

			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="copyright-info">
								<span>Copyright © 2019 a theme by <a href="https://themefisher.com">themefisher.com</a></span>
							</div>
						</div>
					</div><!-- Row end -->

					<div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top affix">
						<button class="btn btn-primary" title="Back to Top">
							<i class="fa fa-angle-double-up"></i>
						</button>
					</div>

				</div><!-- Container end -->
			</div><!-- Copyright end -->

		</footer><!-- Footer end -->


		<!-- Javascript Files
	================================================== -->

		
		<!-- Bootstrap jQuery -->
		<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
		<!-- Owl Carousel -->
		<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
		<!-- Color box -->
		<script type="text/javascript" src="{{ asset('js/jquery.colorbox.js') }}"></script>
		<!-- Isotope -->
		<script type="text/javascript" src="{{ asset('js/isotope.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/ini.isotope.js') }}"></script>
		
		


    <!-- Google Map API Key-->
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
		<!-- Google Map Plugin-->
		<script type="text/javascript" src="{{ asset('js/gmap3.js') }}"></script>
 
	 <!-- Template custom -->
	 <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
	 <script type="text/javascript">
	 	$('.carousel-clients .clients').owlCarousel({
		    loop:true,
		    margin:10,
		    nav:false,
		    autoplay: true,
    		autoplayTimeout: 2000,
    		dots: true,
		    responsive:{
		        0:{
		            items:2
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:7
		        }
		    }
		})
	 </script>
	 <script type="text/javascript">
	 	$(document).ready(function(){
		   $(".apply_now").click(function(){
		      $(".apply_now_from").toggleClass("active");
		    });
		});
	 </script>
	</div><!-- Body inner end -->
</body>

</html>