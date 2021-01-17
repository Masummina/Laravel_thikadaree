<div class="tab-pane" id="tabs-1" role="tabpanel">

<!-- Apply Now Start-->


<!-- EOI/Proposal bid start -->

   

      @if(@$project_info->request_type=='proposal')

      


      <form action="" method="POST" enctype="multipart/form-data">

     @csrf

       <div class="post-content post-single post-details bid-project">

          <div class="post-body">

             <div class="entry-header">

              <div class="row">

                <div class="col-md-12 col-sm-12 left">

                  <h4>Place a Bid on this Project</h4>

                </div>

              </div>

             </div><!-- header end -->

             <div class="entry-content">

              <div class="title">Bid Details</div>

                <div class="bit-amount proposal">

                  <div class="row">
                          <div class="form-group">
                             <label for="pwd"><h5>Upload your proposal:</h5> </label>
                              <input type="file" class="form-control" id="proposal_image" name="proposal_file[]" multiple>
                              <input type="hidden" value="{!! @$project_info->id !!}" id="project_id" name="project_id">

                          </div>
                          <div class="form-group">

                              <label for="comment"> <h5>Suggest a milestone:</h5></label>

                              <p>Define the tasks that you will complete for this</p>
                                <textarea class="form-control" placeholder="What makes you the best candidate for this project?" rows="7" id="comment" name="discription"></textarea>
                              </div>

                        
                          <div class="pull-right">

                               <input type="submit" name="submit" value="submit" class="btn btn-primary btn-lg">

                          </div>

                  </div>

                </div>

             </div>

          </div><!-- post-body end -->

       </div><!-- post content end -->

      </form>








      <!-- Apply bid start -->
      @else

      <form action="" method="POST">

     @csrf

       <div class="post-content post-single post-details bid-project">
          <div class="post-body">
             <div class="entry-header">
              <div class="row">
                <div class="col-md-12 col-sm-12 left">
                  <h4>Place a Bid on this Project</h4>
                </div>

              </div>

             </div><!-- header end -->

             <div class="entry-content">

              <div class="title">Bid Details</div>

                <div class="bit-amount">

                  <div class="row">

                        <div class="col-md-6 col-sm-6 min-rate">

                          <div class="form-group">

                             <label for="pwd"><h5>Bid Amount:</h5> </label>

                              <input type="number" class="form-control" id="BidAmount" name="BidAmount">

                          </div>

                        </div>

                        <div class="col-md-6 col-sm-6 max-rate">

                          <div class="form-group">

                            <label for="pwd"><h5>This project will be delivered in:</h5></label>

                            <input type="number" id="start" name="delivary_time" placeholder="delivary time" class="form-control">

                          </div>

                        </div>

                        

                        <div class="col-md-12 sug-milestone">


                            <table class="table">

                              <thead>

                                <tr>



                                  <th scope="col">Discription of items </th>

                                  <th scope="col">Quantity</th>

                                  <th scope="col">Unit</th>

                                  <th scope="col">Amount /Unit</th>

                                </tr>

                              </thead>

                              <tbody> 



                           @if(isset($project_info->items))

               

                          

                              @php

                              $item_list = json_decode($project_info->items);

                              //print_r($item_list); exit;

                              $total_items = 0;

                              if(isset($item_list->items))

                              {

                                

                                



                                foreach ($item_list->items as $key => $value) {

                                  $total_items++;

                                  echo '<tr>               

                                          <td> '.$value.'ff<input type="hidden" value="'.$value.'" name="items_title[]"></td>

                                          <td> '.@$item_list->quantity[$key].' <input type="hidden" value="'.@$item_list->quantity[$key].'" name="items_quantity[]"></td>

                                          <td>'.@$item_list->units[$key].' <input type="hidden" value="'.@$item_list->units[$key].'" name="items_unit[]"> </td>

                                          <td><input type="number" class="form-control" value="0" name="unit_price[]" onblur="bidItemCalculation()" id="unit_price_'.$key.'">

                                            <input type="hidden" value="'.@$item_list->quantity[$key].'" id="unit_pices_'.$key.'"></td>              

                                        </tr>';



                                }



                                

                              }

                            @endphp



                           @endif

                          </tbody>
                      </table>

                           <div id="newinput">
                                  
                            </div>

                        </div>

                          

                        <div class="col-md-12 sug-milestone">

                          

                          <div class="form-group">

                            <label for="comment"> <h5>Suggest a milestone:</h5></label>

                            <p>Define the tasks that you will complete for this</p>

                            <textarea class="form-control" placeholder="What makes you the best candidate for this project?" rows="7" id="comment" name="discription"></textarea>



                          </div>

                          
                          <div class="add_new_unit">
                              
                              <div class="form-group">
                                
                            </div>
                          </div>
                          <div class="pull-left">
                                <label class="form-check-label">
                                  <input type="button" id="supplier2" value="Add New Unit" class="btn btn-primary" name="request_type">
                                </label>
                              </div>
                          <div class="pull-right">

                               <input type="submit" name="submit" value="submit" class="btn btn-primary">

                          </div>
                        </div>

                        

                       

                  </div>

                </div>

             </div>

          </div><!-- post-body end -->

       </div><!-- post content end -->

      </form>


      @endif


      <!-- unit section start -->

      

      <script>
        var g_element_id = 1;
      var element = document.getElementById("supplier2");
      window.onload = function() {
			var bidder_type = element.value;
 			
 			var item_element = ' '+
					'<div class="bid_quototion" >'+
						'<div class="form-group">'+
							'<label for="quotation_dis">Discription of item</label>'+
							'<input type="text" class="form-control" placeholder="item title" id="item" name="items[]">'+
						'</div>'+
						'<div class="form-group">'+
							'<label for="unit">Unit</label> <br/>'+
							'<select name="units[]">'+
					          '<option value="Sqft">Sqft</option>'+
					          '<option value="Acre">Acre</option>'+
					          '<option value="Meter">Meter</option>'+
					          '<option value="Feet">Feet</option>'+
					        '</select>'+
						'</div>'+
						'<div class="form-group">'+
							'<label for="quotation_dis">Quantity</label> '+
							'<input type="number" class="form-control" placeholder="quantity" name="quantity[]">'+
            '</div>'+
            '<div class="form-group">'+
							'<label for="quotation_dis">Amount</label> '+
							'<input type="number" class="form-control" placeholder="amount" name="amount[]">'+
						'</div>'+
						'<div class="form-group"> <br/> '+
							'<span class="btn btn-primary" onclick="AddItemElement('+g_element_id+')" ><i class="fa fa-plus"></i></span>'+
						'</div>'+
					'</div>';

			$('#newinput').html(item_element);

    }
    
    // add element start

    function AddItemElement(element_id)
		{
			g_element_id++;
			var item_element = ' '+
					'<div class="bid_quototion" id="item_element_'+g_element_id+'" >'+
						'<div class="form-group">'+				
							'<input type="text" class="form-control" placeholder="item title" id="item" name="items[]">'+
						'</div>'+
						'<div class="form-group">'+							
							'<select name="units[]">'+
					          '<option value="Sqft">Sqft</option>'+
					          '<option value="Acre">Acre</option>'+
					          '<option value="Meter">Meter</option>'+
					          '<option value="Feet">Feet</option>'+
					        '</select>'+
						'</div>'+
						'<div class="form-group">'+						
							'<input type="number" class="form-control" placeholder="quantity" name="quantity[]">'+
            '</div>'+
            '<div class="form-group">'+
							'<label for="quotation_dis">Amount</label> '+
							'<input type="number" class="form-control" placeholder="amount" name="amount[]">'+
						'</div>'+
						'<div class="form-group">'+
							'<span class="btn btn-warning" onclick="removeItemElement('+g_element_id+')" ><i class="fa fa-minus"></i></span>'+
						'</div>'+
					'</div>';

					

			$('#newinput').append(function AddItemElement(element_id)
		{
			g_element_id++;
			var item_element = ' '+
					'<div class="bid_quototion" id="item_element_'+g_element_id+'" >'+
						'<div class="form-group">'+				
							'<input type="text" class="form-control" placeholder="item title" id="item" name="items[]">'+
						'</div>'+
						'<div class="form-group">'+							
							'<select name="units[]">'+
					          '<option value="Sqft">Sqft</option>'+
					          '<option value="Acre">Acre</option>'+
					          '<option value="Meter">Meter</option>'+
					          '<option value="Feet">Feet</option>'+
					        '</select>'+
						'</div>'+
						'<div class="form-group">'+						
							'<input type="number" class="form-control" placeholder="quantity" name="quantity[]">'+
            '</div>'+
            '<div class="form-group">'+
							'<input type="number" class="form-control" placeholder="amount" name="amount[]">'+
						'</div>'+
						'<div class="form-group">'+
							'<span class="btn btn-warning" onclick="removeItemElement('+g_element_id+')" ><i class="fa fa-minus"></i></span>'+
						'</div>'+
					'</div>';

					

			$('#newinput').append(item_element);		

		});		

    }
    

    function removeItemElement(element_id)
		{
			$('#item_element_'+element_id).remove();	
		}


      </script>
  
<!-- EOI/Proposal bid End -->
    

  <!-- Apply Now End -->



  <script type="text/javascript">
    var total_items = '{!! @$total_items !!}';
    function bidItemCalculation() {

      var total = 0;

      for (i = 0; i < total_items; i++) {

         var pices = $("#unit_pices_"+i).val();

         var unit_price = $("#unit_price_"+i).val();

         total += (pices*unit_price);

         $("#BidAmount").val(total);

         //alert(total);

      }

    }

  </script>



</div>