<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('home') }}" class="brand-link text-center">
      <!-- Logo Mini (Solo visible cuando el menú está colapsado) -->
      <img src="{{ url('storage/plantilla/icono-blanco.png') }}" 
           class="brand-image img-circle elevation-3 d-none sidebar-mini-visible"
           style="max-height: 40px; padding: 5px;">

      <!-- Logo Grande (Visible cuando el menú está expandido o en responsive) -->
      <span class="brand-text font-weight-light d-inline sidebar-mini-hidden">
          <img src="{{ url('storage/plantilla/logo-blanco-lineal.png') }}" 
               class="img-fluid"
               style="max-height: 40px; padding: 5px;">
      </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              @if(auth()->user()->photo == '')
                <img src="{{ url('storage/users/anonymous.png')}}" class="img-circle elevation-2" alt="User Image">
              @else
              <img src="{{ url('storage/' .auth()->user()->photo)}}" class="img-circle elevation-2" alt="User Image">
              @endif 
          </div>
          <div class="info">
              <a href="#" class="d-block">{{ auth()->user()->name }}</a>
          </div>
      </div>
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">         
            <li class="nav-item">
                <a href="{{ url('home')}}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Home</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('usuarios')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Usuarios</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('Sucursales')}}" class="nav-link">
                    <i class="nav-icon fas fa-building"></i>
                    <p>Sucursales</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('categorias')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Categorias</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('productos')}}" class="nav-link">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>Productos</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('clientes')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>Clientes</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('ventas')}}" class="nav-link">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>Administrar Ventas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('reportes')}}" class="nav-link">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>Reporte de Ventas</p>
                </a>
            </li>
        
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
