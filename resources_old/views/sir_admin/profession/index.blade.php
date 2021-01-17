@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header clearfix">
            <h1 class="pull-left">  All Clients </h1>

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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="row clearfix">
                                    <a class="right_btn btn btn-primary"  href="{{ url('professions/create') }}"  ><i class="fa fa-plus"></i> New Profession </a>


                                        <table class="table  table-striped">
                                            <thead>
                                            <tr>
                                                <th>S# </th>
                                                <th>Profession Title</th>
                                                <th width="214">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($titles))
                                                    @php $i=1;@endphp
                                                @foreach($titles as $row)
                                                    <tr>
                                                        <td>
                                                            {{$i}}
                                                            @php $i++;@endphp
                                                        </td>
                                                        <td>
                                                            {{$row->title}}
                                                        </td>
                                                    <td style="width: 70px;">
                                                        <a href="{!! url('professions/'.$row->id.'/edit') !!}"  class="btn btn-success"><i class="fa fa-edit"></i> Edit </a>
                                                        <form  class="pull-right delete" action="{{ url('/professions/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >
                                                            {{method_field('DELETE')}}
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button type="submit" class="btn btn-danger"> <i class="fa fa-trash-o"></i> Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                    @endforeach
                                                    @endif

                                            </tbody>
                                        </table>




                                </div>
                                <div class="pull-right">
                                    {{ $titles->links() }}
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