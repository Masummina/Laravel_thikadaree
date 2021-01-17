@extends('admin.layouts.layout')
@section('content')

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

                    <div class="panel-heading" style="text-align: center;"> {!! Config('app.project_name'); !!}  </div>
                    <div style="text-align: center; "> {!! Config('app.project_address'); !!}  </div>
                    <div style="text-align: center; font-size: 20px; padding: 10px 25px;"> Team Wise Target Vs Achievement for the year {!! $year !!} </div>

                    <table id="myTable" class="table table-striped table-hover" border="1"  >
                        <thead>
                        <tr>
                            <th colspan="2">  </th>
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
                            <td> Team </td>
                            <td> Target {!! $year !!} </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Targ </td> <td> Achie </td>
                            <td> Achie </td>
                            <td> Monthly % </td>
                            <td> Yearly % </td>
                        </tr>

                        @php
                          $i=0;
                          $Team_Wise_Date = array();
                          for($m=1; $m<=12; $m++)
                          {
                              $Tot_T_M[$m]=0;
                              $Tot_A_M[$m]=0;

                          }

                          $Month_Wise_Achiv = array(1 =>0, 2 =>0, 3 =>0, 4 =>0, 5 =>0, 6 =>0, 7 =>0, 8 =>0, 9 =>0, 10 =>0, 11 =>0, 12 =>0);
                          $Month_Wise_Target = array(1 =>0, 2 =>0, 3 =>0, 4 =>0, 5 =>0, 6 =>0, 7 =>0, 8 =>0, 9 =>0, 10 =>0, 11 =>0, 12 =>0);

                        @endphp
                        @if($all_users)
                            @foreach($all_users as $row)
                               @php

                                   $i++;
                                   $x = 1;
                                   $TA_HTML = '';
                                   $TOTAL_HTML = '';
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

                                       $Month_Wise_Achiv[$k] +=(int)$achiev;
                                       $Month_Wise_Target[$k] +=(int)$target;

                                       $TA_HTML .= '<td>'.$target.'</td> <td>'.$achiev.'</td> ';
                                       $TOTAL_HTML .= '<td>'.$target.'</td> <td>'.$achiev.'</td> ';
                                       $total_target += (int)$target;
                                       $total_achiev += (int)$achiev;
                                       if($current_month>=$k)
                                       {
                                           $current_month_target += (int)$target;
                                           $current_month_achiev += (int)$achiev;
                                       }
                                       $Tot_T_M[$k] += (int)$target;
                                       $Tot_A_M[$k] += (int)$achiev;

                                       //$Team_Wise_Date[team_id]['January']['target'] = 0
                                       if(isset($Team_Wise_Date[$row->team_id][$v]['target']))
                                           $Team_Wise_Date[$row->team_id][$v]['target'] += (int)$target;
                                       else
                                           $Team_Wise_Date[$row->team_id][$v]['target'] = (int)$target;

                                       //$Team_Wise_Date[team_id]['January']['achiev'] = 0
                                       if(isset($Team_Wise_Date[$row->team_id][$v]['achiev']))
                                           $Team_Wise_Date[$row->team_id][$v]['achiev'] += (int)$achiev;
                                       else
                                           $Team_Wise_Date[$row->team_id][$v]['achiev'] = (int)$achiev;

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

                            @endforeach

                            @php
                                $G_total_target =0;
                                $G_total_achiev =0;
                                $G_monthly_percentage =0;
                                $G_yearly_percentage =0;
                            @endphp

                            @foreach($teams as $row)
                                @php
                                    $current_month = (int)date("m");
                                    $TA_HTML = '';
                                    $TOTAL_HTML = '';
                                    $total_target = 0;
                                    $total_achiev = 0;

                                    $current_month_target = 0;
                                    $current_month_achiev = 0;   //print_r($Team_Wise_Date); exit;

                                    foreach($Team_Wise_Date[$row->team_id] as $k=>$val)
                                    {
                                       $TA_HTML .= '<td>'.$val['target'].'</td> <td>'.$val['achiev'].'</td>';
                                       $total_target +=$val['target'];
                                       $total_achiev +=$val['achiev'];

                                       $dateObj   = DateTime::createFromFormat('!F', $k);
	                                   $month_no = (int)$dateObj->format('m');

                                       if($current_month>=$month_no)
                                       {
                                           $current_month_target += (int)$val['target'];
                                           $current_month_achiev += (int)$val['achiev'];
                                       }
                                    }


                                    foreach ($months as $k=>$v)
                                    {
                                       $TOTAL_HTML .= '<td><strong>'.$Month_Wise_Target[$k].'</strong></td> <td><strong>'.$Month_Wise_Achiv[$k].'</strong></td>';
                                    }


                                    if($current_month_target==0)
                                       $monthly_percentage = '0';
                                    else
                                       $monthly_percentage=($current_month_achiev*100)/$current_month_target;

                                    if($total_target==0)
                                       $yearly_percentage = '0';
                                    else
                                       $yearly_percentage=($total_achiev*100)/$total_target;

                                    $G_total_target +=$total_target;
                                    $G_total_achiev +=$total_achiev;
                                    $G_monthly_percentage +=$monthly_percentage;
                                    $G_yearly_percentage +=$yearly_percentage;
                                @endphp
                                <tr>
                                    <td>{!! $row->name !!}  </td>
                                    <td>{!! $total_target !!} </td>
                                    {!! $TA_HTML !!}
                                    <td>{!! $total_achiev !!}</td>
                                    <td>{!! number_format($monthly_percentage,2) !!} </td>
                                    <td>{!! number_format($yearly_percentage,2) !!}</td>
                                </tr>
                            @endforeach

                                <tr>
                                    <td> <strong> Total </strong>   </td>
                                    <td> <strong> {!! $G_total_target !!} </strong>  </td>
                                         {!! $TOTAL_HTML !!}
                                    <td> <strong> {!! $G_total_achiev !!} </strong>  </td>
                                    <td> <strong> {!! $G_monthly_percentage !!} </strong> </td>
                                    <td> <strong> {!! $G_yearly_percentage !!} </strong>  </td>
                                </tr>

                          @endif
                        </tbody>
                    </table>
                    </div>


                </div>
            </div>
        </div>



</section>
@endsection
