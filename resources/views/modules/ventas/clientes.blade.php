@extends('welcome')

@section('home')

  
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Clientes</h1>
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
                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar"><i class="fas fa-plus"></i> Agregar Clientes</a>                   
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="listado" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Email</th>   
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Total Compras</th>
                        <th>Ultima Compra</th>                  
                        <th>Accion</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($clientes as $key => $cliente)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->documento }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>{{ $cliente->fecha_nacimiento }}</td>
                        <td></td>
                        <td></td>
                        <td><button class="btn btn-warning btn-sm btnEditarCliente" data-toggle="modal" data-target="#modal-editar" idcliente="{{ $cliente->id }}"><i class="fas fa-edit"></i></button></td>                       
                      </tr>


                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Email</th>   
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Total Compras</th>
                        <th>Ultima Compra</th>                  
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
                        <h4 class="modal-title">Agregar Clientes</h4>
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
                                    <input type="text" class="form-control" placeholder="Ingresa Nombre" name="nombre" required> 
                                  </div>
                            </div> 
                            <div class="col-12 col-sm-12">
                              <div class="input-group mb-3">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-key"></span>
                                      </div>
                                    </div>
                                  <input type="text" class="form-control" placeholder="Ingresa Documento" id="nuevoDocumento" name="documento" required> 
                                </div>
                          </div>   
                          <div class="col-12 col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                    </div>
                                  </div>
                                <input type="email" class="form-control" placeholder="Ingresa Email" name="email" required> 
                              </div>
                        </div>   
                        <div class="col-12 col-sm-12">
                          <div class="input-group mb-3">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                  </div>
                                </div>
                              <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-999"'
                              data-mask placeholder="Ingresa Telefono" name="telefono" required> 
                            </div>
                      </div> 
                      <div class="col-12 col-sm-12">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                  <span class="fas fa-map-marker"></span>
                                </div>
                              </div>
                            <input type="text" class="form-control" placeholder="Ingresa Direccion" name="direccion" required> 
                          </div>
                    </div>  
                    <div class="col-12 col-sm-12">
                      <div class="input-group mb-3">
                          <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-calendar"></span>
                              </div>
                            </div>
                          <input type="text" class="form-control" placeholder="Ingresa Fecha de Nacimiento" data-inputmask-alias="datetime"
                          data-inputmask-inputformat="dd/mm/yyyy"
                          data-mask name="fecha_nacimiento" required> 
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

    <div class="modal fade" id="modal-editar">
      <div class="modal-dialog">
          <form method="post" action="">
              @csrf
              <div class="modal-content">
                  <div class="modal-header bg-dark" style="color: white;">
                      <h4 class="modal-title">Editar Clientes</h4>
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
                                  <input type="text" class="form-control" placeholder="Ingresa Nombre" id="nombreClienteEditar" name="nombre" required>
                                  <input type="hidden" class="form-control" id="idClienteEditar" name="id">  
                                </div>
                          </div> 
                          <div class="col-12 col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-key"></span>
                                    </div>
                                  </div>
                                <input type="text" class="form-control" placeholder="Ingresa Documento" id="nuevoDocumentoEditar" name="documento" required> 
                              </div>
                        </div>   
                        <div class="col-12 col-sm-12">
                          <div class="input-group mb-3">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                  </div>
                                </div>
                              <input type="email" class="form-control" placeholder="Ingresa Email" id="emailEditar" name="email" required> 
                            </div>
                      </div>   
                      <div class="col-12 col-sm-12">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                  <span class="fas fa-phone"></span>
                                </div>
                              </div>
                            <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-999"'
                            data-mask placeholder="Ingresa Telefono" id="telefonoEditar" name="telefono" required> 
                          </div>
                    </div> 
                    <div class="col-12 col-sm-12">
                      <div class="input-group mb-3">
                          <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-map-marker"></span>
                              </div>
                            </div>
                          <input type="text" class="form-control" placeholder="Ingresa Direccion" id="direccionEditar" name="direccion" required> 
                        </div>
                  </div>  
                  <div class="col-12 col-sm-12">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-calendar"></span>
                            </div>
                          </div>
                        <input type="text" class="form-control" placeholder="Ingresa Fecha de Nacimiento" data-inputmask-alias="datetime"
                        data-inputmask-inputformat="dd/mm/yyyy"
                        data-mask id="fechaNacimientoEditar" name="fecha_nacimiento" required> 
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