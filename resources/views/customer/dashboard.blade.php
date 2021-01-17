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
                                 <h4>Project Information</h4>
                              </div>
                              <div class="employ_type float-right">
                                <a class="btn btn-success" href="{!! url('dashboard') !!}?type=employer"> Go to as Employer</a>
                        
                              </div>
                           </div>
                     		
                     	</div>
                     </div><!-- header end -->

                     <div class="myproject">




                    <div class="layout--tabs">
                      <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" id="tabs-title-region-nav-tabs" role="tablist">
                          <li class="nav-item active">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#block-simple-text-1" aria-selected="false" aria-controls="block-simple-text-1" id="block-simple-text-1-tab">Live Project</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#block-simple-text-2" aria-selected="false" aria-controls="block-simple-text-2" id="block-simple-text-2-tab">Active Project</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#block-simple-text-3" aria-selected="false" aria-controls="block-simple-text-3" id="block-simple-text-3-tab">Archive</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#block-simple-text-4" aria-selected="false" aria-controls="block-simple-text-4" id="block-simple-text-4-tab">Cancelled</a>
                          </li>

                        </ul>
                      </div>
                      <div class="card">
                        <div class="card-body">
                          <div class="tab-content">

            <div id="block-simple-text-1" class="tab-pane active block block-layout-builder block-inline-blockqfcc-blocktype-simple-text" role="tabpanel" aria-labelledby="block-simple-text-1-tab">
             <div class="main_content">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Sn</th>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Location</th>
                              <th>Pro Budget</th>
                              <th>Close Date</th>
                              <th>Prebid meeting</th>
                              <th>Bid money</th>
                              <th>Days</th>
                           </tr>
                        </thead>
                        <tbody>
                        @php $i = 0 @endphp
                        @if(isset($liveprojectList))
                           @foreach($liveprojectList as $liveproject)
                           @php $i++ @endphp
                              <tr>
                                 <td>{{$i}}</td>
                                 <td>{!! @$liveproject->id !!}</td>
                                 <td> <a href="">{!! @$liveproject->title !!}</a></td>
                                 <td>{!! @$liveproject->joblocatio !!}</td>
                                 <td>${!! @$liveproject->min_budget !!} - ${!! @$liveproject->max_budget !!}</td>
                                 <td>{!! @$liveproject->close_date !!}</td>
                                 <td>{!! @$liveproject->prebit_meeting !!}</td>
                                 <td>{!! @$liveproject->money !!}</td>
                                 <td>{!! @$liveproject->days !!}</td>
                              </tr>
                           @endforeach
                        @endif
                           
                        </tbody>
                     </table>
            </div>


          </div>
          <div id="block-simple-text-2" class="tab-pane block block-layout-builder block-inline-blockqfcc-blocktype-simple-text" role="tabpanel" aria-labelledby="block-simple-text-2-tab">
            
                  <div class="main_content">
                  <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Sn</th>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Location</th>
                              <th>Pro Budget</th>
                              <th>Close Date</th>
                              <th>Prebid meeting</th>
                              <th>Bid money</th>
                              <th>Days</th>
                           </tr>
                        </thead>
                        <tbody>
                        @php $i = 0 @endphp
                        @if(isset($activeProjectList))
                           @foreach($activeProjectList as $activeproject)
                           @php $i++ @endphp
                           @if(@$activeproject->status == 1)
                              <tr>
                                 <td>{{$i}}</td>
                                 <td>{!! @$activeproject->id !!}</td>
                                 <td> <a href="">{!! @$activeproject->title !!}</a></td>
                                 <td>{!! @$activeproject->joblocatio !!}</td>
                                 <td>${!! @$activeproject->min_budget !!} - ${!! @$activeproject->max_budget !!}</td>
                                 <td>{!! @$activeproject->close_date !!}</td>
                                 <td>{!! @$activeproject->prebit_meeting !!}</td>
                                 <td>{!! @$activeproject->money !!}</td>
                                 <td>{!! @$activeproject->days !!}</td>
                              </tr>
                              @endif
                           @endforeach
                        @endif
                     </tbody>
                  </table>
            </div>
          </div>
          <div id="block-simple-text-3" class="tab-pane block block-layout-builder block-inline-blockqfcc-blocktype-simple-text" role="tabpanel" aria-labelledby="block-simple-text-3-tab">
                  <div class="main_content">
                  <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Sn</th>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Location</th>
                              <th>Pro Budget</th>
                              <th>Close Date</th>
                              <th>Prebid meeting</th>
                              <th>Bid money</th>
                              <th>Days</th>
                           </tr>
                        </thead>
                        <tbody>
                        @php $i = 0 @endphp
                        @if(isset($activeProjectList))
                           @foreach($activeProjectList as $activeproject)
                           @php $i++ @endphp
                           @if(@$activeproject->status == 2)
                              <tr>
                                 <td>{{$i}}</td>
                                 <td>{!! @$activeproject->id !!}</td>
                                 <td> <a href="">{!! @$activeproject->title !!}</a></td>
                                 <td>{!! @$activeproject->joblocatio !!}</td>
                                 <td>${!! @$activeproject->min_budget !!} - ${!! @$activeproject->max_budget !!}</td>
                                 <td>{!! @$activeproject->close_date !!}</td>
                                 <td>{!! @$activeproject->prebit_meeting !!}</td>
                                 <td>{!! @$activeproject->money !!}</td>
                                 <td>{!! @$activeproject->days !!}</td>
                              </tr>
                              @endif
                           @endforeach
                        @endif
                     </tbody>
                  </table>
            </div>
          </div>
          <div id="block-simple-text-4" class="tab-pane block block-layout-builder block-inline-blockqfcc-blocktype-simple-text" role="tabpanel" aria-labelledby="block-simple-text-4-tab">
                         <div class="main_content">
                         <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Sn</th>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Location</th>
                              <th>Pro Budget</th>
                              <th>Close Date</th>
                              <th>Prebid meeting</th>
                              <th>Bid money</th>
                              <th>Days</th>
                           </tr>
                        </thead>
                        <tbody>
                        @php $i = 0 @endphp
                        @if(isset($activeProjectList))
                           @foreach($activeProjectList as $activeproject)
                           @php $i++ @endphp
                           @if(@$activeproject->status == 3)
                              <tr>
                                 <td>{{$i}}</td>
                                 <td>{!! @$activeproject->id !!}</td>
                                 <td> <a href="">{!! @$activeproject->title !!}</a></td>
                                 <td>{!! @$activeproject->joblocatio !!}</td>
                                 <td>${!! @$activeproject->min_budget !!} - ${!! @$activeproject->max_budget !!}</td>
                                 <td>{!! @$activeproject->close_date !!}</td>
                                 <td>{!! @$activeproject->prebit_meeting !!}</td>
                                 <td>{!! @$activeproject->money !!}</td>
                                 <td>{!! @$activeproject->days !!}</td>
                              </tr>
                              @endif
                           @endforeach
                        @endif
                     </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>








                     </div>
                  </div><!-- post-body end -->
               </div><!-- post content end -->

               <!-- Post comment start -->

         </div><!-- Main row end -->

      </div><!-- Conatiner end -->
   </section><!-- Main container end -->

	
@endsection
