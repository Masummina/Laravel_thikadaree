@extends('layouts.app')

@section('content')
 	
	<div class="bidder-dashboard">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="container">
					<div class="topnav" id="myTopnav">
					  <a href="#home">Dashboard</a>
					  <a href="#news">Inbox</a>
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
            	
               <div class="post-content post-single post-details">
                  <div class="post-body">
                  
                     <div class="entry-header">
                     	<div class="row">
                     		<div class="col-md-6 col-sm-6 left">
                     			<h4>Project Details</h4>
                     		</div>
                     		<div class="col-md-6 col-sm-6 right text-right">
                     			<strong class="detaile-price"><span class="rate">{!! $project_info->fixed_budget !!}<b> BDT</b> </span></strong>
                     		</div>
                     	</div>
                     </div><!-- header end -->
                      
                     <div class="entry-content">
                        <h3 class="title-post">
	
						            	{!! $projectId !!}
                          {!! $project_info->title !!}
                          
									       
                        </h3>
                        <p>
                        	{!! $project_info->discription !!}  
                        </p>
                     </div>
          
                     <div class="tags-area clearfix">
                     	<h5>Skills Required</h5>
                        <div class="post-tags pull-left">
                           {!! $project_info->skills !!}
                        </div>
                       
                     </div>

                    <div class="tags-area clearfix">
                        <div>
                        @if(isset($bid_list[0]))

                          <h5> Bid List </h5>
                           <table border="" style="width:100%">
                                 <tr>
                                     <th>Name</th>
                                     <th>Money</th>
                                     <th>Date</th>
                                     <th>status</th>
                                    
                                  </tr>
                                
                                   @foreach($bid_list as $val) 
                                    <tr>
                                      @php
                                      $result = strtolower(str_replace(" ", "-", $val->name));
                                      @endphp
                                        <td>

                                          <a href="{{url('users')}}/{{$result}}-{!! $val->user_id !!}?pid={{$projectId}}&prouid={!! $project_info->user_id !!}">{!! $val->name !!}</a>
                                          
                                        </td>
                                        <td>{!! $val->money; !!}</td>
                                        <td>{!! $val->created_at; !!}</td>

                                    
                                        <td>
                                          @if($project_info->win_bid_id == 0)
                                          <a href="{!! url('project-win/?project_id='.$project_info->id.'&bid_id='.$val->id) !!}" class="btn btn-primary btn-sm" > Hiring</a>
                                          @endif

                                           @if($val->win != 0) <b style="color: blue" > Hired </b>  @endif                                          
                                        </td>
                                     

                                    </tr>
                                     @endforeach 
                                @endif
                            </table>
                               
                        </div>
                     </div>
                 @if((session('status') && $project_info->user_id !=Auth::user()->id)&&($project_info->win_bid_id == 0))

                     <div class="tags-area clearfix">
                      <div class="pull-right ">
                        <button class="apply_now btn btn-success btn-lg">Apply Now</button>
                       </div>
                    </div>
                    @endif
                 </div><!-- post-body end -->
               </div><!-- post content end -->
              <div class="apply_now_from">
                <form action="" method="POST">
                   @csrf
                     <div class="post-content post-single post-details bid-project">
                        <div class="post-body">
                           <div class="entry-header">
                           	<div class="row">
                           		<div class="col-md-12 col-sm-12 left">
                           			<h4>Place a Bid on this Project</h4>
                           		</div>
                           	</div>
                           </div><!-- header end -->

                           <div class="entry-content">

                            <div class="title">Bid Details</div>
                            	<div class="bit-amount">
                            		<div class="row">

                                			<div class="col-md-6 col-sm-6 min-rate">
                                				<div class="form-group">
          									               <label for="pwd"><h5>Bid Amount:</h5> </label>
          									                <input type="number" class="form-control" id="pwd" name="money">
          									            </div>
                                			</div>
                                			<div class="col-md-6 col-sm-6 max-rate">
                                				<div class="form-group">
                											    <label for="pwd"><h5>This project will be delivered in:</h5></label>
                                          <input type="number" id="start" name="days" placeholder="delivary time" class="form-control">
                											  </div>
                                			</div>
                                			<div class="col-md-12 sug-milestone">
          	                      			
          	                      			<div class="form-group">
                  											  <label for="comment"> <h5>Suggest a milestone:</h5></label>
                  											  <p>Define the tasks that you will complete for this</p>
                  											  <textarea class="form-control" placeholder="What makes you the best candidate for this project?" rows="7" id="comment" name="discription"></textarea>

                  											</div>
                                        <div class="pull-right">
                                             <input type="submit" name="submit" value="submit" class="btn btn-primary btn-lg">
                                        </div>
                                        
                  										</div>

                            			
                            		</div>
                            	</div>
                           </div>
                           
                        </div><!-- post-body end -->
                     </div><!-- post content end -->
                    </form>
                  </div>
               <!-- Post comment start -->
               <div id="comments" class="comments-area">
                  <h3 class="comments-heading">07 Comments</h3>

                  <ul class="comments-list">
                     <li>
                        <div class="comment">
                           <img class="comment-avatar pull-left" alt="" src="{{ asset('images/news/avator1.png')}}">
                           <div class="comment-body">
                              <div class="meta-data">
                                 <span class="comment-author">Michelle Aimber</span>
                                 <span class="comment-date pull-right">January 17, 2016 at 1:38 pm</span>
                              </div>
                              <div class="comment-content">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehen.</p></div>
                              <div class="text-left">
                                 <a class="comment-reply" href="#">Reply</a>
                              </div>   
                           </div>
                        </div><!-- Comments end -->

                        <ul class="comments-reply">
                           <li>
                              <div class="comment">
                                 <img class="comment-avatar pull-left" alt="" src="{{ asset('images/news/avator2.png')}}">
                                 <div class="comment-body">
                                    <div class="meta-data">
                                       <span class="comment-author">Tom Harnandez</span>
                                       <span class="comment-date pull-right">January 17, 2016 at 1:38 pm</span>
                                    </div>
                                    <div class="comment-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehen.</p></div>
                                    <div class="text-left">
                                       <a class="comment-reply" href="#">Reply</a>
                                    </div>   
                                 </div>
                              </div><!-- Comments end -->
                           </li>
                        </ul><!-- comments-reply end -->
                           <div class="comment last">
                              <img class="comment-avatar pull-left" alt="" src="{{ asset('images/news/avator3.png')}}">
                              <div class="comment-body">
                                 <div class="meta-data">
                                    <span class="comment-author">Genelia Dusteen</span>
                                    <span class="comment-date pull-right">January 17, 2016 at 1:38 pm</span>
                                 </div>
                                 <div class="comment-content">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehen.</p></div>
                                 <div class="text-left">
                                    <a class="comment-reply" href="#">Reply</a>
                                 </div>   
                              </div>
                           </div><!-- Comments end -->
                     </li><!-- Comments-list li end -->
                  </ul><!-- Comments-list ul end -->
               </div><!-- Post comment end -->

               <div class="comments-form border-box">
                  <h3 class="title-normal">Add a comment</h3>

                  <form role="form">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <textarea class="form-control required-field" id="message" placeholder="Your Comment" rows="10" required></textarea>
                           </div>
                        </div><!-- Col 12 end -->

                        <div class="col-md-4">
                           <div class="form-group">
                              <input class="form-control" name="name" id="name" placeholder="Your Name" type="text" required>
                           </div>
                        </div><!-- Col 4 end -->

                        <div class="col-md-4">
                           <div class="form-group">
                              <input class="form-control" name="email" id="email" placeholder="Your Email" type="email" required>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group">
                              <input class="form-control" placeholder="Your Website" type="text" required>
                           </div>
                        </div>

                     </div><!-- Form row end -->
                     <div class="clearfix">
                        <button class="btn btn-primary" type="submit">Post Comment</button> 
                     </div>
                  </form><!-- Form end -->
               </div><!-- Comments form end -->

         

            </div><!-- Content Col end -->


            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

               <div class="sidebar sidebar-right">


                  <div class="widget recent-posts">
                     <h3 class="widget-title">Recent Posts</h3>
                     <ul class="unstyled clearfix">
                        <li>
                          <div class="posts-thumb pull-left"> 
                              <a href="#"><img alt="img" src="{{ asset('images/news/news1.jpg')}}"></a>
                          </div>
                          <div class="post-info">
                              <h4 class="entry-title">
                                 <a href="#">We Just Completes $17.6 Million Medical Clinic In Mid-missouri</a>
                              </h4>
                          </div>
                          <div class="clearfix"></div>
                        </li><!-- 1st post end-->

                        <li>
                          <div class="posts-thumb pull-left"> 
                              <a href="#"><img alt="img" src="{{ asset('images/news/news2.jpg')}}"></a>
                          </div>
                          <div class="post-info">
                              <h4 class="entry-title">
                                 <a href="#">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                              </h4>
                          </div>
                          <div class="clearfix"></div>
                        </li><!-- 2nd post end-->

                        <li>
                          <div class="posts-thumb pull-left"> 
                              <a href="#"><img alt="img" src="{{ asset('images/news/news3.jpg')}}"></a>
                          </div>
                          <div class="post-info">
                              <h4 class="entry-title">
                                 <a href="#">Silicon Bench And Cornike Begin Construction Solar Facilities</a>
                              </h4>
                          </div>
                          <div class="clearfix"></div>
                        </li><!-- 3rd post end-->

                     </ul>
                     
                  </div><!-- Recent post end -->

                  <div class="widget">
                     <h3 class="widget-title">Categories</h3>
                     <ul class="arrow nav nav-tabs nav-stacked">
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Commercial</a></li>
                        <li><a href="#">Building</a></li>
                        <li><a href="#">Safety</a></li>
                        <li><a href="#">Structure</a></li>
                     </ul>
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
