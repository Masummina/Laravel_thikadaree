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
                        $y = date("y");
                    @endphp
                    <p class="pull-right">
                        <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_able')"> <i class="glyphicon glyphicon-print"> Print </i> </span>
                        <span title="Download" class="btn btn-primary" onclick="wordDownload('print_able')"> <i class="glyphicon glyphicon-download-alt"> Download </i> </span>
                    </p>
                    <br/>
                    <div class="clearfix"></div>

                    <div id="print_able">

                    <div class="panel-heading" style="text-align: center;"> {!! Config('app.project_name') !!}  </div>
                    <div style="text-align: center; "> {!! Config('app.project_address') !!}  </div>
                    <div style="text-align: center; font-size: 20px; padding: 10px 25px;"> Individual Target Vs Achievement for the year {!! $year !!} </div>
                        <table id="myTable" class="table table-striped table-hover" border="1"  >
                            <thead>
                            <tr>
                                <th colspan="4"></th>
                                <th colspan="2"> Jan' {!! $y !!}</th>
                                <th colspan="2"> Feb' {!! $y !!} </th>
                                <th colspan="2"> Mar' {!! $y !!} </th>
                                <th colspan="2"> Apr' {!! $y !!} </th>
                                <th colspan="2"> May' {!! $y !!}</th>
                                <th colspan="2"> Jun' {!! $y !!} </th>
                                <th colspan="2"> Jul' {!! $y !!} </th>
                                <th colspan="2"> Aug' {!! $y !!} </th>
                                <th colspan="2"> Sep' {!! $y !!} </th>
                                <th colspan="2"> Oct' {!! $y !!} </th>
                                <th colspan="2"> Nov' {!! $y !!} </th>
                                <th colspan="2"> Dec' {!! $y !!} </th>
                                <th colspan="4">  </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="font-weight: bold"> Sl. </td>
                                <td style="font-weight: bold"> Team </td>
                                <td style="font-weight: bold"> Execution person </td>
                                <td style="font-weight: bold"> Target {!! $year !!} </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Targ </td> <td style="font-weight: bold"> Achie </td>
                                <td style="font-weight: bold"> Total Achieve </td>
                                <td style="font-weight: bold"> Sarp/Defic </td>
                                <td style="font-weight: bold"> Monthly % </td>
                                <td style="font-weight: bold"> Yearly % </td>
                            </tr>

                            @php
                              $i=0;
                              for($m=1; $m<=12; $m++)
                              { $Tot_T_M[$m]=0; $Tot_A_M[$m]=0; }

                                $sl = 1;
                                $totalTar = 0;
                                $totalAchieve = 0;
                                $SD = 0;
                                $monthAch = 0;
                            @endphp
                            @if($items)
                                @foreach($items as $row)
                                   @php
                                        $i++;
                                        $x = 1;
                                        $TA_HTML = '';
                                        $current_month = (int)date("m");
                                        $current_month_target = 0;
                                        $current_month_achiev = 0;
                                        $total_target = 0;
                                        $total_achiev = 0;

                                        $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
                                        foreach ($months as $k=>$v)
                                        {
                                            $achiev = $targetNachiev[$row->id][$v]['achiev'];
                                            $target = $targetNachiev[$row->id][$v]['target'];
                                            $TA_HTML .= '<td>'.$target.'</td> <td>'.$achiev.'</td>';
                                            $total_target += (int)$target;
                                            $total_achiev += (int)$achiev;
                                            if($current_month>=$k)
                                            {
                                                $current_month_target += (int)$target;
                                                $current_month_achiev += (int)$achiev;
                                            }
                                            $Tot_T_M[$k] += (int)$target;
                                            $Tot_A_M[$k] += (int)$achiev;
                                        }

                                        $S_D = $current_month_target-$current_month_achiev;
                                        if($S_D<0)
                                            $S_D = abs($S_D); //str_replace('-',$S_D);
                                        else
                                            $S_D = '('.$S_D.')';

                                        $due=$total_target-$total_achiev;
                                        if($current_month_target==0)
                                            $monthly_percentage = '0';
                                        else
                                            $monthly_percentage=($current_month_achiev*100)/$current_month_target;

                                        if($total_target==0)
                                            $yearly_percentage = '0';
                                        else
                                            $yearly_percentage=($total_achiev*100)/$total_target;
                                   @endphp
                                    <tr>
                                        @php $totalTar += $total_target; $totalAchieve += $total_achiev; @endphp
                                        <td>{!! $sl++ !!}</td>
                                        <td>{!! $row->tName !!}</td>
                                        <td>{!! $row->name !!}</td>
                                        <td>{!! $total_target !!} </td>
                                            {!! $TA_HTML !!}
                                        <td>{!! $total_achiev !!}</td>
                                        <td>{!! $S_D !!} </td>
                                        <td>{!! number_format($monthly_percentage,2) !!} </td>
                                        <td>{!! number_format($yearly_percentage,2) !!}</td>
                                    </tr>

                                @endforeach
                                <tr>
                                    <td colspan="3" style="font-weight: bold">Total</td>
                                    <td style="font-weight: bold">{{ $totalTar }}</td>
                                    @foreach ($months as $k=>$v)
                                        @php $targetMonth = $Tot_T_M[$k]; $achieveMonth = $Tot_A_M[$k] @endphp

                                        <td style="font-weight: bold">{!! $targetMonth !!}</td> <td style="font-weight: bold">{!! $achieveMonth !!}</td>
                                    @endforeach
                                    <td style="font-weight: bold">{{ $totalAchieve }}</td>
                                    <td style="font-weight: bold">({!! $totalTar-$totalAchieve !!})</td>
                                    @php 
                                        $targetCurrentMonth = $Tot_T_M[$current_month]; $achieveCurrentMonth = $Tot_A_M[$current_month];
                                        if($targetCurrentMonth==0)
                                        $monthPercentage = '0';
                                        else
                                        $monthPercentage=($achieveCurrentMonth*100)/$targetCurrentMonth; 
                                    @endphp
                                    <td style="font-weight: bold">{!! number_format($monthPercentage,2) !!}%</td>
                                    @php
                                        if($totalTar==0)
                                        $yearPercentage = '0';
                                        else
                                        $yearPercentage=($totalAchieve*100)/$totalTar;
                                    @endphp
                                    <td style="font-weight: bold">{!! number_format($yearPercentage,2) !!}%</td>

                                </tr>
                              @endif
                            </tbody>
                        </table>
                    @php
                        $labels = '';
                        $target_labels = '';
                        $achiev_labels = '';
                        $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
                        foreach ($months as $k=>$v)
                        {
                           $labels .="'".$v."',";
                           $target_labels .= $Tot_T_M[$k].",";
                           $achiev_labels .= $Tot_A_M[$k].",";
                        }
                        $labels = rtrim($labels,',');
                        $target_labels = rtrim($target_labels,',');
                        $achiev_labels = rtrim($achiev_labels,',');
                        //echo $labels.' <br/>'.$target_labels.' <br/>'.$achiev_labels;
                    @endphp
                    <canvas id="ZoneWise" height="80"></canvas>
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
                                        { label: 'Target', backgroundColor: '#1C2833', data: [{!! $target_labels !!}] },
                                        { label: 'Achievement', backgroundColor: '#E53E11', data: [{!! $achiev_labels !!}] }]
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
                </div>
            </div>
        </div>
    </div>






</section>
@endsection
