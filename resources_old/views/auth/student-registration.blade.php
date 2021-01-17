@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Student Registration</div>               

                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ url('student-registration') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('fathers_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Father's Name</label>

                            <div class="col-md-6">
                                <input id="fathers_name" type="text" class="form-control" name="fathers_name" value="{{ old('fathers_name') }}" required>

                                @if ($errors->has('fathers_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fathers_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('mothers_name') ? ' has-error' : '' }}">
                            <label for="mothers_name" class="col-md-4 control-label">Mother's Name</label>

                            <div class="col-md-6">
                                <input id="mothers_name" type="text" class="form-control" name="mothers_name" value="{{ old('mothers_name') }}" >

                                @if ($errors->has('mothers_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mothers_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('ssc_roll') ? ' has-error' : '' }}">
                            <label for="ssc_roll" class="col-md-4 control-label">S.S.C Roll No. </label>

                            <div class="col-md-6">
                                <input id="ssc_roll" type="text" class="form-control" name="ssc_roll" value="{{ old('ssc_roll') }}" required>

                                @if ($errors->has('ssc_roll'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ssc_roll') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                            <label for="mobile_no" class="col-md-4 control-label">Mobile No. </label>

                            <div class="col-md-6">
                                <input id="mobile_no" type="text" class="form-control" name="mobile_no" value="{{ old('mobile_no') }}">

                                @if ($errors->has('mobile_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('home_district') ? ' has-error' : '' }}">
                            <label for="home_district" class="col-md-4 control-label">Home District </label>

                            <div class="col-md-6">
                                <input id="home_district" type="text" class="form-control" name="home_district" value="{{ old('home_district') }}">

                                @if ($errors->has('home_district'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('home_district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-mail (if any)</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('present_address') ? ' has-error' : '' }}">
                            <label for="present_address" class="col-md-4 control-label">Present Address </label>

                            <div class="col-md-6">
                                <input id="present_address" type="text" class="form-control" name="present_address" value="{{ old('present_address') }}" required>

                                @if ($errors->has('present_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('present_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('permanent_address') ? ' has-error' : '' }}">
                            <label for="permanent_address" class="col-md-4 control-label">Permanent Address </label>

                            <div class="col-md-6">
                                <input id="permanent_address" type="text" class="form-control" name="permanent_address" value="{{ old('permanent_address') }}" required>

                                @if ($errors->has('permanent_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permanent_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                       
                        <div class="form-group{{ $errors->has('ssc_board') ? ' has-error' : '' }}">
                            <label for="ssc_board" class="col-md-4 control-label">S.S.C. / 'O' Level Borad</label>

                            <div class="col-md-6">
                               <select name="ssc_board">
                                    <option value="">Please select one </option>
                                    <option value="dhaka"> Dhaka </option>
                                    <option value="jessore"> Jessore </option>
                                    <option value="rajshahi"> Rajshahi </option>
                                    <option value="comillah"> Comillah </option>
                                    <option value="sylhet"> Sylhet </option>
                                    <option value="chittagong"> Chittagong </option>
                                    <option value="barisal"> Barisal </option>
                                    <option value="dinajpur"> Dinajpur </option>
                                    <option value="oLevel"> 'O' Level </option>
                                </select>

                                @if ($errors->has('ssc_board'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ssc_board') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('school_name') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">School Name </label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="school_name" value="{{ old('school_name') }}">

                                @if ($errors->has('school_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ssc_passing_year') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label"> Passing Year  </label>

                            <div class="col-md-6">
                                <select name="ssc_passing_year">
                                    <option value="2006"> 2007 </option>
                                    <option value="2007"> 2008 </option>
                                    <option value="2008"> 2009 </option>
                                    <option value="2009"> 2010 </option>
                                    <option value="2010"> 2011 </option>                          
                                    <option value="2011"> 2012 </option>                          
                                    <option value="2012"> 2013 </option>                          
                                    <option value="2013"> 2014 </option>                          
                                    <option value="2014"> 2015 </option>                            
                                    <option value="2015"> 2016 </option>
                                    <option value="2015"> 2018 </option>
                                </select>
                                @if ($errors->has('ssc_passing_year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ssc_passing_year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('ssc_gpa') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">G.P.A </label>

                            <div class="col-md-6">
                                <input id="" type="text" class="form-control" name="ssc_gpa" value="{{ old('ssc_gpa') }}" >

                                @if ($errors->has('ssc_gpa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ssc_gpa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('hsc_board') ? ' has-error' : '' }}">
                            <label for="ssc_roll" class="col-md-4 control-label">H.S.C. / 'A' Level Board </label>

                            <div class="col-md-6">
                                <select name="hsc_board">
                                    <option value="">Please select one </option>
                                    <option value="dhaka"> Dhaka </option>
                                    <option value="jessore"> Jessore </option>
                                    <option value="rajshahi"> Rajshahi </option>
                                    <option value="comillah"> Comillah </option>
                                    <option value="sylhet"> Sylhet </option>
                                    <option value="chittagong"> Chittagong </option>
                                    <option value="barisal"> Barisal </option>
                                    <option value="dinajpur"> Dinajpur </option>
                                    <option value="aLevel"> 'A' Level </option>
                                </select>

                                @if ($errors->has('hsc_board'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hsc_board') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('college_name') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">College Name </label>

                            <div class="col-md-6">
                                <input id="" type="text" class="form-control" name="college_name" value="{{ old('college_name') }}" >

                                @if ($errors->has('college_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('college_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hsc_passing_year') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">Passing Year </label>

                            <div class="col-md-6">
                                <select name="hsc_passing_year">
                                    <option value="appeared"> Appeared </option>
                                    <option value="2006"> 2007 </option>
                                    <option value="2007"> 2008 </option>
                                    <option value="2008"> 2009 </option>
                                    <option value="2009"> 2010 </option>
                                    <option value="2010"> 2011 </option>                          
                                    <option value="2011"> 2012 </option>                          
                                    <option value="2012"> 2013 </option>                          
                                    <option value="2013"> 2014 </option>                          
                                    <option value="2014"> 2015 </option>                            
                                    <option value="2015"> 2016 </option>
                                    <option value="2015"> 2017 </option>
                                </select>
                                @if ($errors->has('hsc_passing_year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hsc_passing_year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hsc_gpa') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">G.P.A. </label>

                            <div class="col-md-6">
                                <input id="" type="text" class="form-control" name="hsc_gpa" value="{{ old('hsc_gpa') }}" >

                                @if ($errors->has('hsc_gpa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hsc_gpa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                      

                        <div class="form-group{{ $errors->has('branch_name') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">Branch </label>

                            <div class="col-md-6">
                                <select name="branch_name">                               
                                    <option value="">Please select one </option>
                                    <option value="Dhaka"> Dhaka </option>
                                    <option value="Jessore"> Jessore </option>
                                    <option value="Rajshahi"> Rajshahi </option>
                                    <option value="Comillah"> Comillah </option>
                                    <option value="Sylhet"> Sylhet </option>
                                    <option value="Chittagong"> Chittagong </option>
                                    <option value="Barisal"> Barisal </option>
                                    <option value="Dinajpur"> Dinajpur </option>
                                    <option value="OLevel"> 'O' Level </option>                               
                                </select>
                                @if ($errors->has('branch_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('branch_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hsc_registration_no') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">H.S.C./'A Level' Registration No.* </label>

                            <div class="col-md-6">
                                <input id="" type="text" class="form-control" name="hsc_registration_no" value="{{ old('hsc_registration_no') }}">

                                @if ($errors->has('hsc_registration_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hsc_registration_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                     

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
