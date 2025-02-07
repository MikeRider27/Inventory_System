<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->

      <li class="nav-item dropdown">
      <li class="dropdown user user-menu">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">            
              @if(auth()->user()->photo == '')
                <img src="{{ url('storage/users/anonymous.png')}}" class="user-image" alt="User Image">
              @else
              <img src="{{ url('storage/' .auth()->user()->photo)}}" class="user-image" alt="User Image">
              @endif 
              <span class="hidden-xs">{{ auth()->user()->name }}</span>                      
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">

              @if(auth()->user()->photo == '')
                <img src="{{ url('storage/users/anonymous.png')}}" class="img-circle" alt="User Image">
              @else
              <img src="{{ url('storage/' .auth()->user()->photo)}}" class="img-circle" alt="User Image">
              @endif

              
                <p>
                  {{ auth()->user()->name }}
                    <small> {{ auth()->user()->rol }}</small>
                </p>
            </li>
            <!-- Menu Footer -->
            <li class="user-footer">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ url('Perfil')}}" class="btn btn-primary btn-flat"><i class="fa fa-user"></i> Perfil</a>
                    </div>
                    <div class="ml-auto">
                        <a href="{{ route('logout')}}" class="btn btn-danger btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Salir</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
        
      </li>
      </li>


  </ul>

  </nav>