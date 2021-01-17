@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Individual prospects </div>

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif


                        <button type="button" data-target="#Modal-Add" class="btn btn-primary pull-right" data-toggle="modal"> + Add New</button>
                    <br/>
                    <div class="clearfix"></div>
                    <table id="myTable" class="table table-striped table-hover clearfix">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> User </th>
                            <th> Report date </th>
                            <th> Previous  </th>
                            <th> New  </th>
                            <th> Esc  </th>
                            <th> Sold  </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                       @foreach($prospects as $row)
                           @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><b>{{$row->user_name}}</b></td>
                                <td><b>{{ date("j F Y",strtotime($row->report_date))  }}</b></td>
                                <td>{{$row->previous}}</td>
                                <td>{{$row->new}}</td>
                                <td>{{$row->esc}}</td>
                                <td>{{$row->close}}</td>
                                <td style="width: 210px;">
                                    <a href="{{ url('/individual-prospects/'.$row->id.'/edit') }}" class="btn btn-default pull-left">Edit</a>
                                    <!--
                                    <form  class="pull-right delete" action="{{ url('/individual-prospects/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >
                                        {{method_field('DELETE')}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-default">Delete</button>
                                    </form>
                                    -->
                                </td>
                            </tr>
                       @endforeach
                        </tbody>
                    </table>

                        <div class="pull-right" style="display: inline-flex" >
                            {{ $prospects->links() }}
                        </div>
                </div>
            </div>
        </div>
</section>


        <div class="modal fade" id="Modal-Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"   >
            <div class="modal-dialog" role="document" style="min-width: 900px;" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h3> Add Individual Prospects </h3>
                    </div>

                    <div class="modal-body">
                    <form class="form-horizontal" action="{!! url('individual-prospects') !!}" onsubmit="return confirm('Are you sure you want to submit?')" method="POST">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Report Date : </label>
                            <div class="col-sm-3">
                                <input name="report_date" id="report_date" type="date" value="" autocomplete="off" class="form-control" required>
                            </div>

                            <label class="col-sm-3 control-label" for="name"> Previous : </label>
                            <div class="col-sm-3">
                                <input name="previous" id="previous" type="number" value="" autocomplete="off" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> New : </label>
                            <div class="col-sm-3">
                                <input name="new" id="new" type="number" value="" autocomplete="off" class="form-control" required>
                            </div>

                            <label class="col-sm-3 control-label" for="name"> Escept : </label>
                            <div class="col-sm-3">
                                <input name="esc" id="esc" type="number" value="" autocomplete="off" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Sold : </label>
                            <div class="col-sm-3">
                                <input name="close" id="close" type="number" value="" autocomplete="off" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <button type="Submit" class="btn btn-primary" >Submit</button>
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        {{method_field('POST')}}
                    </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

@endsection
