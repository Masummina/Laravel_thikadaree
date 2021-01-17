@php
if(isset($project_info->comment)){
	$commnets = $project_info->comment;
	$result = json_decode($commnets);
}
@endphp
       
    <!-- Project Comment start -->            
    <div id="comments" class="comments-area">
      <ul class="comments-list">

        @php 
          $seo_title = strtolower(str_replace(" ", "-", $project_info->title)).'-'.$project_info->id;

        @endphp
        @if(isset($result))
          @foreach($result as $cid=>$value)
          <li @if(isset($value->reply)) class="comments-reply"  @endif>
            <div class="comment">

            @php 

              $userName = DB::table('users')->join('userprofile', 'users.id','=','userprofile.user_id')->select('users.name', 'users.id','userprofile.images')->where('users.id', $value->user_id)->first();
              if(isset($userName->name) && $userName->name != '')
              {
                $seo_name = strtolower(str_replace(" ", "-", $userName->name)).'-'.$userName->id;
              }  else {
                  $seo_name = '';
              }
              if(strlen($seo_name)>4)
                $url = url('message/'.$seo_name.'/'.$seo_title);
              else 
              $url = url('message');  

              if(isset($userName->images) && $userName->images !=''){
                $profile_image = $userName->images;
              } else {
                $profile_image = '1607600694.png';
              }

              @endphp

               <img class="comment-avatar pull-left" alt="" src="{{asset('images/upload/profile')}}/{!! $profile_image !!} ">
               <div class="comment-body">
                  <div class="meta-data">
                     <span class="comment-author">
                      @if(isset($value->user_id))
                        <a href="user/{!! $value->user_id !!}">
                           @if(isset($userName->name))
                             {!! $userName->name !!}  
                             
                          @endif
                        </a>
                        <br>                    
                        <a class="btn btn-primary btn-sm" href="{!! $url !!} ">Sent message</a>
                      @endif  
                     </span>
                     <span class="comment-date pull-right"> 
                        @if(isset($value->time)) {!! $value->time; !!} @endif
                      </span>
                  </div>
                  <div class="comment-content">
                  <p> 
                    @if(isset($value->comments)) 
                      {!! $value->comments; !!} 
                    @elseif(isset($value->reply)) 
                      {!! $value->reply; !!}  
                    @endif 
                  </p>
                </div>
                  
               
                  @if( isset($value->comments) && @Auth::user()->id == $project_info->user_id)
                    <div class="text-right">
                       <a class="comment-reply btn btn-info" onclick="showReplyForm('{!! $cid !!}')"  >Reply</a>
                    </div>
                    <br>
                    <div class="comt_reply" id="reply-form-{!! $cid !!}" >
                       <form method="POST" action="">
                        @csrf
                         <div class="row">
                            <div class="col-md-12">
                               <div class="form-group">
                                  <textarea class="form-control required-field" id="message" name="reply" placeholder="Your Comment" rows="4" required=""></textarea>
                                  <input type="hidden" name="cid" value="{!! $cid !!}">
                               </div>
                            </div><!-- Col 12 end -->

                         </div><!-- Form row end -->
                         <div class="clearfix">
                            <button class="btn btn-primary" type="submit">submit</button> 
                         </div>
                      </form>
                    </div>
                  @endif



               </div>
              </div><!-- Comments end -->
            </li>
          @endforeach
          @endif

      </ul><!-- Comments-list ul end -->
   </div>
   <!-- comment section end -->