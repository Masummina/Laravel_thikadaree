@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          New Prospects
          <small> Add new prospects  </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('project') }}"><i class="fa fa-dashboard"></i> Projects</a></li>
          <li class="active">New prospects</li>
        </ol>
      </section>
      <?php // print_r($projects)  ; ?>
       <section class="content">
        <!-- Small boxes (Stat box) -->
        
        <div class="row">
        <div class="col-sm-8">
          <div class="card-box">

              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

              <div class="panel-body">
                {{Form::open(array('url'=>'posperts/store','method'=>'post', 'class'=>'form-horizontal'))}} 

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
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="address" class="form-control" name="address" value="{{ old('address') }}" required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="active" class="col-md-4 control-label">Project</label>
                            <div class="col-md-6">
                                <select class="form-control" name="project">
                                    <option value="">Select Project</option>
                                    $project_list
                                    <option value="1">Project 1</option>
                                    <option value="2">Project 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="active" class="col-md-4 control-label">Property</label>
                            <div class="col-md-6">
                                <select class="form-control" name="property">
                                    <option selected disabled>Select Property</option>
                                    <option value="1">Property 1</option>
                                    <option value="2">Property 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="active" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>                         
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    {{Form::close()}}
              </div>
          </div> <!-- end card-box -->
        </div>
      </div>
      </section>
@endsection    