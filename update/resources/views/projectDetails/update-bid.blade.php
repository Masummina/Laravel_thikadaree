@if(isset($_GET['userid'])) 

    <div class="apply_now_from-update" name="updatebid">
    	<form action="" method="POST">
       	@csrf
         <div class="post-content post-single post-details bid-project">
            <div class="post-body">
               <div class="entry-header">
                <div class="row">
                  <div class="col-md-12 col-sm-12 left">
                    <h4>Update Your Bid</h4>
                  </div>
                </div>
               </div><!-- header end -->

               <div class="entry-content">
                  <div class="bit-amount">
                    <div class="row">

                          <div class="col-md-6 col-sm-6 min-rate">
                            <div class="form-group">
                               <label for="pwd"><h5>Bid Amount:</h5> </label>
                                <input type="number" class="form-control" value="{!! $bidval->money !!}" id="pwd" name="updatemoney">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6 max-rate">
                            <div class="form-group">
                              <label for="pwd"><h5>This project will be delivered in:</h5></label>
                              <input type="number" id="start" value="{!! $bidval->days !!}" name="days" placeholder="delivary time" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-12 sug-milestone">
                            
                            <div class="form-group">
                              <label for="comment"> <h5>Suggest a milestone:</h5></label>
                              <p>Define the tasks that you will complete for this</p>
                              <textarea class="form-control" placeholder="What makes you the best candidate for this project?" rows="7" id="comment" name="discription">{!! $bidval->discription !!}</textarea>

                            </div>
                            <div class="pull-right">
                                 <input type="submit" name="submit" value="Update" class="btn btn-primary btn-lg">
                            </div>
                            
                          </div>
                      
                    </div>
                  </div>
               </div>
               
            </div><!-- post-body end -->
         </div><!-- post content end -->
      	</form>
    </div>

@endif