   

 <div class="tab-pane" id="tabs-3" role="tabpanel">
    <!-- bid list start -->
    <div class="tags-area bidlist clearfix">
      <div>
           @if(isset($bid_list[0]))
              @php
                $proTitle =  strtolower(str_replace(" ", "-", $project_info->title));
                $bid_permission = 1;
                if(@Auth::user()->id == $project_info->user_id)
                {
                    $bid_permission = 0;
                }

                if($project_info->security_deposit == 0)
                {
                  $bid_view_permission = 0;
                } else {
                  $bid_view_permission = 1;
                }

                
              @endphp


              @foreach($bid_list as $bidval) 
                @php
                 //$result = str_replace(" ", "-", $bidval->name);
                 //$result = strtolower($result);
                  if(@Auth::user()->id == $bidval->user_id )
                  {
                      $bid_permission = 0;
                  }
               
                  $userName = DB::table('users')->join('userprofile', 'users.id','=','userprofile.user_id')->select('users.name', 'users.id','userprofile.images')->where('users.id', $bidval->user_id)->first();


                  @endphp

                  <div class="post bidlist">
                    <div class="post-body">
                        <div class="left-content">                                
                            <h5 class="title">
                                <div class="job-list" style="max-width: 64px; padding: 10px;">
                                  @if(isset($userName->images) && $userName->images != '' && $bid_view_permission==1)
                                    <img class="images" alt="" src="{{asset('images/upload/profile')}}/{!! $userName->images !!} ">
                                  @else
                                    <img src="{{url('images/upload/profile/1607600694.png')}}">
                                  @endif
                                </div>
                                <a href="{{url('users')}}-{!! $bidval->user_id !!}?pid={{$projectId}}&prouid={!! $project_info->user_id !!}">
                                  {!! App\User::PrintBidInfo($bidval->name,$bid_view_permission)   !!}
                                </a>
                              </h5>  

                              @php 
          
                                $seo_title = strtolower(str_replace(" ", "-", $project_info->title).'-'.$project_info->id);
                                $seo_name = strtolower(str_replace(" ", "-", $bidval->name).'-'.$bidval->user_id);
                                
                                if(strlen($seo_name)>4 && $bid_view_permission==1 )
                                  $url = url('message/'.$seo_name.'/'.$seo_title);
                                else 
                                  $url = '#';  
                                
                              @endphp

                              <a class="btn btn-primary btn-sm" href="{!! $url !!} ">Sent message</a> 

                              <p> {!! App\User::PrintBidInfo($bidval->discription,$bid_view_permission)   !!}   </p>
                                                                
                        </div>

                        <div class="entry-header text-right good">
                            <div class="right-content">
                                <span class="max-min-price">
                                    <strong>Price:</strong> 
                                    <span class="min-prc">
                                        ${!! App\User::PrintBidInfo($bidval->bid_amount,$bid_view_permission) !!} USD
                                    </span> 
                                    <span class="max-price"></span> 
                                    <br> in  {!! App\User::PrintBidInfo($bidval->days,$bid_view_permission) !!} days
                                </span>
                            </div>
                            <div class="button_classs">
                                @if(@Auth::user()->id == $project_info->user_id)
                                  @if($project_info->win_bid_id == 0 && $bid_view_permission == 1 )
                                    <a href="{!! url('project-win/?project_id='.$project_info->id.'&bid_id='.$bidval->id) !!}" class="btn btn-info btn-sm goodness" > Hiring</a>
                                  @endif
                                  @if($bidval->win != 0) 
                                    <b style="color: blue" > Hired </b>  
                                  @endif 
                                @else
                                    <p class=" btn-sm btn-info goodness">Running</p>
                                    @if($bidval->user_id == @Auth::user()->id) 
                                      <a class="btn-sm btn-danger" href="{{url('projects'.'/'.$proTitle.'-'.$project_info->id)}}?userid={!! $bidval->user_id; !!}#updatebid">edit</a>
                                    @endif
                                @endif   
                            </div> 
                        </div>
                    </div>
                  </div>
              @endforeach 
            @else
              No bid yet.  
            @endif
          </div>
       </div>
       <!-- bid list End -->
  </div>
 
    
   