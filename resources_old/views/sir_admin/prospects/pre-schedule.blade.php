@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Pre-Schedule </div>
                <div class="panel-body">
                    @php 
                        //dd($pre_schedules);
                    @endphp
                    
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

                    @if(isset($prospect_id) && $prospect_id>0)
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#pre-schedule-modal">
                                <i class="fa fa-plus" ></i>  Add New
                        </button>
                    @endif
                    
                    <table id="myTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Schedule ID</th>
                            <th> Create Date</th>
                            <th> Prospect </th>
                            <th> Project</th>
                            <th> Property</th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp
                       @foreach($pre_schedules as $row)
                           @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>PS{!! $row->id +1000 !!} </td>
                                <td>{!! date("d-F-Y", strtotime($row->created_at)) !!} </td>
                                <td><b>{!!$row->prefix!!} {{$row->name}}</b></td>
                                <td>{{$row->project_title}}</td>
                                <td>{{$row->property_title}}</td>
                                <td>  
                                    <a href="{{ url('/pre-schedules-status/'.$row->id.'/') }}" class="btn btn-success pull-left"> <i class="fa fa-eye" ></i> View</a>
                                    @if(1 == Auth::user()->group_id)
                                        <a href="{{ url('/pre-schedules-delete/'.$row->id.'/') }}" class="btn btn-danger " style="margin-left: 4px;"  onclick="return confirm('Are you sure you want to delete?')" > <i class="fa fa-trash-o" ></i> Delete </a>
                                    @endif
                                </td>
                            </tr>
                       @endforeach
                        </tbody>
                    </table>

                    <div class="pull-right">{{ $pre_schedules->links() }}</div>

                </div>
            </div>
        </div>


          <!-- Modal -->
          <div class="modal fade" id="pre-schedule-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"> Create Pre-Schedule </h5>
                      </div>
                      <div class="modal-body">

                        <div class="row">  
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
                                        <td> </td>
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
                                        <td colspan="2" style="text-align:center; font-weight:bold; padding:15px;">                                              
                                                Payment Schedule Offered by Prospect/Client                                                                                                                                      
                                        </td>                                          
                                    </tr>
                                    
                                    <tr > 
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
                                            </td>    
                                            <td>
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
                                                @if(isset($prospect_id))
                                                <input type="hidden" id="prospect_id" name="prospect_id" value="{!! $prospect_id !!}"/>
                                                @endif
                                        </td>                                     
                                    </tr>                                   

                                </table>
                        
                            </form>

                        </div>

                          
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </div>
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

            function SetNoOfMonth(date1) 
            {
                
                $("#inst_start").val(date1);

                var date2 = $("#handover_date").val();
                var loan_amount = $("#loan_amount").val();
                
                $.ajax({
                    //url: '{!! url('test/property/public/get_months_by_dates') !!}/?date1='+date1+'&date2='+date2,
                    url: '{!! url('get_months_by_dates') !!}/?date1='+date1+'&date2='+date2,
                    type:"GET",                
                    success:function(data) {
                        //alert(data);
                        $("#periods").val(data);
                        var no_of_month = parseInt(data, 10);
                        var per_month = (loan_amount/no_of_month);
                        $("#monthly_payment").val(per_month.toFixed(0));
                    },            
                });

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