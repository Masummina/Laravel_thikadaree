@extends('admin.layouts.layout')
@section('content')
    <style>
        table tr td, table tr th{
            text-align: center;
        }
        .pro-name{
            margin-left:215px !important;
        }
    </style>
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                    <p class="pull-right">  &nbsp;&nbsp;&nbsp;
                        <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_table')"> <i class="glyphicon glyphicon-print"> Print </i> </span>
                        <span title="Download" class="btn btn-primary" onclick="wordDownload('print_table')"> <i class="glyphicon glyphicon-download-alt"> Download </i> </span>
                    </p>


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </section>

            <div class="content" id="print_table">


                <div class="box-header with-border text-center" style="text-align: center">
                    <h3 class="box-title pro-name" style="font-weight: bold; font-size: 20px; margin: 0; margin-bottom: -10px; ">
                        {!! Config('app.project_name'); !!}
                    </h3><br/>
                    <h3 class="box-title" style="font-size: 16px; margin: 0; margin-bottom: 10px;">{!! Config('app.project_address'); !!}</h3>
                </div>
                <h3 class="text-center" style="text-align:center;"> AREA WISE AVAILABLE APARTMENTS</h3>

                <div class="panel-body">


                    <table  class="table  table-striped" border="1">
                        <thead>
                        <tr>
                            <th >AREA WISE AVAILABLE </th>
                            <th> READY</th>
                            <th >ONGOING</th>
                            <th >FORTHCOMING</th>
                            <th >TOTAL</th>
                        </tr>


                        </thead>
                        <tbody>

                        @php $grand_total=0; @endphp
                        @foreach($locations as $key =>$val)
                            <tr>
                                <td class="text-left">{{$key}}</td>
                                <td >{{$val['1']}}</td>
                                <td>{{$val['2']}}</td>
                                <td>{{$val['3']}}</td>
                                <td>{{$val['1']+$val['2']+$val['3']}}</td>
                                @php
                                    $locations[$key]['total']=$val['1']+$val['2']+$val['3'];
                                    $grand_total+=$val['total'];

                                @endphp
                            </tr>
                        @endforeach
                        <tr>
                            <td style="border-top: 2px solid #000; background-color: #b9def0; "> <strong>{{'Total'}} </strong></td>
                            <td style="border-top: 2px solid #000; background-color: #b9def0;"> <strong>{{$total['1']}}</strong> </td>
                            <td style="border-top: 2px solid #000; background-color: #b9def0;"> <strong>{{$total['2']}}</strong></td>
                            <td style="border-top: 2px solid #000; background-color: #b9def0;"> <strong>{{$total['3']}}</strong></td>
                            <td style="border-top: 2px solid #000; background-color: #b9def0;"> <strong>{{$total['1']+$total['2']+$total['3']}}</strong></td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="panel-body" style="width: 98%">
                             <canvas id="areaChart"  ></canvas>
                        </div>
                    </div>

            </div>
    </div>

    <script type="text/javascript" src="{{URL::asset('chart/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/chartjs/Chart.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            var locations = <?php echo json_encode($locations); ?>

            console.log(locations);
            var p_l= [];
            var ongoing = [];
            var forthcoming  = [];
            var ready = [];
            var total = [];

            for (var i in locations)
            {
                p_l.push(i);
                ongoing.push(locations[i]["2"]);
                forthcoming.push(locations[i]["3"]);
                total.push(locations[i]["total"]);
                ready.push(locations[i]["1"]);


            }
            var arr = <?php echo json_encode($total);?>

            p_l.push('Total');
            ongoing.push(arr['2']);
            forthcoming.push(arr['3']);
            ready.push(arr['1']);
            total.push(<?php echo $grand_total?>);


            console.log(ongoing);
            console.log(total);
            var areaChartData = {
                labels: p_l,
                datasets: [
                    {
                        label: "Ready",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.9)",
                        pointColor: "rgba(210, 214, 222, 1)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: ready
                    },

                    {
                        label: "Forthcoming",
                        fillColor: "rgba(255,0,0,0.9)",
                        strokeColor: "rgba(255,0,0,0.9)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: ongoing
                    },
                    {
                        label: "Total",
                        fillColor: "rgba(255, 204, 153,0.9)",
                        strokeColor: "rgba(255, 204, 153,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: forthcoming
                    },
                    {
                        label: "Total",
                        fillColor: "rgba(102, 224, 255,0.9)",
                        strokeColor: "rgba(102, 224, 255,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: total
                    }
                ]
            };
            var barChartCanvas = $("#areaChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = areaChartData;

            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,

                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,

                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true
                }

                //String - A legend template

            };


            barChartOptions.datasetFill = true;
            barChart.Bar(barChartData, barChartOptions);


        });
    </script>

@endsection