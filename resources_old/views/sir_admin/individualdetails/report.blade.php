@extends('admin.layouts.layout')
@section('content')
    <style>
        table tr th{
            text-align: center;
            font-size: 16px;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">

                <div class="row">
                    <div class="col-xs-12">

                        @if (Session::has('msg') && Session::get('msg')!='')
                            <div class="alert alert-info">{{ Session::get('msg') }}</div>    
                        @endif


                        <form method="get" class="  form-inline my-2 my-lg-0" action="">

                            <div class="panel-body">

                                @if(isset($team_memebers))
                                    <div class="col-sm-4">
                                        <span class="report-headline"> Member : </span>
                                        <select name="member" class="form-control" id="exampleSelect1" style="width: 170px !important;">
                                            <option value="all">All Memeber</option>
                                            @foreach ($team_memebers as $team)
                                                <option @if(@$_GET["member"]==$team->id) selected @endif value="{{$team->id}}">{{$team->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="col-sm-4">
                                    <span class="report-headline"> Select Month : </span>
                                    <input name="month" type="date" class="form-control" value="{{@$_GET["month"]}}">
                                </div>
                                <div class="col-sm-4">
                                    <input  type="submit" class="btn btn-primary" value=" Search " name="submit">
                                </div>

                            </div>

                        </form>

                    </div>
                </div>



                @if(isset($prospect_list[0]))
                    <div class="col-xs-12">
                        <div class="row">
                            @foreach($prospect_list as $row)
                               <a href="{!! url('individual-details-report?member='.$_GET['member'].'&month='.$_GET['month'].'&report_date='.$row->report_date) !!}" > {!! $row->report_date !!} </a>
                               &nbsp; |
                            @endforeach
                        </div>
                    </div>
                @endif


                @if(isset($prospect_details[0]))
                    <div class="panel-body">
                        <p class="pull-right">  &nbsp;&nbsp;&nbsp;
                            <span class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" > <i class="glyphicon glyphicon-pencil"> Edit Remarks </i> </span>
                            <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_able')"> <i class="glyphicon glyphicon-print"> Print </i> </span>
                            <span title="Download" class="btn btn-primary" onclick="wordDownload('print_able')"> <i class="glyphicon glyphicon-download-alt"> Download </i> </span>
                        </p>
                    </div>
                <div id="print_able" >

                    <style type = "text/css">

                        @media  print {
                            .table { font-size: 14px; }
                            .post-comment{ display:none }
                        }
                    </style>

                    <div class="box-header with-border" style="text-align: center">
                        <div style="text-align: center; font-size: 22px; font-weight: bold;">
                            {!! Config('app.project_name'); !!}
                        </div>
                        <h3 class="box-title" style="font-size: 16px; margin: 0; margin-bottom: 10px;">{!! Config('app.project_address'); !!}</h3>
                    </div>
                    <div style="text-align: center; padding: 5px; background-color: #9ad717; font-size: 22px; font-weight: bold;">
                        Individual Prospect Report for the Month of {{ date("F Y",strtotime($_GET['report_date']))  }}
                    </div>

                    <div style="text-align: center; padding: 5px; background-color: #0d6aad; font-weight: bold; font-size: 22px;">
                       @if($_GET['member']=='all') {!! 'All Member' !!} @else {!! $member_info->name !!} @endif
                    </div>

                    <div class="panel-body">
                        <strong class="pull-left">
                            Report Date : {!! $_GET['report_date'] !!}
                        </strong>
                    </div>

                    @php
                        $i=1; $x=1; $y=1; $z=1;
                        $Primary = '';
                        $Primary_edit = '';
                        $Secondary = '';
                        $Secondary_edit = '';
                        $Near_to_Close = '';
                        $Near_to_Close_edit = '';
                        foreach($prospect_details as $row)
                        {
                            $activitie = DB::table('activities')
                                 ->select('project_id','remarks','lead_status')
                                 ->where('customer_id','=', $row->prospect_id)
                                 ->orderBy('id','desc')
                                 ->first();

                            if(isset($activitie->project_id))
                            {
                                $project = DB::table('projects')
                                         ->select('title')
                                         ->where('id','=', $activitie->project_id)->first();
                                if(isset($project->title))
                                    $project_title =  $project->title;
                                else
                                    $project_title = '..';
                            } else { $project_title = '..'; }

                            $CID = 10000000+$row->prospect_id;
                            $CID = substr($CID,1,7);

                            if(@$activitie->lead_status=='Primary'){
                                $i=$x; $x++;
                            } else if(@$activitie->lead_status=='Secondary'){
                                $i=$y; $y++;
                            } else if(@$activitie->lead_status=='Near to Close'){
                                $i=$z; $z++;
                            }

                            if($row->note !='' ){
                                $note = $row->note;
                            } else {
                                $note = @$activitie->remarks;
                            }

                            $pros ='
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$CID.'</td>
                                    <td>'.$row->prefix.' '.$row->name.'</td>
                                    <td>'.$project_title.'</td>
                                    <td> '.$note.' </td>
                                </tr>';

                            $edit_pros ='
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$CID.'</td>
                                    <td>'.$row->prefix.' '.$row->name.'</td>
                                    <td>'.$project_title.'</td>
                                    <td><input type="text" class="form-control" value="'.$note.'" name="note['.$row->id.']" ></td>
                                </tr>';    

                            if(@$activitie->lead_status=='Primary'){
                                $Primary .= $pros;
                                $Primary_edit .= $edit_pros;
                            } else if(@$activitie->lead_status=='Secondary'){
                                $Secondary .= $pros;
                                $Secondary_edit .= $edit_pros;
                            } else if(@$activitie->lead_status=='Near to Close'){
                                $Near_to_Close .= $pros;
                                $Near_to_Close_edit .= $edit_pros;
                            }

                        }

                    @endphp

                    <div class="panel-body">
                        <h3 class="box-title"> Primary </h3>
                        <div class="clearfix"></div>
                        <table id="myTable" class="table table-striped table-hover clearfix" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="4%"> S# </th>
                                <th width="12%"> ID  </th>
                                <th width="24%"> Name  </th>
                                <th width="20%"> Project  </th>
                                <th width="40%"> Remarks </th>
                            </tr>
                            </thead>
                            <tbody>
                                {!! $Primary !!}
                            </tbody>
                        </table>
                    </div>


                    <div class="panel-body">
                        <h3 class="box-title"> Secondary </h3>
                        <div class="clearfix"></div>
                        <table id="myTable" class="table table-striped table-hover clearfix" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="4%"> S# </th>
                                <th width="12%"> ID  </th>
                                <th width="24%"> Name  </th>
                                <th width="20%"> Project  </th>
                                <th width="40%"> Remarks </th>
                            </tr>
                            </thead>
                            <tbody>
                            {!! $Secondary !!}
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-body">
                        <h3 class="box-title"> Near to close </h3>
                        <div class="clearfix"></div>
                        <table id="myTable" class="table table-striped table-hover clearfix" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="4%"> S# </th>
                                <th width="12%"> ID  </th>
                                <th width="24%"> Name  </th>
                                <th width="20%"> Project  </th>
                                <th width="40%"> Remarks </th>
                            </tr>
                            </thead>
                            <tbody>
                            {!! $Near_to_Close !!}
                            </tbody>
                        </table>
                    </div>


                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>

                            <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/individual-report-note-update') }}" method="POST">
                            <div class="modal-body">
                                    <div class="panel-body">
                                        <h3 class="box-title"> Primary </h3>
                                        <div class="clearfix"></div>
                                        <table id="myTable" class="table table-striped table-hover clearfix" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th width="4%"> S# </th>
                                                <th width="12%"> ID  </th>
                                                <th width="24%"> Name  </th>
                                                <th width="20%"> Project  </th>
                                                <th width="40%"> Remarks </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                {!! $Primary_edit !!}
                                            </tbody>
                                        </table>
                                    </div>
                
                
                                    <div class="panel-body">
                                        <h3 class="box-title"> Secondary </h3>
                                        <div class="clearfix"></div>
                                        <table id="myTable" class="table table-striped table-hover clearfix" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th width="4%"> S# </th>
                                                <th width="12%"> ID  </th>
                                                <th width="24%"> Name  </th>
                                                <th width="20%"> Project  </th>
                                                <th width="40%"> Remarks </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {!! $Secondary_edit !!}
                                            </tbody>
                                        </table>
                                    </div>
                
                                    <div class="panel-body">
                                        <h3 class="box-title"> Near to close </h3>
                                        <div class="clearfix"></div>
                                        <table id="myTable" class="table table-striped table-hover clearfix" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th width="4%"> S# </th>
                                                <th width="12%"> ID  </th>
                                                <th width="24%"> Name  </th>
                                                <th width="20%"> Project  </th>
                                                <th width="40%"> Remarks </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {!! $Near_to_Close_edit !!}
                                            </tbody>
                                        </table>
                                    </div>

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" name="member" value="{!! $_GET['member'] !!}" >
                                    <input type="hidden" name="month" value="{!! $_GET['month'] !!}" >
                                    <input type="hidden" name="report_date" value="{!! $_GET['report_date'] !!}" >                                     
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>


            @endif

            </div>
        </div>
</section>


@endsection
