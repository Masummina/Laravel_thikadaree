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
                                  <h4>My Project Information</h4>
                              </div>
                              <div class="employ_type float-right">
                              <a class="btn btn-success" href="{!! url('dashboard') !!}"> Back to as Applicat</a>
                              </div>
                           </div>
                           
                        </div>
                     </div><!-- header end -->

                     <div class="myproject">

 
           
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>S#</th>      
                              <th>Title</th>
                              <th>Location</th>                              
                              <th>Close Date</th>
                              <th>Prebid meeting</th>                         
                              <th>Total bid</th>
                              <th>Status </th>
                           </tr>
                        </thead>
                        <tbody>
                        @php $i = 0 @endphp
                        @if(isset($my_projectList[0]))
                           @foreach($my_projectList as $p_info)
                           @php 
                                 $i++;
                                 $seo_title = App\User::MakeSeoTitle($p_info->title, $p_info->id);

                                 if($p_info->status == 1){
                                    $status = 'Awarded ';
                                 } else if($p_info->status == 2){
                                    $status = 'Completed';
                                 } else if($p_info->status == 3){
                                    $status = 'Canceled';
                                 } else {
                                    $status = 'Running';
                                 }
                                                                  
                           @endphp
                              <tr>
                                 <td>{{$i}}</td>                                
                                 <td> <a href="{!! url('job-details/'.$seo_title) !!}">{!! @$p_info->title !!}</a></td>
                                 <td>{!! @$p_info->joblocation !!}</td>
                                 <td>{!! @$p_info->close_date !!}</td>
                                 <td>{!! @$p_info->prebit_meeting !!}</td>
                                 <td>{!! @$p_info->t_bid !!}</td> 
                                 <td>{!! @$status !!}</td> 
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

   
@endsection
