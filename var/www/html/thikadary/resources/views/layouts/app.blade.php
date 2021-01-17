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

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<div class="body-inner">
		<!-- Header start -->
		<header id="header" class="header-one">
			<div class="container">
				<div class="row">
					<div class="logo-area clearfix">
						<div class="logo col-xs-12 col-md-5">
							<a href="{{url('/')}}" >
								<img style="max-width: 140px;" src="{{asset ('images/home/thikadari.png')}}" alt="">
							</a>
							<div class="browse btn-lg" data-toggle="modal" data-target="#myModal">
								<a href="#"><i class="fa fa-search"></i>Job Browse</a>
							</div>
							<div class="browse work">
								<a href="#">How It Works?</a>
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
							      <div class="top-header-content">
						              <form class="form-search">
						                  <input placeholder="Type something" type="text" class="input-medium search-query">
						                  <button type="submit" class="btn btn-square btn-theme">Search</button>
						                </form>
						            </div>
							      </div>
							      <div class="modal-body">
							        <div class="brows-job">

							        	<div class="jobtitle"> <h6>SEARCH BY TYPE</h6> </div>
							        	<div class="row">
							        		<div class="col-md-4">
							        			<a href="{{url('projects')}}">
					                             <div class="img-left">
					                               <img src="images/home/browse-portfolios-v2.svg">
					                             </div>
					                              <div class="con-right">
					                                <p class="title">Project</p>
					                                <p> Browse available projects to work on </p>
					                              </div>
					                            </a>
							        		</div>	
							        		<div class="col-md-4">
							        			<a href="projects.html">
					                             <div class="img-left">
					                               <img src="images/home/browse-portfolios-v2.svg">
					                             </div>
					                              <div class="con-right">
					                                <p class="title">Project</p>
					                                <p> Browse available projects to work on </p>
					                              </div>
					                            </a>
							        		</div>
							        		<div class="col-md-4">
							        			<a href="projects.html">
					                             <div class="img-left">
					                               <img src="images/home/browse-portfolios-v2.svg">
					                             </div>
					                              <div class="con-right">
					                                <p class="title">Project</p>
					                                <p> Browse available projects to work on </p>
					                              </div>
					                            </a>
							        		</div>
							        	</div>
							        		<div class="jobtitle"> <h6>SEARCH BY TYPE</h6> </div>
							        	<div class="row">
							        		<div class="col-md-4">
							        			<a href="projects.html">
					                             <div class="img-left">
					                               <img src="images/home/browse-portfolios-v2.svg">
					                             </div>
					                              <div class="con-right">
					                                <p class="title">Project</p>
					                                <p> Browse available projects to work on </p>
					                              </div>
					                            </a>
							        		</div>	
							        		<div class="col-md-4">
							        			<a href="projects.html">
					                             <div class="img-left">
					                               <img src="images/home/browse-portfolios-v2.svg">
					                             </div>
					                              <div class="con-right">
					                                <p class="title">Project</p>
					                                <p> Browse available projects to work on </p>
					                              </div>
					                            </a>
							        		</div>
							        		<div class="col-md-4">
							        			<a href="projects.html">
					                             <div class="img-left">
					                               <img src="images/home/browse-portfolios-v2.svg">
					                             </div>
					                              <div class="con-right">
					                                <p class="title">Project</p>
					                                <p> Browse available projects to work on </p>
					                              </div>
					                            </a>
							        		</div>
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
								<li class="user">
									<div class="info-box">
										<div class="info-box-content">
											Welcome {{ Auth::user()->name }} 
										</div>
									</div>
								</li>
								<li class="user">
									<ul class=" ml-auto">
										<li class="nav-item dropdown">
											<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
												My Account <span class="caret"></span>
											</a>

											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
										 
												<a class="dropdown-item" href="{{ url('profile') }}" >
													Profile
												</a>
												<br/>
												<a class="dropdown-item" href="{{ url('dashboard') }}" >
													Dashboard
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
								<img style="max-width: 140px;" src="{{asset ('images/home/thikadari.png')}}" alt="">
							</a>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inci done idunt ut
								labore et dolore magna aliqua.</p>
							<div class="footer-social">
								<ul>
									<li><a href="https://facebook.com/themefisher"><i class="fa fa-facebook"></i></a></li>
									<li><a href="https://twitter.com/themefisher"><i class="fa fa-twitter"></i></a></li>
									<li><a href="https://instagram.com/themefisher"><i class="fa fa-instagram"></i></a></li>
									<li><a href="https://github.com/themefisher"><i class="fa fa-github"></i></a></li>
								</ul>
							</div><!-- Footer social end -->
						</div><!-- Col end -->

						<div class="col-md-4 col-sm-12 footer-widget">
							<h3 class="widget-title">Working Hours</h3>
							<div class="working-hours">
								We work 7 days a week, every day excluding major holidays. Contact us if you have an emergency, with our
								Hotline and Contact form.
								<br><br> Monday - Friday: <span class="text-right">10:00 - 16:00 </span>
								<br> Saturday: <span class="text-right">12:00 - 15:00</span>
								<br> Sunday and holidays: <span class="text-right">09:00 - 12:00</span>
							</div>
						</div><!-- Col end -->

						<div class="col-md-4 col-sm-12 footer-widget">
							<h3 class="widget-title">Services</h3>
							<ul class="list-arrow">
								<li><a href="service-single.html">Pre-Construction</a></li>
								<li><a href="service-single.html">General Contracting</a></li>
								<li><a href="service-single.html">Construction Management</a></li>
								<li><a href="service-single.html">Design and Build</a></li>
								<li><a href="service-single.html">Self-Perform Construction</a></li>
							</ul>
						</div><!-- Col end -->


					</div><!-- Row end -->
				</div><!-- Container end -->
			</div><!-- Footer main end -->

			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="copyright-info">
								<span>Copyright © 2019 a theme by <a href="https://themefisher.com">themefisher.com</a></span>
							</div>
						</div>

						<div class="col-xs-12 col-sm-6">
							<div class="footer-menu">
								<ul class="nav unstyled">
									<li><a href="about.html">About</a></li>
									<li><a href="team.html">Our people</a></li>
									<li><a href="faq.html">Faq</a></li>
									<li><a href="news-left-sidebar.html">Blog</a></li>
									<li><a href="pricing.html">Pricing</a></li>
								</ul>
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

		<!-- initialize jQuery Library -->
		<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
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