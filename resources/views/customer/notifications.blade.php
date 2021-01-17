@extends('layouts.app')

@section('content')
   
   <div class="bidder-dashboard">
      <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <div class="container">
               <div class="topnav" id="myTopnav">
                     @include('customer.myTopnav')               
               </div>
            </div>
         </div>
      </nav>
   </div>

   <section id="main-container" class="main-container">
      <div class="container">
         <div class="row">

               <div class="post-content post-single post-details bidder-login">
                  <div class="post-body">
                     <div class="entry-header">
                        <div class="row">
                           <div class="myinfo_header">
                                 <div class="running-project-header float-left">
                                  <h4>All Notifications </h4>
                              </div>
                               
                           </div>
                           
                        </div>
                     </div><!-- header end -->

                     <div class="myproject">

                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th> S#</th>
                                 <th> Notification Text </th>                            
                                 <th> Status </th>
                              </tr>
                           </thead>
                           <tbody>
                           @php $i=0; @endphp

                           @if(isset($notifications[0]))
                              @foreach($notifications as $row)
                                 @php                                 
                                      $i++;                                 
                                      $action = url($row->action_url);
                                 @endphp
                                  <tr>
                                      <td>{{$i}}</td>
                                      <td><b>{{$row->notification_text}}</b></td>
                                      <td><b> <a href="{!! $action !!}" class="btn btn-success" onclick="ChangeViewAsSeen('{!!$row->id!!}')" > Go -> </a></b></td>
                                  </tr>
                              @endforeach
                           @endif   
                              
                           </tbody>
                        </table>
  

                     </div>
                  </div><!-- post-body end -->
               </div><!-- post content end -->

               <!-- Post comment start -->

         </div><!-- Main row end -->

      </div><!-- Conatiner end -->
   </section><!-- Main container end -->

      <script> 
        function ChangeViewAsSeen(notification_id)
        {
            $.ajax({
                type:'GET',
                url:'{!! url('/notification-seen/?notification_id=') !!}'+notification_id,
                success:function(data){
                    //$('#header-noti-count').html(data);
                }
            });
        }
      </script>

@endsection
