@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header clearfix">
        <h1 class="pull-left">  Common Bin </h1>
        <div class="row">
              <div class="col-xs-12">
                  @php $group_id = \Auth::user()->group_id; @endphp
                  <form id="advanced_s" method="get" class="  form-inline my-2 my-lg-0" action="">
                      <div class="row mt-1">
                        @if(count($team_memebers)>1)
                          <div class="col-sm-3">
                            <span class="report-headline"> Member : </span>
                              <select name="user" class="form-control" id="exampleSelect1" style="width: 170px !important;">
                                  <option value="all">All Memeber</option>
                                  @foreach ($team_memebers as $team)
                                      <option @if(@$_GET["user"]==$team->id) selected @endif value="{{$team->id}}">{{$team->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                        @endif
                        <div class="col-sm-9">
                            <span class="report-headline">  Name : </span>
                            <input type="text" name="customer_name" value="{{@$_GET['customer_name']}}" minlength="4" style="width: 150px">
                            <span class="report-headline"> Mobile : </span>
                            <input type="text" name="customer_mobile" value="{{@$_GET['customer_mobile']}}" minlength="5" style="width: 150px" >

                            <input  type="submit" class="btn btn-primary" value=" Search " name="submit" style="margin-left: 20px">
                        </div>
                      </div>

                  </form>

              </div>
          </div>
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

                <div class="col-md-12">
                  <div class="row clearfix">
                      @if($customer_list && count($customer_list) > 0 )

                      <table class="table  table-striped">
                          <thead>
                          <tr>
                              <th>S# </th>
                              <th>ID </th>
                              <th>Name </th>
                              <th>Mobile </th>
                              <th>Team Member</th>
                              <th>Team</th>
                              <th width="340">Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          @php $i=0 @endphp
                          @foreach($customer_list as $row)
                              @php $i++; @endphp
                              @php
                                  $CID = 10000000+$row->id;
                                  $CID = substr($CID,1,7);
                              @endphp
                              <tr>
                                  <td>{{ $i }} </td>
                                  <td > {{ $CID }} </td>
                                  <td><b> {{ $row->prefix }} {{ $row->name }} </b></td>
                                  <td>{{ $row->mobile }} </td>
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

                                  <td>
  <form  class="pull-left" action="{{ url('/customers/create-cp/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to move?')" >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <button type="submit" class="btn btn-default">Make My Prospect
 </button>
                                      </form>
                                  
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
        .right_btn {
              float: right;
              margin: 10px 5px 10px 10px;
          }
        .bg-green { background-color: #398439 }
        .bg-red { background-color: #c12e2a }
        .bg-yellow { background-color: #9ad717 }
        .flate-box { height: 80px; width: 100%; margin-bottom: 6px; text-align: center; padding-top: 10px; font-size: 16px; }
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
</script>
@endsection    