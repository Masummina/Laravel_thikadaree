@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
           Project Details
          <small> This project details   </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('project') }}"><i class="fa fa-dashboard"></i> Projects</a></li>
          <li class="active">Project details</li>
        </ol>
      </section>
      <?php // print_r($project)  ; ?>
       <section class="content">
        <!-- Small boxes (Stat box) -->
        
        <div class="row">
        <div class="col-sm-12">
          <div class="card-box">
          <table class="table  table-striped" >
            <tr>
                <th colspan="2"  style="text-align: center ;">Project Details </th>
            </tr>
            <tr>
                <td width="25%">Title</td>
                <td width="75%">{{ $project->title}}</td>
            </tr>
            <tr>
                <td>Type</td>
                <td>{{ $project->type}}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $project->address}}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td> @if($project->status == 1 )
                     <button type="button" class="btn btn-success">Active</button>
                   @else
                    <button type="button" class="btn btn-warning">Inactive</button>
                   @endif</td>
            </tr>
            <tr>
                <td>Created At</td>
                <td>{{ $project->created_at}}</td>
            </tr>
            <tr>
                <td>Updated At</td>
                <td>{{ $project->updated_at}}</td>
            </tr>
            <tr>
                    <th colspan="2"  style="text-align: center ;">Flat Details </th>
            </tr>

            </table>
          </div> <!-- end card-box -->
        </div>
      </div>
      </section>
@endsection    