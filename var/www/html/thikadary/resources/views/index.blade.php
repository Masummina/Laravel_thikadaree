@extends('layouts.app')

@section('content')

		<!-- Carousel -->
		<div id="main-slide" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			<ol class="carousel-indicators visible-lg visible-md">
				<li data-target="#main-slide" data-slide-to="0" class="active"></li>
				<li data-target="#main-slide" data-slide-to="1"></li>
				<li data-target="#main-slide" data-slide-to="2"></li>
			</ol>
			<!--/ Indicators end-->

			<!-- Carousel inner -->
			<div class="carousel-inner">

				<div class="item active" style="background-image:url(images/slider-main/bg1.jpg)">
					<div class="slider-content">
						<div class="col-md-12 text-left margin-left-text">
							<h2 class="slide-title animated4">17 Years of excellence in</h2>
							<h3 class="slide-sub-title animated5">Hire the best Contractor for any job.</h3>
							<p>
								<a href="services.html" class="slider btn btn-primary">Our Services</a>
								<a href="contact.html" class="slider btn btn-primary border">Contact Now</a>
							</p>
						</div>
					</div>
				</div>
				<!--/ Carousel item 1 end -->

				<div class="item" style="background-image:url(images/slider-main/bg2.jpg)">
					<div class="slider-content text-left">
						<div class="col-md-12">
							<h2 class="slide-title-box animated2">World Class Service</h2>
							<h3 class="slide-title animated3">When Service Matters</h3>
							<h3 class="slide-sub-title animated3">Your Choice is Simple</h3>
							<p class="animated3">
								<a href="services.html" class="slider btn btn-primary border">Our Services</a>
							</p>
						</div>
					</div>
				</div>
				<!--/ Carousel item 2 end -->

				<div class="item" style="background-image:url(images/slider-main/bg3.jpg)">
					<div class="slider-content text-left">
						<div class="col-md-12">
							<h2 class="slide-title animated6">Meet Our Engineers</h2>
							<h3 class="slide-sub-title animated7">We believe sustainability</h3>
							<p class="slider-description lead animated7">We will deal with your failure that determines how you
								achieve success.</p>
							<p>
								<a href="contact.html" class="slider btn btn-primary">Get Free Quote</a>
								<a href="about.html" class="slider btn btn-primary border">Learn More</a>
							</p>
						</div>
					</div>
				</div>
				<!--/ Carousel item 3 end -->

			</div><!-- Carousel inner end-->

			<!-- Controllers -->
			<a class="left carousel-control" href="#main-slide" data-slide="prev">
				<span><i class="fa fa-angle-left"></i></span>
			</a>
			<a class="right carousel-control" href="#main-slide" data-slide="next">
				<span><i class="fa fa-angle-right"></i></span>
			</a>
		</div>
		<!--/ Carousel end -->


		<!-- client satisfaction	 -->

	<section class="callaction">
      <div class="container">
        <div class="row">
                  <div class="row">
          <div class="carousel-clients">
            <h4 class="satisfied">Satisfied clients</h4>
            <ul id="mycarousel" class="jcarousel-skin-tango recent-jcarousel clients owl-carousel">
              <li>
                <a href="#">
		          <img src="images/dummies/clients/client1.png" class="client-logo" alt="" />
		          </a>
              </li>
              <li>
                <a href="#">
		          <img src="images/dummies/clients/client2.png" class="client-logo" alt="" />
		          </a>
              </li>
              <li>
                <a href="#">
          <img src="images/dummies/clients/client3.png" class="client-logo" alt="" />
          </a>
              </li>
              <li>
                <a href="#">
		          <img src="images/dummies/clients/client4.png" class="client-logo" alt="" />
		          </a>
              </li>
              <li>
                <a href="#">
		          <img src="images/dummies/clients/client5.png" class="client-logo" alt="" />
		          </a>
              </li>
              <li>
                <a href="#">
		          <img src="images/dummies/clients/client6.png" class="client-logo" alt="" />
		          </a>
              </li>
              <li>
                <a href="#">
		          <img src="images/dummies/clients/client1.png" class="client-logo" alt="" />
		          </a>
              </li>
              <li>
                <a href="#">
		          <img src="images/dummies/clients/client2.png" class="client-logo" alt="" />
		          </a>
              </li>
              <li>
                <a href="#">
	          <img src="images/dummies/clients/client3.png" class="client-logo" alt="" />
	          </a>
              </li>
              <li>
                <a href="#">
                <img src="images/dummies/clients/client4.png" class="client-logo" alt="" />
                </a>
              </li>
              <li>
                <a href="#">
                <img src="images/dummies/clients/client5.png" class="client-logo" alt="" />
                </a>
              </li>
              <li>
                <a href="#">
                <img src="images/dummies/clients/client6.png" class="client-logo" alt="" />
                </a>
              </li>
            </ul>
          </div>
        </div>
        </div>
      </div>
    </section>

	<!-- client satisfaction	 -->


		<section id="ts-service-area" class="ts-service-area">
			<div class="container">
				<div class="row text-center">
					<h3 class="section-sub-title">Need something done?</h3>
				</div>
				<!--/ Title row end -->

				<div class="row">
					<div class="col-md-4">
						<div class="ts-service-box text-center">
							<div class="ts-service-box-img">
								<img src="images/icon-image/service-icon2.png" alt="" />
							</div>
							<div class="ts-service-box-info">
								<h3 class="service-box-title"><a href="#">Home Construction</a></h3>
								<p>Lorem ipsum dolor sit amet consectetur adipiscing elit Integer adipiscing erat</p>
							</div>
							<a href="contact.html" class=" btn btn-primary border">Read More</a>
						</div><!-- Service 1 end -->

					</div><!-- Col end -->

					<div class="col-md-4 text-center">
						<div class="ts-service-box text-center">
							<div class="ts-service-box-img">
								<img src="images/icon-image/service-icon1.png" alt="" />
							</div>
							<div class="ts-service-box-info">
								<h3 class="service-box-title"><a href="#">Home Construction</a></h3>
								<p>Lorem ipsum dolor sit amet consectetur adipiscing elit Integer adipiscing erat</p>
							</div>
							<a href="contact.html" class=" btn btn-primary border">Read More</a>
						</div><!-- Service 1 end -->
					</div><!-- Col end -->

					<div class="col-md-4">
						<div class="ts-service-box text-center">
							<div class="ts-service-box-img">
								<img src="images/icon-image/service-icon5.png" alt="" />
							</div>
							<div class="ts-service-box-info">
								<h3 class="service-box-title"><a href="#">Home Construction</a></h3>
								<p>Lorem ipsum dolor sit amet consectetur adipiscing elit Integer adipiscing erat</p>
							</div>
							<a href="#" class=" btn btn-primary border">Read More</a>
						</div><!-- Service 1 end -->
					</div><!-- Col end -->
				</div><!-- Content row end -->

			</div>
			<!--/ Container end -->
		</section><!-- Service end -->
		<!--/ News end -->

		<section id="news" class="news">
			<div class="container">
				<div class="row text-center">
					<h2 class="section-title">Work of Excellence</h2>
					<h3 class="section-sub-title">Here are some of our most popular projects.</h3>
				</div>
				<!--/ Title row end -->

				<div class="row">
					<div class="col-md-4 col-xs-12">
						<div class="latest-post">
							<div class="latest-post-media">
								<a href="news-single.html" class="latest-post-img">
									<img class="img-responsive" src="images/news/news1.jpg" alt="img">
									<div class="middle">
									    <div class="text"> View This Project </div>
									  </div>
								</a>
							</div>
							<div class="post-body">
								<h4 class="post-title">
									<a href="news-single.html">We Just Completes $17.6 million Medical Clinic in Mid-Missouri</a>
								</h4>
								<div class="latest-post-meta">
									<span class="post-item-date">
										<i class="fa fa-clock-o"></i> July 20, 2017
									</span>
								</div>
							</div>
						</div><!-- Latest post end -->
					</div><!-- 1st post col end -->

					<div class="col-md-4 col-xs-12">
						<div class="latest-post">
							<div class="latest-post-media">
								<a href="news-single.html" class="latest-post-img">
									<img class="img-responsive" src="images/news/news2.jpg" alt="img">
									<div class="middle">
									    <div class="text"> View This Project </div>
									  </div>
								</a>
							</div>
							<div class="post-body">
								<h4 class="post-title">
									<a href="news-single.html">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
								</h4>
								<div class="latest-post-meta">
									<span class="post-item-date">
										<i class="fa fa-clock-o"></i> June 17, 2017
									</span>
								</div>
							</div>
						</div><!-- Latest post end -->
					</div><!-- 2nd post col end -->
					<div class="col-md-4 col-xs-12">
						<div class="latest-post">
							<div class="latest-post-media">
								<a href="news-single.html" class="latest-post-img">
									<img class="img-responsive" src="images/news/news1.jpg" alt="img">
									<div class="middle">
									    <div class="text"> View This Project </div>
									  </div>
								</a>
							</div>
							<div class="post-body">
								<h4 class="post-title">
									<a href="news-single.html">We Just Completes $17.6 million Medical Clinic in Mid-Missouri</a>
								</h4>
								<div class="latest-post-meta">
									<span class="post-item-date">
										<i class="fa fa-clock-o"></i> July 20, 2017
									</span>
								</div>
							</div>
						</div><!-- Latest post end -->
					</div><!-- 1st post col end -->

					<div class="col-md-4 col-xs-12">
						<div class="latest-post">
							<div class="latest-post-media">
								<a href="news-single.html" class="latest-post-img">
									<img class="img-responsive" src="images/news/news3.jpg" alt="img">
									<div class="middle">
									    <div class="text"> View This Project </div>
									  </div>
								</a>
							</div>
							<div class="post-body">
								<h4 class="post-title">
									<a href="news-single.html">Silicon Bench and Cornike Begin Construction Solar Facilities</a>
								</h4>
								<div class="latest-post-meta">
									<span class="post-item-date">
										<i class="fa fa-clock-o"></i> Aug 13, 2017
									</span>
								</div>
							</div>
						</div><!-- Latest post end -->
					</div><!-- 3rd post col end -->
					<div class="col-md-4 col-xs-12">
						<div class="latest-post">
							<div class="latest-post-media">
								<a href="news-single.html" class="latest-post-img">
									<img class="img-responsive" src="images/news/news1.jpg" alt="img">
									<div class="middle">
									    <div class="text"> View This Project </div>
									  </div>
								</a>
							</div>
							<div class="post-body">
								<h4 class="post-title">
									<a href="news-single.html">We Just Completes $17.6 million Medical Clinic in Mid-Missouri</a>
								</h4>
								<div class="latest-post-meta">
									<span class="post-item-date">
										<i class="fa fa-clock-o"></i> July 20, 2017
									</span>
								</div>
							</div>
						</div><!-- Latest post end -->
					</div><!-- 1st post col end -->
					<div class="col-md-4 col-xs-12">
						<div class="latest-post">
							<div class="latest-post-media">
								<a href="news-single.html" class="latest-post-img">
									<img class="img-responsive" src="images/news/news3.jpg" alt="img">
									<div class="middle">
									    <div class="text"> View This Project </div>
									  </div>
								</a>
							</div>
							<div class="post-body">
								<h4 class="post-title">
									<a href="news-single.html">Silicon Bench and Cornike Begin Construction Solar Facilities</a>
								</h4>
								<div class="latest-post-meta">
									<span class="post-item-date">
										<i class="fa fa-clock-o"></i> Aug 13, 2017
									</span>
								</div>
							</div>
						</div><!-- Latest post end -->
					</div><!-- 3rd post col end -->

				</div>
				<!--/ Content row end -->

				<div class="general-btn text-center">
					<a class="btn btn-primary" href="news-left-sidebar.html">See All Projects</a>
				</div>

			</div>
			<!--/ Container end -->
		</section>
		<!--/ News end -->

		<!--/ Start different categories -->


		<section id="different-categories" class="different-categories">
			<div class="container">
				<div class="row text-center">
					<h2 class="section-title">Work of Excellence</h2>
					<h3 class="section-sub-title">Here are some of our most popular projects.</h3>
				</div>
				<!--/ Title row end -->

				<div class="row">
					<div class="col-md-8 col-sm-12 categories">
						<div class="row">
							<div class="col-md-4 col-sm-6 single-list">
								<a href="#">
									<img src="images/home/hire-data-processing.svg">
									<h4>Website Design</h4>
								</a>
							</div>
							<div class="col-md-4 col-sm-6 single-list">
								<a href="#">
									<img src="images/home/hire-website-design-v2.svg">
									<h4>Website Design</h4>
								</a>
							</div>
							<div class="col-md-4 col-sm-6 single-list">
								<a href="#">
									<img src="images/home/hire-website-design-v2.svg">
									<h4>Website Design</h4>
								</a>
							</div>
							<div class="col-md-4 col-sm-6 single-list">
								<a href="#">
									<img src="images/home/hire-data-processing.svg">
									<h4>Website Design</h4>
								</a>
							</div>
							<div class="col-md-4 col-sm-6 single-list">
								<a href="#">
									<img src="images/home/hire-website-design-v2.svg">
									<h4>Website Design</h4>
								</a>
							</div>
							<div class="col-md-4 col-sm-6 single-list">
								<a href="#">
									<img src="images/home/hire-data-processing.svg">
									<h4>Website Design</h4>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 categories-ad">
						<img style="max-width: 100%;" src="images/news/team1.jpg">
					</div>
				</div>
			</div>
		</section>

		<!--/ Start different categories -->


 
@endsection
