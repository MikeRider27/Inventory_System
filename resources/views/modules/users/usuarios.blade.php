@extends('welcome')

@section('home')

  
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Usuarios</h1>
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
            <div class="col-12">
    
              <div class="card">
                <div class="card-header py-3">
                  <div class="float-left">
                    <h3 class="card-title" style="display: inline-block;"></h3>
                  </div>
                  <div class="float-right">                 
                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar"><i class="fas fa-plus"></i> Agregar Usuario</a>                   
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="listado" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Sucursal</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Ultimo login</th>
                        <th>Accion</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($usuarios as $key => $user)
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>
                              @if(empty($user->photo))
                                  <img src="{{ url('storage/users/anonymous.png') }}" class="img-fluid" style="max-height: 40px; padding: 5px;">
                              @else
                                  <img src="{{ url('storage/' . $user->photo) }}" class="img-fluid" style="max-height: 40px; padding: 5px;">
                              @endif
                          </td>
                          <td>
                              @if($user->rol != 'Administrador')
                                  {{ $user->sucursal->nombre }}                          
                              @endif
                          </td>                         
                          <td>{{ $user->rol }}</td>
                          <td>
                              @if($user->estado == 1)
                                  <span class="badge badge-success">Activo</span>
                              @else
                                  <span class="badge badge-danger">Inactivo</span>
                              @endif
                          </td>
                          <td>{{ $user->last_login }}</td>
                          <td>
                            @if($user->estado == 1)
                              <button class="btn btn-danger btn-sm btnEstadoUser" Uid="{{ $user->id }}" estado="0"><i class="fas fa-lock"></i></button>
                            @else
                              <button class="btn btn-success btn-sm btnEstadoUser" Uid="{{ $user->id }}" estado="1"><i class="fas fa-lock-open"></i></button>
                            @endif
                          </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                 
                    
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Sucursal</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Ultimo login</th>
                        <th>Accion</th>                             
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <div class="modal fade" id="modal-agregar">
      <div class="modal-dialog">
          <form method="post" action="">
              @csrf
              <div class="modal-content">
                  <div class="modal-header bg-dark" style="color: white;">
                      <h4 class="modal-title">Crear Usuario</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-12 col-sm-12">
                              <div class="input-group mb-3">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                      </div>
                                    </div>
                                  <input type="text" class="form-control" placeholder="Ingresa Nombre" name="name" required>
                                 
                                </div>
                          </div> 
                          <div class="col-12 col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                    </div>
                                  </div>
                                <input type="text" class="form-control" placeholder="Ingresa Email" name="email" required>
                               
                              </div>
                        </div> 
                        @error('email')
                        <script type="text/javascript">
                          document.addEventListener("DOMContentLoaded", function () {
                            toastr.error('El email ya se encuentra registrado');
                          });
                        </script>
                        @enderror
                        <div class="col-12 col-sm-12">
                          <div class="input-group mb-3">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                  </div>
                                </div>
                              <input type="password" class="form-control" placeholder="Ingresa Contraseña" name="password" required>
                             
                            </div>
                      </div> 
                      <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-users"></i>
                                </span>
                            </div>
                            <select class="form-control select2bs4 selectRol" id="rol" name="rol">
                                <option value="">Seleccione Rol</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Encargado">Encargado</option>
                                <option value="Vendedor">Vendedor</option>
                            </select>
                        </div>
                    </div>                 
                  <div class="col-12 selectSucursal" style="display: none;">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-building"></i>
                            </span>
                        </div>
                        <select class="form-control select2bs4" id="id_sucursal" name="id_sucursal">
                            <option value="">Seleccione Sucursal</option>
                            @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                            @endforeach
                           
                        </select>
                    </div>
                </div>
                                           
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>                    
                      <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
                  </div>
              </div>
          </form>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
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