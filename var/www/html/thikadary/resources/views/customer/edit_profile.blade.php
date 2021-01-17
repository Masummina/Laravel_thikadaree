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
				<form action="" method="post">
					<h2>Add Your information.</h2>
					<div class="form-group">
						<label for="username">User Name</label>
						<input type="text" value="<?php echo Auth::user()->name; ?>" class="form-control" name="username" placeholder="User Name" required="required">
					</div>
					<div class="form-group">
						<label for="user_id">Profile Picture</label>
						<input type="file" class="form-control" name="images" placeholder="images " required="required">
					</div>

					<div class="form-group">
						<label for="user_id">Address</label>
						<input type="text" class="form-control" name="address" placeholder="address " required="required">
					</div>


					<div class="form-group">
						<label for="user_id">Mobile Number</label>
						<input type="number" class="form-control" name="mobile" placeholder="Mobile " required="required">
					</div>
					<div class="form-group">
						<label for="user_id">Select District</label>
						<select name="district">
						  <option value="dhaka">Dhaka</option>
						  <option value="khulna">Khulna</option>
						  <option value="comilla">Comilla</option>
						  <option value="borishal">Borishal</option>
						  <option value="sylhet">Sylhet</option>
						</select>
					</div>
					<div class="form-group">
						<label for="user_id">Details</label>
						<input type="text" class="form-control" name="details" placeholder="Details">
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" name="skills" placeholder="skills " required="required">
					</div>			
 
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block">Submit</button>
					</div>
					@csrf
				</form>

       
         

            </div><!-- Content Col end -->

 
         </div><!-- Main row end -->

      </div><!-- Conatiner end -->
   </section><!-- Main container end -->

	
@endsection
