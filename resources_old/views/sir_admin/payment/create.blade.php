@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
         <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border"> <h3 class="box-title">Payment</h3>  </div>
                <div class="box-body">
                    @if(count($errors)>0)
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif

                    <form class="form-horizontal" onsubmit="return confirm('Are you sure you want to submit?')" action="@hasSection('id'){{ url('/payment') }}/@yield('id')@else {{ url('/payment') }} @endif" method="POST">
                        @section('editMethod')
                        @show

                       <div class="form-group">
                          
                          <div class="col-sm-12" >

                              @php
                                  $ac_id = 0;
                                  if(isset($item->account_id)){
                                      $ac_id = $item->account_id;
                                  }
                                  if(isset($_GET["account"])){
                                      $ac_id = $_GET["account"];
                                  }
                                  $total='';
                              @endphp

                              @if(isset($_GET['schedule']) && isset($schedule_info->amount) && $_GET['schedule']!='')
                              <table class="table table-striped table-hover">
                                  <thead>
                                  <tr>
                                      <th> Payment Date </th>
                                      <th> Payment Amount</th>
                                      <th> Advance Days </th>
                                      <th> Rebate </th>
                                      <th> Delay Days</th>
                                      <th> Delay Charge</th>
                                      <th> Total </th>
                                  </tr>
                                  </thead>
                                  @php
                                      $delay_rate = $account_info->delay_rate;
                                      $redate_rate = $account_info->redate_rate;
                                      $amount = $schedule_info->amount;
                                      $payment_date = $schedule_info->payment_date;
                                      $today = date("Y-m-d");
                                      $datetime1 = date_create($today);
                                      $datetime2 = date_create($payment_date);
                                      $interval = date_diff($datetime1, $datetime2);
                                      $days =  $interval->format('%a');

                                      if($payment_date<$today)
                                      {
                                        $advance_days = 0;
                                        $delay_days = $days;
                                        $rebate = 0;
                                        $delay_charge = ((($amount*$delay_rate)/100)/365)*$delay_days;
                                        $total = $amount+$delay_charge;
                                      } else {
                                          $advance_days = $days;
                                          $delay_days = 0;
                                          $rebate = ((($amount*$redate_rate)/100)/365)*$advance_days;
                                          $delay_charge = 0;
                                          $total = $amount-$rebate;
                                      }

                                   echo '<input type="hidden" name="advance_days" value="'.$advance_days.'"/>';
                                   echo '<input type="hidden" name="delay_days" value="'.$delay_days.'"/>';
                                   echo '<input type="hidden" name="rebate" value="'.$rebate.'"/>';
                                   echo '<input type="hidden" name="delay_charge" value="'.$delay_charge.'"/>';

                                  @endphp

                                  <tbody>
                                  <tr>
                                      <td> {!! $schedule_info->payment_date !!}  </td>
                                      <td> {!! number_format($schedule_info->amount) !!}  </td>
                                      <td> {!! $advance_days !!}  </td>
                                      <td> {!! number_format($rebate,2) !!}  </td>
                                      <td> {!! $delay_days !!}  </td>
                                      <td> {!! number_format($delay_charge) !!} </td>
                                      <td> {!! number_format($total) !!} </td>
                                  </tr>
                                  </tbody>
                              </table>
                              @endif

                          </div>


                          <label class="col-sm-3 control-label" for="name">Account</label>

                          <div class="col-sm-7">
                              <select  name="account_id" class="selectpicker form-control col-md-6" data-live-search="true">
                                @if(isset($accounts))
                                    @foreach($accounts as $row)
                                        <option  value="{{ $row->id }}"  @if(isset($ac_id) && $ac_id == $row->id) selected="selected" @endif >{{ $row->name }} - {{ $row->projects_title }} - {{ $row->property_title }}</option>
                                    @endforeach
                                @endif
                              </select>
                          </div> 
                           
                        </div>

                       @php

                           if(isset($_GET['schedule']))
                           {
                               $p_status = DB::table('payments')
                                                ->where('account_id','=', $_GET['account'])
                                                ->where('schedule_id','=', $_GET['schedule'])
                                                ->orderBy('id','desc')
                                                ->first();
                           }


                           if(isset($p_status->dues_amount))
                           {
                               $dues_amount=$p_status->dues_amount;
                               $schedule_date = $p_status->dues_schedule_date;
                               $due_txt = number_format($dues_amount).' From '.date("F j, Y",strtotime($schedule_date));
                               $datetime1 = date_create($today);
                               $datetime2 = date_create($schedule_date);
                               $interval = date_diff($datetime1, $datetime2);
                               $delay_days =  $interval->format('%a');
                               $delay_charge = ((($dues_amount*$delay_rate)/100)/365)*$delay_days;

                               $total = $dues_amount + $delay_charge;
                           }
                       @endphp


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="type">Payment For </label>
                            <div class="col-sm-7">
                                <select name="payment_for" class="form-control">
                                    <option value="">Select</option>
                                    @php $payment_for = DB::table('items')
                                                ->where('type','=', 'payment_for')
                                                ->where('value','!=', '')
                                                ->orderBy('id','asc')
                                                ->get(); @endphp
                                    @if(isset($payment_for))
                                        @foreach($payment_for as $row)
                                            <option  value="{{ $row->value }}" >{{ $row->value }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="amount">Amount</label>
                             <div class="col-sm-7">
                                 <input type="text" class="form-control" value="{!! round($total) !!}" name="amount"  placeholder="Amount">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Payment  Date:</label>
                            <div class="col-sm-7">    
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input name="payment_date" type="date" value="@yield('date')" class="form-control pull-right">
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label" for="exampleSelect1">Payment Method</label>
                           <div class="col-sm-7"> 
                          <select name="payment_mode" onchange="checkBank(this.value)" class="form-control" id="exampleSelect1">
                            <option value="Cash">Cash</option>
                            <option value="Bank Cheque">Bank Cheque</option>
                          </select>
                        </div>
                        </div>
                         <div class="form-group bank" style="display: none">
                            <label class="col-sm-3 control-label" for="check_no">Check No</label>
                            <div class="col-sm-7"> 
                                <input type="text" class="form-control" value="@yield('check_no')" name="check_no"  placeholder="Check No">
                            </div>
                        </div>
                         <div class="form-group bank" style="display: none">
                            <label class="col-sm-3 control-label" for="bank">Bank Name</label>
                            <div class="col-sm-7"> 
                                <input type="text" class="form-control" value="@yield('bank')" name="bank"  placeholder="Bank name">
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="type">Payment Type</label>
                            <div class="col-sm-7"> 
                                <select name="type" class="form-control">
                                    <option value="cr">Credit</option>
                                    <option value="dr">Debit</option>
                                </select>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="remark">Money Recept No. </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="@yield('mr_no')" name="mr_no"  placeholder="Money Recept">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="remark">Remark</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="@yield('remark')" name="remark"  placeholder="Remark">
                            </div>
                        </div>




                        <div class="form-group">
                            <div class="col-sm-3">&nbsp;</div> 
                            <div class="col-sm-7">
                                <button class="btn btn-info pull-right" type="submit" class="btn btn-default">Submit</button>
                            </div>    
                        </div>
                        
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        @if(isset($_GET['schedule']) && $_GET['schedule']!='')
                           <input type="hidden" name="schedule_id" value="{!! $_GET['schedule'] !!}"/>
                        @endif
                        <input type="hidden" name="account" value="{!! $_GET['account'] !!}"/>

                    </form>

                </div>
            </div>
        </div>
    <script>
        function checkBank(method)
        {

            if(method=='Cash')
            {
                $(".bank").css("display", "none");
            } else {
                $(".bank").css("display", "block");
            }
        }
    </script>
@endsection
