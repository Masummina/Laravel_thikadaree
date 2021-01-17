<div class="tab-pane active" id="tabs-2" role="tabpanel">
    <div class="row">
    <div class="comments-form border-box">
        <h3 class="title-normal">Your Question</h3>
      <form action="" method="POST">
         @csrf
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <textarea class="form-control required-field" id="question" placeholder="Your Question" rows="6" required="" name="comment"></textarea>
               </div>
            </div><!-- Col 12 end -->
           </div><!-- Form row end -->
           <div class="clearfix">
              <button class="btn btn-primary" name="submit" type="submit">Post Question</button> 
           </div>
        </form><!-- Form end -->
     </div>
   </div>
</div>