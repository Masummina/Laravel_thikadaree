@extends('admin.layouts.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->

    <script type="text/javascript" src="{!! url('js/add-child.js') !!}"></script>

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

      <section class="content-header">

        <h1> New Client/Prospects </h1>

      </section>

    <!-- Main content -->

    <section class="content">

      <div class="row">

        <!-- left column -->

          @if(session()->has('success'))

              <div class="alert alert-success">

                  {{ session()->get('success') }}

              </div>

          @endif

        

        <!--/.col (left) -->

        <!-- right column -->

        <div class="col-md-12">

          <!-- Horizontal Form -->

          <div class="box box-info">

            <div class="box-header with-border">

              <h3 class="box-title">New Client/Prospects  </h3>

            </div>

            <!-- /.box-header -->

              <div class="box-body" >

                @if ($errors->any())

                  <div class="alert alert-danger">

                      <ul>

                          @foreach ($errors->all() as $error)

                              <li>{{ $error }}</li>

                          @endforeach

                      </ul>

                  </div>

              @endif

              @if (Session::has('error'))

                <div id="modal" class="modal">

                      <div class="modal-dialog" role="document">

                        <div class="modal-content modal-content alert alert-dismissible alert-danger">

                          <div class="modal-header">

                            <h5 class="modal-title">Warning!</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                              <span aria-hidden="true">&times;</span>

                            </button>

                          </div>

                          <div class="modal-body">

                            <p>{{ Session::get('error') }}</p>

                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                          </div>

                        </div>

                      </div>

                </div>

                    <script type="text/javascript">

                      jQuery(document).ready(function(){

                            jQuery("#modal").modal();

                      });

                    </script>

              @endif

              

              <!-- form start -->

               <form id="master_div" class="form-horizontal" onsubmit="return confirm('Are you sure you want to submit?')" action="@hasSection('customer_id'){{ url('submit-user') }}@else {{ url('customers') }} @endif" method="POST">

                    <div id="ContactBlock" class="card-body">

                        Customer information

                      <div class="input-group input-group-sm">

                          <span class="input-group-addon">Name</span>

                          <input style="width: 100px" name="prefix" placeholder="Prefix" class="form-control" value="@yield('prefix')" required>

                          <input name="name" value="@yield('name')" placeholder="Full Name" class="form-control" required>

                          <span class="input-group-addon">Status</span>

                         

                          <select id="type" name="type" class="form-control">

                              <option @if(@$customer->type=='Prospect') selected @endif value="Prospect">Prospect</option>

                              <option @if(@$customer->type=='Client') selected @endif value="Client">Client</option>

                              <option @if(@$customer->type=='Others') selected @endif value="Others">Others</option>

                          </select>

                      </div>

                      <div class="input-group input-group-sm">

                          <span class="input-group-addon">Mobile </span>

                          <input type="text" name="mobile" value="@yield('mobile')" placeholder="Mobile " class="form-control " required >

                          <span class="input-group-addon">Alternative Mobile </span>

                          <input name="alt_mobile" value="@yield('alt_mobile')" placeholder="Alternative Mobile " class="form-control " >

                      </div>

                      <div class="input-group input-group-sm">

                          <span class="input-group-addon">Phone</span>

                          <input name="phone" value="@yield('phone')" placeholder="Phone " class="form-control ">

                          <span class="input-group-addon">Fax</span>

                          <input name="fax" value="@yield('fax')" placeholder="Fax" class="form-control ">

                          <span class="input-group-addon">Email</span>

                          <input name="email" value="@yield('email')" placeholder="Email" class="form-control ">

                      </div>

                      <div class="input-group input-group-sm">

                          <span class="input-group-addon">Online</span>

                          <input name="website" value="@yield('website')" placeholder="Website" class="form-control ">

                          <input name="facebook" value="@yield('facebook')" placeholder="Facebook" class="form-control ">

                          <input name="twitter" value="@yield('twitter')" placeholder="Twitter" class="form-control ">

                          <input name="instagram" value="@yield('instagram')" placeholder="Instagram" class="form-control ">

                      </div>

                      <div class="input-group input-group-sm">

                          <span class="input-group-addon">Address 01</span>

                          <input name="address_1" value="@yield('address_1')" placeholder="Address 01" class="form-control ">

                          <span class="input-group-addon">City 2</span>

                          <input name="city_2" value="@yield('city_2')" placeholder="City 2" class="form-control ">

                      </div>

                      <div class="input-group input-group-sm">

                           <span class="input-group-addon">City 1</span>

                          <input name="city" value="@yield('city')" placeholder="City 1" class="form-control ">

                          <span class="input-group-addon">Address 02</span>

                          <input name="address_2" value="@yield('address_2')" placeholder="Address 02" class="form-control ">

                         

                        

                      </div>

                      <div class="input-group input-group-sm">

                          <span class="input-group-addon">Home District 1</span>

                          <input name="district" value="@yield('district')" placeholder="District 1" list="datalistDistrict" class="form-control ">

                          <span class="input-group-addon">Home District 2</span>

                          <input name="country" value="@yield('country')" placeholder="District 2" class="form-control ">

                      </div>

                      <div class="input-group input-group-sm">

                          <span class="input-group-addon">Contact Person</span>

                          <input name="content_persion" value="@yield('content_persion')" placeholder="Contact Person" class="form-control ">

                          <span class="input-group-addon">Relation</span>

                          <input name="relation_client" value="@yield('relation_client')" placeholder="Relation with Client" class="form-control ">

                      </div>

                  </div>

                  <br/>

                   @if(isset($activities))

                     <div id="area_of_interest" class="card-body" style="height: 200px; overflow-y: scroll; ">

                        Customer Interest History

                          @if($activities)

                             @foreach($activities as $row)

                                <div class="input-group input-group-sm">

                                    <span class="input-group-addon">Project</span>

                                    @php

                                        if(isset($row->project_id) && $row->project_id>0)

                                        {

                                            $project = DB::table('projects')

                                                     ->select('title')

                                                     ->where('id','=', $row->project_id)->first();

                                        }

                                        if(isset($row->property_id) && $row->property_id>0)

                                        {

                                            $property = DB::table('property')

                                                     ->select('title')

                                                     ->where('id','=', $row->property_id)->first();

                                        }

                                   @endphp

                                    <input readonly="" value="{!! @$project->title !!}" class="form-control ">

                                    <span class="input-group-addon">Property</span>

                                    <input readonly="" value="{!! @$property->title !!}" class="form-control ">

                                    <span class="input-group-addon">Date</span>

                                    <input readonly="" value="@php

                                              echo date('l jS  F Y h:i:s A', strtotime($row->created_at));

                                          @endphp" class="form-control ">

                                    <span class="input-group-addon">Status : </span>

                                    <input readonly="" value="{!! $row->lead_status !!}" class="form-control">

                                </div>

                                <div class="input-group input-group-sm">

                                    <span class="input-group-addon">Next action : </span>

                                    <input readonly="" value="{!! $row->next_action !!}" class="form-control">

                                    <span class="input-group-addon">Next action date : </span>

                                    <input readonly="" value="{!! $row->next_action_date !!}" class="form-control">

                                    <span class="input-group-addon">Remarks : </span>

                                    <input readonly="" value="{!! $row->remarks !!}" class="form-control">

                                </div>

                          @endforeach

                        @endif

                    </div> 

                    @endif

                    <br/>

                    <div  id="PersonalBlock" class="card-body">

                        Customer Interest

                        <div class="input-group">

                            <span class="input-group-addon">Project </span>

                            @if($projects)

                                <select id="project" name="project_id" class="form-control">

                                    <option value="" > Select Project </option>

                                    @if($projects)

                                        @foreach($projects as $row)

                                            <option value="{!! $row->id !!}" @if(old('project_id')==$row->id) selected @endif >{!! $row->title !!}</option>

                                        @endforeach

                                    @endif

                                </select>

                            @endif

                            <span class="input-group-addon"> Property </span>

                            <select name="property_id" id="property_id" class=" form-control">

                                <option value=""> Select Property </option>

                            </select>

                            

                            <span class="input-group-addon"> Contact Method </span>

                            @php $contact_methods = array('Call to','Call received','Visit to Office','Visit to Project','Internal Visit','Both','Visit to Home'); @endphp

                            <select name="contact_method" class="form-control">

                                @foreach($contact_methods as $v)

                                    <option value="{!! $v !!}" @if(old('contact_method')==$v) selected @endif >{!! $v !!}</option>

                                @endforeach

                            </select>

                            <span id="spanContactType" class="input-group-addon">Status </span>

                            @php $lead_status = array('Primary','Secondary','Near to Close','DOL','BFO','Dead','Future'); @endphp

                            <select name="lead_status" class="form-control">

                                @foreach($lead_status as $v)

                                    <option value="{!! $v !!}" @if(old('lead_status')==$v) selected @endif >{!! $v !!}</option>

                                @endforeach

                            </select>

                        </div>

                        @if(!isset($customer_id))

                        <div class="input-group">

                            <span class="input-group-addon">Next Action </span>

                            @php $next_actions = array('Phone Call','Internal Visit','Project Visit','External Visit','Both','Visit to Home'); @endphp

                            <select name="next_action" class="form-control">

                                @foreach($next_actions as $v)

                                    <option value="{!! $v !!}" @if(old('next_plan')==$v) selected @endif >{!! $v !!}</option>

                                @endforeach

                            </select>

                            <span class="input-group-addon">Date </span>

                            <input name="next_action_date" value="{!! old('next_action_date') !!}" class="form-control col-md-2" type="date" required>

                            <span class="input-group-addon">Time</span>

                            <input name="next_action_time" type="time" value="{!! old('next_action_time') !!}" class="form-control">

                        </div>

                        @endif

                    </div>

                   @if(!isset($customer_id))

                    <div id="CustomerRemarks">

                        <textarea name="remarks" placeholder="Description" class="form-control" required></textarea>

                    </div>

                   @endif

                    <br><br>

                    <div id="area_of_interest" class="card-body">

                        Area of Interest

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Area</span>
                            <select name="district_name" class="form-control" onchange="show_location(this.value)">   
                                <option value="">Select district </option>
                                @php 
                                $district_list = DB::table('locations')                                    
                                    ->select('id','district')                              
                                    ->groupBy('district')
                                    ->orderBy('district', 'asc')
                                    ->get();

                                    foreach($district_list as $row){
                                        if($row->district=='Dhaka') $sel='selected="selected"'; else $sel='';
                                        echo '<option value="'.$row->district.'" '.$sel.' >'.$row->district.'</option>';
                                    }   
                                @endphp                                                       
                            </select>

                            <select name="area_name" id="area_name" class="form-control">                               

                                <option value="">Select Area </option>

                                @php 
                                $locations = DB::table('locations')
                                    ->whereRaw("`district` LIKE 'dhaka'")
                                    ->orderBy('location','asc')
                                    ->get();

                                    foreach($locations as $row){
                                        echo '<option value="'.$row->location.'">'.$row->location.'</option>';
                                    }   
                                @endphp 

                            </select>  

                             

                            

                            <!-- <input name="area_name__" value="@yield('area_of_interest')" placeholder="Area of Interest " class="form-control "> -->

                            

                            <span class="input-group-addon">Size(sft)</span>

                            <input name="area_size" value="@yield('size_of_interest')" placeholder="Size" class="form-control ">

                            <span class="input-group-addon">Price(tk)</span>

                            <input name="area_price" value="@yield('price_of_interest')" placeholder="Price" class="form-control ">

                        </div>

                    </div>

                    <br><br>

                  <div id="AreaOfInterestBlock" class="card-body">

                      Personal Info

                      <div class="input-group input-group-sm">

                         <span class="input-group-addon">Home District</span>

                          <input name="home_district" value="@yield('home_district')" placeholder="Home District" list="datalistDistrict" class="form-control input-personal">

                          <span class="input-group-addon">Date of Birth</span>

                          <input name="dob" value="@yield('dob')" class="form-control col-md-2" type="date">

                          <span class="input-group-addon">Political Prefences</span>

                          <input name="interest_02" value="@yield('interest_01')" placeholder="Political Preferences" class="form-control input-personal">

                      </div>

                      <div class="input-group input-group-sm">

                          <span class="input-group-addon">Interests</span>

                          <input name="interest_01" value="@yield('interest_02')" placeholder="Interests" class="form-control input-personal">

                          <span class="input-group-addon">Food Habits</span>

                          <input name="food_habit" value="@yield('food_habit')" placeholder="Food Habits" class="form-control input-personal">

                          <span class="input-group-addon">Health Info</span>

                          <input name="health_info" value="@yield('health_info')" placeholder="Health Info" class="form-control input-personal">

                      </div>

                      <div class="input-group input-group-sm">

                          <span class="input-group-addon">Car Preference</span>

                          <input name="car_preference" value="@yield('car_preference')" placeholder="Car Preference" class="form-control ">

                          <span class="input-group-addon">Color Preference</span>

                          <input name="color_preference" value="@yield('color_preference')" placeholder="Color Preference" class="form-control ">

                      </div>

                  </div>

                    <br/>

                    <div id="Organizationblock" class="card-body">

                        Office information

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Organization Name</span>

                            <input name="o_name" placeholder="Name" class="form-control" value="@yield('organization')">

                            <span class="input-group-addon">Profession</span>

                            <select class="form-control" name="o_profession">

                                <option value="" > Select </option>

                                @foreach($profession_options as $p)

                                    <option

                                      @if(!empty($area))

                                        @if ($area[0]->profession == $p->id)selected

                                        @endif

                                      @endif

                                      value={{$p->id}}>

                                        {{$p->title}}

                                    </option>

                                @endforeach

                            </select>

                            {{--<input name="o_profession" placeholder="Profession" class="form-control" value="@yield('profession')">--}}

                            <input name="o_rank" value="@yield('designation')" placeholder="Rank" class="form-control">

                        </div>

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Mobile</span>

                            <input name="o_mobile" value="@yield('office_mobile')" placeholder="Mobile " class="form-control "  >

                            <input name="o_alt_mobile" value="@yield('office_alt_mobile')" placeholder="Alternative Mobile " class="form-control " >

                        </div>

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Phone</span>

                            <input name="o_phone" value="@yield('office_phone')" placeholder="Phone " class="form-control ">

                            <span class="input-group-addon">Fax</span>

                            <input name="o_fax" value="@yield('office_fax')" placeholder="Fax" class="form-control ">

                            <span class="input-group-addon">Email</span>

                            <input name="o_email" value="@yield('office_email')" placeholder="Email" class="form-control ">

                        </div>

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Online</span>

                            <input name="o_website" value="@yield('office_website')" placeholder="Website" class="form-control ">

                            <input name="o_facebook" value="@yield('office_facebook')" placeholder="Facebook" class="form-control ">

                            <input name="o_twitter" value="@yield('office_twitter')" placeholder="Twitter" class="form-control ">

                        </div>

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Address 01</span>

                            <input name="o_address_1" value="@yield('office_address_1')" placeholder="Address 01" class="form-control ">

                        </div>

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Address 02</span>

                            <input name="o_address_2" value="@yield('office_address_2')" placeholder="Address 02" class="form-control ">

                        </div>

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">City</span>

                            <input name="o_city" value="@yield('office_city')" placeholder="City" list="datalistCity" class="form-control ">

                            <span class="input-group-addon">District</span>

                            <input name="o_district" value="@yield('office_district')" placeholder="District" list="datalistDistrict" class="form-control ">

                            <span class="input-group-addon">Country</span>

                            <input name="o_country" value="@yield('office_country')" placeholder="Country" class="form-control ">

                        </div>

                    </div>

                    <br/>

                    <div id="AreaOfInterestBlock_wife" class="card-body">

                        Family Info

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Name of Spouse</span>

                            <input style="width: 45px;" name="m_prefix" placeholder="Mrs" class="form-control" value="@yield('wife_prefix')">

                            <input name="m_name" value="@yield('wife_name')" placeholder="name" class="form-control">

                        </div>

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Date of Birth</span>

                            <input name="m_dob" value="@yield('wife_dob')" class="form-control col-md-2" type="date">

                            <span class="input-group-addon">Marriage Anniversary</span>

                            <input name="m_dom" value="@yield('wife_dom')" class="form-control col-md-2" type="date">

                            <span class="input-group-addon">Home District</span>

                            <input name="m_home_district" value="@yield('wife_home_district')" placeholder="Home District" list="datalistDistrict" class="form-control input-personal">

                        </div>

                        <div class="input-group input-group-sm">

                            <span class="input-group-addon">Interests</span>

                            <input name="m_interest_01" value="@yield('wife_interest_01')" placeholder="Interests" class="form-control input-personal">

                            <span class="input-group-addon">Food Habits</span>

                            <input name="m_food_habit" value="@yield('wife_food_habit')" placeholder="Food Habits" class="form-control input-personal">

                            <span class="input-group-addon">Health Info</span>

                            <input name="m_health_info" value="@yield('wife_health_info')" placeholder="Health Info" class="form-control input-personal">

                        </div>

                        <div class="input-group input-group-sm">

                            <button type="button" class="btn btn-warning" id="add-child"> Add Child(ren)</button>

                        </div>

                        <br/>

                        <br/>

                        @if(isset($children))

                        @if($children)

                           @foreach($children as $row)

                                <div class="card-body">

                                    Child Info

                                    <div class="input-group input-group-sm">

                                        <span class="input-group-addon">Name of Child</span>

                                        <input name="c_prefix[]" type="text" value="{!!$row->prefix !!}" placeholder="Prefix" class="form-control">

                                        <input name="c_name[]" type="text" placeholder="name" value="{!!$row->name !!}" class="form-control" required="">

                                        <span class="input-group-addon">Date of Birth</span>

                                        <input name="c_dob[]" value="{!!$row->dob !!}" type="date" class="form-control col-md-2"><br>

                                    </div>

                                    <div class="input-group input-group-sm">

                                        <span class="input-group-addon">Interests</span>

                                        <input name="c_interest[]" type="text" value="{!!$row->interest_01 !!}" placeholder="Interests" class="form-control input-personal">

                                        <span class="input-group-addon"> Food Habits </span>

                                        <input name="c_foodhabits[]" value="{!!$row->food_habit !!}" type="text" placeholder="Food Habits" class="form-control input-personal">

                                        <span class="input-group-addon"> Health Info</span>

                                        <input name="c_health_info[]" value="{!!$row->health_info !!}" type="text" placeholder="Health Info " class="form-control input-personal">

                                    </div>

                                    <button type="submit" name="rmv" id="1" class="btn btn-warning remove-child">Remove</button>

                                </div>

                            @endforeach

                        @endif

                        @endif

                    </div>

                    <div class="box-footer">

                        <div class="form-group">

                            <div class="col-sm-3"></div>

                            <div class="col-sm-9">

                                <button type="submit" class="btn btn-info pull-right"> Submit </button>

                            </div>

                        </div>

                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input class="form-control" type="hidden" name="id" value="@yield('customer_id')">

                    <!-- /.box-footer -->

            {{Form::close()}}

          </div>

          <!-- /.box -->

          <!-- /.box -->

        </div>

        <!--/.col (right) -->

      </div>

      <!-- /.row -->

    </section>



    <script type="text/javascript">



        function show_location(district)

        {

            $.ajax({

                url: '{!! url('show-location/?district=') !!}'+district,

                type:"GET",

                //dataType:"json",

                beforeSend: function(){

                    //$('#loader').css("visibility", "visible");

                    $('#area_name').html('<option value="">Loading... </option>');

                },

                success:function(data) {

                    $('#area_name').html(data);                  

                },

                complete: function(){

                    //$('#loader').css("visibility", "hidden");

                }

            });

        }

            

    </script>

    



@endsection    