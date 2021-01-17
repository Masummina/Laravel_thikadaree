@extends('admin.layouts.layout')
@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">

                <div class="row">
                    <div class="col-xs-12">

                        <form method="get" class="  form-inline my-2 my-lg-0" action="">

                            <div class="panel-body">

                                <div class="col-sm-6">
                                    <span class="report-headline"> Select Date From : </span>
                                    <input name="from" type="date" class="form-control" value="{{@$_GET["from"]}}">
                                    To
                                    <input name="to" type="date" class="form-control" value="{{@$_GET["to"]}}">

                                </div>
                                <div class="col-sm-2">
                                    <input  type="submit" class="btn btn-primary" value=" Search " name="submit">
                                </div>

                            </div>

                        </form>

                    </div>
                </div>

                @if(isset($prospect_date_list[0]))
                    <div class="col-xs-12">
                        <div class="row"> &nbsp;&nbsp;&nbsp; |
                            @foreach($prospect_date_list as $row)
                                <a href="{!! url('individual-prospect-report?from='.$_GET['from'].'&to='.$_GET['to'].'&report_date='.$row->report_date) !!}" > {!! $row->report_date !!} </a>
                                &nbsp; |
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($prospects[0]))
                    <div class="panel-body">
                        <p class="pull-right">  &nbsp;&nbsp;&nbsp;
                            <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_able')"> <i class="glyphicon glyphicon-print"> Print </i> </span>
                            <span title="Download" class="btn btn-primary" onclick="wordDownload('print_able')"> <i class="glyphicon glyphicon-download-alt"> Download </i> </span>
                        </p>

                    </div>
                <div id="report-header" style="display: none" >
                    <strong>
                        Individual prospect report of {{ date("F Y",strtotime($_GET['from']))  }}
                        <br/>
                        Date : {!! date("j F, Y",strtotime($_GET['report_date'])) !!}
                    </strong>
                </div>

                <div id="print_able" >

                    <div class="box-header with-border" style="text-align: center">
                        <div style="text-align: center; padding: 5px; font-size: 22px; font-weight: bold;">
                            {!! Config('app.project_name'); !!}
                        </div>
                        <h3 class="box-title" style="font-size: 16px; margin: 0; margin-bottom: 10px;">{!! Config('app.project_address'); !!}</h3>
                    </div>
                    <div style="text-align: center; padding: 5px; background-color: #9ad717; font-size: 22px; font-weight: bold;">
                        Individual prospect report of {{ date("F Y",strtotime($_GET['from']))  }}
                    </div>


                    <div class="panel-body">
                        <strong class="pull-left">
                            Date : {!! date("j F, Y",strtotime($_GET['report_date'])) !!}
                        </strong>

                        <br/>
                        <br/>
                        <div class="clearfix"></div>
                        <table id="myTable" class="table table-striped table-hover clearfix" style="width: 100%">
                            <thead>
                            <tr>
                                <th class="text-center"> Team </th>
                                <th class="text-center"> Execution Person </th>
                                <th class="text-center"> Previous  </th>
                                <th class="text-center"> New  </th>
                                <th class="text-center"> Esc  </th>
                                <th class="text-center"> Sold  </th>
                                <th class="text-center"> Total </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php

                                $T_previous = 0;
                                $T_new = 0;
                                $T_esc = 0;
                                $T_close = 0;
                                $labels = '';
                                $previous_labels = '';
                                $new_labels = '';
                                $esc_labels = '';
                                $close_labels = '';
                                $total_labels = '';
                                $G_total = 0;
                            @endphp

                           @foreach($prospects as $row)
                               @php
                                   $total = ($row->previous+$row->new)-($row->esc+$row->close);
                                   $T_previous += $row->previous;
                                   $T_new += $row->new;
                                   $T_esc += $row->esc;
                                   $T_close += $row->close;
                                   $labels .="'".$row->user_name."',";
                                   $previous_labels .= $row->previous.",";
                                   $new_labels .= $row->new.",";
                                   $esc_labels .= $row->esc.",";
                                   $close_labels .= $row->close.",";
                                   $total_labels .= $total.",";
                                   $G_total +=$total;
                               @endphp
                                <tr>
                                    <td class="td-rd text-center"><b>{{$row->team}}</b></td>
                                    <td class="td-rd text-center"><b>{{$row->user_name}}</b></td>
                                    <td class="td-rd text-center">{{$row->previous}}</td>
                                    <td class="td-rd text-center">{{$row->new}}</td>
                                    <td class="td-rd text-center">{{$row->esc}}</td>
                                    <td class="td-rd text-center">{{$row->close}}</td>
                                    <td class=" text-center"><strong>{{$total}}</strong></td>
                                </tr>
                           @endforeach
                               <tr>
                                   <td></td>
                                   <td class="td-rd "><b>Total </b></td>
                                   <td class="td-rd text-center"><strong>{{$T_previous}} </strong> </td>
                                   <td class="td-rd text-center"><strong>{{$T_new}} </strong></td>
                                   <td class="td-rd text-center"><strong>{{$T_esc}} </strong></td>
                                   <td class="td-rd text-center"><strong>{{$T_close}} </strong></td>
                                   <td class=" text-center"><strong>{!! $G_total !!}</strong> </td>
                               </tr>
                            </tbody>
                        </table>
                    </div>


                @php
                    $labels = rtrim($labels,',');
                    $previous_labels = rtrim($previous_labels,',');
                    $new_labels = rtrim($new_labels,',');
                    $esc_labels = rtrim($esc_labels,',');
                    $close_labels = rtrim($close_labels,',');
                    $total_labels = rtrim($total_labels,',');
                @endphp

                <!-- Graph -->
                    <div class="row">
                        <div class="panel-body">
                            <canvas id="ZoneWise" height="80"></canvas>
                        </div>
                    </div>

                    <!--- For Chart --->
                    <script type="text/javascript" src="{{URL::asset('chart/moment/moment.min.js')}}"></script>
                    <!-- chart js -->
                    <script type="text/javascript" src="{{URL::asset('chart/chartjs/chart.min.js')}}"></script>

                    <script type="text/javascript">

                        // Bar chart
                        var ctx = document.getElementById("ZoneWise");
                        var mybarChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [{!! $labels !!}],
                                datasets: [
                                    { label: 'Previous', backgroundColor: '#42B600', data: [{!! $previous_labels !!}] },
                                    { label: 'New', backgroundColor: '#FCF500', data: [{!! $new_labels !!}] },
                                    { label: 'Esc', backgroundColor: '#F20700', data: [{!! $esc_labels !!}] },
                                    { label: 'Sold', backgroundColor: '#0022FC', data: [{!! $close_labels !!}] },
                                    { label: 'Total', backgroundColor: '#BFC9CA', data: [{!! $total_labels !!}] }]
                            },

                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });

                    </script>


                @endif
               </div>

            </div>
        </div>
</section>


@endsection
