@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Update property 
          <small> This property update   </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('property') }}"><i class="fa fa-dashboard"></i> property</a></li>
          <li class="active">Update property</li>
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
            {{Form::open(array('url'=>'property/update/'.$property->property_id,'method'=>'post', 'class'=>'form-horizontal'))}}
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

              <?php // print_r( $property) ?>

               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project  <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                     <select class="form-control" name="project_id">
                        <option value="">Select project </option>
                        @foreach($projects as $project)
                          <option <?php if($property->property_id == $project->project_id ){ echo 'selected' ; } ?>  value="{{ $project->project_id }}">{{$project->title}}</option>
                        @endforeach
                       
                     </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Property title <span class="text-danger">*</span> </label>

                  <div class="col-sm-7">
                     <input type="text" name="title" value="{{$property->title}}" parsley-trigger="change" 
                             placeholder="Property title" class="form-control" id="title">
                  </div>
                </div>

            

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project Description <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                    <textarea parsley-trigger="change" name="description"
                             placeholder="Project Description" class="form-control" style="min-height: 200px;" id="editor_no">{{$property->description}}</textarea>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Property price <span class="text-danger">*</span> </label>

                  <div class="col-sm-7">
                     <input type="text" name="price" parsley-trigger="change" value="{{$property->price}}"
                             placeholder="Property price" class="form-control" id="title">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                      <select class="form-control" name="status">
                        <option value="">Select Property status</option>
                        <option <?php if($property->status == '1'){ echo 'selected' ; } ?> value="1">Active</option>
                        <option <?php if($property->status == '0'){ echo 'selected' ; } ?> value="0">Inactive</option>
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