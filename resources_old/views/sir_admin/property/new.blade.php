@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          New Property  
          <small> Add new Property   </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('property') }}"><i class="fa fa-dashboard"></i> Property </a></li>
          <li class="active">New Property </li>
        </ol>
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
              <h3 class="box-title">New Property </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              {{Form::open(array('url'=>'property/store','method'=>'post', 'class'=>'form-horizontal'))}}
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
              <?php // print_r($projects) ?>
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project  <span class="text-danger">*</span></label>
                  <div class="col-sm-7">
                     <select class="form-control" name="project_id">
                        <option value="">Select project </option>
                        @foreach($projects as $project)
                          <option value="{{ $project->project_id }}">{{$project->title}}</option>
                        @endforeach
                       
                     </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Property title <span class="text-danger">*</span> </label>
                  <div class="col-sm-7">
                     <input type="text" name="title" parsley-trigger="change" 
                             placeholder="Property title" class="form-control" id="title">
                  </div>
                </div>
                  <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Floor No <span class="text-danger">*</span> </label>
            <div class="col-sm-7">
                <input type="text" value="{{$property_fields[0]->floor_no}}" name="floor_no" parsley-trigger="change" placeholder="Floor No" class="form-control" required id="title">
            </div>
        </div> 
        
            
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project Description <span class="text-danger">*</span></label>
                  <div class="col-sm-7">
                    <textarea parsley-trigger="change" name="description"
                             placeholder="Project Description" class="form-control" style="min-height: 200px;" id="editor_no"></textarea>
                  </div>
                </div>
                <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">land (katha)<span class="text-danger">*</span> </label>
                        <div class="col-sm-7">
                            <input type="text" name="land" 
                                   placeholder="land (katha)" class="form-control" id="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Building ( storage)<span class="text-danger">*</span> </label>
                        <div class="col-sm-7">
                            <input type="text" name="building" 
                                   placeholder="Building ( storage)" class="form-control" id="title">
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
                        <label for="inputEmail3" class="col-sm-3 control-label">Landmarking<span class="text-danger">*</span> </label>
                        <div class="col-sm-7">
                            <input type="text" name="landmarking" 
                                   placeholder="Landmarking" class="form-control" id="title">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Hand over<span class="text-danger">*</span> </label>
                        <div class="col-sm-7">
                            <input type="date" name="hand_over" 
                                   placeholder="Hand over" class="form-control" id="title">
                        </div>
                    </div>
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Property price <span class="text-danger">*</span> </label>
                  <div class="col-sm-7">
                     <input type="text" name="price" parsley-trigger="change" 
                             placeholder="Property price" class="form-control" id="title">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
                  <div class="col-sm-7">
                      <select class="form-control" name="status">
                        <option value="">Select Property status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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
                      <button type="submit" class="btn btn-info pull-right">Add Now</button>
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
        
    </section>
@endsection    