@extends('welcome')

@section('home')

  
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Perfil</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- General form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-cog"></i> Gestor de Perfil</h3>
                </div>
                <!-- /.card-header -->
                <!-- Form start -->
                <form method="post" action="" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="name" name="name" 
                               required value="{{ auth()->user()->name }}" placeholder="Ingrese su nombre">
                      </div>
                    </div>
            
                    <div class="form-group">
                      <label for="email">Email</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" id="email" name="email" 
                               required value="{{ auth()->user()->email }}" placeholder="Ingrese su correo">
                      </div>
                    </div>
            
                    <div class="form-group">
                      <label for="password">Contraseña</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Ingrese su nueva contraseña" autocomplete="new-password">
                      </div>
                    </div>
            
                    <div class="form-group">
                      <label for="photo">Foto de Perfil</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="photo" name="photo">
                          <label class="custom-file-label" for="photo">Seleccionar archivo</label>
                        </div>
                      </div>
            
                      <div class="mt-3">
                        @if(auth()->user()->photo != '')
                          <img src="{{ url('storage/' . auth()->user()->photo) }}" class="img-thumbnail" 
                               alt="User Image" style="width: 100px; height: 100px;">
                        @else
                          <img src="{{ url('storage/users/anonymous.png') }}" class="img-thumbnail"
                               alt="User Image" style="width: 100px; height: 100px;">
                        @endif
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
            
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            
            <!--/.col (left) -->
            <!-- right column -->
           
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2025 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>
  
    <!-- Control Sidebar -->
  
   

@endsection