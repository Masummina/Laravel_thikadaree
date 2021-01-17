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

               
              $total_purchase_price = $schedules_info->purchase_price;

              $SS_EM = $property_info->earnest_money; 

              $discounted_price = $schedules_info->property_price + $schedules_info->parking_price - $schedules_info->discount_amount;
                       
              $total_DP_EM_amount = ($discounted_price*$property_info->e_d_percentage)/100;

              if($property_info->two_dp==1)
              {
                  $EM_and_part_DP = ($discounted_price*15)/100;                
                  $part_DP = $EM_and_part_DP - $SS_EM;
                  $SS_down_payment = $part_DP;
                  $SS_balance_down_payment = ($discounted_price*5)/100;        
              } else {
                  $SS_down_payment = $total_DP_EM_amount - $SS_EM;
                  $SS_balance_down_payment = 0;                
              }
              $SS_balance_down_payment_date = $schedules_info->balance_dp_date;
 

              //dd($schedules_info); 
              $SS_EM_date = $schedules_info->em_payment_date;
              $SS_down_payment_date = date("Y-m-d", strtotime('+1 month',strtotime($SS_EM_date)));         
 

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
                    <tr> <td> Earnest Money </td> <td>: {!! number_format($SS_EM) !!} </td> </tr>
                    <tr> <td> Down Payment </td> <td>: {!! number_format($SS_down_payment) !!} </td> </tr>
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
                            <th> Adv. Days </th>
                            <th> Rebate</th>
                            <th> Del. Days </th>
                            <th> Del. Charge </th>
                        </tr>
                        </thead>
                        <tbody>

                        @php  

                            $rebateRate = $schedules_info->redate_rate;
                            $delay_rate = $schedules_info->delay_rate;
                            $Delay_Charge_Total = 0;
                            $Rebate_Total = 0;

                            $advance_deposited = 0; 
                            $advance_date = ''; 
                            $_EM_Balance = 0;
                            $_DP_Balance = 0;
                            
                            $earnest_money = $schedules_info->earnest_money;
                            $down_payment = $schedules_info->down_payment;
                            $balance_down_payment = $schedules_info->balance_down_payment;

                            // Update all schedule details as not used
                            DB::table('pre_schedule_details')
                                        ->where('pre_schedule_id', $schedule_id)
                                        ->update(['used' => 0]);

                            
                            $data = DB::table('pre_schedule_details')
                                    ->select('id','amount','payment_date')                                                
                                    ->where('pre_schedule_id', $schedule_id)
                                    ->where('used', 0)
                                    ->orderBy('payment_date', 'asc')
                                    ->first();

                            if($earnest_money==0 && $down_payment==0 && $balance_down_payment==0)
                            {                                                                          
                                    DB::table('pre_schedule_details')
                                            ->where('id', $data->id)->update(['used' => 1]); 

                                    if($data->amount >$SS_EM){
                                        $advance_deposited = $data->amount - $SS_EM; 
                                        $advance_date = $data->payment_date;
                                        $_EM_Balance = 0;
                                        $deposit_amount = $SS_EM;
                                    } else {
                                        $advance = array('amount'=>0, 'date'=>'');
                                        $deposit_amount = $data->amount;
                                        $_EM_Balance = $SS_EM - $deposit_amount;                                        
                                    }

                                    $payment_info = array('date'=>$data->payment_date,'amount'=>$deposit_amount);                                                                          
                            }
                            else if($earnest_money==0 && $down_payment>0)
                            {
                                if($down_payment >$SS_EM){
                                    $down_payment = $down_payment - $SS_EM;                                   
                                    $_EM_Balance = 0;
                                    $deposit_amount = $SS_EM;
                                } else {    
                                    $down_payment = 0;                                
                                    $deposit_amount = $down_payment;
                                    $_EM_Balance = $SS_EM - $deposit_amount;                                        
                                }

                                $payment_info = array('date'=>$SS_down_payment_date,'amount'=>$deposit_amount);                                                                          
                            }
                            else if($SS_EM >$earnest_money)
                            {
                                $_EM_Balance = $SS_EM - $earnest_money;
                                $payment_info = array('date'=>$SS_EM_date,'amount'=>$earnest_money);                           
                            }
                            else if($SS_EM < $earnest_money)
                            {
                                $earnest_money = $earnest_money - $SS_EM;  
                                $_EM_Balance = 0;
                                $payment_info = array('date'=>$SS_EM_date,'amount'=>$earnest_money);                           
                            
                            } else {
                                $_EM_Balance = 0;
                                $payment_info = array('date'=>$SS_EM_date,'amount'=>$SS_EM);
                            }  
                            
                            $Delay_Days = '-'; $Delay_Charge = '-';
                            $Advance_Days = '-'; $Rebate = '-'; 

                            if($SS_EM_date<$payment_info['date'])
                            {
                                $Delay_Days = get_days_diff($payment_info['date'],$SS_EM_date);                                                
                                $Delay_Charge = ((($payment_info['amount']*$delay_rate)/100)/365)*$Delay_Days;
                                $Delay_Charge_Total += $Delay_Charge;
                                $Delay_Charge = number_format($Delay_Charge,2);
                            } else if($SS_EM_date>$payment_info['date']){
                                $Advance_Days = get_days_diff($SS_EM_date,$payment_info['date']);
                                $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                $Rebate_Total += $Rebate;
                                $Rebate = number_format($Rebate,2);
                            } 
                        @endphp                        
                            <tr>
                                <td> #</td>
                                <td> Earnest Money </td>
                                <td> {!! date("j M Y", strtotime($SS_EM_date)) !!} </td>
                                <td style="text-align:right;"> {!! number_format($SS_EM) !!} </td>
                                <td> {!! date("j M Y", strtotime($payment_info['date'])) !!} </td>
                                <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!} </td>                                                   
                                <td> {!! $Advance_Days !!} </td>
                                <td> {!! $Rebate !!} </td>
                                <td> {!! $Delay_Days !!} </td>
                                <td> {!! $Delay_Charge !!} </td>                        
                            </tr>
                            
                        @if($_EM_Balance>0)
                            @php 


                                $data = DB::table('pre_schedule_details')
                                    ->select('id','amount','payment_date')                                                
                                    ->where('pre_schedule_id', $schedule_id)
                                    ->where('used', 0)
                                    ->orderBy('payment_date', 'asc')
                                    ->first();
                            
                                if($down_payment>0)
                                {    
                                    if($down_payment >$_EM_Balance)
                                    {                                       
                                        $down_payment = $down_payment - $_EM_Balance;  
                                        $deposit_amount = $_EM_Balance;                                  
                                        $_EM_Balance = 0;                                        
                                    } else {    
                                        $down_payment = 0;                                
                                        $deposit_amount = $down_payment;
                                        $_EM_Balance = $_EM_Balance - $deposit_amount;                                        
                                    }
                                    $payment_info = array('date'=>$SS_down_payment_date,'amount'=>$deposit_amount);                                    
                                } else {

                                    DB::table('pre_schedule_details')
                                        ->where('id', $data->id)->update(['used' => 1]); 

                                    if($data->amount >$_EM_Balance)
                                    {
                                        $advance_deposited = $data->amount - $_EM_Balance; 
                                        $advance_date = $data->payment_date;
                                        $deposit_amount = $_EM_Balance;
                                        $_EM_Balance = 0;                                        
                                    } else {                                 
                                        $advance_deposited = 0;                                         
                                        $deposit_amount = $data->amount;
                                        $_EM_Balance = $_EM_Balance - $deposit_amount;                                        
                                    }
                                    $payment_info = array('date'=>$data->payment_date,'amount'=>$deposit_amount);                                      
                                }
                                
                                $Delay_Days = '-'; $Delay_Charge = '-';
                                $Advance_Days = '-'; $Rebate = '-'; 

                                if($SS_EM_date<$payment_info['date']){
                                    $Delay_Days = get_days_diff($payment_info['date'],$SS_EM_date);                                                
                                    $Delay_Charge = ((($payment_info['amount']*$delay_rate)/100)/365)*$Delay_Days;
                                    $Delay_Charge_Total += $Delay_Charge;
                                    $Delay_Charge = number_format($Delay_Charge,2);
                                } else if($SS_EM_date>$payment_info['date']){
                                    $Advance_Days = get_days_diff($SS_EM_date,$payment_info['date']);
                                    $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                    $Rebate_Total += $Rebate;
                                    $Rebate = number_format($Rebate,2);
                                }

                            @endphp
                            <tr>
                                <td> #</td>
                                <td> -- </td>
                                <td> -- </td>
                                <td> -- </td>
                                <td> {!! date("j M Y", strtotime($payment_info['date'])) !!} </td>
                                <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!} </td>                                                   
                                <td> {!! $Advance_Days !!} </td>
                                <td> {!! $Rebate !!} </td>
                                <td> {!! $Delay_Days !!} </td>
                                <td> {!! $Delay_Charge !!} </td>                       
                            </tr>
                        @endif  
                        

    <!-- *************** Download Part Setup Start *******************-->  
                    @php 
                         //echo $down_payment; echo "vvv"; exit;    
                         
                        if($earnest_money>0)
                        { 
                            if($earnest_money >$SS_down_payment){
                                $advance_deposited = $earnest_money - $SS_down_payment;    
                                $advance_date = $SS_EM_date;                                 
                                $_DP_Balance = 0;
                                $deposit_amount = $SS_down_payment;
                            } else {
                                $advance_deposited = 0;
                                $deposit_amount = $earnest_money;
                                $_DP_Balance = $SS_down_payment - $deposit_amount;                                        
                            }
                            $payment_date = $SS_EM_date;

                            $payment_info = array('date'=>$payment_date,'amount'=>$deposit_amount); 
                        } 
                        else  if($down_payment==0)
                        {
                            
                            if($advance_deposited>0)
                            {
                                if($advance_deposited >$SS_down_payment){
                                    $advance_deposited = $advance_deposited - $SS_down_payment;                                     
                                    $_DP_Balance = 0;
                                    $deposit_amount = $SS_down_payment;
                                } else {
                                    $advance_deposited = 0;
                                    $deposit_amount = $advance_deposited;
                                    $_DP_Balance = $SS_down_payment - $deposit_amount;                                        
                                }
                                $payment_date = $advance_date;

                            } else {
                                $data = DB::table('pre_schedule_details')
                                    ->select('id','amount','payment_date')                                                
                                    ->where('pre_schedule_id', $schedule_id)
                                    ->where('used', 0)
                                    ->orderBy('payment_date', 'asc')
                                    ->first();  

                                DB::table('pre_schedule_details')
                                        ->where('id', $data->id)->update(['used' => 1]); 

                                if($data->amount >$SS_down_payment)
                                {
                                    $advance_deposited = $data->amount - $SS_down_payment; 
                                    $advance_date = $data->payment_date;
                                    $_DP_Balance = 0;
                                    $deposit_amount = $SS_down_payment;
                                } else {
                                    $advance_deposited = 0;
                                    $deposit_amount = $data->amount;
                                    $_DP_Balance = $SS_down_payment - $deposit_amount;                                                                
                                }
                                $payment_date = $data->payment_date;
                            }
                                
                            $payment_info = array('date'=>$payment_date,'amount'=>$deposit_amount);                                                                          
                        }
                        else if($SS_down_payment >=$down_payment)
                        {
                            $_DP_Balance = $SS_down_payment - $down_payment;
                            $payment_info = array('date'=>$SS_down_payment_date,'amount'=>$down_payment);                           
                        } else {
                            $_DP_Balance = 0;
                            $advance_deposited = $down_payment - $SS_down_payment; 
                            $advance_date = $SS_down_payment_date;
                            $payment_info = array('date'=>$SS_down_payment_date,'amount'=>$SS_down_payment);
                        }

                        $Delay_Days = '-'; $Delay_Charge = '-';
                        $Advance_Days = '-'; $Rebate = '-'; 

                        if($SS_down_payment_date<$payment_info['date']){
                            $Delay_Days = get_days_diff($payment_info['date'],$SS_down_payment_date);                                                
                            $Delay_Charge = ((($payment_info['amount']*$delay_rate)/100)/365)*$Delay_Days;
                            $Delay_Charge_Total += $Delay_Charge;
                            $Delay_Charge = number_format($Delay_Charge,2);
                        } else if($SS_down_payment_date>$payment_info['date']){
                            $Advance_Days = get_days_diff($SS_down_payment_date,$payment_info['date']);
                            $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                            $Rebate_Total += $Rebate;
                            $Rebate = number_format($Rebate,2);
                        }
                        
                    @endphp    
                        
                        <tr>
                            <td> #</td>
                            <td> Down Payment </td>
                            <td> {!! date("j M Y", strtotime($SS_down_payment_date)) !!} </td>
                            <td style="text-align:right;"> {!! number_format($SS_down_payment) !!}   </td>
                            <td> {!! date("j M Y", strtotime($payment_info['date'])) !!} </td>
                            <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!}   </td>                                                        
                            <td> {!! $Advance_Days !!} </td>
                            <td> {!! $Rebate !!} </td>
                            <td> {!! $Delay_Days !!} </td>
                            <td> {!! $Delay_Charge !!} </td>
                        </tr>

                        @if($_DP_Balance>0)
                            @php 
                            $data = DB::table('pre_schedule_details')
                                ->select('id','amount','payment_date')                                                
                                ->where('pre_schedule_id', $schedule_id)
                                ->where('used', 0)
                                ->orderBy('payment_date', 'asc')
                                ->first();

                            DB::table('pre_schedule_details')
                                    ->where('id', $data->id)->update(['used' => 1]); 

                            if($data->amount >$_DP_Balance)
                            {
                                $advance_deposited = $data->amount - $_DP_Balance; 
                                $advance_date = $data->payment_date;
                                $_DP_Balance = 0;
                                $deposit_amount = $_DP_Balance;
                            } else {
                                $advance_deposited = 0;
                                $advance_date= '';
                                $deposit_amount = $data->amount;
                                $_DP_Balance = $_DP_Balance - $deposit_amount;                                        
                            }
                            $payment_info = array('date'=>$data->payment_date,'amount'=>$deposit_amount);
                            
                            $Delay_Days = '-'; $Delay_Charge = '-';
                            $Advance_Days = '-'; $Rebate = '-'; 

                            if($SS_down_payment_date<$payment_info['date']){
                                $Delay_Days = get_days_diff($payment_info['date'],$SS_down_payment_date);                                                
                                $Delay_Charge = ((($payment_info['amount']*$delay_rate)/100)/365)*$Delay_Days;
                                $Delay_Charge_Total += $Delay_Charge;
                                $Delay_Charge = number_format($Delay_Charge,2);
                            } else if($SS_down_payment_date>$payment_info['date']){
                                $Advance_Days = get_days_diff($SS_down_payment_date,$payment_info['date']);
                                $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                $Rebate_Total += $Rebate;
                                $Rebate = number_format($Rebate,2);
                            }
                            
                            @endphp
                            <tr>
                                <td> #</td>
                                <td> -- </td>
                                <td> -- </td>
                                <td> -- </td>
                                <td> {!! date("j M Y", strtotime($payment_info['date'])) !!} </td>
                                <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!} </td>                                                   
                                <td> {!! $Advance_Days !!} </td>
                                <td> {!! $Rebate !!} </td>
                                <td> {!! $Delay_Days !!} </td>
                                <td> {!! $Delay_Charge !!} </td>                        
                            </tr>
                        @endif

    <!-----------************** Down Payment End ******************------------>   

    <!-----------************** Banalce Down Payment Start ******************------------> 
    @if($SS_balance_down_payment>0)
    
        @php 

            //echo $SS_balance_down_payment."  >= ".$balance_down_payment; exit;

        if($balance_down_payment==0)
        {
            //echo $advance_deposited; exit;

            if($advance_deposited>0)
            {    
                if($advance_deposited >$SS_balance_down_payment){
                    $advance_deposited = $advance_deposited - $SS_balance_down_payment;                                     
                    $_balance_DP_Balance = 0;
                    $deposit_amount = $SS_balance_down_payment;
                } else {
                    
                    $deposit_amount = $advance_deposited;
                    $advance_deposited = 0;
                    
                    $_balance_DP_Balance = $SS_balance_down_payment - $deposit_amount;                                        
                }            
                $payment_date = $advance_date;              
            } else {
                $data = DB::table('pre_schedule_details')
                    ->select('id','amount','payment_date')                                                
                    ->where('pre_schedule_id', $schedule_id)
                    ->where('used', 0)
                    ->orderBy('payment_date', 'asc')
                    ->first();  

                DB::table('pre_schedule_details')
                        ->where('id', $data->id)->update(['used' => 1]); 

                if($data->amount >$SS_balance_down_payment)
                {
                    $advance_deposited = $data->amount - $SS_balance_down_payment; 
                    $advance_date = $data->payment_date;
                    $_balance_DP_Balance = 0;
                    $deposit_amount = $SS_balance_down_payment;
                } else {
                    $advance_deposited = 0;
                    $deposit_amount = $data->amount;
                    $_balance_DP_Balance = $SS_balance_down_payment - $deposit_amount;                                                                
                }
                $payment_date = $data->payment_date;
            }
                
            $payment_info = array('date'=>$payment_date,'amount'=>$deposit_amount);                                                                          
        }
        else if($SS_balance_down_payment >=$balance_down_payment)
        {
            $_balance_DP_Balance = $SS_balance_down_payment - $balance_down_payment;
            $payment_info = array('date'=>$SS_balance_down_payment_date,'amount'=>$balance_down_payment);                           
            //print_r($payment_info); exit;
        } else {
            $_balance_DP_Balance = 0;
            $advance_deposited = $balance_down_payment - $SS_balance_down_payment; 
            $advance_date = $SS_balance_down_payment_date;
            $payment_info = array('date'=>$SS_balance_down_payment_date,'amount'=>$SS_balance_down_payment);
        }

        $Delay_Days = '-'; $Delay_Charge = '-';
        $Advance_Days = '-'; $Rebate = '-';  

        if($SS_balance_down_payment_date<$payment_info['date']){
            $Delay_Days = get_days_diff($payment_info['date'],$SS_balance_down_payment_date);                                                
            $Delay_Charge = ((($payment_info['amount']*$delay_rate)/100)/365)*$Delay_Days;
            $Delay_Charge_Total += $Delay_Charge;
            $Delay_Charge = number_format($Delay_Charge,2);
        } else if($SS_balance_down_payment_date>$payment_info['date']){
            $Advance_Days = get_days_diff($SS_balance_down_payment_date,$payment_info['date']);
            $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
            $Rebate_Total += $Rebate;
            $Rebate = number_format($Rebate,2);
        }
        
    @endphp    
        
        <tr>
            <td> #</td>
            <td> Balance Down Payment </td>
            <td> {!! date("j M Y", strtotime($SS_balance_down_payment_date)) !!} </td>
            <td style="text-align:right;"> {!! number_format($SS_balance_down_payment) !!}   </td>
            <td> {!! date("j M Y", strtotime($payment_info['date'])) !!} </td>
            <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!}   </td>                                                        
            <td> {!! $Advance_Days !!} </td>
            <td> {!! $Rebate !!} </td>
            <td> {!! $Delay_Days !!} </td>
            <td> {!! $Delay_Charge !!} </td>
        </tr>

    @endif
    <!-----------************** Banalce Down Payment Start End ******************------------>                
 


        @php
        
            $i=0; 
            $totalInstallment = 0;
            $no_of_month = 0;  
            $total_advance = $SS_EM + $SS_down_payment;
                
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
            //$date_start = date("Y-m-01", strtotime($schedules_info->frist_payment_date));
            $date_start = $schedules_info->frist_payment_date;
            //$date_start = date("Y-m-01", strtotime('+1 month',strtotime($date_start)));
            if($no_of_month>0){
                $per_month_installment = $balance/$no_of_month;
            }else{
                $per_month_installment = $totalPrice-$total_advance;
            }
            
            //foreach($payment_schedules_list as $row)
            
            $schedule_total = $SS_EM + $SS_down_payment + $SS_balance_down_payment;
            $deposit_total = $schedules_info->earnest_money+$schedules_info->down_payment;
            
            $Advance_deposit_total = 0;  
            $Total_deposit = $schedule_total;  
                

            $data = DB::table('pre_schedule_details')
                        ->select('id','amount','payment_date')                                                                                          
                        ->where('pre_schedule_id', $schedule_id)
                        ->orderBy('payment_date', 'asc')
                        ->first();
            
            if( $schedules_info->down_payment > 1 ){
                $deposit_total = $data->amount; 
            }                    

            $first_payment_date = $data->payment_date;                                                                        
            $payment_date = $data->payment_date;                                                                        
            $payment_info = array('date'=>$first_payment_date,'amount'=>$per_month_installment);
            if($deposit_total > $schedule_total)
            {
                $Advance_deposit_total = $deposit_total - $schedule_total;    
            }

            $Advance_deposit_total = $advance_deposited;
            $payment_date = $advance_date;

        @endphp
        
            @if($no_of_month>0)
                @while($date_end>$date_start)
                    @php 
                                                        
                        $dm = substr($date_start,0,7);  
                        $data = DB::table('pre_schedule_details')
                                    ->select('id','amount','payment_date')                                                
                                    ->whereRaw("pre_schedule_id=$schedule_id AND payment_date LIKE '".$dm."%'")
                                    ->first();

                        //$schedule_date = $data->payment_date; 
                        $schedule_date = $date_start; 

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
                                <td style="text-align:right;"> -- </td>                                            
                                <td style="text-align:right;"> -- </td>                                            
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
                            if($Advance_deposit_total==0){
                                $Advance_deposit_txt = ' <td> '.$i.' </td> <td> Installment </td>
                                <td> '.date("F j, Y", strtotime($schedule_date) ).' </td>
                                <td style="text-align:right;">'.number_format($per_month_installment).'</td> ';
                            } else {
                                $Advance_deposit_txt = '<td> -- </td> <td> -- </td> <td> -- </td> <td> -- </td>';
                            }
                                

                            @endphp 
                            @if($Advance_deposit_total>0)   
                            <tr>
                                <td> {!! $i !!} </td>
                                <td> {!! 'Installment' !!}  </td>
                                <td> {!! date("F j, Y", strtotime($schedule_date) ) !!}  </td>
                                <td style="text-align:right;"> {!! number_format($per_month_installment) !!} </td>
                                <td style="text-align: right;"> {!! date("F j, Y", strtotime($payment_info['date']) ) !!}  </td>
                                <td style="text-align:right;"> {!! number_format($payment_info['amount']) !!} </td>                                    
                                <td style="text-align:center;"> {!! $Advance_Days !!} </td>
                                <td style="text-align:right;"> {!! number_format($Rebate) !!} </td>                                            
                                <td style="text-align:right;"> -- </td>                                            
                                <td style="text-align:right;"> -- </td>                                            
                                
                            </tr>
                            @endif
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
                                
                                $Advance_Days = 0;
                                $After_Days = 0;

                                $Rebate = 0;
                                $Delay_Charge = 0;
                                if($schedule_date<$payment_date){
                                    $After_Days = get_days_diff($payment_date,$schedule_date);                                                
                                    $Delay_Charge = ((($payment_info['amount']*$delay_rate)/100)/365)*$After_Days;
                                    $Delay_Charge_Total += $Delay_Charge;
                                } else {
                                    $Advance_Days = get_days_diff($schedule_date,$payment_date);
                                    $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                    $Rebate_Total += $Rebate;
                                }

                                
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
                                    {!! $Advance_deposit_txt !!}
                                    <td style="text-align: right;"> {!! date("F j, Y", strtotime($payment_info['date']) ) !!}  </td>
                                    <td style="text-align:right;"> {!! number_format($Second_Payment) !!} </td>                                    
                                    <td style="text-align:center;"> {!! $Advance_Days !!} </td>
                                    <td style="text-align:right;"> {!! number_format($Rebate) !!} </td>                                            
                                    <td style="text-align:center;"> {!! $After_Days !!} </td>
                                    <td style="text-align:right;"> {!! number_format($Delay_Charge) !!} </td>                                            
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
                                        
                                        
                                        $Advance_Days = 0;
                                        $After_Days = 0;

                                        $Rebate = 0;
                                        $Delay_Charge = 0;
                                        if($schedule_date<$payment_date){
                                            $After_Days = get_days_diff($payment_date,$schedule_date);                                                
                                            $Delay_Charge = ((($payment_info['amount']*$delay_rate)/100)/365)*$After_Days;
                                            $Delay_Charge_Total += $Delay_Charge;
                                        } else {
                                            $Advance_Days = get_days_diff($schedule_date,$payment_date);
                                            $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                            $Rebate_Total += $Rebate;
                                        }
                                        
                                        // Print  Table Here                                                 
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
                                            <td style="text-align:center;"> {!! $After_Days !!} </td>
                                            <td style="text-align:right;"> {!! number_format($Delay_Charge) !!} </td>                                           
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
                                                        
                                                $Advance_Days = 0;
                                                $After_Days = 0;

                                                $Rebate = 0;
                                                $Delay_Charge = 0;
                                                if($schedule_date<$payment_date){
                                                    $After_Days = get_days_diff($payment_date,$schedule_date);                                                
                                                    $Delay_Charge = ((($payment_info['amount']*$delay_rate)/100)/365)*$After_Days;
                                                    $Delay_Charge_Total += $Delay_Charge;
                                                } else {
                                                    $Advance_Days = get_days_diff($schedule_date,$payment_date);
                                                    $Rebate = ((($payment_info['amount']*$rebateRate)/100)/365)*$Advance_Days;
                                                    $Rebate_Total += $Rebate;
                                                }
                                                
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
                                                    <td style="text-align:center;"> {!! $After_Days !!} </td>
                                                    <td style="text-align:right;"> {!! number_format($Delay_Charge) !!} </td> 
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
                                                        
                        $date_start = date("Y-m-d", strtotime('+1 month',strtotime($date_start)));
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
                                <td style="text-align: center;"> -- </td>
                                <td style="text-align: right;">{!! number_format($Delay_Charge_Total) !!} </td>
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