@extends('admin.layouts.layout')
@section('content')

    @php //dd('in new');@endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          New project 
          <small> Add new project  </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('project') }}"><i class="fa fa-dashboard"></i> Projects</a></li>
          <li class="active">New Project</li>
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
              <h3 class="box-title">New project</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              {{Form::open(array('url'=>'project/store','method'=>'post', 'class'=>'form-horizontal'))}}
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
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project area <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                     <input type="text" name="area" parsley-trigger="change" 
                             placeholder="Area" class="form-control" id="area">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project Name <span class="text-danger">*</span> </label>

                  <div class="col-sm-7">
                     <input type="text" name="title" parsley-trigger="change" 
                             placeholder="Project title" class="form-control" id="title">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Project Type <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                     <select id="pps" class="form-control" name="type">
                        <option value="">Select project type</option>
                        <option value="Apartment">Apartment</option>
                        <option value="Commercial">Commercial</option>
                         <option value="Apartment & Commercial">Apartment & Commercial</option>
                         <option value="Common Facilities">Common Facilities</option>
                         <option value="Community Hall">Community Hall</option>
                     </select>
                  </div>
                </div>
                <div  id="property">

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Project address <span class="text-danger">*</span></label>

                      <div class="col-sm-7">
                        <textarea parsley-trigger="change" name="address"
                                 placeholder="Project address " class="form-control"   id="editor_no"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Project Description <span class="text-danger">*</span></label>

                        <div class="col-sm-7">
                            <textarea parsley-trigger="change" name="description"
                              placeholder="Project Description" class="form-control"  id="editor_no"></textarea>
                              
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
                    
                    </div>

                   

                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>

                  <div class="col-sm-7">
                      <select class="form-control" name="status">
                                <option value="">Select project status</option>
                                <option value="1">Ready</option>
                                <option value="2">Ongoing</option>
                                <option value="3">Forthcoming</option>
                                <option value="4">Sold</option>
                             </select>
                  </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label"> Flat or Plot List <span class="text-danger">*</span> </label>

                    <div class="col-sm-3">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".AddProperty" data-whatever="@Property"> Add Property </button>
                    </div>

                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" id="property_details">

                        </div>
                    </div>
                </div>
                
                
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                 <div class="form-group">

                  <div class="col-sm-3"></div>

                     <div class="col-sm-7">

                      <button type="submit" class="btn btn-default">Cancel</button>
                      <button type="submit" class="btn btn-info pull-right">Add Project </button>
                    </div>
                </div>
              </div>
              <!-- /.box-footer -->
            {{Form::close()}}
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->


            <div class="row" >
                @include('admin.projects.new-property-modal')
            </div>


          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
@endsection    