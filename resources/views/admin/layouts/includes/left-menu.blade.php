 <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar" >
      <div  >
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            @if(Auth::user()->photo!='')
              <img src="{{ asset('img/'.Auth::user()->photo) }}" class="img-circle" alt="User Image" style=" height: 30px; width: 30px; max-width: none;">
            @else
              <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" style=" height: 30px; width: 30px; max-width: none;">
            @endif
          </div>
          <div class="pull-left info">
              <a href="#"><i class="fa fa-circle text-success"></i> {{ Auth::user()->name }} </a>             
          </div>

          <li class="dropdown notifications-menu">

									<a href="{{ url('bem-notifications') }}" class="dropdown-toggle"  >

									@php									 
										$user_id = Auth::user()->id;
										 
										$notification_count = DB::table('notifications')
											->selectRaw("count(`id`) as total")                       
											->where('user_id', $user_id )
											->where('status','0')
											->first();
									 

										if(isset($notification_count->total) && $notification_count->total>0)
											$NC_total ='<i class="fa fa-bell-o"></i> <span class="label label-warning" >'.$notification_count->total.'</span>';
										else
											$NC_total = '';
											
									@endphp

										<span id="header-noti-count">{!! $NC_total !!}</span>

									</a>

								</li>



						<script type="text/javascript">

							var ajax_call = function() {
								$.ajax({
									type:'GET',
									url:'{!! url('/get-notification-count/?pos=head') !!}',
									success:function(data){
										$('#header-noti-count').html(data);
									}
								});
							};

							var interval = 1000 * 60 * 0.5; // where X is your every X minutes
							setInterval(ajax_call, interval);

							var ajax_call_left = function() {
								$.ajax({
									type:'GET',
									url:'{!! url('/get-notification-count') !!}',
									success:function(data){
										$('#left-noti-count').html(data);
									}
								});
							};

							var interval2 = 1000 * 60 * 0.5; // where X is your every X minutes
							setInterval(ajax_call_left, interval2);

            </script>
            

        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

        <?php           
            $parm = $_SERVER['REQUEST_URI'];
            //$parm = str_replace("/", "_", $url_repace);
            $url = $parm;
            $url = substr($url, 0, strrpos( $url, '?'));
            $project_view = $parm;
            $project_view = substr($project_view, 0, strrpos( $project_view, '/'));
        ?>

 
         
          <li class="treeview <?php if($parm=='/dashboard') { echo 'active'; }?>" >
            <a href="{{ url('dashboard') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>

         
          <li class="treeview <?php if(strstr($parm,'/complains')) { echo 'active'; }?>"  >
              <a href="#">
                <i class="fa fa-laptop" aria-hidden="true"></i> <span> Manage Complains </span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                  <li class="treeview">
                      <a href="{{ url('complains/create') }}">
                         <i class="fa fa-plus-square-o" aria-hidden="true"></i> <span> New Complain </span>
                          <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                      </a>
                  </li>
                  <li class="treeview">
                    <a href="{{ url('complains') }}">
                      <i class="fa fa-list-alt" aria-hidden="true"></i> <span> Complain List </span>
                      <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                    </a>
                  </li>                   
              </ul>
            </li>

            <li class="treeview <?php if(strstr($parm,'/estimations')) { echo 'active'; }?>"  >
              <a href="#">
                <i class="fa fa-calculator" aria-hidden="true"></i> <span> Manage Estimation </span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                  <li class="treeview">
                      <a href="{{ url('new-estimation') }}">
                         <i class="fa fa-plus-square-o" aria-hidden="true"></i> <span> New Estimation </span>
                          <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                      </a>
                  </li>
                  <li class="treeview">
                    <a href="{{ url('estimations') }}">
                      <i class="fa fa-list-alt" aria-hidden="true"></i> <span> Estimation List </span>
                      <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                    </a>
                  </li>                      
              </ul>
            </li>
            
       
          
          <li class="treeview <?php if($parm=='/users') { echo 'active';} ?>">
            <a href="{{ url('bem-users') }}">
              <i class="fa fa fa-users"></i> <span>User Manager</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview <?php if($parm=='/users') { echo 'active';} ?>">
            <a href="{{ url('bem-posts') }}">
              <i class="fa fa fa-users"></i> <span>Posts</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview <?php if($parm=='/bem-categories') { echo 'active';} ?>">
            <a href="{{ url('bem-categories') }}">
              <i class="fa fa fa-users"></i> <span> Category Manager </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
  
            @php 
              if($parm =='/project-wise-report' || $parm =='/monthly-filtering' || $parm =='/filtering-report' || $parm =='/technican-report' || $parm =='/top-sheet')
              { $parm = 'report'; }  
            @endphp
            <li class="treeview <?php if($parm=='report') { echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Reports</span>
                <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview">
                  <a href="{{ url('bem-remittance') }}">
                      <i class="fa fa-table" aria-hidden="true"></i><span> Remittance  </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('bem-transactions') }}">
                      <i class="fa fa-table" aria-hidden="true"></i><span> Transactions  </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('bem-charge') }}">
                      <i class="fa fa-table" aria-hidden="true"></i><span> Bid Charge  </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('bem-settings') }}">
                      <i class="fa fa-table" aria-hidden="true"></i><span> Settings  </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
              </ul>
            </li>
             

  

          <li class="treeview">            
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </li>                         
        </ul>
      </div>
      </section>
      <!-- /.sidebar -->
</aside>