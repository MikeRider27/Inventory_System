@extends('welcome')

@section('home')

  
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Administrar Venta - {{ $venta->codigo }}</h1>
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
            <div class="col-md-6">
              <!-- General form elements -->
              <div class="card card-success">
                <div class="card-header">                 
                </div>
                <!-- /.card-header -->
                <!-- Form start -->
                <form method="post" action="" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <!-- Campos de entrada con íconos -->
                    <div class="row">
                        <div class="col-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $venta->vendedor->name }}" readonly>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $venta->codigo }}" readonly>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-plus"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $venta->cliente->nombre }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Campos ocultos -->
                    <div class="row">
                        <div class="col-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <input type="hidden" id="idVenta" value="{{ $venta->id }}">
                                <input type="hidden" id="url" value="{{ url('') }}">
                            </div>
                        </div>
                    </div>
                
                    <!-- Botón para agregar producto -->
                    <div class="row">
                        <div class="col-12 mb-3">
                            <button class="btn btn-default d-lg-none" id="btnAgregar">Agregar Producto</button>
                        </div>
                    </div>
                
                    <!-- Tabla de impuestos y total -->
                    <div class="row justify-content-end">
                      <div class="col-12 col-md-6">
                          <table class="table table-bordered table-sm">
                              <thead class="thead-light">
                                  <tr>
                                      <th class="text-center">Impuesto</th>
                                      <th class="text-center">Total</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>
                                          <div class="input-group input-group-sm">
                                              <input type="number" class="form-control" min="0" name="impuesto" required aria-label="Impuesto">
                                          </div>
                                      </td>
                                      <td>
                                          <div class="input-group input-group-sm">
                                              <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                              </div>
                                              <input type="number" class="form-control" min="0" name="total" readonly>
                                          </div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="form-group">
                          <div class="input-group">
                              <select class="form-control select2bs4" name="metodo_pago" required>
                                  <option value="">Seleccione un Metodo de Pago</option>
                                  <option value="Efectivo">Efectivo</option>
                                  <option value="TC">Tarjeta de Crédito</option>
                                  <option value="TD">Tarjeta de Débito</option>
                                 
                              </select>
                          </div>
                      </div>
                      </div>
                    </div>
                </div>
                  <!-- /.card-body -->
            
                  <div class="card-footer">
                    <button class="btn btn-success"><i class="fas fa-save"></i> Finalizar Ventas</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>

            <div class="col-md-6">
              <!-- General form elements -->
              <div class="card card-warning">
                <div class="card-header">
               
                </div>
                <!-- /.card-header -->
                <!-- Form start -->              
                  <div class="card-body">
                    <!-- Campos de entrada con íconos -->
                    <table id="listado" class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th style="width: 10px">ID</th>
                          <th>Imagen</th>
                          <th>Codigo</th>
                          <th>Descripcion</th>
                          <th>Stock</th>
                          <th>Accion</th>                        
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($productos as $key => $producto)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td> 
                            @if ($producto->imagen == "")
                            <img src="{{ url('storage/products/default.png') }}" class="img-thumbnail" alt="User Image" style="width: 50px; height: 50px;">
                            @else
                            <img src="{{ url('storage/' . $producto->imagen) }}" class="img-thumbnail" alt="User Image" style="width: 50px; height: 50px;">
                            @endif
                          </td>
                          <td>{{ $producto->codigo }}</td>
                          <td>{{ $producto->descripcion }}</td>
                          <td>
                            @if($producto->stock <= 10)
                            <span class="badge badge-danger">{{ $producto->stock }}</span>
                            @elseif($producto->stock <= 15)
                            <span class="badge badge-warning">{{ $producto->stock }}</span>
                            @else
                            <span class="badge badge-success">{{ $producto->stock }}</span>
                            @endif
                          </td>
                          <td>
                            <button class="btn btn-primary btn-sm" id="btnAgregarProducto" data-id="{{ $producto->id }}" data-codigo="{{ $producto->codigo }}" data-descripcion="{{ $producto->descripcion }}" data-precio="{{ $producto->precio }}" data-stock="{{ $producto->stock }}"><i class="fas fa-plus"></i> Agregar</button>                          
                          </td>
                        </tr>
                        @endforeach
                        
                      </tbody>                      
                    </table>
                  </div>             
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