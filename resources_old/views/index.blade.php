@extends('layouts.app')

@section('content')

		<!-- Carousel -->
		<div id="main-slide" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			@php $i = -1; @endphp
			<ol class="carousel-indicators visible-lg visible-md">
				@foreach($homeinfo as $value)
					@if($value->post_type=='slider')
						@php 
						    $i++;
						    if($i == 1) $active = 'class="active"'; else $active = '';
						@endphp
						<li data-target="#main-slide" data-slide-to="{!! $i !!}" {!! $active !!} ></li> 
					@endif
				@endforeach
			</ol>
			<!--/ Indicators end-->

			<!-- Carousel inner -->
			<div class="carousel-inner">
				@php 
					$slidernun = 1;
					$slide_indicators = "";  
				@endphp
				@foreach($homeinfo as $value)
					 
					@if($value->post_type=='slider')
				<div class="item @if($slidernun==1) active @endif" style="background-image:url({{ asset('images/post') }}/{!! $value->image !!})">
					@php $slidernun++; @endphp
					<div class="slider-content text-left">
						<div class="col-md-12">
							<h2 class="slide-title animated6">{!! $value->title !!}</h2>
							<h3 class="slide-sub-title animated7">{!! $value->short_desc !!}</h3>
							<p class="slider-description lead animated7">{!! $value->discription !!}</p>
							<!-- <p>
								<a href="contact.html" class="slider btn btn-primary">Get Free Quote</a>
								<a href="about.html" class="slider btn btn-primary border">Learn More</a>
							</p> -->
						</div>
					</div>
				</div>
					@endif
				@endforeach




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
                @if(isset($homeinfo))
					@foreach($homeinfo as $client)
						@if($client->post_type=='client')
						<li>
							<a href="#">
							<img src=" {{asset('images/post')}}/{!! $client->image !!}" class="client-logo" alt="" />
							</a>
						</li>
						@endif
					@endforeach
				@endif
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
					<h3 class="section-sub-title">Need something ?</h3>
				</div>
				<!--/ Title row end -->
				<div class="row">
					@foreach($homeneed as $need)
					@if($need->post_type=='home_need')
					<div class="col-md-3 col-sm-3">
						<div class="ts-service-box text-center">
							<div class="ts-service-box-img">
								<img src="images/icon-image/{!! $need->image; !!}" alt="" />
							</div>
							<div class="ts-service-box-info">
								<h3 class="service-box-title">
								<a href="#">
									{!! $need->title; !!}
								</a></h3>
								
								

								<p class="ArticleBody">{{ substr(strip_tags($need->discription), 0, 100) }}
									{{ strlen(strip_tags($need->discription)) > 50 ? "..." : "" }} 
								</p>




							</div>
							@php
								$result = strtolower(str_replace(" ", "-", $need->title));
							@endphp
							<a href="{{url('need')}}/{{$result}}-{{$need->id}}" class=" btn btn-primary border">Read More</a>
						</div><!-- Service 1 end -->
					</div><!-- Col end -->
					@endif
					@endforeach 
				</div><!-- Content row end -->

			</div>
			<!--/ Container end -->
		</section><!-- Service end -->
		<!--/ News end -->

		<section id="news" class="news">
			<div class="container">
				<div class="row text-center">
					<h3 class="section-sub-title">Top Supplier/Contractor</h3>
				</div>
				<!--/ Title row end -->

				<div class="row home_ads">
					<ul class="itemes">
						@foreach($homeinfo as $tender)
						@if($tender->post_type=='tender')
							<li class="item">
								<div class="vendor_img">
									<img src="{{ asset('images/post') }}/{!! $tender->image !!}" alt="" />
								</div>
								<p><a href="#">{!! $tender->title !!}</a></p>
							</li>
						@endif
						@endforeach 
				
					</ul>
				</div>
				<!--/ Content row end -->
			</div>
			<!--/ Container end -->
		</section>
		<!--/ News end -->


 
@endsection
