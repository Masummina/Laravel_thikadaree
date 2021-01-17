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
 

                    @if(session()->has('msg'))
                        <div class="alert alert-info">
                            {{ session()->get('msg') }}
                        </div>
                    @endif
					
					
                    <div class="row">

						<div class="col-md-12">
							<p class="pull-right">  &nbsp;&nbsp;&nbsp;
							  Print : <span class="glyphicon glyphicon-print  " onclick="PrintElem('#print_able')"> </span>
						  </p>  <br/>
						</div>
					</div>
		
		<div class="row" id="print_able" >
		
        <div class="col-md-12">
          <div class="box box-solid">
              
            <div class="box-header with-border" style="text-align: center">
                <h3> Urban Design & Development Ltd. </h3>
                <h3 class="box-title"> House No. 34/A, Road No. 10/A (new), Dhanmondi R/A., Dhaka-1209 </h3>
            </div>
            <div style="text-align: center; padding: 5px; background-color: #9ad717;"> Rebate & Delay Charge Calculation </div>
            @php

               
              $total_purchase_price = $schedules_info->purchase_price;

              // Standard Earnest money
              //$SS_EM = $property_info->earnest_money; 
              $SS_EM = $schedules_info->earnest_money; 

              $discounted_price = $schedules_info->property_price + $schedules_info->parking_price - $schedules_info->discount_amount;
                       
              $total_DP_EM_amount = ($discounted_price*$property_info->e_d_percentage)/100;
            
            // Set standard down payment & standard balance of down payment
              /*  
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
              */

            // Set standard down payment & standard balance of down payment  
              $SS_down_payment = $schedules_info->down_payment;
              $SS_balance_down_payment = $schedules_info->balance_down_payment; 
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
              $paidAmount = $schedules_info->earnest_money_c+$schedules_info->down_payment_c+$schedules_info->balance_down_payment_c;
              $dueAmount = $totalPrice-$paidAmount;

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
                        <tr> <td colspan="2" style="border-top:2px solid red;" ></td></tr>
                        <tr> <td> Earnest Money Paid </td> <td>: {!! number_format($schedules_info->earnest_money_c) !!} </td> </tr>
                        <tr> <td> Down Payment Paid </td> <td>: {!! number_format($schedules_info->down_payment_c) !!} </td> </tr>
                        <tr> <td> Balance Down of Payment Paid </td> <td>: {!! number_format($schedules_info->balance_down_payment_c) !!} </td> </tr>
                        <tr> <td> Total Paid Amount </td> <td style="color: #c12e2a; font-weight: bold;">: {!! number_format($paidAmount) !!} </td> </tr> 

                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr> <td> Handover date </td> <td>: {!! date("j F, Y",strtotime($project_info->hand_over)) !!} </td> </tr>
                        <tr> <td> Rebate </td> <td>: {!! $schedules_info->redate_rate !!}% </td> </tr>
                        <tr> <td> Delay Charge  </td> <td>: {!! $schedules_info->delay_rate !!}% </td> </tr>
                        <tr> <td> Frist Payment Date  </td> <td>: {!! date("j F Y",strtotime($schedules_info->frist_payment_date)) !!} </td> </tr>
                        <tr> <td> Earnest Money </td> <td>: {!! number_format($SS_EM) !!} </td> </tr>
                        <tr> <td> Down Payment </td> <td>: {!! number_format($SS_down_payment) !!} </td> </tr>
                        <tr> <td> Balance Down of Payment </td> <td>: {!! number_format($SS_balance_down_payment) !!} </td> </tr>

                        
                        <tr> <td colspan="2" style="border-top:2px solid red;" ></td></tr>
                        <tr> <td> Total Price </td> <td>: {!! number_format($totalPrice) !!} </td> </tr>
                        <tr> <td> Total Paid Amount </td> <td>: {!! number_format($paidAmount) !!} </td> </tr>                        
                        <tr> <td> Total installment Amount </td> <td style="color: #c12e2a; font-weight: bold;">: {!! number_format($dueAmount) !!} </td> </tr> 

                    </tbody>
                </table>
                 
                
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="box-body">
                    

                    <form  onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/update-schedules') }}" method="POST">

                    <div class="col-md-6">  
                        <h3> Standard Schedules </h3>
                        <table id="ss-table" class="table">
                            <tr style="text-align:center"> 
                                <td> S# </td>
                                <td> Date </td>
                                <td> Amount </td>         
                            </tr>
                            @php 
                                $i=1; 
                                $payment_date = $schedules_info->frist_payment_date;
                            @endphp
                            @foreach ($standard_schedules_list as $item)    
                                @php $item = (object) $item; @endphp                          
                                <tr id="ss_tr_{!! $i !!}"> 
                                    <td> {!! $i !!} </td>                                    
                                    <td> <input type="date" name="ss_date[]" id="ss_date_{!! $i !!}" value="{!! $payment_date !!}" placeholder="Date" class="form-control" > </td>
                                    <td> <input type="text" name="ss_amount[]" id="ss_amount_{!! $i !!}" value="{!! number_format($item->amount) !!}" placeholder="Amount" onblur="CalculatStandardSecheduleRestAmount();" value="0" class="form-control" >  </td>                                        
                                </tr>                                 
                                @php 
                                    $i++; 
                                    $payment_date = date("Y-m-d", strtotime('+1 month',strtotime($payment_date)));
                                @endphp
                            @endforeach
                            
                        </table>
                         
                        <strong> Banalce Amount : </strong> <strong id="ss_balance_amount_new"> 0 </strong> 

                        <input id="hid_total_SS_input" name="hid_total_SS_input" type="hidden" value="{!! $i-1 !!}" >
                        <input id="ss_hid_rest_amount" name="hid_rest_amount" type="hidden" value="0" >
                         
                    </div>

                    <div class="col-md-6">  
                        <h3> Payment Schedules </h3>
                        <table id="multiple-table" class="table">
                            <tr style="text-align:center"> 
                                <td> S# </td>
                                <td> Date </td>
                                <td> Amount </td>
                                <td>  </td>
                            </tr>
                            @php $i=1; @endphp
                            @foreach ($payment_schedules_list as $item)
                                @if($i==1)
                                    <tr id="tr_{!! $i !!}"> 
                                        <td> {!! $i !!} </td>
                                        <td> <input type="date" name="date[]" id="date_{!! $i !!}" value="{!! $item->payment_date !!}" placeholder="Date" class="form-control" > </td>
                                        <td> <input type="text" name="amount[]" id="amount_{!! $i !!}" value="{!! number_format($item->amount) !!}" placeholder="Amount" onblur="CalculateRestAmount();" value="0" class="form-control" >  </td>
                                        <td> &nbsp;
                                                <input type="button" value=" + " onclick="AddMore();" > 
                                                <input type="button" value=" x " onclick="RemoveMore();" > 
                                        </td>
                                    </tr>
                                @else 
                                    <tr id="tr_{!! $i !!}"> 
                                        <td> {!! $i !!} </td>
                                        <td> <input type="date" name="date[]" id="date_{!! $i !!}" value="{!! $item->payment_date !!}" placeholder="Date" class="form-control" > </td>
                                        <td> <input type="text" name="amount[]" id="amount_{!! $i !!}" value="{!! number_format($item->amount) !!}" placeholder="Amount" onblur="CalculateRestAmount();" value="0" class="form-control" >  </td>
                                        <td>  </td>
                                    </tr>
                                @endif
                                @php $i++; @endphp
                            @endforeach
                            
                        </table>

                        <strong> Banalce Amount : </strong> <strong id="balance_amount_new"> 0 </strong> 

                        <input id="hid_last_input_id" name="hid_last_input_id" type="hidden" value="{!! $i-1 !!}" >
                        <input id="hid_rest_amount" name="hid_rest_amount" type="hidden" value="0" >
                        <input name="id" type="hidden" value="{!! $schedules_info->id !!}" >
                        <input type="hidden" name="dueAmount" id="dueAmount" value="{!! $dueAmount !!}" />

                        <div class="form-group">                  
                            <div class="col-sm-3">
                                <button type="submit" id="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </div>
                </form>

                </div>
            </div>
 
        </div>
		
		
            </div>
        </div>
      </section>
    </div>
      
    <script type="text/javascript">
   
        function SetDP_Date(date1) 
        {              
            var dt = new Date(date1);
            dt.setMonth( dt.getMonth() + 1 ); 

            var year = dt.getFullYear();
            var MM =  year;

            var month = ( dt.getMonth() + 1 ) ;                
            if(month<10){
                var MM = MM+"-0"+month;
            } else {
                var MM = MM+"-"+month;
            }

            var day = dt.getDate();
            if(day<10){
                var MM = MM+"-0"+day;
            } else {
                var MM = MM+"-"+day;
            }

            $("#part_down_payment_date").val(MM);
         
        }

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

       
        var inc = 1;
        function AddMore() 
        {
            var inc = $("#hid_last_input_id").val(); 
            var date1 = $("#date_"+inc).val(); alert(date1); 
            var dt = new Date(date1);
                dt.setMonth( dt.getMonth() + 1 ); 

            var year = dt.getFullYear();
            var month = ( dt.getMonth() + 1 ) ;  
            var day = dt.getDate();

             
            if (month < 10) 
                month = '0' + month;
            if (day < 10) 
                day = '0' + day;
            var new_date = year+'-'+month+'-'+day;
            alert(new_date);

            inc ++;
            var div_html = '<tr id="tr_'+inc+'">';
                    div_html += '<td> '+inc+' </td> ';
                    div_html += '<td> <input name="date[]" id="date_'+inc+'" value="'+new_date+'" type="date" placeholder="Date" class="form-control" > </td> ';
                    div_html += '<td> <input name="amount[]" id="amount_'+inc+'" onblur="CalculateRestAmount();" type="text" value="0" class="form-control" >  </td> ';
                    div_html += '<td>  </td> ';
                div_html += '</tr>';            
            $("#multiple-table").append(div_html);      
            $("#hid_last_input_id").val(inc);               
        }
    
        function RemoveMore() 
        {                
            var inc = $("#hid_last_input_id").val();  
            var last_id = Number(inc); 

            if(last_id<2)
            {
                alert("Sorry can not remove last one.");
            } else {
                $("#tr_"+inc).remove();  
                var last_id = Number(inc)-1;              
                $("#hid_last_input_id").val(last_id);                  
            }  
            CalculateRestAmount();              
        }    

           
        function CalculateRestAmount() 
        {
                          
            var hid_last_input_id = $("#hid_last_input_id").val(); 
            var dueAmount = Number($("#dueAmount").val());
         
            var T_amount = 0;
            for(var i=1; i<=hid_last_input_id; i++)
            {
                var amount = $("#amount_"+i).val();
                var amount = amount.replace(/,/gi, '');                     
                var amount = parseInt(amount, 10);
                T_amount += amount;
            } 
            
            var rest_amount = dueAmount - T_amount;
                  
            //$("#amount_"+hid_last_input_id).val(rest_amount);  
            $("#hid_rest_amount").val(rest_amount);  
            //alert(rest_amount);
            $("#balance_amount_new").html(formatNumber(rest_amount));
            
                     
        }

        function CalculatStandardSecheduleRestAmount() 
        {
                          
            var hid_total_SS_input = $("#hid_total_SS_input").val(); 
            
            var TotaldueAmount = Number($("#dueAmount").val());
         
            var T_amount = 0;
            for(var i=1; i<=hid_total_SS_input; i++)
            {
                var amount = $("#ss_amount_"+i).val();
                var amount = amount.replace(/,/gi, '');                     
                var amount = parseInt(amount, 10);
                T_amount += amount;
            } 
            
            var rest_amount = TotaldueAmount - T_amount;
                  
            //$("#amount_"+hid_last_input_id).val(rest_amount);  
            $("#ss_hid_rest_amount").val(rest_amount);  
            //alert(rest_amount);
            $("#ss_balance_amount_new").html(formatNumber(rest_amount));
            
                     
        }

        function monthDiff_1(dt1, dt2) {
            var diff =(dt2.getTime() - dt1.getTime()) / 1000;
            diff /= (60 * 60 * 24 * 7 * 4);
            return Math.abs(Math.round(diff));
        }

        function monthDiff(start, end) {
            var tempDate = new Date(start);
            var monthCount = 0;
            while((tempDate.getMonth()+''+tempDate.getFullYear()) != (end.getMonth()+''+end.getFullYear())) {
                monthCount++;
                tempDate.setMonth(tempDate.getMonth()+1);
            }
            return monthCount+1;
        }
    
    </script>
 
@endsection