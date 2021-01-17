@extends('layouts.app')

@section('content')

   <section id="main-container" class="main-container">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="post-content post-single post-details bidder-login">
                  <div class="post-body">
                     <div class="entry-header">
                     	<div class="row">
                         <div class="myinfo_header">
                                 <div class="running-project-header float-left">
                                 <h4>My Transactions History</h4>
                              </div>
                              <div class="employ_type float-right">
                                 <button type="button" class="btn btn-info education" data-toggle="modal" data-target="#addmoney">
                                 Add money
                              </button>
                                 <button type="button" class="btn btn-info education" data-toggle="modal" data-target="#withdrawal">
                                 Withdrawal
                              </button>
                              </div>
                           </div>
                     	</div>
                     </div><!-- header end -->

                     <div class="myproject">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th>S#</th>
                              <th>Particulars</th>                          
                              <th>Remarks</th>
                              <th>Transaction ID</th>
                              <th>Amount</th>
                              <th>Date</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>

                        @php $i=0; @endphp
                              @foreach($transaction as $value)
                              @php  $i++; 

                                 if($value->status == 0 ) {
                                    $status = "Pending";
                                 } else if($value->status == 1 ) {
                                    $status = "Approved";
                                 } else if($value->status == 2 ) {
                                    $status = "Cancled";
                                 }
                              @endphp
                              <tr>
                                 <td>{{$i}}</td>
                                 <td>{!! $value->narration !!}</td>
          
                                 <td>{!! $value->remarks !!}</td>
                                 <td>{!! $value->transaction_id !!}</td>
                                 <td style="text-align: right; padding-right: 37px;">{!! number_format($value->amount,2) !!}</td>
                                 <td>
                                    {!! date("F j, Y", strtotime($value->txn_date));  !!}
                                 </td>
                                 <td>
                                    {!! $status !!}
                                 </td>
                              
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     </div>
                  </div><!-- post-body end -->
               </div><!-- post content end -->


               <!-- Add money model section start -->

               <div class="modal fade" id="addmoney">
               <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="experience_section education">
                      <header>
                          <h4>Add Money</h4>
                      </header>
                      <content>
                          <form method="POST" action="" enctype="multipart/form-data" onsubmit="return confirm('Do you really want to submit?');" >
                              @csrf

                              <div class="form-group">
               
                                 <div class="paymethod">
                                    <div class="custom-control custom-checkbox mb-3 bkash">
                                       <input type="radio" class="custom-control-input" id="bkashMethod" value="bkash" name="paymentmethod" required>
                                       <label class="custom-control-label" for="paymentmethod">bKash</label>
                                       <img class="paylogo" src="{{asset('images/bkash.png')}}" alt="bkash">
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 bank">
                                       <input type="radio" class="custom-control-input" id="bank_method" value="Bank" name="paymentmethod">
                                       <label class="custom-control-label" for="paymentmethod">Bank </label>
                                       <img class="paylogo" src="{{asset('images/bank.jpg')}}" alt="Bank"> 
                                    </div>
                                 </div>
                           </div>
              
                          <div class="form-group">
                              <div id="methodadd">
                              </div>
                           </div>
                          
                          <input type="submit" name="submit" class="btn btn-primary pull-right">
                          </form>
                      </content>
                  </div>

                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                          
                        </div>
                      </div>
                    </div>

               <!-- Add money model section End -->

               

                      <!-- Withdrawal model section start -->

             <div class="modal fade" id="withdrawal">
               <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="experience_section education">
                      <header>
                          <h4>Withdrawal Money</h4>
                      </header>
                      <content>
                          <form method="POST" action="" enctype="multipart/form-data" onsubmit="return confirm('Do you really want to submit?');">
                              @csrf

                              <div class="form-group">
               
                                 <div class="paymethod">
                                 <div class="form-group">
                                    <label for="branch">Amount:</label>
                                    <input type="number" class="form-control" placeholder="amount" id="amount" name="wit_amount" required>
                                 </div>
                                 </div>
                           </div>
              
                          <div class="form-group">
                              <div id="methodadd">
                              </div>
                           </div>
                          
                          <input type="submit" name="submit" class="btn btn-primary pull-right">
                          </form>
                      </content>
                  </div>

                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                          
                        </div>
                      </div>
                    </div>

               <!-- Withdrawal model section End -->
         

            </div><!-- Content Col end -->


         </div><!-- Main row end -->

      </div><!-- Conatiner end -->

   <script>
   var element = document.getElementById("bkashMethod");
		element.onchange = function() {
			var bidder_type = element.value;
			$('#methodadd').html('<div class="bidder_want"><div class="form-group"><label for="amount">Amount:</label><input type="number" class="form-control" name="bkash_amount" placeholder="Amount" id="amount"></div></div>');

		}
		var element2 = document.getElementById("bank_method");
		element2.onchange = function() {
			var bidder_type = element2.value;
			$('#methodadd').html('<div class="bidder_want"><div class="form-group"><div class="paymethod"><div class="custom-control custom-checkbox mb-3 bkash"><input type="radio" onclick="brackbankfun()" class="custom-control-input" id="brac_bank_val" value="brac" name="bank_name" required><label class="custom-control-label" for="bank_name">BRAC</label><img class="paylogo" src="{{asset('images/bkash.png')}}" alt="BRAC"></div><div class="custom-control custom-checkbox mb-3 bank"><input type="radio" onclick="dbblbankfun()" class="custom-control-input" id="dbbl_bank_val" value="dbbl" name="bank_name"><label class="custom-control-label" for="bank_name">Dutch Bangla Bank</label><img class="paylogo" src="{{asset('images/bank.jpg')}}" alt="Dutch"></div></div></div><div class="form-group"><div id="own_account"></div></div><div class="form-group"><div id="dbbl_own_account"></div></div><div class="form-group"><label for="branch">Branch Name:</label><input class="form-control" placeholder="Branch name" id="branch_name" name="branch_name"></div><div class="form-group"><label for="branch">Amount:</label><input type="number" class="form-control" placeholder="Amount" id="amount" name="amount"></div><div class="form-group"><label for="txn_date">Date</label><input type="date" class="form-control" id="txn_date" name="txn_date"></div><div class="form-group"><label for="cheque_num">Upload Deposit Slip:</label><input type="file" class="form-control" placeholder="Deposit Slip" id="deposit_slip" name="deposit_slip[]" multiple></div><div class="form-group"><label for="branch">Deposit/Cheque Number</label><input type="number" class="form-control" placeholder="Branch name" id="deposit_num" name="deposit_num"></div></div>');
		}

      function brackbankfun() {
      document.getElementById("own_account").innerHTML = "<div class='bank_payment_info'><div class='pay_note'><p>Tip: If you use labels for accompanying text, add the .custom-control-label class to it. Note that the value of the for attribute should match the id of the checkbox:</p></div><h5>BRAC Bank Limited</h5><p><b>Branch:</b> AC#45323434</p><p><b>Account Name:</b> Md Raquibul Hasan</p><p><b>Account Number:</b> AC#45323434</p></div>";
      }
      function dbblbankfun() {
      document.getElementById("own_account").innerHTML = "<div class='bank_payment_info'><div class='pay_note'><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has</p></div><h5>Dutch Bangla Bank</h5><p><b>Branch:</b> AC#45323434</p><p><b>Account Name:</b> Md Raquibul Hasan</p><p><b>Account Number:</b> AC#45323434</p></div>";
      }
   </script>


   </section><!-- Main container end -->

	
@endsection
