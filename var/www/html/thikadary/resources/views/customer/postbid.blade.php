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
					<h2> Project Bid </h2>
					<p class="hint-text">Create your account. It's free and only takes a minute.</p>
					 
					 


					<div class="form-group">
						<input type="text" class="form-control" name="money" placeholder="Expected Money">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="discription" placeholder="discription" required="required">
					</div>
					
					<div class="form-group">
						<input type="hidden" name="project_id" value="1">
						<button type="submit" class="btn btn-success btn-lg btn-block"> Submit </button>
					</div>
					@csrf
				</form>

       
         

            </div><!-- Content Col end -->

 
         </div><!-- Main row end -->

      </div><!-- Conatiner end -->
   </section><!-- Main container end -->

	
@endsection
