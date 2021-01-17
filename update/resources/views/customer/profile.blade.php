@extends('layouts.app')

@section('content')
<div class="profile-bg">
    <div class="image">
        <img style="width: 100%;" src="{{ asset('images/banner/banner1.jpg') }} " alt="">
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="user-profile" style="padding: 20px 0">
    <div class="container">
        <div class="pro-left col-md-12 col-sm-8">
            <div class="details">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="porfile_imf">
                        @if(@$userPro->images)
                         <img style="width: 100%;" src="{{url('images/upload/profile')}}/{!! @$userPro->images !!}" alt="">
                         @else
                         <img style="width: 100%;" src="{{url('images/upload/profile/default.png')}}" alt="">
                        @endif
                         
                    </div>
                   
                    <div class="profile_info">
                         <p class="gmail"><b>Email:</b>  {{ Auth::user()->email }}</p>
                            <p class="mobile">
                                <b>Phone: </b> 
                                {!! @$userPro->mobile !!}
                        </p>
                        <p class="mobile"> <b>Skills: </b><span>{!! @$userPro->skills !!}</span></p>
                        <p class="mobile">Address:  <span>{!! @$userPro->address !!}</span></p>
                        <p class="mobile"><b>National ID:</b>   <span>Varified</span></p>
                    </div>

                </div>
                <div class="col-md-9 col-sm-9 profile_right">
                    <div class="pull-right">
                       <a href="{{ url('editprofile') }}" class="btn btn-success">Edit Profile</a>
                    </div>
                    <div class="row top_section">
                    <div class="Auth">
                        <h3> {{ Auth::user()->name }}</h3>
                    </div>

                    <div class="professional">
                        <p>{!! @$userPro->professional  !!}</p>
                    </div>
                     
                    <!--  Review start -->

                                           <div class="view_rating">
                       <span class="review-stars" style="color: #1e88e5;">
                        @php
                          $review = 4;
                        @endphp
                      <!-- ////////////// STAR RATE CHECKER ////////////// -->
                          @if($review <= 0)
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review === 1)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review === 2)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review === 3)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review === 4)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                          @elseif($review >= 5)
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                          @endif
                          <!-- ///////////////////////////////////////////// -->
                      </span>
                     </div>

                     <!-- review End -->

                    <p class="short-dis">
                        {!! @$userPro->details !!}
                        {!! @$userPro->professional !!}
                    </p>
                    <div class="bid_post">
                        <p class="Jobs pull-left"><b>Jobs Completed: </b> <span> 20</span></p>
                    </div>
                    </div>

                    <!-- Expericence add section start -->

                    <div class="profile_add_section">
                        <div class="header">
                            <h4>Experience</h4>
                            <button type="button" class="btn btn-info experience" data-toggle="modal" data-target="#experience">
                        Add Experience
                      </button>
                        </div>
                        <div class="profile_content">
                            <ul>
                            @if(isset($experience))
                                @foreach($experience as $expvalue)
                                <li>
                                    <h5 class="desigination">{!! $expvalue->exp_edu_title !!}</h5>
                                    <p class="copany">{!! $expvalue->com_edu_name !!}</p>
                                    <p class="summary">
                                    {!! $expvalue->exp_edu_summary !!}
                                    </p>
                                    <table width="300px">
                                        <tr class="scdate">
                                            <td>
                                                <p><b>Start Date</b></p>
                                                <p>{!! $expvalue->start_date !!}</p>
                                            </td>
                                            <td>
                                                <p><b>Start Date</b></p>
                                                <p>{!! $expvalue->end_date !!}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                                @endforeach
                                @else
                                <p>didn't add Experience Yet</p>
                            @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Experiencc added Form start -->

                    


                      <!-- Button to Open the Modal -->
                      <!-- The Modal -->
                      <div class="modal fade" id="experience">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <div class="experience_section experience" name="experience_section">
                        <header>
                            <h4>Experience</h4>
                        </header>
                        <content>
                            <form method="POST" action="" enctype="multipart/form-data">
                                @csrf
                            <table class="experience_form">
                                <tr>
                                    <td>
                                        <h6>Name of work</h6>

                                        <div class="form-group">
                                          <input type="text" placeholder="Enter your position or title" name="exp_title" required>
                                        </div>
                                        <!-- hiddent input feild -->
                                        <input type="hidden" name="profile_add_type" value="experience">
                                                            
                                    </td>
                                    <td width="40px"></td>
                                    <td>
                                        <h6>Company/Person name</h6>
                                        <div class="form-group">
                                        <input type="text" placeholder="Enter your company name" name="company_name" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h6>Start Date</h6>
                                        <select placeholder="Select month" name="start_month" required>
                                              <option value="" >Select month</option>
                                              <option value="January">January</option>
                                              <option value="February">February</option>
                                              <option value="March">March</option>
                                              <option value="April">April</option>
                                              <option value="May">May</option>
                                              <option value="June">June</option>
                                              <option value="July">July</option>
                                              <option value="August">August</option>
                                              <option value="September">September</option>
                                              <option value="October">October</option>
                                              <option value="November">November</option>
                                              <option value="December">December</option>
                                        </select>
                                         <select placeholder="Select Year" name="start_year" required>
                                              <option value="" >Select Year</option>
                                              <option value="2005">2006</option>
                                              <option value="2007">2007</option>
                                              <option value="2008">2008</option>
                                              <option value="2010">2009</option>
                                              <option value="2011">2011</option>
                                              <option value="2012">2012</option>
                                              <option value="2013">2014</option>
                                              <option value="2015">2015</option>
                                        </select>

                                    </td>
                                    <td width="40px"></td>
                                    <td>
                                        <h6>End Date</h6>
                                        <select placeholder="Select month" name="end_month">
                                              <option value="" >Select month</option>
                                              <option value="January">January</option>
                                              <option value="February">February</option>
                                              <option value="March">March</option>
                                              <option value="April">April</option>
                                              <option value="May">May</option>
                                              <option value="June">June</option>
                                              <option value="July">July</option>
                                              <option value="August">August</option>
                                              <option value="September">September</option>
                                              <option value="October">October</option>
                                              <option value="November">November</option>
                                              <option value="December">December</option>
                                        </select>
                                         <select placeholder="Select Year" name="end_year">
                                              <option value="" >Select Year</option>
                                              <option value="2007">2007</option>
                                              <option value="2008">2008</option>
                                              <option value="2010">2009</option>
                                              <option value="2011">2011</option>
                                              <option value="2012">2012</option>
                                              <option value="2013">2014</option>
                                              <option value="2015">2015</option>
                                        </select>
                                    </td>
                                </tr>
                                    
                            </table>
                            <div class="form-group">
                              <label for="comment">Summery:</label>
                              <textarea class="form-control" name="experience_summary" rows="5" id="comment"></textarea>
                            </div>
                            <div class="form-group">
                              <label for="certificate">Upload certificate:</label>
                              <input type="file" class="form-control" name="certificate">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary pull-right">
                            </form>
                        </content>
                    </div>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            
                          </div>
                        </div>
                      </div>




                   <!--  Education section start -->

                    <div class="profile_add_section">
                        <div class="header">
                        <h4>Education</h4>
                                <button type="button" class="btn btn-info education" data-toggle="modal" data-target="#education">
                            Add Education
                          </button>
                        </div>
                        <div class="profile_content">
                            <ul>
                            @if(isset($experience))
                                @foreach($education as $eduvalue)
                                <li>
                                    <h5 class="desigination"> Degree:  {!! $eduvalue->com_edu_name !!}</h5>
                                    <p class="country"><b>Country: </b>{!! $eduvalue->country !!}</p>
                                    <p class="country"><b>University/College: </b>{!! $eduvalue->exp_edu_title !!}</p>
                                    <table width="300px">
                                        <tr class="scdate">
                                            <td>
                                                <p><b>Start Year</b></p>
                                                <p>{!! $eduvalue->start_date !!}</p>
                                            </td>
                                            <td>
                                                <p><b>End Year</b></p>
                                                <p>{!! $eduvalue->end_date !!}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                                @endforeach

                                @else
                                <p>didn't add Education Yet</p>

                            @endif

                            </ul>
                        </div>
                    </div>

                    <!-- education add end -->

                    
                   <!--  Education section End -->

                      <!-- Button to Open the Modal -->
                      <!-- The Modal -->
               <div class="modal fade" id="education">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <div class="experience_section education">
                        <header>
                            <h4>Education</h4>
                        </header>
                        <content>
                            <form method="POST" action="" enctype="multipart/form-data">
                                @csrf
                            <table class="experience_form">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                          <h6>Country</h6>
                                        <select placeholder="Select month" name="edu_country">
                                              <option value="" >Select Country</option>
                                              <option value="Afganistan">Afghanistan</option>
                                               <option value="Albania">Albania</option>
                                               <option value="Algeria">Algeria</option>
                                               <option value="American Samoa">American Samoa</option>
                                               <option value="Andorra">Andorra</option>
                                               <option value="Angola">Angola</option>
                                               <option value="Anguilla">Anguilla</option>
                                               <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                               <option value="Argentina">Argentina</option>
                                               <option value="Armenia">Armenia</option>
                                               <option value="Aruba">Aruba</option>
                                               <option value="Australia">Australia</option>
                                               <option value="Austria">Austria</option>
                                               <option value="Azerbaijan">Azerbaijan</option>
                                               <option value="Bahamas">Bahamas</option>
                                               <option value="Bahrain">Bahrain</option>
                                               <option value="Bangladesh">Bangladesh</option>
                                               <option value="Barbados">Barbados</option>
                                               <option value="Belarus">Belarus</option>
                                        </select>
                                        </div>
                                                            
                                    </td>
                                    <td width="40px"></td>
                                    <td>
                                        <h6>University/College</h6>
                                        <div class="form-group">
                                        <input type="text" name="collage" placeholder="University/College">
                                        </div>
                                        <input type="hidden" name="post_type" value="education">
                                    </td>
                                </tr>
                                <tr class="collage">
                                    <td>
                                        <h6>Degree</h6>
                                        <div class="form-group">
                                        <input type="text" name="degree" placeholder="Degree">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h6>Start Year</h6>
                                         <select placeholder="Select Year" name="start_year">
                                              <option value="" >Select Year</option>
                                              <option value="2005">2006</option>
                                              <option value="2007">2007</option>
                                              <option value="2008">2008</option>
                                              <option value="2010">2009</option>
                                              <option value="2011">2011</option>
                                              <option value="2012">2012</option>
                                              <option value="2013">2014</option>
                                              <option value="2015">2015</option>
                                        </select>

                                    </td>
                                    <td width="40px"></td>
                                    <td>
                                        <h6>End Year</h6>
                                         <select placeholder="Select Year" name="end_year">
                                              <option value="" >Select Year</option>
                                              <option value="2007">2007</option>
                                              <option value="2008">2008</option>
                                              <option value="2010">2009</option>
                                              <option value="2011">2011</option>
                                              <option value="2012">2012</option>
                                              <option value="2013">2014</option>
                                              <option value="2015">2015</option>
                                        </select>
                                    </td>
                                </tr>
                                    
                            </table>
                            <input type="submit" name="submit" class="btn btn-primary pull-right">
                            </form>
                        </content>
                    </div>

                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            
                          </div>
                        </div>
            </div>


            <!-- upload certificate stary -->

                 <div class="profile_add_section certificate">
                        <div class="header">
                        <h4>Certificate</h4>
                                <button type="button" class="btn btn-info education" data-toggle="modal" data-target="#certificate_upload">
                            Add certificate
                          </button>
                        </div>
                        <div class="profile_content">
                            <ul>
                            @if(isset($certificate))
                                @foreach($certificate as $certificate_show)
                                    @if(isset($certificate_show->certificate))
                                    <li>
                                        <img src="{{ url('images/certificate/other')}}/{!! $certificate_show->certificate !!}" alt="">
                                        <p class="cer_tit">{!! @$certificate_show->certificate_title !!}</p>
                                    </li>
                                    @endif
                                @endforeach

                                @else
                                <p>didn't add Education Yet</p>

                            @endif

                            </ul>
                        </div>
                    </div>
            <!-- upload certificate End -->

            <!-- upload certificate model start -->
            <div class="modal fade" id="certificate_upload">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                <!-- Modal body -->
                    <div class="modal-body">
                              <div class="experience_section education">
                        <header>
                            <h4>Cerfificate</h4>
                        </header>
                        <content>
                            <form method="POST" action="" enctype="multipart/form-data">
                                @csrf
                            <table class="experience_form">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                          <h6>Certificate title</h6>
                                          <input type="text" name="certificate_title" placeholder="Enter certificate title">
                                        </div>
                                                            
                                    </td>
                                    <td width="40px"></td>
                                    <td>
                                        <h6>Upload certificate</h6>
                                        <div class="form-group">
                                            <input type="file" name="certificate_image">
                                        </div>
                                    </td>
                                </tr>
                                    
                            </table>
                            <input type="submit" name="submit" class="btn btn-primary pull-right">
                            </form>
                        </content>
                    </div>

                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            
                          </div>
                        </div>
            </div>
            <!-- upload certificate model End -->



                </div>
            </div>
            </div>
        </div>    
    </div>
</div>

@endsection
