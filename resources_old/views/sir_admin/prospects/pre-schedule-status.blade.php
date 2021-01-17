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
              </p>  <br/>
            <div class="box-header with-border" style="text-align: center">
                <p> Urban Design & Development Ltd. </p>
                <h3 class="box-title"> House No. 34/A, Road No. 10/A (new), Dhanmondi R/A., Dhaka-1209 </h3>
            </div>
              <div style="text-align: center; padding: 5px; background-color: #9ad717;"> Rebate & Delay Charge Calculation </div>
            @php
              
              $schedule_id = $schedules_info->id;
              $parking_price = '';
              if(count($parking_info)>0)
              {
                foreach ($parking_info as $row)
                {
                  $parking_price .=number_format($row->price).' + ';
                }
                $parking_price = rtrim($parking_price,'+ ');
              }

              $down_payment = $schedules_info->down_payment;
              $installment_payment = 0;
              if(isset($paid_amount[0]))
              {
                 $installment_payment = $paid_amount[0]->total_paid;
              }

              $Total_Paid = $down_payment+$installment_payment;
              $Total_Due = $schedules_info->purchase_price - $Total_Paid;
              $parking = (int)(str_replace(',','', $parking_price));
              $totalPrice = $schedules_info->property_price+$schedules_info->parking_price-$schedules_info->discount_amount;
              $dueAmount = $totalPrice-$schedules_info->earnest_money-$schedules_info->down_payment;
            @endphp

            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr> <td> Project </td> <td>: {!! $project_info->title !!} </td> </tr>
                        <tr> <td> Apt. </td> <td>: {!! $property_info->title !!} </td> </tr>
                        <tr> <td> Size </td> <td>: {!! $property_info->description !!} </td> </tr>
                        <tr> <td> Price </td> <td>: @if(isset($property_info->title)) {!! number_format($schedules_info->property_price) !!} @endif </td> </tr>
                        <tr> <td> Parking </td> <td>:   {!! number_format($schedules_info->parking_price) !!} </td> </tr>
                        <tr> <td> Discount </td> <td>:   {!! number_format($schedules_info->discount_amount) !!} </td> </tr>
                        <tr> <td> Total Price </td> <td>: {!! number_format($totalPrice) !!} </td> </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr> <td> Handover date </td> <td>: {!! date("j F, Y",strtotime($project_info->hand_over)) !!} </td> </tr>
                    <tr> <td> Rebate </td> <td>: {!! $schedules_info->redate_rate !!}% </td> </tr>
                    <tr> <td> Delay Charge  </td> <td>: {!! $schedules_info->delay_rate !!}% </td> </tr>
                    <tr> <td> Earnest Money </td> <td>: {!! number_format($schedules_info->earnest_money) !!} </td> </tr>
                    <tr> <td> Down Payment </td> <td>: {!! number_format($schedules_info->down_payment) !!} </td> </tr>
                    <tr> <td> Total installment Amount </td> <td style="color: #c12e2a; font-weight: bold;">: {!! number_format($dueAmount) !!} </td> </tr>
                    </tbody>
                </table>
                <div class="col-md-4">
                    <button type="button" data-target="#Modal-Edit" class="btn btn-primary pull-right" data-toggle="modal">Edit Rate</button>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="box-body">
                    <h3> Standard Schedule </h3>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S# </th>
                            <th> Payment Type </th>
                            <th> Date </th>
                            <th> Amount</th>                            
                            <th> Payment Date </th>
                            <th> Payment Amount </th>
                            <th> Advance Days </th>
                            <th> Rebate</th>                            
                        </tr>
                        </thead>
                        <tbody>

                        @php 
                            if($schedules_info->down_payment>$property_info->down_payment)
                                $down_payment = $property_info->down_payment;
                            else    
                                $down_payment = $schedules_info->down_payment;
                            
                            if($schedules_info->earnest_money>$property_info->down_payment)
                                $earnest_money = $property_info->earnest_money;
                            else    
                                $earnest_money = $schedules_info->earnest_money;
                        @endphp
                        <tr>
                            <td> #</td>
                            <td> Earnest Money </td>
                            <td> {!! date("j M Y", strtotime($schedules_info->created_at)) !!} </td>
                            <td style="text-align:right;"> {!! number_format($property_info->earnest_money) !!} </td>
                            <td> {!! date("j M Y", strtotime($schedules_info->created_at)) !!} </td>
                            <td style="text-align:right;"> {!! number_format($earnest_money) !!} </td>                                                   
                            <td> -- </td>
                            <td> -- </td>
                        </tr>
                        
                        <tr>
                            <td> #</td>
                            <td> Down Payment </td>
                            <td> {!! date("j M Y", strtotime($schedules_info->created_at)) !!} </td>
                            <td style="text-align:right;"> {!! number_format($property_info->down_payment) !!}   </td>
                            <td> {!! date("j M Y", strtotime($schedules_info->created_at)) !!} </td>
                            <td style="text-align:right;"> {!! number_format($schedules_info->down_payment) !!}   </td>                                                        
                            <td> -- </td>
                            <td> -- </td>
                        </tr>
                        @php
                            //$parking = (int)(str_replace(',','', $parking_price));
                            //var_dump($parking);
                            $rebateRate = $schedules_info->redate_rate;
                            $i=0;
                            $totalInstallment = 0;
                            $no_of_month=0;
                            $total_advance = $property_info->earnest_money+$property_info->down_payment;
                            $balance = ($schedules_info->property_price + $schedules_info->parking_price) - ($total_advance + $schedules_info->discount_amount);
                            
                            //$date_start = date("Y-m-01", strtotime('+1 month'));
                            //$date_start = date("Y-m-01", strtotime($payment_schedules_list[0]->payment_date));
                            $date_start = date("Y-m-01", strtotime($schedules_info->frist_payment_date));
                            $date_end = $project_info->hand_over;
                            while($date_end>$date_start)
                            {
                                $date_start = date("Y-m-01", strtotime('+1 month',strtotime($date_start)));
                                $no_of_month++;
                            }
                            //echo "<br/>".$no_of_month;
                            $date_start = date("Y-m-01", strtotime($schedules_info->frist_payment_date));
                            //$date_start = date("Y-m-01", strtotime('+1 month',strtotime($date_start)));
                            if($no_of_month>0){
                                $per_month_installment = $balance/$no_of_month;
                            }else{
                                $per_month_installment = $totalPrice-$total_advance;
                            }
                            
                            //foreach($payment_schedules_list as $row)
                            
                            $schedule_total = $property_info->earnest_money+$property_info->down_payment;
                            $deposit_total = $schedules_info->earnest_money+$schedules_info->down_payment;
                            $Rebate_Total = 0;
                            $Advance_deposit_total = 0;  
                            $Total_deposit = $schedule_total;  
                            
                            //$schedule_id = 9;
                            DB::table('pre_schedule_details')
                                                ->where('pre_schedule_id', $schedule_id)
                                                ->update(['used' => 0]);    //exit;

                            $data = DB::table('pre_schedule_details')
                                                ->select('id','amount','payment_date')                                                                                          
                                                ->where('pre_schedule_id', $schedule_id)
                                                ->orderBy('payment_date', 'asc')
                                                ->first();

                            $first_payment_date = $data->payment_date;                                                                        
                            $payment_date = $data->payment_date;                                                                        
                            $payment_info = array('date'=>$first_payment_date,'amount'=>$per_month_installment);
                            if($deposit_total > $schedule_total)
                            {
                                $Advance_deposit_total = $deposit_total - $schedule_total;    
                            }
                        @endphp
                        @if($no_of_month>0)
                            @while($date_end>$date_start)
                                @php 
                                                                  
                                    $dm = substr($date_start,0,7);
                                    $data = DB::table('pre_schedule_details')
                                                ->select('id','amount','payment_date')                                                
                                                ->whereRaw("pre_schedule_id=$schedule_id AND payment_date LIKE '".$dm."%'")
                                                ->first();
                                    $schedule_date = $data->payment_date; 
                                    
                                    
                                    if($Advance_deposit_total > $per_month_installment)
                                    {
                                        $Advance_deposit_total -= $per_month_installment;  
                                        $payment_info = array('date'=>$payment_date,'amount'=>$per_month_installment); 
                                        $Advance_Days = get_days_diff($schedule_date,$payment_date);
                                        $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                        $Rebate_Total += $Rebate;
                                        $i++; 
                                        $Total_deposit += $payment_info['amount'];
                                        @endphp    
                                        <tr>
                                            <td> {!! $i !!} </td>
                                            <td> {!! 'Installment' !!}  </td>
                                            <td> {!! date("F j, Y", strtotime($schedule_date) ) !!}  </td>
                                            <td style="text-align:right;"> {!! number_format($per_month_installment) !!} </td>
                                            <td style="text-align: right;"> {!! date("F j, Y", strtotime($payment_info['date']) ) !!}  </td>
                                            <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!} </td>                                    
                                            <td style="text-align:center;"> {!! $Advance_Days !!} </td>
                                            <td style="text-align:right;"> {!! number_format($Rebate) !!} </td>                                            
                                        </tr>
                                        @php
                                    } else {                                        
                                        $payment_info = array('date'=>$payment_date,'amount'=>$Advance_deposit_total);                                                                                     
                                        $Advance_Days = get_days_diff($schedule_date,$payment_date);
                                        $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                        $Rebate_Total += $Rebate;
                                        $i++; 
                                        $Total_deposit += $payment_info['amount'];
                                        $First_Payment = $payment_info['amount'];
                                        // Print  Table Here
                                        @endphp    
                                        <tr>
                                            <td> {!! $i !!} </td>
                                            <td> {!! 'Installment' !!}  </td>
                                            <td> {!! date("F j, Y", strtotime($schedule_date) ) !!}  </td>
                                            <td style="text-align:right;"> {!! number_format($per_month_installment) !!} </td>
                                            <td style="text-align: right;"> {!! date("F j, Y", strtotime($payment_info['date']) ) !!}  </td>
                                            <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!} </td>                                    
                                            <td style="text-align:center;"> {!! $Advance_Days !!} </td>
                                            <td style="text-align:right;"> {!! number_format($Rebate) !!} </td>                                            
                                        </tr>
                                        @php
                                        // End Table
                                        $data = DB::table('pre_schedule_details')
                                                ->select('id','amount','payment_date')                                                
                                                ->where('pre_schedule_id', $schedule_id)
                                                ->where('used', 0)
                                                ->orderBy('payment_date', 'asc')
                                                ->first(); 
                                        if(isset($data->id))
                                        {                                          
                                            DB::table('pre_schedule_details')
                                                    ->where('id', $data->id)
                                                    ->update(['used' => 1]);                                     
                                            
                                            //dd($data); //exit;
                                            $payment_date = $data->payment_date;       
                                            $payment_info = array('date'=>$payment_date,'amount'=>$data->amount);         
                                            // Print  Table Here
                                            $Advance_Days = get_days_diff($schedule_date,$payment_date);
                                            $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                            $Rebate_Total += $Rebate;
                                            //$Total_deposit += $payment_info['amount'];

                                            $Second_Payment = $payment_info['amount'];
                                            $will_be_deposit = $First_Payment + $Second_Payment;
                                            if($will_be_deposit > $per_month_installment ) 
                                            {
                                                $Second_Payment = $per_month_installment - $First_Payment; 
                                            }

                                            $Total_deposit += $Second_Payment;

                                            //$i++;
                                            @endphp    
                                            <tr>
                                                <td> -- </td>
                                                <td> -- </td>
                                                <td> -- </td>
                                                <td> -- </td>
                                                <td style="text-align: right;"> {!! date("F j, Y", strtotime($payment_info['date']) ) !!}  </td>
                                                <td style="text-align:right;"> {!! number_format($Second_Payment) !!} </td>                                    
                                                <td style="text-align:center;"> {!! $Advance_Days !!} </td>
                                                <td style="text-align:right;"> {!! number_format($Rebate) !!} </td>                                            
                                            </tr>
                                            @php
                                            // End Table                                          
                                            $deposit_total = $Advance_deposit_total + $data->amount; 
                                            if($per_month_installment>$deposit_total) 
                                            {
                                                $rest_installment = $per_month_installment-$deposit_total;
                                                $data = DB::table('pre_schedule_details')
                                                    ->select('id','amount','payment_date')                                                
                                                    ->where('pre_schedule_id', $schedule_id)
                                                    ->where('used', 0)
                                                    ->orderBy('payment_date', 'asc')
                                                    ->first();
                                                if(isset($data->id))
                                                {                                                                                          
                                                    DB::table('pre_schedule_details')
                                                            ->where('id', $data->id)
                                                            ->update(['used' => '1']);
                                                    
                                                    $payment_date = $data->payment_date; 
                                                    $deposit_total = $deposit_total + $data->amount;
                                                    if($deposit_total > $per_month_installment) 
                                                    {
                                                        $payment_info = array('date'=>$payment_date,'amount'=>$rest_installment);         
                                                    } else {
                                                        $payment_info = array('date'=>$payment_date,'amount'=>$data->amount);
                                                    }                                            
                                                    // Print  Table Here
                                                    $Advance_Days = get_days_diff($schedule_date,$payment_date);
                                                    $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                                    $Rebate_Total += $Rebate;
                                                    $Total_deposit += $payment_info['amount'];
                                                    //$i++; 
                                                    @endphp    
                                                    <tr>
                                                        <td> -- </td>
                                                        <td> --  </td>
                                                        <td> -- </td>
                                                        <td> -- </td>
                                                        <td style="text-align: right;"> {!! date("F j, Y", strtotime($payment_info['date']) ) !!}  </td>
                                                        <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!} </td>                                    
                                                        <td style="text-align:center;"> {!! $Advance_Days !!} </td>
                                                        <td style="text-align:right;"> {!! number_format($Rebate) !!} </td>                                            
                                                    </tr>
                                                    @php
                                                    // End Table 
                                                    //dd($data);
                                                    if($per_month_installment>$deposit_total) 
                                                    {
                                                        $rest_installment = $per_month_installment-$deposit_total;
                                                        $data = DB::table('pre_schedule_details')
                                                            ->select('id','amount','payment_date')                                                
                                                            ->where('pre_schedule_id', $schedule_id)
                                                            ->where('used', 0)
                                                            ->orderBy('payment_date', 'asc')
                                                            ->first();
                                                        if(isset($data->id))
                                                        {                                                                                             
                                                            DB::table('pre_schedule_details')
                                                                    ->where('id', $data->id)
                                                                    ->update(['used' => '1']);
                                                            $payment_date = $data->payment_date; 
                                                            $deposit_total = $deposit_total + $data->amount;
                                                            if($deposit_total > $per_month_installment) 
                                                            {
                                                                $payment_info = array('date'=>$payment_date,'amount'=>$rest_installment);         
                                                            } else {
                                                                $payment_info = array('date'=>$payment_date,'amount'=>$data->amount);
                                                            }       
                                                                    
                                                            // Print  Table Here
                                                            $Advance_Days = get_days_diff($schedule_date,$payment_date);
                                                            $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                                            $Rebate_Total += $Rebate; 
                                                            $Total_deposit += $payment_info['amount'];                                                           
                                                            @endphp    
                                                            <tr>
                                                                <td> -- </td>
                                                                <td> --  </td>
                                                                <td> {!! date("F j, Y", strtotime($schedule_date) ) !!}  </td>
                                                                <td style="text-align:right;"> {!! number_format($per_month_installment) !!} </td>
                                                                <td style="text-align: right;" > {!! date("F j, Y", strtotime($payment_info['date']) ) !!}  </td>
                                                                <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!} </td>                                    
                                                                <td style="text-align:center;"> {!! $Advance_Days !!} </td>
                                                                <td style="text-align:right;"> {!! number_format($Rebate) !!} </td>                                            
                                                            </tr>
                                                            @php
                                                            // End Table                                                
                                                            $Advance_deposit_total = $deposit_total - $per_month_installment;
                                                        }    
                                                    } else {
                                                        $Advance_deposit_total = $deposit_total - $per_month_installment;
                                                    } 
                                                }     
                                            
                                            }  else {
                                                $Advance_deposit_total = $deposit_total - $per_month_installment;
                                            } 
                                        }
                                         
                                    }
                                                                  
                                    $date_start = date("Y-m-01", strtotime('+1 month',strtotime($date_start)));
                                    $totalInstallment += $per_month_installment;
                                @endphp
                            @endwhile
                        @else
                            <tr>
                                <td> {!! $i !!}  </td>
                                <td> {!! 'Installment' !!}  </td>
                                <td> {!! date("F j, Y") !!} </td>
                                <td> {!! number_format($per_month_installment,2) !!} </td>
                            </tr>
                            @php
                                $totalInstallment = $per_month_installment;
                            @endphp
                        @endif
                            @php
                                $total = $totalInstallment + $total_advance;
                            @endphp
                            <tr>
                                <td colspan="3" style="text-align: right;"> <strong>Total: </strong> </td>
                                <td style="text-align: right;">{!! number_format($total) !!} </td>
                                <td style="text-align: center;"> -- </td>
                                <td style="text-align: right;">{!! number_format($Total_deposit) !!} </td>
                                <td style="text-align: center;"> -- </td>
                                <td style="text-align: right;">{!! number_format($Rebate_Total) !!} </td>
                            </tr>
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
                    <form class="form-horizontal" action="{!! url('/pre-schedule-status-add/'.$schedules_info->id) !!}" onsubmit="return confirm('Are you sure you want to submit?')" method="POST">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Payment Type </label>
                            <div class="col-sm-7">
                                <input name="ptype"  type="radio" value="MI"  checked /> Monthly Installment
                                <input name="ptype" type="radio" value="EM" /> Down Payment
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
                    <form class="form-horizontal" action="{!! url('/pre-schedules-update/'.$schedules_info->id) !!}" method="POST">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Property Price </label>
                            <div class="col-sm-7">
                                <input name="property_price" id="property_price" type="text" value="{!! $schedules_info->property_price !!}" autocomplete="off" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Parking Price </label>
                            <div class="col-sm-7">
                                <input name="parking_price" id="parking_price" type="text" value="{!! $schedules_info->parking_price !!}" autocomplete="off" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Discount Amount </label>
                            <div class="col-sm-7">
                                <input name="discount_amount" id="discount_amount" type="text" value="{!! $schedules_info->discount_amount !!}" autocomplete="off" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Earnest Money </label>
                            <div class="col-sm-7">
                                <input name="earnest_money" id="earnest_money" type="text" value="{!! $schedules_info->earnest_money !!}" autocomplete="off" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Down Payment </label>
                            <div class="col-sm-7">
                                <input name="down_payment" id="down_payment" type="text" value="{!! $schedules_info->down_payment !!}" autocomplete="off" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Rebate rate (%) </label>
                            <div class="col-sm-7">
                                <input name="redate_rate" id="redate_rate" type="text" value="{!! $schedules_info->redate_rate !!}" autocomplete="off" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Delay rate (%) </label>
                            <div class="col-sm-7">
                                <input name="delay_rate" id="delay_rate" type="text" value="{!! $schedules_info->delay_rate !!}" autocomplete="off" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name"> &nbsp; </label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{!! $schedules_info->id !!}"/>
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
                <tr> <td> Price </td> <td>: @if(isset($property_info->title)) {!! number_format($schedules_info->property_price) !!} @endif </td> </tr>
                <tr> <td> Parking </td> <td>:   {!! number_format($schedules_info->parking_price) !!} </td> </tr>
                <tr> <td> Discount </td> <td>:   {!! number_format($schedules_info->discount_amount) !!} </td> </tr>
                <tr> <td> Total Price </td> <td>: {!! number_format($totalPrice) !!} </td> </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-hover">
                <tbody>
                <tr> <td> Handover date </td> <td>: {!! date("j F, Y",strtotime($project_info->hand_over)) !!} </td> </tr>
                <tr> <td> Rebate </td> <td>: {!! $schedules_info->redate_rate !!}% </td> </tr>
                <tr> <td> Delay Charge  </td> <td>: {!! $schedules_info->delay_rate !!}% </td> </tr>
                <tr> <td> Earnest Money </td> <td>: {!! number_format($schedules_info->earnest_money) !!} </td> </tr>
                <tr> <td> Down Payment </td> <td>: {!! number_format($schedules_info->down_payment) !!} </td> </tr>
                <tr> <td> Total installment Amount </td> <td style="color: #c12e2a; font-weight: bold;">: {!! number_format($dueAmount) !!} </td> </tr>
                </tbody>
            </table>
        </div>
        <h3> Standard Schedule </h3>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th> S# </th>
                <th> Payment Type </th>
                <th> Date </th>
                <th> Amount</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> #</td>
                <td> Earnest Money </td>
                <td> -- </td>
                <td> {!! number_format($property_info->earnest_money) !!} </td>
            </tr>
            <tr>
                <td> #</td>
                <td> Down Payment </td>
                <td> -- </td>
                <td> {!! number_format($property_info->down_payment) !!}   </td>
            </tr>
            @php
                //$parking = (int)(str_replace(',','', $parking_price));
                //var_dump($parking);
                $i=1;
                $totalInstallment = 0;
                $no_of_month=0;
                $total_advance = $property_info->earnest_money+$property_info->down_payment;
                $balance = $schedules_info->property_price-$total_advance + $schedules_info->parking_price-$schedules_info->discount_amount;
                $date_start = date("Y-m-01", strtotime('+1 month'));
                $date_end = $project_info->hand_over;
                while($date_end>$date_start)
                {
                    $date_start = date("Y-m-01", strtotime('+1 month',strtotime($date_start)));
                    $no_of_month++;
                }
                $date_start = date("Y-m-01", strtotime('+1 month'));
                if($no_of_month>0){
                    $per_month_installment = $balance/$no_of_month;
                }else{
                    $per_month_installment = $totalPrice-$total_advance;
                }
            @endphp
            @if($no_of_month>0)
                @while($date_end>$date_start)
                    <tr>
                        <td> {!! $i !!}  </td>
                        <td> {!! 'Installment' !!}  </td>
                        <td> {!! date("F j, Y", strtotime($date_start) ) !!} </td>
                        <td> {!! number_format($per_month_installment,2) !!} </td>
                    </tr>
                    @php $i++;
                                    $date_start = date("Y-m-01", strtotime('+1 month',strtotime($date_start)));
                                    $totalInstallment += $per_month_installment;
                    @endphp
                @endwhile
            @else
                <tr>
                    <td> {!! $i !!}  </td>
                    <td> {!! 'Installment' !!}  </td>
                    <td> {!! date("F j, Y") !!} </td>
                    <td> {!! number_format($per_month_installment,2) !!} </td>
                </tr>
                @php
                    $totalInstallment = $per_month_installment;
                @endphp
            @endif
            @php
                $total = $totalInstallment + $total_advance;
            @endphp
            <tr>
                <td colspan="4" style="text-align: right;"> <strong>Total: </strong>{!! number_format($total,2) !!} </td>
            </tr>
            </tbody>
        </table>
        <h3> Proposed Schedule </h3>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th> S# </th>
                <th> Payment Type </th>
                <th> Date </th>
                <th> Amount</th>
                <th> Advance Days </th>
                <th> Rebate </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> #</td>
                <td> Earnest Money </td>
                <td> {!! date("F j, Y", strtotime($schedules_info->created_at)) !!} </td>
                <td class="tright"> {!! number_format($schedules_info->earnest_money) !!} </td>
                <td>  </td>
                <td>  </td>
            </tr>
            <tr>
                <td> #</td>
                <td> Down Payment </td>
                <td> {!! date("F j, Y", strtotime($schedules_info->created_at)) !!} </td>
                <td class="tright"> {!! number_format($schedules_info->down_payment) !!} </td>
                <td>  </td>
                <td>  </td>
            </tr>
            @php $i=0; $totalInsPro = 0; $totalRebate = 0; @endphp
            @if($payment_schedules_list)
                @foreach($payment_schedules_list as $row)
                    @php
                        $i++;
                        $today = date("Y-m-d");
                        $schedule_date = $row->payment_date;
                        $amount = $row->amount;
                        $datetime1 = date_create($today);
                        $datetime2 = date_create($schedule_date);
                        if ($datetime1<$datetime2){
                            $interval = date_diff($datetime1, $datetime2);
                            $days =  $interval->format('%a');
                            $Advance_Days = $days;
                        }else{
                            $Advance_Days = 0;
                        }
                        $rebateRate = $schedules_info->redate_rate;
                        $Rebate = ((($amount*$rebateRate)/100)/365)*$Advance_Days;
                    @endphp
                    <tr>
                        <td> {!! $i !!}  </td>
                        <td> @if($row->ptype=='MI') {!! 'Installment' !!} @else {!! 'Down Payment' !!} @endif  </td>
                        <td> {!! date("F j, Y", strtotime($row->payment_date) ) !!} </td>
                        <td class="tright"> {!! number_format($row->amount) !!} </td>
                        <td> {!! $Advance_Days !!} </td>
                        <td class="tright"> <span title="{!! $rebateRate !!}%">{!! number_format($Rebate,2) !!}</span> </td>
                    </tr>
                    @php
                        $totalInsPro += $row->amount;
                        $totalRebate += $Rebate;
                    @endphp
                @endforeach
                @php
                    $totalPro = $totalInsPro + $schedules_info->down_payment + $schedules_info->earnest_money;
                @endphp
                <tr>
                    <td colspan="4" style="text-align: right;"> <strong>Total Amount: </strong>{!! number_format($totalPro,2) !!} </td>
                    <td colspan="2" style="text-align: right;"> <strong>Total Rebate: </strong>{!! number_format($totalRebate,2) !!} </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@php
    function get_days_diff($day_start,$day_end)
    {
        $datetime1 = date_create($day_end);
        $datetime2 = date_create($day_start);
        if ($datetime1<$datetime2)
        {
            $interval = date_diff($datetime1, $datetime2);
            $days =  $interval->format('%a');
            $Advance_Days = $days;
        }else{
            $Advance_Days = 0;
        }
        return $Advance_Days;
    }
@endphp
@endsection