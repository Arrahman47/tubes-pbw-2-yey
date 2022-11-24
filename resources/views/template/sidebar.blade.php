<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if ($role == 1 )
          <li class="nav-item">
            <a href="{{route('admin')}}" class="nav-link @if ($title == 'USER' ){{'active'}} @endif">
              <i class="fas fa-calculator nav-icon"></i>
              <p>User</p>
            </a>
          </li>
          
          @endif
          @if ($role == 2 )
          <li class="nav-item">
            <a href="{{route('user')}}" class="nav-link @if ($title == 'USER' ){{'active'}} @endif">
              <i class="fas fa-calculator nav-icon"></i>
              <p>User</p>
            </a>
          </li>
          
          
          @endif
          <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link ">
              <i class="fas fa-calculator nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>