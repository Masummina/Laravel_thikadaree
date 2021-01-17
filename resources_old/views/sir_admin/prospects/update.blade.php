@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Update project 
          <small> This project update   </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('project') }}"><i class="fa fa-dashboard"></i> Projects</a></li>
          <li class="active">Update Project</li>
        </ol>
      </section>


         <section class="content">
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">New project</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{Form::open(array('url'=>'project/update/'.$project->id,'method'=>'post', 'class'=>'form-horizontal'))}}
                  
            
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

                @if(session()->has('message'))
                   <div class="alert alert-success">
                      {{ session()->get('message') }}
                    </div>
                @endif
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project title <span class="text-danger">*</span> </label>

                  <div class="col-sm-7">
                     <input type="text" name="title" parsley-trigger="change" 
                             placeholder="Project title" value="{{$project->title}}" class="form-control" id="title">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project/Apartment Type <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                     <select class="form-control" name="type">
                                <option value="">Select project type</option>
                                <option <?php if($project->type == 'Apartment'){ echo 'selected' ; } ?> value="Apartment">Apartment</option>
                                <option <?php if($project->type == 'Commercial'){ echo 'selected' ; } ?>  value="Commercial">Commercial</option>
                         <option <?php if($project->type == 'Apartment & Commercial'){ echo 'selected' ; } ?>  value="Apartment & Commercial">Apartment & Commercial</option>
                     </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project area <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                      <input type="text" value="{{$project->area}}" name="area" parsley-trigger="change" 
                             placeholder="Area" class="form-control" id="area">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project address <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                    <textarea parsley-trigger="change" name="address"
                             placeholder="Project address " class="form-control" style="min-height: 200px;" id="editor_no">{{$project->address}}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                      <select class="form-control" name="status">
                                <option value="">Select project status</option>
                                <option <?php if($project->status == '1'){ echo 'selected' ; } ?> value="1">Ready</option>
                                <option <?php if($project->status == '2'){ echo 'selected' ; } ?> value="2">Ongoing</option>
                                <option <?php if($project->status == '3'){ echo 'selected' ; } ?> value="3">Forthcoming</option>
                                <option <?php if($project->status == '4'){ echo 'selected' ; } ?> value="4">Sold</option>
                             </select>
                  </div>
                </div>
                
                
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                 <div class="form-group">

                  <div class="col-sm-3"></div>

                     <div class="col-sm-7">

                      <button type="submit" class="btn btn-default">Cancel</button>
                      <button type="submit" class="btn btn-info pull-right">Update Now</button>
                    </div>
                </div>
              </div>
              <!-- /.box-footer -->
            {{Form::close()}}
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
@endsection    