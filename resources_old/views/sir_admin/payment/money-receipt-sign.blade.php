@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header clearfix">
            <h1 class="pull-left">  Money Receipt Sign </h1>

        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box-body">

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="row clearfix">
                                    <a class="right_btn btn btn-primary"  href="{{ url('add-sign') }}"  ><i class="fa fa-plus"></i> Add New Sign </a>


                                    <table class="table  table-striped">
                                        <thead>
                                        <tr>
                                            <th>S# </th>
                                            <th>Image</th>
                                            <th width="214">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($details))
                                            <tr>
                                                <td>1</td>
                                                <td><img src="{{ asset('img/'.$details->photo) }}" height="80" width="120"></td>
                                                <td>
                                                    <a href="{!! url('edit-sign/'.$details->id) !!}"  class="btn btn-success"><i class="fa fa-edit"></i> Edit </a>
                                                    <a href="{!! url('delete-sign/'.$details->id) !!}"  class="btn btn-danger"> Delete </a>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>




                                </div>

                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
        <style>
            .right_btn {
                float: right;
                margin: 10px 5px 10px 10px;
            }
            .bg-green { background-color: #398439 }
            .bg-red { background-color: #c12e2a }
            .bg-yellow { background-color: #9ad717 }
            .flate-box { height: 80px; width: 100%; margin-bottom: 6px; text-align: center; padding-top: 10px; font-size: 16px; }
        </style>
        <script>
            $(function () {
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
        </script>

@endsection