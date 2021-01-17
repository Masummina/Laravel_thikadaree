@extends('admin.layouts.layout')
@section('content')
    <style>
        table tr td, table tr th{
            text-align: center;
        }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body" style="overflow-x: scroll !important;">
                    @php
                        $year = date("Y");
                        $month = date("F");
                        $y = date("y");
                    @endphp
                    <div class="pull-right">
                        <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_able')"> <i class="glyphicon glyphicon-print"> Print </i> </span>
                        <span title="Download" class="btn btn-primary" onclick="wordDownload('print_able')"> <i class="glyphicon glyphicon-download-alt"> Download </i> </span>
                    </div>
                    <div id="print_able">

                        <div class="clearfix"> </div>

                        <div class="box-header with-border" style="text-align: center">
                            <h3 class="box-title" style="font-weight: bold; font-size: 20px; margin: 0; margin-bottom: -10px;">
                                {!! Config('app.project_name'); !!}
                            </h3><br/>
                            <h3 class="box-title" style="font-size: 16px; margin: 0; margin-bottom: 10px;">{!! Config('app.project_address'); !!}</h3>
                        </div>
                        <div style="text-align: center; font-size: 20px; padding: 10px 25px;"> Profession Wise In-hand Individual Prospect for the Month of {!! $month !!} {!! $year !!} </div>

                        <table id="myTable" class="table table-striped table-hover" border="1"  >
                            <thead>

                            <tr>
                                <th> Sl. </th>
                                <th> Team </th>
                                <th> Execution Person </th>
                                @foreach($professions as $row)
                                    <th> {!! $row->title !!}</th>
                                @endforeach
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($users)
                                @php $i = 1; @endphp
                                @foreach($users as $row)
                                    @php $rt = 0 @endphp
                                    <tr>
                                        <td>{!! $i++ !!}</td>
                                        <td>{!! $row->t_name !!}</td>
                                        <td>{!! $row->name !!}</td>
                                    @foreach($professions as $val)
                                        <td>{!! $report_data[$row->id][$val->id] !!} </td>
                                            @php $rt += $report_data[$row->id][$val->id] @endphp
                                    @endforeach

                                        <td style="font-weight: bold">{{$rt}}</td>
                                    </tr>
                                @endforeach
                                <tr style="font-weight: bold">
                                    <td colspan="3" style="border-top: 2px solid #000; background-color: #b9def0; ">Grand Total</td>
                                    @php $total = 0 @endphp
                                    @foreach($professions as $row)
                                        @php $r = 0 @endphp
                                        @foreach($users as $val)
                                            @php $r += $report_data[$val->id][$row->id] @endphp
                                            @php $total += $report_data[$val->id][$row->id] @endphp
                                        @endforeach
                                        <td style="border-top: 2px solid #000; background-color: #b9def0; ">{{ $r }}</td>
                                    @endforeach
                                    <td>{{ $total }}</td>
                                </tr>

                              @endif
                            </tbody>
                        </table>
                        @php
                            $labels = '';
                            $target_labels = '';
                            $achiev_labels = '';
                        @endphp

                </div>
            </div>
        </div>



</section>
@endsection
