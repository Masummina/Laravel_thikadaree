@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
                

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif

                    <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
              <p class="pull-right">  &nbsp;&nbsp;&nbsp;
                  Print : <span class="glyphicon glyphicon-print  " onclick="PrintElem('#print_able')"> </span>
              </p> <br/>

            <div class="box-header with-border" style="text-align: center">

                <p> {!! Config('app.project_name'); !!} </p>
                <h3 class="box-title"> {!! Config('app.project_address'); !!} </h3>
            </div>

              <div style="text-align: center; padding: 5px; background-color: #9ad717;"> Rebate & Delay Charge Calculation </div>
            @php
              $parking_price = '';
              if(count($parking_info)>0)
              {
                foreach ($parking_info as $row)
                {
                  $parking_price .=number_format($row->price).' + ';
                }
                $parking_price = rtrim($parking_price,'+ ');
              }

              $down_payment = $account_info->down_payment;
              $installment_payment = 0;
              if(isset($paid_amount[0]))
              {
                 $installment_payment = $paid_amount[0]->total_paid;
              }
              $Total_Paid = $down_payment+$installment_payment;
              $Total_Due = $account_info->purchase_price - $Total_Paid;
            @endphp

            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr> <td> Project </td> <td>: {!! $project_info->title !!} </td> </tr>
                        <tr> <td> Apt. </td> <td>: {!! $property_info->title !!} </td> </tr>
                        <tr> <td> Size </td> <td>: {!! $property_info->description !!} </td> </tr>
                        <tr> <td> Price </td> <td>: @if(isset($property_info->title)) {!! number_format($property_info->price) !!} @endif </td> </tr>
                        <tr> <td> Parking </td> <td>:   {!! $parking_price !!} </td> </tr>
                        <tr> <td> Discount </td> <td>:   {!! number_format($account_info->discount_amount) !!} </td> </tr>
                        <tr> <td> Total Price </td> <td>: {!! number_format($account_info->purchase_price) !!} </td> </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr> <td> Handover date </td> <td>: {!! $account_info->handover_date !!} </td> </tr>
                    <tr> <td> Rebate </td> <td>: {!! $account_info->redate_rate !!} % </td> </tr>
                    <tr> <td> Delay Charge  </td> <td>: {!! $account_info->delay_rate !!} % </td> </tr>

                    <tr> <td> Total Paid </td> <td>: {!! number_format($Total_Paid) !!} </td> </tr>
                    <tr> <td> Total Balance </td> <td style="color: #c12e2a; font-weight: bold;">: {!! number_format($Total_Due) !!} </td> </tr>
                    </tbody>
                </table>

                <div class="col-md-3">
                    <button type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">Edit Rate</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('/account/'.$account_info->id) }}" class="btn btn-primary pull-left">Show Report</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('/payment/create?account='.$account_info->id) }}" class="btn btn-primary pull-left">Make Payment</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('/payment/') }}" class="btn btn-primary pull-left">Payment List</a>
                </div>

            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="box-body">
                    <h3 class="box-title"> Payment Schedule & Installment Paid </h3>
                    @php
                        $delay_rate = $account_info->delay_rate;
                        $redate_rate = $account_info->redate_rate;
                        $i=0;
                    @endphp

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> Payment Type </th>
                            <th> Payment Date </th>
                            <th> Payment Amount </th>
                            <th> Paid Amount </th>
                            <th style="width: 90px"> Paid Date </th>
                            <th> Advance Days </th>
                            <th> Rebate </th>
                            <th> Delay Days</th>
                            <th> Delay Charge</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td> Earnest Money </td>
                                <td> --  </td>
                                <td class="tright"> {!! number_format($account_info->earnest_money) !!} </td>
                                <td> 0 </td>
                                <td> -- </td>
                                <td> 0 </td>
                                <td> -- </td>
                                <td> -- </td>
                                <td> -- </td>
                            </tr>
                            <tr>
                                <td> Down Payment </td>
                                <td> --  </td>
                                <td class="tright"> {!! number_format($account_info->down_payment) !!} </td>
                                <td> 0 </td>
                                <td> -- </td>
                                <td> 0 </td>
                                <td> -- </td>
                                <td> -- </td>
                                <td> -- </td>
                            </tr>
                        @php $installment_no = 0; @endphp
                        @if($payment_schedules_list)
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

                                    $paid_date = '--';
                                    $edit_btn=1;

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
                                        $paid_date = date("d M y",strtotime($paid_date));

                                        $edit_btn=0;
                                    }
                                    $installment_no++;
                                    if($installment_no==1) $ext='st';
                                    if($installment_no==2) $ext='nd';
                                    if($installment_no==3) $ext='rd';
                                    if($installment_no>3) $ext='th';
                                    @endphp
                                        <tr>
                                            <td>
                                                {!! $installment_no.$ext.' Inst.' !!}
                                                @if($row->status==0 && $edit_btn==1)
                                                    <button type="button" data-target="#Modal-Edit{!! ++$i !!}" class="btn btn-primary pull-right" data-toggle="modal">Edit</button>
                                                @endif
                                            </td>
                                            <td> {!! date("d M y",strtotime($schedule_date)) !!}   </td>
                                            <td class="tright"> {!! number_format($schedule_amount) !!} </td>
                                            <td style="text-align: right"> {!! number_format($paid_amount,2) !!} </td>
                                            <td> {!! $paid_date !!} </td>
                                            <td> {!! $Advance_Days !!} </td>
                                            <td class="tright"> <span title="{!! $delay_rate !!}%">{!! number_format($Rebate,2) !!}</span>  </td>
                                            <td> {!! $Delay_Days !!} </td>
                                            <td class="tright"> <span title="{!! $delay_rate !!}%"> {!! number_format($Delay_Charge,2) !!} </span>  </td>
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

                                            echo '<tr>
                                                    <td> -- </td>
                                                    <td> -- </td>
                                                    <td> -- </td>
                                                    <td style="text-align: right"> '.number_format($paid_amount,2).' </td>
                                                    <td> '.date("d M y",strtotime($paid_date)).' </td>
                                                    <td> '.$Advance_Days.' </td>
                                                    <td class="tright"> <span title="'.$delay_rate.'">'.number_format($Rebate,2).'</span>  </td>
                                                    <td> '.$Delay_Days.'</td>
                                                    <td class="tright"> <span title="'.$delay_rate.'"> '.number_format($Delay_Charge,2).' </span>  </td>
                                                </tr>';
                                       }
                                    }

                                @endphp


                                <div class="modal fade" id="Modal-Edit{!! $i !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3> Change schedule information </h3>
                                            </div>
                                            <div class="modal-body">

                                                <form class="form-horizontal" action="{!! url('/payment-schedule-status-update/'.$account_info->id) !!}" onsubmit="return confirm('Are you sure you want to submit?')" method="POST">

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="name"> Payment date </label>
                                                        <div class="col-sm-7">
                                                            <input name="payment_date" id="payment_date" type="date" value="{!! $row->payment_date !!}" autocomplete="off" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="name"> Amount </label>
                                                        <div class="col-sm-7">
                                                            <input name="amount" id="amount" type="text" value="{!! $row->amount !!}" autocomplete="off" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label" for="name"> &nbsp; </label>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="id" value="{!! $row->id !!}"/>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                    {{method_field('PUT')}}

                                                </form>


                                            </div>
                                            <div class="modal-footer">
                                                <a href="{!! url('/payment-schedule-status-delete/'.$row->id.'/'.$account_info->id) !!}" onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger"> Delete </a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            <tr>
                                <td > <button type="button" data-target="#Schedule-Add" class="btn btn-primary pull-right" data-toggle="modal">Add New</button></td>
                                <td colspan="8">  </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                </div>
        </div>


            </div>
        </div>
      </section>
    </div>

    <div class="modal fade" id="Schedule-Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3> Add New Schedule </h3>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" action="{!! url('/payment-schedule-status-add/'.$account_info->id) !!}" onsubmit="return confirm('Are you sure you want to submit?')" method="POST">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Payment Type </label>
                            <div class="col-sm-7">
                                <input name="ptype"  type="radio" value="MI"  checked /> Monthly Installment
                                <input name="ptype" type="radio" value="EM" /> Earnest Money
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Payment date </label>
                            <div class="col-sm-7">
                                <input name="payment_date" id="payment_date" type="date" value="" autocomplete="off" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Amount </label>
                            <div class="col-sm-7">
                                <input name="amount" id="amount" type="text" value="" autocomplete="off" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name"> &nbsp; </label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Add New</button>
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        {{method_field('PUT')}}

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modal-Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3> Change Rate </h3>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" action="{!! url('/account/'.$account_info->id) !!}" method="POST">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Earnest Money </label>
                            <div class="col-sm-7">
                                <input name="down_payment" id="down_payment" type="text" value="{!! $account_info->down_payment !!}" autocomplete="off" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Rebate rate (%) </label>
                            <div class="col-sm-7">
                                <input name="redate_rate" id="redate_rate" type="text" value="{!! $account_info->redate_rate !!}" autocomplete="off" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Delay rate (%) </label>
                            <div class="col-sm-7">
                                <input name="delay_rate" id="delay_rate" type="text" value="{!! $account_info->delay_rate !!}" autocomplete="off" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name"> &nbsp; </label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{!! $account_info->id !!}"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        {{method_field('PUT')}}

                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div id="print_able" style="display: none;" >
        <div class="box-header with-border" style="text-align: center">
            <h3 class="box-title">
                Urban Design & Development Ltd. <br/>
                House No. 34/A, Road No. 10/A (new), Dhanmondi R/A., Dhaka-1209
            </h3>
        </div>
        <div style="text-align: center; padding: 5px; background-color: #9ad717;"> Rebate & Delay Charge Calculation </div>

        <div class="col-md-6">
            <table class="table table-striped table-hover">
                <tbody>
                <tr> <td> Project </td> <td>: {!! $project_info->title !!} </td> </tr>
                <tr> <td> Apt. </td> <td>: {!! $property_info->title !!} </td> </tr>
                <tr> <td> Size </td> <td>: {!! $property_info->description !!} </td> </tr>
                <tr> <td> Price </td> <td>: @if(isset($property_info->title)) {!! number_format($property_info->price) !!} @endif </td> </tr>
                <tr> <td> Parking </td> <td>:   {!! $parking_price !!} </td> </tr>
                <tr> <td> Discount </td> <td>:   {!! number_format($account_info->discount_amount) !!} </td> </tr>
                <tr> <td> Total Price </td> <td>: {!! number_format($account_info->purchase_price) !!} </td> </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-hover">
                <tbody>
                <tr> <td> Handover date </td> <td>: {!! $account_info->handover_date !!} </td> </tr>
                <tr> <td> Rebate </td> <td>: {!! $account_info->redate_rate !!} </td> </tr>
                <tr> <td> Delay Charge  </td> <td>: {!! $account_info->delay_rate !!} </td> </tr>

                <tr> <td> Earnest Money </td> <td>: {!! number_format($Total_Paid) !!} </td> </tr>
                <tr> <td> Total installment Amount </td> <td style="color: #c12e2a; font-weight: bold;">: {!! number_format($Total_Due) !!} </td> </tr>
                </tbody>
            </table>
        </div>

        <h3> Standard Schedule </h3>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th> Payment Type </th>
                <th> Date </th>
                <th> Amount</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> Earnest Money </td>
                <td> {!! date("F j, Y", strtotime($account_info->created_at)) !!} </td>
                <td> {!! number_format($account_info->down_payment) !!} </td>
            </tr>
            @php $i=1; @endphp
            @if($payment_schedules_list)
                @foreach($payment_schedules_list as $row)
                    <tr>
                        <td> @if($row->ptype=='MI') {!! 'Installment' !!} @else {!! 'Earnest Money' !!} @endif </td>
                        <td> {!! date("F j, Y", strtotime($row->payment_date) ) !!} </td>
                        <td> {!! number_format($row->amount) !!} </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </div>



@endsection
