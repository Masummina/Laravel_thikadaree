<div class="tab-pane" id="tabs-1" role="tabpanel">
<!-- Apply Now Start-->
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

                          

                           @if(isset($project_info->items))
               
                          
                              @php
                              $item_list = json_decode($project_info->items);
                              //print_r($item_list); exit;
                              $total_items = 0;
                              if(isset($item_list->items))
                              {
                                
                                echo '<table class="table">
                                        <thead>
                                          <tr>
                                        
                                            <th scope="col">Discription of items </th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Amount /Unit</th>
                                          </tr>
                                        </thead>
                                        <tbody>';

                                foreach ($item_list->items as $key => $value) {
                                  $total_items++;
                                  echo '<tr>               
                                          <td> '.$value.'</td>
                                          <td> '.@$item_list->quantity[$key].' </td>
                                          <td>'.@$item_list->units[$key].'</td>
                                          <td><input type="number" class="form-control" value="0" name="unit_price[]" onblur="bidItemCalculation()" id="unit_price_'.$key.'">

                                            <input type="hidden" value="'.@$item_list->quantity[$key].'" id="unit_pices_'.$key.'"></td>              
                                        </tr>';

                                }

                                echo '</tbody>
                                  </table>';
                              }
                            @endphp

                           @endif
                        </div>
                          
                        <div class="col-md-12 sug-milestone">
                          
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
             </div>
          </div><!-- post-body end -->
       </div><!-- post content end -->
      </form>
  <!-- Apply Now End -->

  <script type="text/javascript">
    var total_items = '{!! $total_items !!}';
    
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