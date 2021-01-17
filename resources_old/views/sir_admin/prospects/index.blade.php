@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1> Prospect Manager <small> All Prospect list </small> </h1>
      </section>

       <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row"> 
        <div class="col-sm-12">
            <a class="right_btn btn btn-primary"  href="{{ url('posperts/add/') }}"  ><i class="fa fa-plus"></i> New Posperts</a>

            @if(session()->has('message'))
                 <div class="alert alert-success">
                    {{ session()->get('message') }}
                  </div>
            @endif

            <table class="table  table-striped">
              <thead>
                <tr>
                  <th>Posperts Name </th>
                  <th>Email </th>
                  <th>Phone Number </th> 
                  <th>Address</th>
                  <th>Status</th>
                  <th width="150">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($prospects as $prospect)
                <tr>
                  <td>{{ $prospect->name }} </td>
                  <td>{{ $prospect->email }} </td>
                  <td>{{ $prospect->phone }}</td>
                  <td>{{ $prospect->address }}</td> 
                  <td>
                   @if($prospect->status == 1 )
                     <button type="button" class="btn btn-success">Active</button>
                   @else
                    <button type="button" class="btn btn-warning">Inactive</button>
                   @endif                  
                  </td>
                  <td> 
                    <a href="{{ url('posperts/edit/'.$prospect->prospects_id) }}"  class="btn btn-success"><i class="fa fa-edit"></i></a>
                  
                    <a onclick="return confirm('You are going to delete ?')" href="{{ url('posperts/delete/'.$prospect->prospects_id) }}"  class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
                @endforeach
              
              </tbody>
            </table>

        </div>
        </div>
      </section>
      <style>
        .right_btn {
              float: right;
              margin: 10px 5px 10px 10px;
          }
      </style>
@endsection    