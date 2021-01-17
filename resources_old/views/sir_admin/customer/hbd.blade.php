@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header clearfix">
        <h1 class="pull-left"> Greeting / Wishes   </h1>


          @if($customer_list && count($customer_list) > 0 )
              @php $download_link=''; @endphp
              <p class="pull-right" >  &nbsp;&nbsp;&nbsp;
                  Print : <span class="glyphicon glyphicon-print  " onclick="PrintElem('#print_bday')" > </span>
                  <!-- Download :<a href="{!! $download_link !!}" target="_blank" >  <span class="glyphicon glyphicon-download-alt"  > </span> </a> -->
              </p>
          @endif

      </section>
      
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">

                @if(session()->has('success'))
                   <div class="alert alert-success">
                      {{ session()->get('success') }}
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
                    <form id="bday" method="get" class="pull-right form-inline my-2 my-lg-0" action="">
                        <span class="report-headline">  Search by Month </span>
                        <select name="month" class="form-control" id="exampleSelect1">
                            <option>Select Month</option>
                            @foreach ($months as $key =>$value)
                                <option @if(@$_GET["month"]== ($key+1)) selected @endif value="{{$key+1}}">{{$value}}</option>
                            @endforeach


                        </select>
                        <input  type="submit" class="btn btn-secondary my-2 my-sm-0" value=" Search " name="submit">
                    </form>

                <div class="col-md-12">
                  <div class="row clearfix">
                      


                     <div id='print_bday'>

                         <div class="box-header with-border" style="text-align: center;  ">
                             <h3 class="box-title">
                                 Urban Design &amp; Development Ltd. <br/>
                                <small> House No. 34/A, Road No. 10/A (new), Dhanmondi R/A., Dhaka-1209 </small>
                             </h3>
                         </div>

                         @if($customer_list && count($customer_list) > 0 )

                              <table class="table  table-striped">
                                  <thead>
                                  <tr>
                                      <th>ID# </th>
                                      <th>Name </th>

                                      <th>Mobile </th>
                                      <th>Type </th>
                                      <th>Date of birth </th>
                                      <th>Date of Marriage </th>
                                      <th>Team Member</th>
                                      <th>Team</th>

                                  </tr>
                                  </thead>
                                  <tbody>
                                  @php $i=0 @endphp
                                  @foreach($customer_list as $row)
                                      @php $i++; @endphp
                                      <tr>
                                          <td> 000{{ $row->id }} </td>
                                          <td><b>{{ $row->prefix }} {{ $row->name }}</b> </td>
                                           <td>{{ $row->mobile }} </td>
                                          <td>{{ $row->type }} </td>
                                           <td>@php
                                                   if(!is_null($row->dob))
                                                 echo date('l jS  F Y ', strtotime($row->dob));
                                          @endphp</td>
                                          <td>@php
                                                    if(!is_null($row->dom))
                                                  echo date('l jS  F Y ', strtotime($row->dom));
                                              @endphp</td>
                                           <td>{{ $row->created_by }} </td>
                                          <td>@php

                                    $users = DB::table('users')
                                                 ->select('team_id')
                                                 ->where('id','=', $row->
                                                 created_id)->first();

                                    if(isset($users->team_id)){
                                    $teams = DB::table('teams')
                                                 ->select('name')
                                                 ->where('id','=', $users->team_id)->first();
                                      echo  $teams->name;
                                    }
                                   @endphp
                                     </td>
                                  </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                         @else
                             No data found
                         @endif

                     </div>



                  </div>
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
     <div class="modal fade" id="Modal-Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3> Move Prospects </h3>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" action="{!! url('/customers/create-cp') !!}" method="POST">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Team </label>
                            <div class="col-md-6">
                           <select name="team" class="form-control " id="team">
                            <option>Select Team</option>

                            @foreach ($allteams as $team)
                                  <option value="{{$team->id}}">{{$team->name}}</option>
                               @endforeach
                    
                  
                      </select>
                </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Team Member</label>
                            <div class="col-md-6">
                           <select name="team_member" class="form-control ">
                            <option>Select Team Member</option>
                  
                      </select>
                </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name"> &nbsp; </label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                        <input id="pid" type="hidden" name="pid" value=""/>
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
        .flate-box { height: 80px; width: 100%; margin-bottom: 6px; text-align: center; padding-top: 10px; font-size: 16px; }
      </style>
@endsection    