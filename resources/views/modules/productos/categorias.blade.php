@extends('welcome')

@section('home')

  
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Categorias</h1>
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
                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar"><i class="fas fa-plus"></i> Agregar Categoria</a>                   
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="listado" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>                     
                        <th>Accion</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($categorias as $key => $categoria)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>
                          <button class="btn btn-warning btn-sm btnEditarCategoria" data-toggle="modal" data-target="#modal-editar" idcategoria="{{ $categoria->id }}"><i class="fas fa-edit"></i></button>
                          <button class="btn btn-danger btn-sm btnEliminarCategoria" categoria="{{ $categoria->nombre }}" idcategoria="{{ $categoria->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                          
                        
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>                  
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
                        <h4 class="modal-title">Agregar Categoria</h4>
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
                                          <span class="fas fa-th"></span>
                                        </div>
                                      </div>
                                    <input type="text" class="form-control" placeholder="Ingresa Categoria" name="nombre" required> 
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
          <form method="post" action="{{ url('Actualizar-Categoria') }}">
              @csrf
              @method('put')
              <div class="modal-content">
                  <div class="modal-header bg-dark" style="color: white;">
                      <h4 class="modal-title">Editar Categoria</h4>
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
                                        <span class="fas fa-building"></span>
                                      </div>
                                    </div>
                                  <input type="hidden" class="form-control" name="id" id="idEditar" required>
                                  <input type="text" class="form-control" placeholder="Ingresa Categoria" name="nombre" id="nombreEditar" required>
                                 
                                </div>
                          </div>                           
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>                    
                      <button id="guardar" type="submit" class="btn btn-success">Guardar</button>
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