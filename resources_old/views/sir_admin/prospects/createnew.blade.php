@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
    <div class="row"> <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"> Create new payment schedule </div>
            <div class="panel-body">

                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    </div>
                @endif

                @if (Session::has('msg'))
                    <div class="alert alert-info">{{ Session::get('msg') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-info">{{ Session::get('error') }}</div>
                @endif
               
                <form class="form-horizontal" id="preScheduleForm" onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/create-pre-schedule') }}" method="POST">
                            
                    <table style="width:98%;">
                        <tr> 
                            <td> 
                                        
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label" for="name">Project </label>
                                        <div class="col-sm-5">
                                            <select id="project" name="project_id" class="selectpicker form-control" data-live-search="true" style="width:250px;">
                                                <option  value="" > select </option>
                                                @if(isset($projects))
                                                    @foreach($projects as $row)
                                                        <option  value="{{ $row->id }}"  @if(isset($item->project_id) && $item->project_id == $row->id) selected="selected" @endif >{{ $row->title }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                            </td>
                            <td>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name">Client No.</label>
                                    <div class="col-sm-5">
                                        <select name="prospect_id" id="prospect_id" class="selectpicker form-control" data-live-search="true" >
                                            @if(isset($customer_list))
                                                @foreach($customer_list as $row)
                                                    <option  value="{{ $row->id }}" >{{ $row->name }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr> 

                        <tr> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Apartment price </label>
                                    <div class="col-sm-5">
                                        <input name="property_price" id="property_price" type="text" value="" class="form-control" readonly required>
                                    </div>
                                </div>
                            </td>
                            <td> 
                                <label class="col-sm-5 control-label" for="name">Apartment No.</label>
                                <div class="col-sm-5">
                                    <select name="property_id" id="property_id" class=" form-control">
                                        @if(isset($proparties))
                                            @foreach($proparties as $row)
                                                <option  value="{{ $row->id }}"  @if(isset($item->property_id) && $item->property_id == $row->id) selected="selected" @endif >{{ $row->title }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                            </td>
                        </tr> 

                        <tr> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Parking price </label>
                                    <div class="col-sm-5">
                                        <input name="parking_price" id="parking_price" type="text" value="" class="form-control" readonly required>
                                    </div>
                                </div>
                            </td>
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name">Car Parking </label>
                                    <div class="col-sm-5" id="parking_div" >
                                    </div>
                                </div>
                            </td>                                        
                        </tr>

                        <tr> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Discount Amount </label>
                                    <div class="col-sm-5">
                                        <input name="discount_amount" onblur="SetDiscount(this.value);" id="discount_amount" type="text" value="0" class="form-control"  />
                                    </div>
                                </div>
                            </td>
                            <td> </td>
                        </tr>

                        <tr> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Total Purchase price </label>
                                    <div class="col-sm-5">
                                        <input name="purchase_price" id="purchase_price" type="text" value="" class="form-control" readonly required>
                                    </div>
                                </div>                                            
                            </td>
                            <td> </td>
                        </tr>

                        <tr> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Earnest Money </label>
                                    <div class="col-sm-5">
                                        <input name="earnest_money" id="earnest_money" type="text" value="0" class="form-control" required>
                                    </div>
                                </div>
                            </td>
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Earnest Money payment date  </label>
                                    <div class="col-sm-5">
                                        <input name="em_payment_date" id="em_payment_date" type="date" value="{!! old('em_payment_date') !!}" onblur="SetDP_Date(this.value);"  class="form-control" required>
                                    </div>
                                </div>
                            </td>
                        </tr> 

                        <tr> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name">Part of Down Payment </label>
                                    <div class="col-sm-5">
                                        <input name="down_payment" id="down_payment" type="text" value="0" class="form-control" required>
                                    </div>
                                </div>
                            </td>
                            <td> 
                                    <label class="col-sm-5 control-label" for="name">Part of Down Payment Date </label>
                                    <div class="col-sm-5">
                                        <input name="part_down_payment_date" id="part_down_payment_date" value="" type="date" class="form-control" readonly="" >
                                    </div>
                            </td>
                        </tr>

                        <tr id="balance_down_payment_tr"> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name">Balance of Down Payment </label>
                                    <div class="col-sm-5">
                                        <input name="balance_down_payment" id="balance_down_payment" type="text" value="0" class="form-control" >
                                    </div>
                                </div>
                            </td>
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Balance Down Payment date  </label>
                                    <div class="col-sm-5">
                                        <input name="balance_dp_date" id="balance_dp_date" type="date" value="{!! old('balance_dp_date') !!}" class="form-control" >
                                    </div>
                                </div>
                            </td>
                        </tr> 

                        <tr> 
                            <td> 
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label" for="name"> Balance amount   </label>
                                        <div class="col-sm-5">
                                            <input name="loan_amount" id="loan_amount" type="text" value="" readonly class="form-control" required>
                                        </div>
                                    </div>
                            </td> 
                            <td> </td>                                     
                        </tr>   

                        <tr> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Rebate rate (%) </label>
                                    <div class="col-sm-5">
                                        <input name="redate_rate" id="redate_rate" type="text" value="{!! old('redate_rate') !!}" autocomplete="off" class="form-control" required>
                                    </div>
                                </div>
                            </td> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Delay rate (%) </label>
                                    <div class="col-sm-5">
                                        <input name="delay_rate" id="delay_rate" type="text" value="" autocomplete="off" class="form-control" required>
                                    </div>
                                </div>                                                
                            </td>                                         
                        </tr>   

                        <tr> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Frist payment date  </label>
                                    <div class="col-sm-5">
                                        <input name="frist_payment_date" id="frist_payment_date" type="date" value="{!! old('frist_payment_date') !!}" onblur="SetNoOfMonth(this.value);" class="form-control" required>
                                    </div>
                                </div>                                                
                            </td> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Periods (Months) </label>
                                    <div class="col-sm-5">
                                        <input name="periods" id="periods" type="text" value="" class="form-control" readonly required>
                                    </div>
                                </div>
                            </td>                                     
                        </tr>   

                        <tr> 
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Monthly payment  </label>
                                    <div class="col-sm-5">
                                        <input name="monthly_payment" id="monthly_payment" readonly type="text" value="" class="form-control" required>
                                    </div>
                                </div>                                                
                            </td> 
                            <td>                                             
                                <div class="form-group">
                                    <label class="col-sm-5 control-label" for="name"> Handover date  </label>
                                    <div class="col-sm-5">
                                        <input name="handover_date" readonly id="handover_date" type="date" value="{!! old('handover_date') !!}" class="form-control" required>
                                    </div>
                                </div>
                            </td> 
                        </tr> 
                        
                        <tr> 
                            <td style="text-align:center; font-weight:bold; padding:15px;">                                              
                                    Standard Payment Schedule                                                                                                                                     
                            </td> 
                            
                            <td style="text-align:center; font-weight:bold; padding:15px;">                                              
                                    Customize Payment Schedule for Prospect/Client                                                                                                                                      
                            </td> 
                        </tr>
                        
                        <tr > 
                                <td>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Payment Type</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                            </tr>                                           
                                        </thead>
                                        <tbody id="InstallmentList">
                                            
                                        </tbody>                                                                
                                    </table>
                                    <input type="hidden" id="total_installment" name="total_installment" value="0" />
                                </td>    
                                <td>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label" for="name"> Earnest Money </label>
                                            <div class="col-sm-5">
                                                <input name="earnest_money_c" id="earnest_money_c" type="text" autocomplete="off" value="0" onblur="CalculateRestAmount();" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label" for="name">Part of Down Payment </label>
                                            <div class="col-sm-5">
                                                <input name="down_payment_c" id="down_payment_c" type="text" autocomplete="off" value="0" onblur="CalculateRestAmount();" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="form-group" id="div_Balance_Down">
                                            <label class="col-sm-5 control-label" for="name">Balance Down Payment </label>
                                            <div class="col-sm-5">
                                                <input name="balance_down_payment_c" id="balance_down_payment_c" type="text" autocomplete="off" value="0" onblur="CalculateRestAmount();" class="form-control" >
                                            </div>
                                        </div>
                                    
                                        <strong> Custom Date by Prospect/Client ? </strong>
                                        <input name="multiplepayment" value="1" type="checkBox" id="multiplepayment" onclick="ShowMultiplePayment()"/> 
                                        <div  id="multiple-down" style="display:none; padding:10px;" >
                                            <table id="multiple-table">
                                                <tr style="text-align:center"> 
                                                    <td> Date </td>
                                                    <td> Amount </td>
                                                    <td>  </td>
                                                </tr>
                                                <tr id="tr_1"> 
                                                    <td> <input type="date" name="date_1" id="date_1" placeholder="Date" class="form-control" > </td>
                                                    <td> <input type="text" name="amount_1" id="amount_1" placeholder="Amount" onblur="CalculateRestAmount();" value="0" class="form-control" >  </td>
                                                    <td> &nbsp;
                                                            <input type="button" value=" + " onclick="AddMore();" > 
                                                            <input type="button" value=" x " onclick="RemoveMore();" > 
                                                    </td>
                                                </tr>                                                            
                                            </table>

                                            <strong> Banalce Amount : </strong> <strong id="balance_amount_new">  </strong> 
    
                                            <input id="hid_last_input_id" type="hidden" value="1" >
                                            <input id="hid_rest_amount" type="hidden" value="0" >
                                                
                                        </div>
                                        <br/> 
                                        <strong> Rest of payment convert to installment ? </strong>
                                        <input name="installmentpayment" value="1" type="checkBox" id="InstallmentInput" onclick="ShowInstallmentPayment()"/> 
                                        <div class="form-group" id="installment-payment" style="display:none; padding:10px;" >

                                                <strong> Total Banalce Amount : </strong> <strong id="installment_balance_amount">  </strong> <br/>
                                                <strong> Per Month : </strong> <strong id="installment_monthly">  </strong>  <br/>

                                                <strong style="float:left;" > Installment Start Date : &nbsp; </strong> 
                                                    <input type="date" name="inst_start" id="inst_start" onblur="ShowInstallmentPayment();" placeholder="Date" class="form-control" style="width:120px; float:left; padding:2px;" >
                                        </div>    
                                </td>   
                            </tr> 

                        <tr> 
                            <td> </td> 
                            <td> 
                                    <div class="form-group">
                                        <div class="col-sm-5">&nbsp;</div>
                                        <div class="col-sm-5">
                                            <button type="submit" id="submit" class="btn btn-info pull-right">Submit</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" id="flat_price" value=""/>
                                    <input type="hidden" id="parking_price" value=""/>
                            </td>                                     
                        </tr>                                   

                    </table>
            
                </form>        


            </div>
        </div>
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

            function SetNoOfMonth(date1) 
            {
                //alert(date1);
                $("#inst_start").val(date1);

                var date2 = $("#handover_date").val();
                var loan_amount = $("#loan_amount").val();
                
                $.ajax({
                    url: '{!! url('test/property/public/get_months_by_dates') !!}/?date1='+date1+'&date2='+date2,
                    //url: '{!! url('get_months_by_dates') !!}/?date1='+date1+'&date2='+date2,
                    type:"GET",                
                    success:function(data) {
                        //alert(data);
                        $("#periods").val(data);
                        var no_of_month = parseInt(data, 10);
                        var per_month = (loan_amount/no_of_month);
                        $("#monthly_payment").val(per_month.toFixed(0));

                        var pay_date = date1;
                        var res = pay_date.split("-");
                        var dd = res[2];
                        
                        $("#InstallmentList").html("");
                        var total = 0;
                        for(m=1; m<=data; m++)
                        {                            
                            total = total + per_month;
                            $("#InstallmentList").append("<tr>");
                            $("#InstallmentList").append('<td scope="row"> '+m+' </td>');
                            $("#InstallmentList").append('<td> Installment </td>');
                            $("#InstallmentList").append('<td> <input type="date" name="ss_date_'+m+'" value="'+pay_date+'" class="form-control" > </td>');
                            $("#InstallmentList").append('<td> <input type="text" name="ss_amount_'+m+'" id="ss_amount_'+m+'" value="'+formatNumber(per_month.toFixed(0))+'" onblur="CalStandardAmount();" class="form-control" >  </td>');
                            $("#InstallmentList").append("</tr>");

                            var date = new Date(pay_date);
                            var next_date = date.setMonth(date.getMonth() + 1);                            
                            /*    
                            var next_date = date.setDate(date.getDate() + 28);                            
                            */
                            var next_date = new Date(next_date);
                            //alert(next_date);

                            var mm = next_date.getMonth() + 1;    
                            if(mm<10) { var mm ='0'+mm; }
                            var yyyy = next_date.getFullYear(); 
                            var pay_date = yyyy+'-'+mm+'-'+dd;
                            //alert(pay_date);
                        }

                        $("#total_installment").val(m); 

                        $("#InstallmentList").append("<tr>"); 
                        $("#InstallmentList").append('<td colspan="2" style="text-align:right;"> Total : </td>');                                          
                        $("#InstallmentList").append('<td> '+formatNumber(total.toFixed(0))+' </td>');
                        $("#InstallmentList").append('<td id="ss_sum_total"> '+formatNumber(total.toFixed(0))+' </td>');
                        $("#InstallmentList").append("</tr>");
                    },            
                });

            }

            function CalStandardAmount() 
            { 
                var total_installment = $("#total_installment").val(); 
                var total_balance_amount = $("#loan_amount").val();
                                 

                var T_amount = 0;
                for(var i=1; i<total_installment; i++)
                {
                    var amount = $("#ss_amount_"+i).val();   //alert(amount);
                    var amount = amount.replace(/,/gi, ''); //alert(amount);
                    var amount = parseInt(amount, 10);      //alert(amount);
                    T_amount += amount;
                } 
                
                var rest_amount = total_balance_amount - T_amount;
               
                $("#ss_sum_total").html(formatNumber(T_amount));
            }

            function ShowMultiplePayment() 
            {
                 
                var balance_down_payment = Number($("#balance_down_payment").val());
                var purchase_price = $("#purchase_price").val();
                var earnest_money = $("#earnest_money").val();
                var down_payment = $("#down_payment").val();
                var total_price = purchase_price-earnest_money-down_payment-balance_down_payment;
                //$("#amount_1").val(total_price);
                $("#hid_rest_amount").val(total_price);
                
                var input = document.getElementById ("multiplepayment");
                var isChecked = input.checked;
                if(isChecked==true){
                    $("#multiple-down").show();
                } else {
                    $("#multiple-down").hide();
                }

                $("#balance_amount_new").html(purchase_price);

                CalculateRestAmount();  
                
            }

            function ShowInstallmentPayment()
            {

                var no_months = Number($("#periods").val());
                var inst_start = $("#inst_start").val(); 
                if(inst_start!=''){
                    var handover_date = $("#handover_date").val();                     
                    var no_months = monthDiff( new Date(inst_start) , new Date(handover_date) );                       
                    //alert(no_months);                    
                }
                
                var total_price = $("#purchase_price").val();                
                var earnest_money_c = Number($("#earnest_money_c").val());
                var down_payment_c = Number($("#down_payment_c").val());
                var balance_down_payment_c = Number($("#balance_down_payment_c").val());
                
                var T_Mul_amount = 0;
                var input = document.getElementById ("multiplepayment");
                var isChecked = input.checked;
                if(isChecked==true)
                {                    
                    var hid_last_input_id = $("#hid_last_input_id").val();                      
                    for(var i=1; i<=hid_last_input_id; i++)
                    {
                        var amount = $("#amount_"+i).val();
                        var amount = parseInt(amount, 10);
                        T_Mul_amount += amount;
                    }        
                }
         
                var rest_amount = total_price - (earnest_money_c+down_payment_c+balance_down_payment_c+T_Mul_amount);
              
                var per_month = rest_amount/no_months;
                
                $("#installment_balance_amount").html(rest_amount);
                $("#installment_monthly").html(per_month.toFixed(0));
                
                
                var input = document.getElementById ("InstallmentInput");
                var isChecked = input.checked;
                if(isChecked==true){
                    $("#installment-payment").show();
                } else {
                    $("#installment-payment").hide();
                }
            }
        
            var inc = 1;
            function AddMore() 
            {
                var inc = $("#hid_last_input_id").val(); 
                inc ++;
                var div_html = '<tr id="tr_'+inc+'">';
                        div_html += '<td> <input name="date_'+inc+'" id="date_'+inc+'" type="date" placeholder="Date" class="form-control" > </td> ';
                        div_html += '<td> <input name="amount_'+inc+'" id="amount_'+inc+'" onblur="CalculateRestAmount();" type="text" value="0" class="form-control" >  </td> ';
                        div_html += '<td>  </td> ';
                    div_html += '</tr>';            
                $("#multiple-table").append(div_html);  
        
                $("#hid_last_input_id").val(inc);  
                $("#multiplepayment").val(inc);  
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
                    $("#myInput").val(last_id); 
                }  
                CalculateRestAmount();              
            }    

               

            function CalculateRestAmount() 
            {
                              
                var hid_last_input_id = $("#hid_last_input_id").val(); 
                var total_price = $("#purchase_price").val();
             
                var earnest_money_c = Number($("#earnest_money_c").val());
                var down_payment_c = Number($("#down_payment_c").val());
                var balance_down_payment_c = Number($("#balance_down_payment_c").val());
        
                var rest_amount = parseInt(total_price, 10) - (earnest_money_c+down_payment_c+balance_down_payment_c);
           

                var T_amount = 0;
                for(var i=1; i<=hid_last_input_id; i++)
                {
                    var amount = $("#amount_"+i).val();
                    var amount = parseInt(amount, 10);
                    T_amount += amount;
                } 
                
                var rest_amount = rest_amount - T_amount;
                      
                //$("#amount_"+hid_last_input_id).val(rest_amount);

                $("#balance_amount_new").html(rest_amount);
                
                         
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

        <style>
            #parking_div .checkbox { float: left; margin-right:4px; clear: both; }
        </style>

</section>
@endsection