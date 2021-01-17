@extends('admin.layouts.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

      <section class="content-header">

        <h1> "{!! $project_info->title !!}"  </h1>

        <small> {!! $project_info->area !!} , {!! $project_info->address !!} </small>

        <ol class="breadcrumb">

          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

          <li class="active">Dashboard</li>

        </ol>

      </section>

      

      <section class="content">

      <div class="row">

        <div class="col-xs-12">

          <div class="box">

            <!-- /.box-header -->

            <div class="box-body">

                @if(session()->has('message'))

                   <div class="alert alert-success">

                      {{ session()->get('message') }}

                   </div>

                @endif

                @if ($errors->any())

                  <div class="alert alert-danger">

                    <ul>

                      @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                      @endforeach

                    </ul>

                  </div>

                @endif

                <div class="col-md-12">

                  <div class="row clearfix">

                  @php //print_r($parking_price);

                    $parkingPrice = @$parking_price->price;

                    $p=(int)($parkingPrice);

                    //var_dump($p);

                  @endphp

                  @if($property_list)

                      <fieldset>

                          <legend>Property</legend>

                    @php $floor_title = 0; @endphp      

                    @foreach($property_list as $row)

                        @if($row->floor_no > 0)

                        

                           @if($floor_title!=$row->floor_no)

                            <div class="row">

                              <div class="col-md-12 "> <h4 style="text-align: center;display: block;background: #A569BD;color: #fff;padding: 5px;margin-left: 15px;margin-right: 15px;">Floor {!!$row->floor_no!!}</h4></div>   

                            </div> 

                            @php $floor_title = $row->floor_no; @endphp

                           @endif

                              {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                          <input type="hidden" name="property_id" value="{{$row->id}}">

                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                       <div class="col-md-2"> <div class="{!! $cls !!} flate-box">

                            {!! $row->title !!} <br/>

                            {!! $row->description !!} <br/>

                            

                               <br/>

                       </div>

                          @php 

                               $parking = $p * $row->no_parking;

                               //var_dump($parkingPrice);

                                $totalPrice = $row->price+$parking;

                           @endphp

                          @php 

                               $parking = $p * $row->no_parking;

                               //var_dump($parkingPrice);

                                //$totalPrice = $row->price+$parking;

                                $p = $row->r_parking_price;

								                $totalPrice = $row->price + $row->r_parking_price;

                           @endphp

                          <label>Price: {!! number_format($row->price,2) !!} BDT</label><br>

                          <label>Car Parking ({{ $row->no_parking }}):  {!! number_format($p,2) !!} BDT</label><br>

                          <label>Total Price:  {!! number_format($totalPrice,2) !!} BDT </label><br>

                           <label>Owner Type: {!!$row->owner_type !!}</label><br>

                           

                           <label>Facing: {!!$row->facing !!}</label><br>

                           <label>Type: {!!$row->type !!}</label><br>

                           <label> Status:

                           @php

                          if($row->status==0) 

                          echo 'Free';

                          if($row->status==2) 

                          echo'Booked';

                          if($row->status==3) 

                          echo'Landowner';

                          if($row->status==1) 

                          echo 'Sold';

                          if($row->status==4) 

                          echo 'Common';

                      @endphp   

                           </label><br>

                            @if($row->status==2)

                            <label>Booking Date upto:  @php 

                                      echo date(' jS  F Y ', strtotime(@$row->booked_date));

                                  @endphp</label><br>

                            @endif

                           <div class="btn-group">

                              @if($row->status!=2)

                               <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                               <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                @endif

                                @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                   <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                    <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                 @endif

                                @endif

                               @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                           </div>

                           

                             @if($row->status==1)

                              <div  class="btn-group">

                                <button style=" visibility: hidden;" type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                              </div>

                             @endif

                           <br/><br/>

                       </div>

                              {{Form::close()}}

                              @endif

                    @endforeach

                    

                    @if(count($ground_floor_list) > 0)

                      <div class="row">

                              <div class="col-md-12 "> <h4 style="text-align: center;display: block;background: #A569BD;color: #fff;padding: 5px;margin-left: 15px;margin-right: 15px;">Ground Floor</h4></div>   

                            </div> 

                    @endif

                     @foreach($ground_floor_list as $row)

                     @if($row->type=='Parking')

                               {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                                      <input type="hidden" name="property_id" value="{{$row->id}}">

                                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                                      <div class="col-md-3"> <div class="{!! $cls !!} flate-box">

                                              {!! $row->title !!} <br/>

                                             

                                              {!! number_format($row->price,2) !!} BDT

                                              <br/>

                                          </div>

                                          <label>{!!$row->owner_type !!}</label><br>

                                          <div class="btn-group">

                                              <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                               <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                              @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                                          </div>

                                          <br/><br/>

                                      </div>

                                      {{Form::close()}}

                                      @else

                                        {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                          <input type="hidden" name="property_id" value="{{$row->id}}">

                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                       <div class="col-md-2"> <div class="{!! $cls !!} flate-box">

                            {!! $row->title !!} <br/>

                            {!! $row->description !!} <br/>

                            

                               <br/>

                       </div>

                          @php 

                               $parking = $p * $row->no_parking;

                               //var_dump($parkingPrice);

                                //$totalPrice = $row->price+$parking;

                                $p = $row->r_parking_price;

								$totalPrice = $row->price;

                           @endphp

                          <label>Price: {!! number_format($row->price,2) !!} BDT</label><br>

                          <label>Car Parking ({{ $row->no_parking }}):  {!! number_format($p,2) !!}  BDT</label><br>

                          <label>Total Price:  {!! number_format($totalPrice,2) !!} BDT</label><br>

                           <label>Owner Type: {!!$row->owner_type !!}</label><br>

                           

                           <label>Facing: {!!$row->facing !!}</label><br>

                           <label>Type: {!!$row->type !!}</label><br>

                           <label>Status:

                           @php

                          if($row->status==0) 

                          echo 'Free';

                          if($row->status==2) 

                          echo'Booked';

                          if($row->status==3) 

                          echo'Landowner';

                          if($row->status==1) echo

                          'Sold';

                          if($row->status==4) echo

                          'Common';

                      @endphp   

                           </label><br>

                            @if($row->status==2)

                            <label>Booking Date upto:  @php 

                                      echo date(' jS  F Y ', strtotime(@$row->booked_date));

                                  @endphp</label><br>

                            @endif

                           <div class="btn-group">

                              @if($row->status!=2)

                               <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                               <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                @endif

                                @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                   <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                   <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                 @endif

                                @endif

                               @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                           </div>

                           

                             @if($row->status==1)

                              <div  class="btn-group">

                                <button style=" visibility: hidden;" type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                              </div>

                             @endif

                           <br/><br/>

                       </div>

                              {{Form::close()}}

                                      @endif

                    @endforeach

                      </fieldset>

                          @endif

                          @if(count($semi_basement_floor_list) > 0)

                      <div class="row">

                              <div class="col-md-12 "> <h4 style="text-align: center;display: block;background: #A569BD;color: #fff;padding: 5px;margin-left: 15px;margin-right: 15px;">Semi Basement</h4></div>   

                            </div> 

                    @endif

                     @foreach($semi_basement_floor_list as $row)

                       @if($row->type=='Parking')

                               {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                                      <input type="hidden" name="property_id" value="{{$row->id}}">

                                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                                      <div class="col-md-3"> <div class="{!! $cls !!} flate-box">

                                              {!! $row->title !!} <br/>

                                             

                                              {!! number_format($row->price,2) !!} BDT

                                              <br/>

                                          </div>

                                          <label>{!!$row->owner_type !!}</label><br>

                                          <div class="btn-group">

                                              <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                               <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                              @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                                          </div>

                                          <br/><br/>

                                      </div>

                                      {{Form::close()}}

                                      @else

                                        {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                          <input type="hidden" name="property_id" value="{{$row->id}}">

                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                       <div class="col-md-2"> <div class="{!! $cls !!} flate-box">

                            {!! $row->title !!} <br/>

                            {!! $row->description !!} <br/>

                            

                               <br/>

                       </div>

                          @php 

                               $parking = $p * $row->no_parking;

                               //var_dump($parkingPrice);

                                //$totalPrice = $row->price+$parking;

                                $p = $row->r_parking_price;

								$totalPrice = $row->price;

                           @endphp

                          <label>Price: {!! number_format($row->price,2) !!} BDT</label><br>

                          <label>Car Parking ({{ $row->no_parking }}):  {!! number_format($p,2) !!} BDT</label><br>

                          <label>Total Price:  {!! number_format($totalPrice,2) !!} BDT</label><br>

                           <label>Owner Type: {!!$row->owner_type !!}</label><br>

                           

                           <label>Facing: {!!$row->facing !!}</label><br>

                           <label>Type: {!!$row->type !!}</label><br>

                           <label>Status:

                           @php

                          if($row->status==0) 

                          echo 'Free';

                          if($row->status==2) 

                          echo'Booked';

                          if($row->status==3) 

                          echo'Landowner';

                          if($row->status==1) echo

                          'Sold';

                          if($row->status==4) echo

                          'Common';

                      @endphp   

                           </label><br>

                            @if($row->status==2)

                            <label>Booking Date upto:  @php 

                                      echo date(' jS  F Y ', strtotime(@$row->booked_date));

                                  @endphp</label><br>

                            @endif

                           <div class="btn-group">

                              @if($row->status!=2)

                               <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                               <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                @endif

                                @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                   <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                   <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                 @endif

                                @endif

                               @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                           </div>

                           

                             @if($row->status==1)

                              <div  class="btn-group">

                                <button style=" visibility: hidden;" type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                              </div>

                             @endif

                           <br/><br/>

                       </div>

                              {{Form::close()}}

                                      @endif

                    @endforeach

                    @if(count($basement1_floor_list) > 0)

                      <div class="row">

                              <div class="col-md-12 "> <h4 style="text-align: center;display: block;background: #A569BD;color: #fff;padding: 5px;margin-left: 15px;margin-right: 15px;">Basement 1</h4></div>   

                            </div> 

                    @endif

                     @foreach($basement1_floor_list as $row)

                       @if($row->type=='Parking')

                               {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                                      <input type="hidden" name="property_id" value="{{$row->id}}">

                                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Common

                      @endphp

                                      <div class="col-md-3"> <div class="{!! $cls !!} flate-box">

                                              {!! $row->title !!} <br/>

                                             

                                              {!! number_format($row->price,2) !!} BDT

                                              <br/>

                                          </div>

                                          <label>{!!$row->owner_type !!}</label><br>

                                          <div class="btn-group">

                                              <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                            <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                              @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                                          </div>

                                          <br/><br/>

                                      </div>

                                      {{Form::close()}}

                                      @else

                                        {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                          <input type="hidden" name="property_id" value="{{$row->id}}">

                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                           if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                       <div class="col-md-2"> <div class="{!! $cls !!} flate-box">

                            {!! $row->title !!} <br/>

                            {!! $row->description !!} <br/>

                            

                               <br/>

                       </div>

                          @php 

                               $parking = $p * $row->no_parking;

                               //var_dump($parkingPrice);

                                //$totalPrice = $row->price+$parking;

                                $p = $row->r_parking_price;

								$totalPrice = $row->price;

                           @endphp

                          <label>Price: {!! number_format($row->price,2) !!} BDT</label><br>

                          <label>Car Parking ({{ $row->no_parking }}):  {!! number_format($p,2) !!} BDT</label><br>

                          <label>Total Price:  {!! number_format($totalPrice,2) !!} BDT</label><br>

                           <label>Owner Type: {!!$row->owner_type !!}</label><br>

                           

                           <label>Facing: {!!$row->facing !!}</label><br>

                           <label>Type: {!!$row->type !!}</label><br>

                           <label>Status:

                           @php

                          if($row->status==0) 

                          echo 'Free';

                          if($row->status==2) 

                          echo'Booked';

                          if($row->status==3) 

                          echo'Landowner';

                          if($row->status==1) echo

                          'Sold';

                          if($row->status==4) 

                          echo'Common';

                      @endphp   

                           </label><br>

                            @if($row->status==2)

                            <label>Booking Date upto:  @php 

                                      echo date(' jS  F Y ', strtotime(@$row->booked_date));

                                  @endphp</label><br>

                            @endif

                           <div class="btn-group">

                              @if($row->status!=2)

                               <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                @endif

                                @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                   <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                  <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                 @endif

                                @endif

                               @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                           </div>

                           

                             @if($row->status==1)

                              <div  class="btn-group">

                                <button style=" visibility: hidden;" type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                              </div>

                             @endif

                           <br/><br/>

                       </div>

                              {{Form::close()}}

                                      @endif

                    @endforeach

                    @if(count($basement2_floor_list) > 0)

                      <div class="row">

                              <div class="col-md-12 "> <h4 style="text-align: center;display: block;background: #A569BD;color: #fff;padding: 5px;margin-left: 15px;margin-right: 15px;">Basement 2</h4></div>   

                            </div> 

                    @endif

                     @foreach($basement2_floor_list as $row)

                       @if($row->type=='Parking')

                               {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                                      <input type="hidden" name="property_id" value="{{$row->id}}">

                                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                                      <div class="col-md-3"> <div class="{!! $cls !!} flate-box">

                                              {!! $row->title !!} <br/>

                                             

                                              {!! number_format($row->price,2) !!} BDT

                                              <br/>

                                          </div>

                                          <label>{!!$row->owner_type !!}</label><br>

                                          <div class="btn-group">

                                              <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                              <button type="submit" onclick="return confirm('Are you sure you want to Delete?')" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                              @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                                          </div>

                                          <br/><br/>

                                      </div>

                                      {{Form::close()}}

                                      @else

                                        {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                          <input type="hidden" name="property_id" value="{{$row->id}}">

                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                       <div class="col-md-2"> <div class="{!! $cls !!} flate-box">

                            {!! $row->title !!} <br/>

                            {!! $row->description !!} <br/>

                            

                               <br/>

                       </div>

                          @php 

                               $parking = $p * $row->no_parking;

                               //var_dump($parkingPrice);

                                //$totalPrice = $row->price+$parking;

                                $p = $row->r_parking_price;

								$totalPrice = $row->price;

                           @endphp

                          <label>Price: {!! number_format($row->price,2) !!} BDT</label><br>

                          <label>Car Parking ({{ $row->no_parking }}):  {!! number_format($p,2) !!} BDT</label><br>

                          <label>Total Price:  {!! number_format($totalPrice,2) !!} BDT</label><br>

                           <label>Owner Type: {!!$row->owner_type !!}</label><br>

                           

                           <label>Facing: {!!$row->facing !!}</label><br>

                           <label>Type: {!!$row->type !!}</label><br>

                           <label>Status:

                           @php

                          if($row->status==0) 

                          echo 'Free';

                          if($row->status==2) 

                          echo'Booked';

                          if($row->status==3) 

                          echo'Landowner';

                          if($row->status==1) echo

                          'Sold';

                          if($row->status==4) echo

                          'Common';

                      @endphp   

                           </label><br>

                            @if($row->status==2)

                            <label>Booking Date upto:  @php 

                                      echo date(' jS  F Y ', strtotime(@$row->booked_date));

                                  @endphp</label><br>

                            @endif

                           <div class="btn-group">

                              @if($row->status!=2)

                               <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                               <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                @endif

                                @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                   <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                  <button type="submit" name="edit" onclick="return confirm('Are you sure you want to Delete?')" value="delete" class="btn btn-danger">Delete</button>

                                 @endif

                                @endif

                               @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                           </div>

                           

                             @if($row->status==1)

                              <div  class="btn-group">

                                <button style=" visibility: hidden;" type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                              </div>

                             @endif

                           <br/><br/>

                       </div>

                              {{Form::close()}}

                                      @endif

                    @endforeach

                      

                      @if(count($mezzanine_floor_list) > 0)

                      <div class="row">

                              <div class="col-md-12 "> <h4 style="text-align: center;display: block;background: #A569BD;color: #fff;padding: 5px;margin-left: 15px;margin-right: 15px;">Mezzanine Floor</h4></div>   

                            </div> 

                    @endif

                     @foreach($mezzanine_floor_list as $row)

                       

                                 @if($row->type=='Parking')

                               {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                                      <input type="hidden" name="property_id" value="{{$row->id}}">

                                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                                      <div class="col-md-3"> <div class="{!! $cls !!} flate-box">

                                              {!! $row->title !!} <br/>

                                             

                                              {!! number_format($row->price,2) !!} BDT

                                              <br/>

                                          </div>

                                          <label>{!!$row->owner_type !!}</label><br>

                                          <div class="btn-group">

                                              <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                              <button onclick="if (!confirm('Are you sure delete?')) { return false }"type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                              @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                                          </div>

                                          <br/><br/>

                                      </div>

                                      {{Form::close()}}

                                      @else

                                        {{Form::open(array('url'=>'property/edit-property/'.$row->project_id,'method'=>'post','id'=>'master_div'))}}

                          <input type="hidden" name="property_id" value="{{$row->id}}">

                      @php

                          if($row->status==0) $cls='bg-gray';$status_type = 'Free'; // Free

                          if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked

                          if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold

                          if($row->status==3) $cls='bg-yellow';$status_type = 'LandOwner'; // Sold

                          if($row->status==4) $cls='bg-info';$status_type = 'Common'; // Sold

                      @endphp

                       <div class="col-md-2"> <div class="{!! $cls !!} flate-box">

                            {!! $row->title !!} <br/>

                            {!! $row->description !!} <br/>

                            

                               <br/>

                       </div>

                          @php 

                               $parking = $p * $row->no_parking;

                               //$parking = $p;

                               //var_dump($parkingPrice);

                                //$totalPrice = $row->price+$parking;

                                $p = $row->r_parking_price;

								$totalPrice = $row->price;

                           @endphp

                          <label>Price: {!! number_format($row->price,2) !!} BDT</label><br>

                          <label>Car Parking ({{ $row->no_parking }}) ({{ $p }}):  {!! number_format($p,2) !!} BDT</label><br>

                          <label>Total Price:  {!! number_format($totalPrice,2) !!} BDT</label><br>

                           <label>Owner Type: {!!$row->owner_type !!}</label><br>

                           

                           <label>Facing: {!!$row->facing !!}</label><br>

                           <label>Type: {!!$row->type !!}</label><br>

                           <label>Status:

                           @php

                          if($row->status==0) 

                          echo 'Free';

                          if($row->status==2) 

                          echo'Booked';

                          if($row->status==3) 

                          echo'Landowner';

                          if($row->status==4) 

                          echo'Common';

                          if($row->status==1) echo

                          'Sold';

                      @endphp   

                           </label><br>

                            @if($row->status==2)

                            <label>Booking Date upto:  @php 

                                      echo date(' jS  F Y ', strtotime(@$row->booked_date));

                                  @endphp</label><br>

                            @endif

                           <div class="btn-group">

                              @if($row->status!=2)

                               <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                               <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                @endif

                                @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                   <button type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                                  <button onclick="return confirm('Are you sure you want to Delete?')" type="submit" name="edit" value="delete" class="btn btn-danger">Delete</button>

                                 @endif

                                @endif

                               @if(\Auth::user()->group_id==1)

                                 @if($row->status==2)

                                 <button id="update_book_date" data="{!! $row->booked_date !!}" pid="{!! $row->id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">booked</button>

                                 @endif

                               @endif

                           </div>

                           

                             @if($row->status==1)

                              <div  class="btn-group">

                                <button style=" visibility: hidden;" type="submit" name="edit" value="edit" class="btn btn-warning">Edit</button>

                              </div>

                             @endif

                           <br/><br/>

                       </div>

                              {{Form::close()}}

                                      @endif

                    @endforeach

                  </div>

                </div>

                <div class="col-md-12">

                    <h3 style="text-align: center;" class="box-title">New property </h3>

                  <!-- form start -->

                  {{Form::open(array('url'=>'property/store','method'=>'post', 'class'=>'form-horizontal'))}}

                    <div class="form-group">

                      <label for="inputEmail3" class="col-sm-3 control-label"> Title <span class="text-danger">*</span> </label>

                      <div class="col-sm-7">

                        <input type="text" name="title" parsley-trigger="change" placeholder="Property title" class="form-control" id="title" required>

                      </div>

                    </div>

                    <div class="form-group">

                    <label for="inputEmail3" class="col-sm-3 control-label">Owner Type<span class="text-danger">*</span> </label>

                    <div class="col-sm-7">

                        <select name="ownertype" class="form-control"  required>

                            <option value="">Select Owner Type</option>

                            <option value="UDDL">UDDL</option>

                            <option value="LandOwner">LandOwner</option>

                            <option value="Common">Common</option>

                        </select>

                    </div>

                    </div>

                    <div class="form-group">

                    <label for="inputEmail3" class="col-sm-3 control-label">Apartment Type<span class="text-danger">*</span> </label>

                    <div class="col-sm-7">

                        <select id="propertytype" name="propertytype" class="form-control"  required>

                          

                           <option value="">Select Apartment Type</option>

                                <option value="Parking">Parking</option>

                                <option value="Apartment-Residential">Apartment-Residential</option>

                                <option value="Apartment-Commercial">Apartment-Commercial</option>

                                <option value="Commercial">Commercial</option>

                                <option value="Common Facilities">Common Facilities</option>

                                <option value="Community Hall">Community Hall</option>

                        </select>

                    </div>

                    </div>

                     

                    

                   <div id="parking_type" style="display: none;" class="form-group parkingtype">

                    <label for="inputEmail3" class="col-sm-3 control-label">Parking Type<span class="text-danger">*</span> </label>

                    <div class="col-sm-7">

                        <select id="parking_title" name="parkingtype" class="form-control" >

                       

                           <option value="">Select Parking Type</option>

                                <option value="Ground Floor">Ground Floor</option>

                                <option value="Semi Basement">Semi Basement</option>

                                <option value="Basement 1">Basement 1</option>

                                <option value="Basement 2">Basement 2</option>

                                <option value="Basement 3">Basement 3</option>

                                 <option value="Basement 4">Basement 4</option>

                                  <option value="Basement 5">Basement 5</option>

                                <option value="Basement Floor">Basement Floor</option>

                                <option value="Mezzanine Floor">Mezzanine Floor</option>

                        </select>

                    </div>

                    </div>



                    <div class="apperment_type">

                        <div class="form-group">

                            <label for="inputEmail3" class="col-sm-3 control-label">Floor No <span class="text-danger">*</span> </label>

                            <div class="col-sm-7">

                                <input type="text" name="floor_no" parsley-trigger="change" placeholder="Floor No" class="form-control"  id="title">

                            </div>

                        </div> 

              

                        <div class="form-group">

                            <label for="inputEmail3" class="col-sm-3 control-label">Facing<span class="text-danger">*</span> </label>

                            <div class="col-sm-7">

                                <input type="text" name="facing" 

                                      placeholder="Facing" class="form-control" id="title">

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="inputEmail3" class="col-sm-3 control-label">Earnest Money<span class="text-danger">*</span> </label>

                            <div class="col-sm-7">

                                <input type="text"  name="earnest_money" placeholder="Earnest Money" class="form-control" >

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="inputEmail3" class="col-sm-3 control-label">Down Payment<span class="text-danger">*</span> </label>

                            <div class="col-sm-7">

                                <input type="text"  name="down_payment"

                                       placeholder="Down Payment" class="form-control" >

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="inputEmail3" class="col-sm-3 control-label">Reserved Parking : </label>

                            <div class="col-sm-7">

                                <select id="parking_no" name="nop" class="form-control" style="width:70px; float:left;" >

                                    <option value="">Select </option>

                                    <option value="0" >0</option>

                                    <option value="1" >1</option>

                                    <option value="2" >2</option>

                                    <option value="3" >3</option>

                                </select>

                                <span class="inp_20"> nos </span> 

                                <input type="text" value="" name="r_parking_price" id="r_parking_price" onblur="changeReservedParking();" class="form-control inp_30" > <span class="inp_20"> BDT </span> 

                            </div>

                        </div>                                            

                    </div>







      <script type="text/javascript">

          function changeSF(in_value, put_div, in_sft)

          {

              var sft = $("#"+in_sft).val();  

              if(in_value>0){

                  var div_value = in_value/sft;

              } else {

                  var div_value = 0;

              }    

              

              $("#"+put_div).html('@ '+div_value.toFixed(2)+' p/sft ');

              //var integer = parseInt(text, 10);

      

              total_price();

          }

      

          function changeReservedParking()

          {

              total_price();

              //alert("cccc");

          }

      

          function total_price()

          {

              //alert("cccc");

              var t_price = Number($("#apt_comm_price").val()); 

              var t_price = t_price+Number($("#planter_price").val());

              var t_price = t_price+Number($("#e_slab_price").val());

              var t_price = t_price+Number($("#g_terrace_price").val());

              $("#price").val(t_price);



              var t_price = t_price+Number($("#r_parking_price").val());

              $("#total_price").val(t_price);

          }    

    

    </script>



                  <div id="Apt_details" >

          

                      <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label">Apt./Comm. : </label>

                        <div class="col-sm-7">

                            <input type="text" value="" name="apt_comm_size" id="apt_comm_size" class="form-control inp_10" > <span class="inp_20"> sft </span> 

                            <span class="inp_40" id="apt_S"> @ p/sft </span> 

                            <input type="text" value="" name="apt_comm_price" id="apt_comm_price" onblur="changeSF(this.value,'apt_S','apt_comm_size');" class="form-control inp_30" > <span class="inp_20"> BDT </span> 

                        </div>

                      </div>

                    

                      <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label">Planter : </label>

                        <div class="col-sm-7">

                            <input type="text" value="" name="planter_size" id="planter_size" class="form-control inp_10" > <span class="inp_20"> sft </span> 

                            <span class="inp_40" id="P_S"> @  p/sft </span> 

                            <input type="text" value="" name="planter_price" id="planter_price" onblur="changeSF(this.value,'P_S','planter_size');" class="form-control inp_30" > <span class="inp_20"> BDT </span> 

                        </div>

                      </div>

                    

                      <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label">Extended Slab  : </label>

                        <div class="col-sm-7">

                            <input type="text" value="" name="e_slab_size" id="e_slab_size" class="form-control inp_10" > <span class="inp_20"> sft </span>

                            <span class="inp_40" id="ES_S"> @ p/sft </span> 

                            <input type="text" value="" name="e_slab_price" id="e_slab_price" onblur="changeSF(this.value,'ES_S','e_slab_size');" class="form-control inp_30" > <span class="inp_20"> BDT </span> 

                        </div>

                      </div>

                     

                      <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label">Garden Terrace : </label>

                        <div class="col-sm-7">

                            <input type="text" value="" name="g_terrace_size" id="g_terrace_size" class="form-control inp_10" > <span class="inp_20"> sft </span>

                            <span class="inp_40" id="GT_S"> @ p/sft </span> 

                            <input type="text" value="" name="g_terrace_price" id="g_terrace_price" onblur="changeSF(this.value,'GT_S','g_terrace_size');" class="form-control inp_30" > <span class="inp_20"> BDT </span>

                        </div>

                      </div> 



                  </div>





                    <div class="form-group">

                      <label for="inputEmail3" class="col-sm-3 control-label">Property price <span class="text-danger">*</span> </label>

                      <div class="col-sm-7">

                          <span style="widt:130px; float:left; " > &nbsp;. </span> 

                          <input type="text" name="price" parsley-trigger="change" placeholder="Property price" class="form-control inp_30" id="price" required>

                      </div>

                    </div>



                    <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label"> Total Property Price <span class="text-danger">*</span> </label>

                        <div class="col-sm-7">

                            <input type="text" readonly value=""  class="form-control" id="total_price" />

                        </div>

                    </div>



                    <div class="form-group">

                      <label for="inputEmail3" class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>

                      <div class="col-sm-7">

                        <select class="form-control" name="status" required>

                          <option value="">Select Property status</option>

                          <option value="0">Unsold</option>

                          <option value="1">Sold</option>

                          <option value="2">Booked</option>

                          <option value="3">Landowner</option>

                          <option value="4">Common</option>

                        </select>

                      </div>

                    </div>

                  <div class="box-footer">

                    <div class="form-group">

                        <button type="submit" class="btn btn-info pull-right">Add Now</button>

                        <input type="hidden" name="project_id" value="{!! $project_id !!}" >

                    </div>

                  </div>

                  <!-- /.box-footer -->

                  {{Form::close()}}

                </div>

            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->

        

          <!-- /.box -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->

    </section>

    <style>

        .inp_10 { float: left; width: 70px; }

        .inp_30 { float: left; width: 120px; text-align: right; }

        .inp_20 { float: left; width: 60px; padding: 0px 15px; }

    </style>

    <div class="modal fade" id="Modal-Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h3> Change Booking Update </h3>

                </div>

                <div class="modal-body">

                    <form class="form-horizontal" action="{!! url('/property/updatebook') !!}" method="POST">

                        <div class="form-group">

                            <label class="col-sm-3 control-label" for="name"> Booking Date </label>

                            <div class="col-sm-7">

                                <input name="booked_date" id="booked_date" type="date" value=""  class="form-control" >

                            </div>

                        </div>

                      

                        <div class="form-group">

                            <label class="col-md-4 control-label" for="name"> &nbsp; </label>

                            <div class="col-md-6">

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </div>

                        </div>

                        <input id="pid" type="hidden" name="pid" value=""/>

                        <input  type="hidden" name="id" value="{!! $project_info->id !!}"/>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>

            </div>

        </div>

    </div>

      <style>

        .right_btn {

              float: right;

              margin: 10px 5px 10px 10px;

          }

        .bg-green { background-color: #398439 }

        .bg-red { background-color: #c12e2a }

        .bg-yellow { background-color: #9ad717 }

        .flate-box { height: auto; width: 100%;margin-bottom: 6px;text-align: center;padding-top: 5px;font-size: 13px;}

      </style>

  <script>

  $(function () {

    $("#example1").DataTable();

    $('#example2').DataTable({

      "paging": true,

      "lengthChange": false,

      "searching": false,

      "ordering": true,

      "info": true,

      "autoWidth": false

    });

  });

  jQuery(document).ready(function($){

    $('#update_book_date').click(function() {

        var dateval = $(this).attr('data');

        var pid = $(this).attr('pid');

        $('#booked_date').val(dateval);

        $('#pid').val(pid);

    });

});

</script>

@endsection    