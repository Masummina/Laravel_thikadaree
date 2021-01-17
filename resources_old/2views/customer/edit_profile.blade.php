@extends('layouts.app')

@section('content')
 	
	<div class="bidder-dashboard">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="container">
					<div class="topnav" id="myTopnav">
					  <a href="{{url('dashboard')}}">Dashboard</a>
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
				<form action="" method="post" enctype="multipart/form-data">
					<h2>Add Your information.</h2>
					<div class="form-group">
						<label for="username">User Name</label>
						<input type="text" value="<?php if(isset(Auth::user()->name)){ echo Auth::user()->name; }  ?>" class="form-control" name="username" placeholder="User Name" required="required">
					</div>

					<div class="form-group">
						<label for="professional">Professional Headline</label>
						<input type="text" value="{!! @$profile_info->professional !!}" class="form-control" name="professional" placeholder="Professional headline">
					</div>

					<div class="form-group">
						<label for="user_id">Profile Picture</label>
						<input type="file" class="form-control" name="images" placeholder="images ">
						<div class="proimg">
							@if(@$profile_info->professional)
							<img src="{{asset('images/upload/profile')}}/{!! $profile_info->images !!}" alt="">
							@else
							<p>No Profile Image</p>
							@endif
						</div>
						
					</div>

					<div class="form-group">
						<label for="user_id">Address</label>
						<input type="text" class="form-control"  value="{!! @$profile_info->address !!}" name="address" placeholder="address">
					</div>

					<!-- address start -->

					<div class="form-group">
						<label for="skills">Skills</label>
						<input type="text" class="form-control" value="{!! @$profile_info->skills !!}" name="skills" placeholder="skills " required="required">
					</div>	

					<div class="form-group">
						<label for="user_id">Summary</label>
						<textarea  type="text" class="form-control" name="details" placeholder="Details">{!! @$profile_info->details !!}</textarea >
					</div>

					<!-- Trade License start -->

					<div class="form-group">
						<label for="trade_id">Trade License</label>
						<div class="tradeLicense">
							<input type="text" class="form-control name" value="{!! @$profile_info->trade_name !!}" name="trade_name" placeholder="Enter Trade Name">
							<input type="file" class="form-control image" name="trade_image">
						</div>
					</div>

					<div class="proimg">
						@if(@$profile_info->trade_image)
						<img src="{{asset('images/upload/cartificate')}}/{!! $profile_info->trade_image !!}" alt="">
						@else
						<p>No Image</p>
						@endif
					</div>

					<!-- VAT start -->

					<div class="form-group">
						<label for="trade_id">VAT</label>
						<div class="vatLicense">
							<input type="text" class="form-control name" value="{!! @$profile_info->vat_name !!}" name="vat_name" placeholder="Enter Name">
							<input type="file" class="form-control image" name="vat_image">
						</div>
					</div>

					<div class="proimg">
						@if(@$profile_info->vat_image)
						<img src="{{asset('images/upload/cartificate')}}/{!! $profile_info->vat_image !!}" alt="">
						@else
						<p>No Image</p>
						@endif
					</div>

					<!-- Tin start -->

					<div class="form-group">
						<label for="trade_id">Tin</label>
						<div class="vatLicense">
							<input type="text" class="form-control name" value="{!! @$profile_info->tin_name !!}" name="tin_name" placeholder="Enter Name">
							<input type="file" class="form-control image" name="tin_image">
						</div>
					</div>

					<div class="proimg">
						@if(@$profile_info->tin_image)
						<img src="{{asset('images/upload/cartificate')}}/{!! $profile_info->tin_image !!}" alt="">
						@else
						<p>No Image</p>
						@endif
					</div>

					<!-- Other start -->

					<a class="btn add_moreButton btn-info" id="add_other_cartificate">Add More</a>

					<div class="other_cartificate">
						<!-- pwd start -->
						<div class="form-group">
							<label for="trade_id">PWD</label>
							<div class="vatLicense">
								<input type="text" value="{!! @$profile_info->pwd_name !!}" class="form-control name" name="pwd_name" placeholder="Enter Name">
								<input type="file" class="form-control image" name="pwd_image">
							</div>
						</div>
						<div class="proimg">
							@if(@$profile_info->pwd_image)
							<img src="{{asset('images/upload/cartificate')}}/{!! $profile_info->pwd_image !!}" alt="">
							@else
							<p>No Image</p>
							@endif
						</div>
						<!-- Liquid start -->
						<div class="form-group">
							<label for="trade_id">Liquid Asset</label>
							<div class="vatLicense">
								<input type="number" value="{!! @$profile_info->liquid_asset !!}" class="form-control" name="liquid_asset" placeholder="Enter Name">
							</div>
						</div>
						<div class="form-group">
							<label for="trade_id">Other Cartificate</label>
							<div class="vatLicense">
						        <input type="text" class="form-control name" name="other_name" placeholder="Enter Name">
								<input type="file" class="form-control image" name="other_image">
							</div>
						</div>
						<div class="proimg">
							@if(@$profile_info->other_image)
							<img src="{{asset('images/upload/cartificate')}}/{!! $profile_info->other_image !!}" alt="">
							@else
							<p>No Image</p>
							@endif
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block">Submit</button>
					</div>
					@csrf
				</form>

       
         

            </div><!-- Content Col end -->

 
         </div><!-- Main row end -->

	  </div><!-- Conatiner end -->
	  <script>
		$(document).ready(function(){
		$(".btn.add_moreButton").click(function(){
			$(".other_cartificate").toggleClass("showdiv");
		});
		});
		</script>
   </section><!-- Main container end -->

	
@endsection
