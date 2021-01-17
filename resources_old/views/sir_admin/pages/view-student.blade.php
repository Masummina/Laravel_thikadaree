@extends('admin.layouts.layout')
@section('extra_style')
    @include('admin.layouts.includes.datatable-css-link')   
@endsection

@section('content')   
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Students</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Students</a></li>      
        </ol>
    </section>
    <!-- Main content -->
     <section class="content">
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title"><b>Student View</b></h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
             @if(!empty($student))
                <table class="table">
                    <thead>
                        <tr><th> Name </th> <th>{{ $student->name }}</th><tr>
                        <tr><th> Father's Name </th> <th>{{ $student->fathers_name }}</th><tr>
                        <tr><th> Mother's Name </th>  <th>{{ $student->mothers_name }}</th><tr>
                        <tr><th> S.S.C Roll  </th>  <th>{{ $student->ssc_roll }}</th><tr>
                        <tr><th> Mobile No. </th>   <th>{{ $student->mobile_no }}</th><tr>
                        <tr><th> Home District </th> <th>{{ $student->home_district }}</th><tr>

                        <tr><th> E-mail  </th> <th>{{ $student->email }}</th><tr>
                        <tr><th> Present Address </th> <th> <p> {{ $student->present_address }} </p></th><tr>
                        <tr><th> Permanent Address </th>  <th> <p> {{ $student->permanent_address }}</p></th><tr>
                        <tr><th> S.S.C. / 'O' Level Board </th> <th>{{ $student->ssc_board }}</th><tr>
                        <tr><th> School Name </th> <th>{{ $student->school_name }}</th><tr>
                        <tr><th> Passing Year </th> <th>{{ $student->ssc_passing_year }}</th><tr>
                        <tr><th> G.P.A </th> <th>{{ $student->ssc_gpa }}</th><tr>

                        <tr><th> H.S.C. / 'A' Level Board </th>  <th>{{ $student->hsc_board }}</th><tr>
                        <tr><th> College Name </th>   <th>{{ $student->college_name }}</th><tr>
                        <tr><th> Passing Year </th>  <th>{{ $student->hsc_passing_year }}</th><tr>
                        <tr><th> G.P.A </th>   <th>{{ $student->hsc_gpa }}</th><tr>
                       
                        <tr><th> Branch </th> <th>{{ $student->branch_name }}</th><tr>
                        <tr><th> H.S.C./'A Level' Registration No.  </th>  <th>{{ $student->hsc_registration_no }}</th><tr>
                    </thead>                 
                </table>
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>        

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('extra_script') 
    @include('admin.layouts.includes.datatable-js-link')
@endsection