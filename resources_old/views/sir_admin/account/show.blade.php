@extends('admin.layouts.layout')
@section('content')
    <style>
        td:nth-child(3){
            border-right: 1px solid;
        }
        .info{
            margin-left: 25px;
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
                    <div class="col-md-3 pull-right" style="margin-top: 20px;margin-right: 20px">
                        <form action="" method="get">
                            <div class="form-group row">
                                <label for="viewAs" class="col-sm-4 col-form-label">View As</label>
                                <div class="col-sm-8">
                                    <select name="type" class="form-control" onchange="this.form.submit();">
                                        <option value="">Select</option>
                                        <option value="rebate" @if(isset($_GET['type']) && $_GET['type']=='rebate') selected @endif>Rebate</option>
                                        <option value="delay" @if(isset($_GET['type']) && $_GET['type']=='delay') selected @endif>Delay</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <p class="pull-right" style="margin-right: 35px">
                        <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_able')"> <i class="glyphicon glyphicon-print"> Print </i> </span>
                        <span title="Download" class="btn btn-primary" onclick="wordDownload('print_able')"> <i class="glyphicon glyphicon-download-alt"> Download </i> </span>
                    </p>
                </div>
                <div id="print_able">
                <div class="" style="text-align: center;"> <h2>{!! Config('app.project_name') !!}</h2>  </div>
                <div style="text-align: center; "> {!! Config('app.project_address') !!}  </div>
                <div style="text-align: center; font-size: 20px; padding: 10px 25px;"> Installment Payment Status(Each client) </div>
                

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif
                    <div class="row info" style="margin-top: 30px; margin-bottom: 30px">
                        <table style="width: 100%;">
                            <tr style="margin-left: 20px">
                                <td><h3>Client Info </h3></td>
                                <td><h3>Property Info </h3></td>
                            </tr>
                            <tr style="margin-left: 20px">
                                <td><strong>Name : </strong>{!! @$clients->name; !!}</td>
                                <td><strong>Project Name : </strong>{!! $project_info->title !!}</td>
                            </tr>
                            <tr style="margin-left: 20px">
                                <td><strong>Mobile : </strong>{!! @$clients->mobile; !!}</td>
                                <td><strong>Flat No : </strong>{!! @$property->title !!}</td>
                            </tr>
                            <tr style="margin-left: 20px">
                                <td><strong>Email : </strong>{!! @$clients->email; !!}</td>
                                <td><strong>Floor No : </strong>{!! @$property->floor_no !!}</td>
                            </tr>
                            <tr style="margin-left: 20px">
                                <td><strong>Address : </strong>{!! @$clients->pre_district; !!}</td>
                                <td><strong>Unit No : </strong>{!! @$property->unit_no !!}</td>
                            </tr>
                        </table>
                    <!-- ./col -->
                  </div>

                        <div class="row">


                            <div class="col-md-12">

                                <div class="box-body">

                                    @php
                                        $delay_rate = $account_info->delay_rate;
                                        $redate_rate = $account_info->redate_rate;
                                        $totalPaid = $account_info->down_payment;
                                        $totalRebate = 0;
                                        $totalDelay = 0;
                                    @endphp

                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th colspan="3" style="text-align: center;"> Settled Schdule </th>
                                            <th colspan="@if(isset($_GET['type']) && $_GET['type']!='') 6 @else 4 @endif" style="text-align: center"> Installment Payment </th>
                                        </tr>
                                        <tr>
                                            <th> Payment Type </th>
                                            <th> Amount </th>
                                            <th> Date </th>
                                            <th> Inatallment No </th>
                                            <th> Payment Date </th>
                                            <th> MR No </th>
                                            <th> Paid Amount </th>
                                            @if(isset($_GET['type']) && $_GET['type']=='rebate')
                                            <th> Advance Days </th>
                                            <th> Rebate </th>
                                            @elseif(isset($_GET['type']) && $_GET['type']=='delay')
                                            <th> Delay Days</th>
                                            <th> Delay Charge</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td> EM&Part-DP </td>
                                            <td> {!! number_format($account_info->down_payment) !!} </td>
                                            <td> {!! date("d M y",strtotime($account_info->created_at)) !!}  </td>
                                            <td> EM&Part-DP </td>
                                            <td> {!! date("d M y",strtotime($account_info->created_at)) !!} </td>
                                            <td> -- </td>
                                            <td> {!! number_format($account_info->down_payment) !!} </td>
                                            @if(isset($_GET['type']) && $_GET['type']=='rebate')
                                            <td> -- </td>
                                            <td> -- </td>
                                            @elseif(isset($_GET['type']) && $_GET['type']=='delay')
                                            <td> -- </td>
                                            <td> -- </td>
                                            @endif
                                        </tr>

                                        @if($payment_schedules_list)


                                                @php
                                                    $k=1;

                                                    // Advance & Earnet &  Payments

                                                    $Advance_Payments = DB::table('payments')
                                                                 ->where('account_id', $id)
                                                                 ->where('payment_for','!=', 'Installment')
                                                                 ->orderBy('id','asc')
                                                                 ->get();

                                                @endphp
                                                @foreach($Advance_Payments as $row)
                                                    <tr>
                                                        <td> {!! $row->payment_for !!} </td>
                                                        <td> {!! number_format($row->amount,2) !!} </td>
                                                        <td> {!! date("d M y",strtotime($row->payment_date)) !!} </td>
                                                        <td> {!! $row->payment_for !!} </td>
                                                        <td> {!! date("d M y",strtotime($row->payment_date)) !!} </td>
                                                        @if(isset($row->mr_no))
                                                        <td> {!! $row->mr_no !!} </td>
                                                        @endif
                                                        <td> {!! number_format($row->amount,2) !!} </td> </td>
                                                        @if(isset($_GET['type']) && $_GET['type']=='rebate')
                                                        <td> -- </td>
                                                        <td> -- </td>
                                                        @elseif(isset($_GET['type']) && $_GET['type']=='delay')
                                                        <td> -- </td>
                                                        <td> -- </td>
                                                        @endif
                                                        @php $totalPaid +=$row->amount; @endphp

                                                    </tr>
                                                @endforeach



                                                @foreach($payment_schedules_list as $row)
                                                    @php
                                                        $amount = $row->amount;
                                                        $today = date("Y-m-d");
                                                        $schedule_date = $row->payment_date;
                                                        $schedule_amount = $row->amount;

                                                        $paid_amount = 0;
                                                        $paid_date = '-';

                                                        //Installment Payments
                                                        $Installment_Payments = DB::table('payments')
                                                                     ->where('account_id','=', $row->account_id)
                                                                     ->where('schedule_id','=', $row->id)
                                                                     ->where('payment_for','=', 'Installment')
                                                                     ->orderBy('id','asc')
                                                                     ->get();



                                                        $datetime1 = date_create($today);
                                                        $datetime2 = date_create($schedule_date);
                                                        $interval = date_diff($datetime1, $datetime2);
                                                        $days =  $interval->format('%a');

                                                        if($schedule_date<$today && $row->status==0)
                                                        {
                                                          $Advance_Days = 0;
                                                          $Delay_Days = $days;
                                                          $Rebate = 0;
                                                          $Delay_Charge = ((($amount*$delay_rate)/100)/365)*$Delay_Days;
                                                        } else {
                                                          $Advance_Days = $days;
                                                          $Delay_Days = 0;
                                                          $Rebate = ((($amount*$redate_rate)/100)/365)*$Advance_Days;
                                                          $Delay_Charge = 0;
                                                        }

                                                        $mr_no = '--';
                                                        $paid_date = '--';

                                                        if(isset($Installment_Payments[0]->amount))
                                                        {
                                                            $delay_rate = $Installment_Payments[0]->delay_rate;
                                                            $rebate_rate = $Installment_Payments[0]->rebate_rate;

                                                            $paid_amount = $Installment_Payments[0]->amount;
                                                            $paid_date = $Installment_Payments[0]->payment_date;

                                                            $Rebate = $Installment_Payments[0]->rebate;
                                                            if($Rebate>0){
                                                                $Advance_Days = $Installment_Payments[0]->days;
                                                            } else {
                                                                $Delay_Days = $Installment_Payments[0]->days;
                                                            }
                                                            $Delay_Charge = $Installment_Payments[0]->delay_charge;

                                                            if(isset($Installment_Payments[0]->mr_no)){
                                                                $mr_no = $Installment_Payments[0]->mr_no;
                                                            }

                                                            $totalPaid +=$paid_amount;
                                                            $totalRebate += $Rebate;
                                                            $totalDelay += $Delay_Charge;

                                                            $paid_date = date("d M y",strtotime($paid_date));
                                                        }



                                                @endphp
                                                <tr>
                                                    <td> {!! $k !!}@if($k%10 ==1 ){!! 'st' !!}@elseif($k%10==2){!! 'nd' !!}@elseif($k%10==3){!! 'rd' !!}@else{!! 'th' !!}@endif </td>
                                                    <td> {!! number_format($schedule_amount,2) !!} </td>
                                                    <td> {!! date("d M y",strtotime($schedule_date)) !!} </td>
                                                    <td> Part-{!! $k !!}@if($k%10 ==1 ){!! 'st' !!}@elseif($k%10==2){!! 'nd' !!}@elseif($k%10==3){!! 'rd' !!}@else{!! 'th' !!}@endif </td>
                                                    <td> {!! $paid_date !!} </td>

                                                    <td> {!! $mr_no !!} </td>


                                                    <td> {!! number_format($paid_amount,2) !!} </td>
                                                    @if(isset($_GET['type']) && $_GET['type']=='rebate')
                                                    <td> {!! $Advance_Days !!} </td>
                                                    <td> <span title="{!! $delay_rate !!}">{!! number_format($Rebate,2) !!}</span>  </td>
                                                    @elseif(isset($_GET['type']) && $_GET['type']=='delay')
                                                    <td> {!! $Delay_Days !!} </td>
                                                    <td> <span title="{!! $delay_rate !!}"> {!! number_format($Delay_Charge,2) !!} </span>  </td>
                                                    @endif
                                                </tr>
                                                @php

                                                    if(isset($Installment_Payments[1]))
                                                    {
                                                       //dd($Installment_Payments);
                                                       for($j=1; $j<count($Installment_Payments); $j++)
                                                       {

                                                            $delay_rate = $Installment_Payments[$j]->delay_rate;
                                                            $rebate_rate = $Installment_Payments[$j]->rebate_rate;

                                                            $paid_amount = $Installment_Payments[$j]->amount;
                                                            $paid_date = $Installment_Payments[$j]->payment_date;

                                                            $Rebate = $Installment_Payments[$j]->rebate;
                                                            if($Rebate>0){
                                                                $Advance_Days = $Installment_Payments[$j]->days;
                                                            } else {
                                                                $Delay_Days = $Installment_Payments[$j]->days;
                                                            }
                                                            $Delay_Charge = $Installment_Payments[$j]->delay_charge;
                                                            $mr_no = '--';
                                                            if(isset($Installment_Payments[$j]->mr_no)){
                                                                $mr_no = $Installment_Payments[$j]->mr_no;
                                                            }

                                                            $totalPaid +=$paid_amount;
                                                            $totalRebate += $Rebate;
                                                            $totalDelay += $Delay_Charge;

                                                            $p = '';
                                                            if ($k%10==1){ $p = "st"; }
                                                            elseif ($k%10==2){ $p = "nd"; }
                                                            elseif ($k%10==3){ $p = "rd"; }
                                                            else { $p = "th"; }
                                                            $prefix = "Part-";

                                                            if (count($Installment_Payments)==$j+1 && $row->status==1){
                                                                $prefix = "Bal-";
                                                            }

                                                            echo '<tr>
                                                                    <td> '.$k.$p.' </td>
                                                                    <td> '.number_format($schedule_amount,2).' </td>
                                                                    <td> '.date("d M y",strtotime($schedule_date)).' </td>
                                                                    <td> '.$prefix.$k.$p.' </td>
                                                                    <td> '.date("d M y",strtotime($paid_date)).' </td>
                                                                    <td> '.$mr_no.' </td>
                                                                    <td> '.number_format($paid_amount,2).' </td>';
                                                                    if(isset($_GET['type']) && $_GET['type']=='rebate')
                                                                    echo '
                                                                        <td> '.$Advance_Days.' </td>
                                                                        <td> <span title="'.$delay_rate.'">'.number_format($Rebate,2).'</span>  </td>';
                                                                    elseif(isset($_GET['type']) && $_GET['type']=='delay')
                                                                    echo '
                                                                    <td> '.$Delay_Days.'</td>
                                                                    <td> <span title="'.$delay_rate.'"> '.number_format($Delay_Charge,2).' </span>  </td>';
                                                            echo '</tr>';
                                                       }
                                                    }

                                                $k++;

                                                @endphp

                                            @endforeach
                                                <tr>
                                                    <td colspan="3" style="text-align: center"><strong>Total Price :  {!! number_format($account_info->purchase_price,2) !!} </strong></td>
                                                    <td colspan="2">  </td>
                                                    <td colspan="2" style="border-right: none"><strong>Total Paid :  {!! number_format($totalPaid,2) !!} </strong></td>

                                                    @if(isset($_GET['type']) && $_GET['type']=='rebate')
                                                        <td >  </td>
                                                        <td >  </td>
                                                    @elseif(isset($_GET['type']) && $_GET['type']=='delay')
                                                        <td >  </td>
                                                        <td >  </td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td colspan="5">  </td>
                                                    <td colspan="3" style="border-right: none"><strong>Balance : </strong> @php $balance = $account_info->purchase_price - $totalPaid @endphp <strong>{!! number_format($balance,2) !!} </strong></td>
                                                    @if(isset($_GET['type']) && $_GET['type']=='rebate')
                                                        <td colspan="2"><strong>{!! number_format($totalRebate,2) !!}</strong></td>
                                                    @elseif(isset($_GET['type']) && $_GET['type']=='delay')
                                                        <td colspan="2"><strong>{!! number_format($totalDelay,2) !!}</strong></td>
                                                    @endif
                                                </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>

                </div>
            </div>
            </div>
        </div>
</section>
@endsection
