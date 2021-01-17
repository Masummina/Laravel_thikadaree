@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          User Manager
          <small> All Users list </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section> 
       <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row"> 
        <div class="col-sm-12"> 
          <div class="card-box">
          @if(session()->has('message'))
             <div class="alert alert-success">
                {{ session()->get('message') }}
              </div>
          @endif
            <table class="table  table-striped">
              <thead>
                <tr>
                  <th>User Type </th>
                  <th>Email </th>
                  <th>Phone Number </th>  
                  <th>Status</th> 
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{ $user->name }} </td>
                  <td>{{ $user->email }} </td>
                  <td>{{ $user->phone }}</td> 
                  <td>
                   @if($user->status == 1 )
                     <button type="button" class="btn btn-success">Active</button>
                   @else
                    <button type="button" class="btn btn-warning">Inactive</button>
                   @endif                  
                  </td> 
                </tr>
                @endforeach
              
              </tbody>
            </table>
          </div>
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