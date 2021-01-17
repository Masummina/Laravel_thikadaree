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
            
          <li class="treeview <?php if($parm=='/project' || $parm=='/apartment') { echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-university" aria-hidden="true"></i><span>Project Manager</span>
                <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview <?php if($parm=='/project') { echo 'active';} ?> <?php if($project_view =='/project-property') { echo 'active';} ?> ">
                  <a href="{{ url('bem-projects') }}">
                    <i class="fa fa fa-university"></i> <span>Project List </span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('bem-categories') }}">
                    <i class="fa fa-building-o" aria-hidden="true"></i> <span> Apartment List  </span>
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
                  <a href="{{ url('project-wise-report') }}">
                      <i class="fa fa-table" aria-hidden="true"></i><span> Projectwise Report  </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('monthly-filtering') }}">
                      <i class="fa fa-table" aria-hidden="true"></i><span> Monthly Filtering Report  </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                    <a href="{{ url('filtering-report') }}">
                        <i class="fa fa-table" aria-hidden="true"></i> <span> Filtering Report  </span>
                      <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                    </a>
                  </li>
                <li class="treeview">
                  <a href="{{ url('technican-report') }}">
                      <i class="fa fa-table" aria-hidden="true"></i> <span> Technician Report  </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('top-sheet') }}">
                      <i class="fa fa-table" aria-hidden="true"></i> <span>Category Top Sheet  </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
  
              </ul>
            </li>
             
            <li class="treeview <?php if($parm=='/invoice') { echo 'active'; }?>">
                <a href="#">
                  <i class="fa fa-dollar"></i> <span>Manage Payments </span>
                  <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                  
                    <li class="treeview">
                      <a href="{{ url('invoice') }}">
                        <i class="fa fa-list-alt" aria-hidden="true"></i> <span> Invoice List </span>
                        <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="{{ url('pay/history') }}">
                        <i class="fa fa-list-alt" aria-hidden="true"></i> <span> Payment History </span>
                        <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                      </a>
                    </li>
                    
                    
                </ul>
              </li>

            <li class="treeview <?php if($parm=='/manage-settings') { echo 'active'; }?>">
              <a href="#">
                <i class="fa fa-cog"></i> <span>Settings</span>
                <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview">
                  <a href="{{ url('manage-settings/complain_type') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Complain type </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/service_mode') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Service Mode </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/com_status') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Complaint Status </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/assign') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Assign </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/com_prio') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Complaint Priority </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/com_src') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Complain Source </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/area') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Area </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/project_type') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Project Type </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/apt_type') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Apartment Type </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/city') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage City </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('manage-settings/zone') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span> Manage Zone </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ url('account-settings') }}">
                      <i class="fa fa-cogs" aria-hidden="true"></i> <span> Account Settings </span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="treeview <?php if($parm=='/materials') { echo 'active'; }?>">
                <a href="{{ url('materials') }}">
                    <i class="fa fa-cubes" aria-hidden="true"></i> <span>Manage Materials</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
            </li>
            <li class="treeview <?php if($parm=='/change-password') { echo 'active'; }?>">
              <a href="{{ url('change-password') }}">
                <i class="fa fa fa-key"></i> <span>Change Password</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
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