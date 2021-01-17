@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1> View Customer information <small> Customer information </small> </h1>
      </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">

            <div class="box-header with-border">
              <h3 class="box-title"> Customer information </h3>
            </div>


              <div class="box-body">

                    @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif


                  <div id="ContactBlock" class="card-body">
                      Customer information

                      <div class="input-group input-group-sm">
                          <span class="input-group-addon">Name</span>
                          {!! $personal->prefix !!}
                          Name : {!! $personal->name !!}
                          <span class="input-group-addon">Status</span> {!! $customer->type !!}
                      </div>
                      <div class="input-group input-group-sm">
                          <span class="input-group-addon">Mobile</span> {!! $contact->mobile !!}
                          Alternative Mobile : {!! $contact->alt_mobile !!}
                      </div>
                      <div class="input-group input-group-sm">
                          <span class="input-group-addon">Phone</span> {!! $contact->phone !!}
                          <span class="input-group-addon">Fax</span> {!! $contact->fax !!}
                          <span class="input-group-addon">Email</span> {!! $contact->email !!}
                      </div>
                      <div class="input-group input-group-sm">
                          <span class="input-group-addon">Online</span>
                          website : {!! $contact->website !!}
                          facebook : {!! $contact->facebook !!}
                          twitter : {!! $contact->twitter !!}
                      </div>
                      <div class="input-group input-group-sm">
                          <span class="input-group-addon">Address 01</span> {!! $contact->address_1 !!}
                      </div>
                      <div class="input-group input-group-sm">
                          <span class="input-group-addon">Address 02</span> {!! $contact->address_2 !!}
                      </div>
                      <div class="input-group input-group-sm">
                          <span class="input-group-addon">City</span> {!! $contact->city !!}
                          <span class="input-group-addon">District</span> {!! $contact->district !!}
                          <span class="input-group-addon">Country</span> {!! $contact->country !!}
                      </div>
                  </div>

                  <div id="PersonalBlock" class="card-body">
                        Area of Interest
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Area</span> {!! $customer->area_of_interest !!}
                            <span class="input-group-addon">Size</span> {!! $customer->size_of_interest !!}
                            <span class="input-group-addon">Price</span> {!! $customer->price_of_interest !!}
                        </div>
                        <div class="input-group input-group-sm"></div>
                  </div>

                  <div id="AreaOfInterestBlock" class="card-body">
                      Personal Info
                      <div class="input-group input-group-sm">
                          <span class="input-group-addon">Date of Birth</span> {!! $personal->dob !!}
                          <span class="input-group-addon">Home District</span> {!! $personal->home_district !!}
                          <span class="input-group-addon">Political Prefences</span> {!! $personal->interest_02 !!}
                      </div>
                      <div class="input-group input-group-sm">
                          <span class="input-group-addon">Interests</span> {!! $personal->interest_01 !!}
                          <span class="input-group-addon">Food Habits</span> {!! $personal->food_habit !!}
                          <span class="input-group-addon">Health Info</span> {!! $personal->health_info !!}
                      </div>
                      <div id="Personal04">
                          Remarks : {!! $customer->remarks !!}
                      </div>
                  </div>

              </div>
          </div>

      </div>
      <!-- /.row -->
    </section>
@endsection    