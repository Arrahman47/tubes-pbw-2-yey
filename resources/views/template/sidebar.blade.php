<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#2C3333" >

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <h6><b class="font-weight-light" style="color: #E7F6F2">LAUNDRYGO</b></h6>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if ($role == 2 )
          <li class="nav-item">
            <a href="{{route('admin')}}" class="nav-link @if ($title == 'DASHBOARD' ){{'active'}} @endif">
              <i class="fas fa-landmark nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin_layanan')}}" class="nav-link @if ($title == 'LAYANAN' ){{'active'}} @endif">
              <i class="fas fa-landmark nav-icon"></i>
              <p>Layanan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin_promo')}}" class="nav-link @if ($title == 'PROMO' ){{'active'}} @endif">
              <i class="fas fa-landmark nav-icon"></i>
              <p>Promo</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin_user')}}" class="nav-link @if ($title == 'USER' ){{'active'}} @endif">
              <i class="fas fa-calculator nav-icon"></i>
              <p>User</p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{route('admin_transaksi')}}" class="nav-link @if ($title == 'TRANSAKSI' ){{'active'}} @endif">
              <i class="fas fa-calculator nav-icon"></i>
              <p>Transaksi</p>
            </a>
          </li> 
          
          
          @endif
          @if ($role == 1 )
          <li class="nav-item">
            <a href="{{route('user')}}" class="nav-link @if ($title == 'PEMESANAN' ){{'active'}} @endif">
              <i class="fas fa-calculator nav-icon"></i>
              <p>Pemesanan</p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{route('user_history')}}" class="nav-link @if ($title == 'HISTORY' ){{'active'}} @endif">
              <i class="fas fa-calculator nav-icon"></i>
              <p>History</p>
            </a>
          </li> 
          @endif

          <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link ">
              <i class="fas fa-power-off nav-icon"></i>
              <p>Sign Out</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>