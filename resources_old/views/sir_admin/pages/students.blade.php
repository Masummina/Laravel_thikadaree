@extends('admin.layouts.layout')
@section('extra_style')
    @include('admin.layouts.includes.datatable-css-link')   
@endsection

@section('content')   
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.layouts.includes.header-content')
    <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            @include('admin.layouts.includes.page-header')

            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
                <thead>
                    <tr>  
                        <th> S.L </th>                   
                        <th> Name </th>
                        <th> Father's Name </th>
                        <th> Mother's Name </th>                        
                        <th> Mobile No. </th>
                        <th> Home District </th>
                        <th> S.S.C Roll  </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody class="buyer-list">
                  @if( isset( $students ) )                       
                      @foreach( $students as $student )
                          <tr>                             
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $student->name }}</td>
                              <td>{{ $student->fathers_name }}</td>
                              <td>{{ $student->mothers_name }}</td>
                              <td>{{ $student->mobile_no }}</td>
                              <td>{{ $student->home_district }}</td>
                              <td>{{ $student->ssc_roll }}</td>                             
                              <td> <a href="{{ url('/students/'.$student->id)}}"> View Details </a> </td>
                          </tr>
                      @endforeach
                  @endif
                </tbody>
                <tfoot>
                    <tr>                      
                        <th> S.L </th>                   
                        <th> Name </th>
                        <th> Father's Name </th>                        
                        <th> Mother's Name </th>
                        <th> Mobile No. </th>
                        <th> Home District </th>
                        <th> S.S.C Roll  </th>
                        <th> Action </th>
                    </tr>
                </tfoot>
              </table>
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