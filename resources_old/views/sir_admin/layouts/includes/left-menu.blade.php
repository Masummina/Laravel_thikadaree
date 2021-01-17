 <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar" >
      <div style="height: 600px !important; overflow-y: scroll;" >
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            @if(Auth::user()->photo!='')
              <img src="{{ asset('img/'.Auth::user()->photo) }}" class="img-circle" alt="User Image" style=" height: 50px; width: 50px; max-width: none;">
            @else
              <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" style=" height: 50px; width: 50px; max-width: none;">
            @endif
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <?php 
          
          $url_repace = $_SERVER['REQUEST_URI'];
          $url_repace = str_replace("/property/property", "", $url_repace);
          $url = $url_repace;
          $url = substr($url, 0, strrpos( $url, '?'));
          $project_view = $url_repace;
          $project_view = substr($project_view, 0, strrpos( $project_view, '/'));
           ?>
          <li class="header">MAIN NAVIGATION</li>
         
          <li class="treeview <?php if($url_repace=='/dashboard') { echo 'active'; }?>">
            <a href="{{ url('dashboard') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
            <li class="treeview <?php if($url_repace=='/activity') { echo 'active';} ?> <?php if($url=='/activity/create') { echo 'active';} ?>">
            <a href="{{ url('activity') }}">
              <i class="fa fa fa-bell-o"></i> <span> All Activity </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
          </li>
         
          <li class="treeview <?php if($url_repace=='/prospects') { echo 'active';} ?> <?php if($_SERVER['REQUEST_URI']=='/prospects') { echo 'active';} ?>">
            <a href="{{ url('prospects') }}">
              <i class="fa fa-edit"></i> <span> All Prospects </span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
          </li>

          <li class="treeview <?php if($url_repace=='/pre-schedules') { echo 'active';} ?> <?php if($_SERVER['REQUEST_URI']=='/pre-schedules') { echo 'active';} ?>">
            <a href="{{ url('pre-schedules/all') }}">
              <i class="fa fa-edit"></i> <span> All Payment Schedules </span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
          </li>

          <li class="treeview <?php if($url_repace=='/hbd') { echo 'active';} ?> <?php if($_SERVER['REQUEST_URI']=='/hbd') { echo 'active';} ?>">
            <a href="{{ url('hbd') }}">
              <i class="fa fa-edit"></i> <span> Greeting / Wishes  </span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
          </li>
          <li class="treeview <?php if($url_repace=='/customers') { echo 'active';} ?>">
            <a href="{{ url('customers') }}">
              <i class="fa fa-user"></i> <span> All Clients </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
            <li class="treeview <?php if($url_repace=='/notifications') { echo 'active';} ?> ">
              <a href="{{ url('notifications') }}">
                <i class="fa fa-fw fa-commenting"></i> <span> All Notification </span>
                <span class="pull-right-container">
                  @php
                    $group_id = Auth::user()->group_id;
                    $user_id = Auth::user()->id;
                    if($group_id<3)
                    {
                      $notification_count = DB::table('notifications')
                                 ->selectRaw("count(`id`) as total")                       
                                 ->where('viewed_admin','0')
                                 ->first();
                    } else {
                      $notification_count = DB::table('notifications')
                         ->selectRaw("count(`id`) as total")
                         //->where('user_new','=', $user_id)
                         ->where('user_already','=', $user_id)
                         ->where('viewed','0')
                         ->first();
                    }
                    if(isset($notification_count->total) && $notification_count->total>0)
                      $NC_total ='<span class="pull-right-container"><small class="label pull-right bg-red" id="left-noti-count">'.$notification_count->total.'</small> </span>';
                    else
                      $NC_total = '';
                  @endphp
                  <span id="left-noti-count">{!! $NC_total !!}</span>
                </span>
              </a>
            </li>
        
          @if (Auth::user()->group_id == "1" || Auth::user()->group_id == "2")
          @if (Auth::user()->group_id == "1")
            <!--<li class="treeview <?php if($url_repace=='/payment-notification') { echo 'active';} ?>  ">
            <a href="{{ url('payment-notification') }}">
             <i class="fa fa-dollar"></i> <span>Payment Notification</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
             </a>
            </li> -->
          @endif
          @endif
          <li class="treeview <?php if($url_repace=='/commonbin') { echo 'active';} ?>">
            <a href="{{ url('commonbin') }}">
              <i class="fa fa-fw fa-cube"></i> <span> Common Bin </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview <?php if($url_repace=='/project') { echo 'active';} ?> <?php if($project_view =='/project-property') { echo 'active';} ?> ">
            <a href="{{ url('project') }}">
              <i class="fa fa fa-university"></i> <span>Project Manager </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview <?php if($url_repace=='/users') { echo 'active';} ?>">
            <a href="{{ url('users') }}">
              <i class="fa fa fa-users"></i> <span>User Manager</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          @if (Auth::user()->group_id == "1")
          <li class="treeview <?php if($url_repace=='/team') { echo 'active';} ?>">
            <a href="{{ url('team') }}">
              <i class="fa fa-dedent"></i> <span>Manage Team</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview <?php if($url_repace=='/account') { echo 'active';} ?>">
            <a href="{{ url('account') }}">
              <i class="fa fa-file"></i> <span>Manage Account</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview  <?php if($url_repace=='/payment') { echo 'active';} ?>">
            <a href="{{ url('payment') }}">
              <i class="fa fa-dollar"></i> <span>Manage Payment</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          
          @endif
          @if (Auth::user()->group_id == "1" || Auth::user()->group_id == "2")
              <li class="treeview <?php if($url_repace=='/manage-target') { echo 'active';} ?> ">
                <a href="{{ url('manage-target') }}">
                  <i class="fa fa-fw fa-commenting"></i> <span> Manage Target </span>
                  <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
                </a>
              </li>
          @endif
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Reports</span>
                <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/users') { echo 'active';} ?>">
                  <a href="{{ url('individual-prospect-report') }}">
                    <i class="fa fa fa-users"></i> <span> Individual Prospect </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/individual-details-report') { echo 'active';} ?>">
                  <a href="{{ url('individual-details-report') }}">
                    <i class="fa fa fa-users"></i> <span> Primary, Secondary, Near to Close </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                @if(Auth::user()->group_id == 1)
                  <li class="treeview <?php if($url_repace=='/activity-report') { echo 'active';} ?> ">
                    <a href="{{ url('activity-report') }}">
                      <i class="fa fa-fw fa-commenting"></i> <span> Teamwise Activity Report </span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                      </span>
                    </a>
                  </li>
                  <li class="treeview <?php if($url_repace=='/areawise-report') { echo 'active';} ?> ">
                    <a href="{{ url('areawise-report') }}">
                      <i class="fa fa fa-university"></i> <span> Area wise Apartments Report </span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                      </span>
                    </a>
                  </li>
                  <li class="treeview <?php if($url_repace=='/professionwise-report') { echo 'active';} ?> ">
                    <a href="{{ url('profession-wise-report') }}">
                      <i class="fa fa fa-users"></i> <span> Profession Wise Report </span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                      </span>
                    </a>
                  </li>
                  <li class="treeview <?php if($url_repace=='/achievements-vs-targets') { echo 'active';} ?> ">
                    <a href="{{ url('achievements-vs-targets') }}">
                      <i class="fa fa-fw fa-commenting"></i> <span> Individual Target vs Achiev  </span>
                      <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
                  </li>
                  <li class="treeview <?php if($url_repace=='/achievements-vs-targets') { echo 'active';} ?> ">
                    <a href="{{ url('team-targets-vs-achievements') }}">
                      <i class="fa fa-fw fa-commenting"></i> <span> Team Wise Target vs Achiev  </span>
                      <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span>
                    </a>
                  </li>
                @endif
                 
              </ul>
            </li>
          @if (Auth::user()->group_id == "3" || Auth::user()->group_id == "4")
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/users') { echo 'active';} ?>">
            <a href="{{ url('individual-prospects') }}">
              <i class="fa fa fa-users"></i> <span> Individual Prospects </span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
          </li>
          @endif
          @if (Auth::user()->group_id == "3" || Auth::user()->group_id == "4")
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/individual-details') { echo 'active';} ?>">
            <a href="{{ url('individual-details') }}">
              <i class="fa fa fa-users"></i> <span> Primary, Secondary, Near to Close </span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
          </li>
          @endif
          @if (Auth::user()->group_id == "1" || Auth::user()->group_id == "2")
            <li class="treeview <?php if($url_repace=='/professions') { echo 'active';} ?> ">
              <a href="{{ url('professions') }}">
                <i class="fa fa-fw fa-commenting"></i> <span> Professions </span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
              </a>
            </li>
          @endif
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i> <span>Settings</span>
                <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/money-receipt-sign') { echo 'active';} ?>">
                  <a href="{{ url('money-receipt-sign') }}">
                    <i class="fa fa-edit"></i> <span> Money Receipt Sign </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
              </ul>
            </li>
          <li class="treeview">            
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="fa fa-edit"></i> <span>Logout</span>
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