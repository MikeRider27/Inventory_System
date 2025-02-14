@extends('welcome')

@section('home')

  
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Productos</h1>
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
                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar"><i class="fas fa-plus"></i> Agregar Producto</a>                   
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="listado" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Categoria</th>
                        <th>Stock</th>
                        <th>Precio de Compra</th>
                        <th>Precio de Venta</th>
                        <th>Agregado</th>                     
                        <th>Accion</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($productos as $key => $producto)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>
                            @if ($producto->imagen == "")
                              <img src="{{ url('storage/products/default.png') }}" class="img-thumbnail" alt="User Image" style="width: 100px; height: 100px;">
                            @else
                              <img src="{{ url('storage/' . $producto->imagen) }}" class="img-thumbnail" alt="User Image" style="width: 100px; height: 100px;">
                            @endif

                            
                          </td>
                          <td>{{ $producto->codigo }}</td>
                          <td>{{ $producto->descripcion }}</td>
                          <td>{{ $producto->categoria_nombre }}</td>
                          <td>
                            @if ($producto->stock <= 10)
                              <span class="badge badge-danger">{{ $producto->stock }}</span>
                            @elseif($producto->stock >= 11 && $producto->stock <= 15)
                              <span class="badge badge-warning">{{ $producto->stock }}</span>
                            @else
                              <span class="badge badge-success">{{ $producto->stock }}</span>
                            @endif
                          </td>
                          <td>$ {{ number_format($producto->precio_compra, 2, '.', ',') }}</td>
                          <td>$ {{ number_format($producto->precio_venta, 2, '.', ',') }}</td>
                          <td>{{ \Carbon\Carbon::parse($producto->agregado)->format('d/m/Y H:i:s') }}</td>

                          <td>
                            <button class="btn btn-warning btn-sm btnEditarProducto" data-toggle="modal" data-target="modal-editar" idproducto="{{ $producto->id}}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btnEliminarProducto" producto="{{ $producto->descripcion }}" idproducto="{{ $producto->id }}"><i class="fas fa-trash"></i></button>
                          </td>
                        </tr>
                      @endforeach
                     
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Categoria</th>
                        <th>Stock</th>
                        <th>Precio de Compra</th>
                        <th>Precio de Venta</th>
                        <th>Agregado</th>                     
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
          <form method="post" action="" enctype="multipart/form-data">
              @csrf
              <div class="modal-content">
                  <div class="modal-header bg-dark text-white">
                      <h4 class="modal-title">Agregar Producto</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <!-- Selección de Categoría -->
                          <div class="col-12">
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-th"></i></span>
                                  </div>
                                  <select class="form-control select2bs4" id="selectCategoria" name="id_categoria" required>
                                      <option value="">Seleccione Categoría</option>
                                      @foreach ($categorias as $categoria)
                                          <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
  
                          <!-- Código de Producto -->
                          <div class="col-12">
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-code"></i></span>
                                  </div>
                                  <input type="text" class="form-control" name="codigo" id="codigoProducto" readonly>
                              </div>
                          </div>
  
                          <!-- Descripción del Producto -->
                          <div class="col-12">
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fab fa-product-hunt"></i></span>
                                  </div>
                                  <input type="text" class="form-control" name="descripcion" placeholder="Descripción del Producto" required>
                              </div>
                          </div>
  
                          <!-- Stock -->
                          <div class="col-12">
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-check"></i></span>
                                  </div>
                                  <input type="number" min="0" class="form-control" name="stock" placeholder="Stock" required>
                              </div>
                          </div>
  
                          <!-- Precio de Compra -->
                          <div class="col-6">
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                  </div>
                                  <input type="number" min="0" class="form-control" name="precio_compra" id="precioCompra" placeholder="Precio de Compra" required>
                              </div>
                          </div>
  
                          <!-- Precio de Venta -->
                          <div class="col-6">
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-arrow-down"></i></span>
                                  </div>
                                  <input type="number" min="0" class="form-control" name="precio_venta" id="precioVenta" placeholder="Precio de Venta" required>
                              </div>
                          </div>
                          <div class="col-6">
                           
                            
                        </div>
  
                          <!-- Checkbox y Descuento: Debajo de Precio de Venta -->
                          <div class="col-6 d-flex align-items-center">
                              <div class="form-check mr-3">
                                  <input type="checkbox" class="minimal porcentaje" checked>   
                                  Utilizar Porcentaje                            
                              </div>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                  </div>
                                  <input type="number" min="0" class="form-control" id="ValorPorcentaje" placeholder="Descuento (%)" value="40">
                              </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <label for="photo">Subir Imagen</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="imagen" name="imagen">
                                  <label class="custom-file-label" for="photo">Seleccionar archivo</label>
                                </div>
                              </div>
                    
                              <div class="mt-3">
                               
                                  <img src="{{ url('storage/products/default.png') }}" class="img-thumbnail"
                                       alt="User Image" style="width: 100px; height: 100px;">
                                
                              </div>
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
      </div>
  </div>
  
  
  

  <div class="modal fade" id="modal-editar">
    <div class="modal-dialog">
        <form method="post" action="{{ url('Actualizar-Producto') }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title">Editar Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Selección de Categoría -->
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-th"></i></span>
                                </div>
                                <select class="form-control select2bs4" id="selectCategoriaEditar" name="id_categoria" required>
                                    <option value="">Seleccione Categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Código de Producto -->
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-code"></i></span>
                                </div>
                                <input type="text" class="form-control" name="codigo" id="codigoProductoEditar" readonly>
                                <input type="hidden" class="form-control" name="id" id="idEditar">
                            </div>
                        </div>

                        <!-- Descripción del Producto -->
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-product-hunt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="descripcionEditar" name="descripcion" placeholder="Descripción del Producto" required>
                            </div>
                        </div>

                        <!-- Stock -->
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                                </div>
                                <input type="number" min="0" class="form-control" id="stockEditar" name="stock" placeholder="Stock" required>
                            </div>
                        </div>

                        <!-- Precio de Compra -->
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                </div>
                                <input type="number" min="0" class="form-control" name="precio_compra" id="precioCompraEditar" placeholder="Precio de Compra" required>
                            </div>
                        </div>

                        <!-- Precio de Venta -->
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-arrow-down"></i></span>
                                </div>
                                <input type="number" min="0" class="form-control" name="precio_venta" id="precioVentaEditar" placeholder="Precio de Venta" required>
                            </div>
                        </div>
                        <div class="col-6">
                         
                          
                      </div>

                        <!-- Checkbox y Descuento: Debajo de Precio de Venta -->
                        <div class="col-6 d-flex align-items-center">
                            <div class="form-check mr-3">
                                <input type="checkbox" class="minimal porcentajeEditar" checked>   
                                Utilizar Porcentaje                            
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                </div>
                                <input type="number" min="0" class="form-control" id="ValorPorcentajeEditar" placeholder="Descuento (%)" value="40">
                            </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                            <label for="photo">Subir Imagen</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="imagen">
                                <label class="custom-file-label" for="photo">Seleccionar archivo</label>
                              </div>
                            </div>
                  
                            <div class="mt-3">
                             
                                <img src="{{ url('storage/products/default.png') }}" class="img-thumbnail"
                                     alt="User Image" style="width: 100px; height: 100px;" id="imagenProductoEditar">
                              
                            </div>
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
    </div>
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