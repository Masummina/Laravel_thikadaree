@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Primary, Secondary, Near to Close prospects </div>

                <div class="panel-body">

                    @if (Session::has('msg') && Session::get('msg')!='')
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif
                    @if (Session::has('error') && Session::get('error')!='')
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                        <button type="button" data-target="#Modal-Add" class="btn btn-primary pull-right" data-toggle="modal"> + Add New</button>
                    <br/>
                    <div class="clearfix"></div>
                    <table id="myTable" class="table table-striped table-hover clearfix">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Report date </th>
                            <th> ID </th>
                            <th> Name </th>
                            <th> Status </th>
                            <th> Project  </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                       @foreach($prospects as $row)
                           @php $i++; @endphp
                            <tr>
                                @php
                                    $CID = 10000000+$row->prospect_id;
                                    $CID = substr($CID,1,7);
                                @endphp
                                <td>{{$i}}</td>
                                <td><b>{{ date("j F Y",strtotime($row->report_date))  }}</b></td>
                                <td><b>{{$CID}}</b></td>
                                <td><b>{{$row->name}}</b></td>
                                <td><b>{{$row->lead_status}}</b></td>
                                <td>
                                    @php
                                        $activitie = DB::table('activities')
                                             ->select('project_id')
                                             ->where('customer_id','=', $row->prospect_id)
                                             ->orderBy('id','desc')
                                             ->first();

                                        if(isset($activitie->project_id))
                                        {
                                            $project = DB::table('projects')
                                                     ->select('title')
                                                     ->where('id','=', $activitie->project_id)->first();
                                            if(isset($project->title))
                                                echo $project->title;
                                            else
                                                echo '..';
                                        }
                                    @endphp
                                </td>

                                <td style="width: 210px;">
                                    @php $days_befpre = round(abs(strtotime(date("Y-m-d"))-strtotime($row->report_date))/86400); @endphp
                                    @if($days_befpre<10)
                                        <a href="{{ url('/individual-details-delete/'.$row->id) }}" onclick="return confirm('Are you sure you want to delete?')"  class="btn btn-danger pull-left"> <i class="fa fa-trash-o"></i> Delete  </a>
                                    @else
                                        --
                                    @endif

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
                        <h3> Submit Individual Prospects Details </h3>
                    </div>

                    <div class="modal-body">
                    <form class="form-horizontal" action="{!! url('individual-details') !!}" onsubmit="return confirm('Are you sure you want to submit?')" method="POST">


                        <div class="form-group">
                            <div class="col-sm-12">
                            <table id="example2" class="table table-fixed">
                                <thead>
                                <tr>
                                    <th style="width: 5%; float: left">SL </th>
                                    <th style="width: 15%; float: left">ID </th>
                                    <th style="width: 35%; float: left">Name </th>
                                    <th style="width: 15%; float: left">Name </th>
                                    <th style="width: 30%; float: left">Project</th>
                                </tr>
                                </thead>
                                <tbody style="height: 300px;">
                                @foreach($my_prospects as $row)
                                    <tr>
                                        @php
                                          $CID = 10000000+$row->id;
                                          $CID = substr($CID,1,7);
                                        @endphp
                                        <td style="width: 5%; float: left">  <input type="checkbox" name="prospects[]" value="{!! $row->id !!}"> </td>
                                        <td style="width: 15%; float: left"> {{ $CID}} </td>
                                        <td style="width: 35%; float: left"><b> {{ $row->prefix.' '.$row->name }}</b> </td>
                                        <td style="width: 15%; float: left"><b> {{ $row->lead_status }}</b> </td>
                                        <td style="width: 30%; float: left">
                                            @php
                                                $activitie = DB::table('activities')
                                                     ->select('project_id')
                                                     ->where('customer_id','=', $row->id)
                                                     ->orderBy('id','desc')
                                                     ->first();

                                                if(isset($activitie->project_id))
                                                {
                                                    $project = DB::table('projects')
                                                             ->select('title')
                                                             ->where('id','=', $activitie->project_id)->first();
                                                    if(isset($project->title))
                                                        echo $project->title;
                                                    else
                                                        echo '..';
                                                }
                                            @endphp
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Report Date : </label>
                            <div class="col-sm-3">
                                <input name="report_date" id="report_date" type="date" value="" autocomplete="off" class="form-control" required>
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

        <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script>
            $(function () {
                $('#example2').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": false,
                    "autoWidth": false
                });
            });
        </script>
@endsection
