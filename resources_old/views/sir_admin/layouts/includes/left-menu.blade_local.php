 <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
       

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <?php 
          $url = $_SERVER['REQUEST_URI'];
          $url = substr($url, 0, strrpos( $url, '?'));
          $project_view = $_SERVER['REQUEST_URI'];
          $project_view = substr($project_view, 0, strrpos( $project_view, '/'));
           ?>
          <li class="header">MAIN NAVIGATION</li>
         
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/dashboard') { echo 'active'; }?>">
            <a href="{{ url('dashboard') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
            <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/activity') { echo 'active';} ?> <?php if($url=='/activity/create') { echo 'active';} ?>">
            <a href="{{ url('activity') }}">
              <i class="fa fa fa-bell-o"></i> <span> All Activity </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
          </li>
         
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/customers/create') { echo 'active';} ?> <?php if($_SERVER['REQUEST_URI']=='/prospects') { echo 'active';} ?>">
            <a href="{{ url('prospects') }}">
              <i class="fa fa-edit"></i> <span> All Prospects </span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
          </li>

          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/customers') { echo 'active';} ?>">
            <a href="{{ url('customers') }}">
              <i class="fa fa-user"></i> <span> All Clients </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>

        
          @if (Auth::user()->group_id == "1" || Auth::user()->group_id == "2")
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/notifications') { echo 'active';} ?> ">
            <a href="{{ url('notifications') }}">
              <i class="fa fa-fw fa-commenting"></i> <span> All Notification </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
          </li>
          @if (Auth::user()->group_id == "1")
            <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/payment-notification') { echo 'active';} ?>  ">
            <a href="{{ url('payment-notification') }}">
             <i class="fa fa-dollar"></i> <span>Payment Notification</span>
              <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
              </span>
                         </a>
                     </li>
                      @endif
          @endif
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/commonbin') { echo 'active';} ?>">
            <a href="{{ url('commonbin') }}">
              <i class="fa fa-fw fa-cube"></i> <span> Common Bin </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
          </li>
          @if (Auth::user()->group_id != "3")
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/project') { echo 'active';} ?> <?php if($project_view =='/project-property') { echo 'active';} ?> ">
            <a href="{{ url('project') }}">
              <i class="fa fa fa-university"></i> <span>Project Manager </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          @endif
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/users') { echo 'active';} ?>">
            <a href="{{ url('users') }}">
              <i class="fa fa fa-users"></i> <span>User Manager</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          @if (Auth::user()->group_id == "1")
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/team') { echo 'active';} ?>">
            <a href="{{ url('team') }}">
              <i class="fa fa-dedent"></i> <span>Manage Team</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview <?php if($_SERVER['REQUEST_URI']=='/account') { echo 'active';} ?>">
            <a href="{{ url('account') }}">
              <i class="fa fa-file"></i> <span>Manage Account</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview  <?php if($_SERVER['REQUEST_URI']=='/payment') { echo 'active';} ?>">
            <a href="{{ url('payment') }}">
              <i class="fa fa-dollar"></i> <span>Manage Payment</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
          
          @endif
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
      </section>
      <!-- /.sidebar -->
</aside>