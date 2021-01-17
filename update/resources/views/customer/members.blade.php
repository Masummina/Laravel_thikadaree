

@extends('layouts.app')



@section('content')





   <section id="main-container" class="main-container">

		<div class="container">

			<div class="row">



				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">



					<div class="sidebar sidebar-left">
						<div class="widget">

							<h3 class="widget-title">Categories</h3>

							<ul class="arrow nav nav-tabs nav-stacked">

									



											 

							</ul>

						</div><!-- Categories end -->

							<div class="widget recent-posts">
								<h3 class="widget-title">Recent Posts</h3>
							</div><!-- Recent post end -->



					</div><!-- Sidebar end -->

				</div><!-- Sidebar Col end -->



				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 post-all-content-right">

					<div class="post-search">

						<div class="row">

							<div class="left col-md-9 col-sm-9">
								<span class="search">

									<i class="fa fa-search"></i>

									<input type="text" placeholder="Search..">

								</span>
							</div>

						</div>

					</div>



                     

		

			    @foreach($allmembers as $val)

					<div class="post">

						<div class="post-body">

							<div class="left-content">

										  

								@php

									$userdetails = strtolower(str_replace(" ", "-", $val->name));

								@endphp



								<a href="{{url('users')}}/{{$userdetails}}-{!! $val->id !!}">

		                        <h5 class="title">

 

		                          <div class="job-list" style="max-width: 40px">

		                            <img src="images/project/monitor.png">

		                          </div> 

	

								     	{!! $val->name !!}

								

                                </h5>







                                

		                            <p><b>Email: </b>

		                        

									{!! $val->email !!}

								

		                           </p>

		                        <div class="open-status">

		                          <div class="open op-st">

		                            <p class="con"><b>Mobile:</b> {!! $val->mobile !!} </p>

		                          </div>

		                          <div class="districe">

		                        	   <p><b>District:</b> {!! $val->district !!}</p>

		                        </div>

		                         

		                        </div>

		                         <div class="address op-st">

		                            <p><b>address:</b> {!! $val->address !!}</p>

		                          </div>



		                        



		                        <div class="skills">

		                          <p><img src="images/project/skills.png"> <b>Skills:</b>



		                          	{!! $val->skills !!}



		                          </p>

		                          <p> <b>Details: </b> {!! $val->details !!}</p>

		                        </div>

		                        </a>

		                      </div>

						</div><!-- post-body end -->

					</div><!-- 1st post end -->
				@endforeach

           

			    

				

					<div class="paging">

			            <ul class="pagination">

			              <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>

			              <li class="active"><a href="#">1</a></li>

			              <li><a href="#">2</a></li>

			              <li><a href="#">3</a></li>

			              <li><a href="#">4</a></li>

			              <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>

			            </ul>

		          	</div>



				</div><!-- Content Col end -->



			</div><!-- Main row end -->



		</div><!-- Container end -->

	</section><!-- Main container end -->

	

	

@endsection











