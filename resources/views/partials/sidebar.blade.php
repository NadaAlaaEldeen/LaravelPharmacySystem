<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="dist/img/images/logo1.gif" alt="pharmacy Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light">Pharmacy System</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
          @role('doctor')
            <a href="{{route('doctors.index')}}" class="nav-link">
            @else
            @role('admin')
            <a href="{{route('admins.index')}}" class="nav-link">
            @else
            <a href="#" class="nav-link">
            @endrole
            @endrole
            <img src="dist/img/images/pharmacyicon.png" class="nav-icon">
              <p>
              Pharmacies
              </p>
            </a>
          </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <img src="dist/img/images/doctorsicon.png" class="nav-icon">
            <p>
              Doctors
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link">
            <img src="dist/img/images/usericon.png" class="nav-icon">
            <p>
              Users
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <img src="dist/img/images/areaicon.png" class="nav-icon" style="height:3vh">
            <p>
              Areas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <img src="dist/img/images/addressicon.png" class="nav-icon" style="height:5vh">
            <p>
              User Addresses
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <img src="dist/img/images/medicineicon.png" class="nav-icon">
            <p>
              Medicines
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <img src="dist/img/images/ordericon.png" class="nav-icon">
            <p>
              Orders
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <img src="dist/img/images/revenueicon.png" class="nav-icon">
            <p>
              Revenue
            </p>
          </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>