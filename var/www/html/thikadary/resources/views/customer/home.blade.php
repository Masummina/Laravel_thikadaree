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

               <div class="post-content post-single post-details bidder-login">
                  <div class="post-body">
                     <div class="entry-header">
                     	<div class="row">
                     		<div class="running-project-header">
                     			<h4>Running Project</h4>
                     		</div>
                     	</div>
                     </div><!-- header end -->

                     <div class="entry-content">
                     	<div class="left-content">
							<a href="projectDetails.html">
		                        <h5 class="title"><div class="job-list" style="max-width: 40px">
		                          <img src="images/project/monitor.png">
		                        </div> Figma Designer </h5>
		                        <p>I am working on product prototype and looking for a Figma Expertise to design wireframes.</p>
		                        <div class="skills">
		                          <p><img src="images/project/skills.png"> Audio Services, Windows Desktop, Graphical User Interface (GUI)</p>
		                        </div>
	                        </a>
	                     </div>
	                     <div class="left-content">
							<a href="projectDetails.html">
	                        <h5 class="title"><div class="job-list" style="max-width: 40px">
	                          <img src="images/project/monitor.png">
	                        </div> Figma Designer </h5>
	                        <p>I am working on product prototype and looking for a Figma Expertise to design wireframes.</p>
	                        <div class="skills">
	                          <p><img src="images/project/skills.png"> Audio Services, Windows Desktop, Graphical User Interface (GUI)</p>
	                        </div>
	                        </a>
	                     </div>
	                    </div>
	                    <div class="bidAds">
	                    	<a href=""><img src="images/ads/bidsAds_01.jpg"></a> 
	                    </div>
                     
                  </div><!-- post-body end -->
               </div><!-- post content end -->

               <div class="post-content post-single post-details finance_acc">
                  <div class="post-body">
                     <div class="entry-content">
                     	<div class="finance-account">
	                      	<div class="row">
	                  			 
 								 <table class="table table-bordered">
								    <thead>
								      <tr>
								        <th>Finance</th>
								        <th>Account</th>
								      </tr>
								    </thead>
								    <tbody>
								      <tr>
								        <td>
								        	<div class="finance">
								        		<ul>
								        			<li><a href="">Balance</a></li>
								        			<li><a href="">Deposit Find</a></li>
								        			<li><a href="">Withdraw Find</a></li>
								        			<li><a href="">Transaction History</a></li>
								        		</ul>
								        	</div>
								        </td>
								        <td>
								        	<div class="finance">
								        		<ul>
								        			<li><a href="">View Profile</a></li>
								        			<li><a href="">Membership</a></li>
								        			<li><a href="">Withdraw Find</a></li>
								        			<li><a href="">Sittings</a></li>
								        			<li><a href="">Get Support From</a></li>
								        			<li><a href="">Log Out</a></li>
								        		</ul>
								        	</div>
								        </td>
								      </tr>
								    </tbody>
								  </table>

	                      	</div>
                      	</div>
                     </div>
                     
                  </div><!-- post-body end -->
               </div><!-- post content end -->

               <!-- Post comment start -->

       
         

            </div><!-- Content Col end -->


            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

               <div class="sidebar sidebar-right">



                  <div class="widget">
                     <h3 class="widget-title">Bid Summery</h3>
                     <ul class="arrow nav nav-tabs nav-stacked">
                   		<li><a href="#">Total Bids</a></li>
                        <li><a href="#">Pending</a></li>
                        <li><a href="#">On going Project</a></li>
                        <li><a href="{!! url('MyProject'); !!}">My Project</a></li>

                     </ul>
                  </div><!-- Categories end -->

                  <div class="widget">
                     <h3 class="widget-title">Pool</h3>
                     <strong>Our Query</strong>
                     <ul class="arrow nav nav-tabs nav-stacked">
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Commercial</a></li>
                        <li><a href="#">Building</a></li>
                     </ul>
                     <div class="skip-sub"><a class="btn btn-info" href="#">Skip Submit</a></div>
                     <a href=""></a>
                  </div><!-- Categories end -->

                  <div class="widget">
                     <h3 class="widget-title">Archives </h3>
                     <ul class="arrow nav nav-tabs nav-stacked">
                        <li><a href="#">Feburay 2016</a></li>
                        <li><a href="#">January 2016</a></li>
                        <li><a href="#">December 2015</a></li>
                        <li><a href="#">November 2015</a></li>
                        <li><a href="#">October 2015</a></li>
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


               </div><!-- Sidebar end -->
            </div><!-- Sidebar Col end -->

         </div><!-- Main row end -->

      </div><!-- Conatiner end -->
   </section><!-- Main container end -->

	
@endsection
