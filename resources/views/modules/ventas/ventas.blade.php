@extends('welcome')

@section('home')

  
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Administrar Ventas</h1>
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
                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar"><i class="fas fa-plus"></i> Crear Nueva Venta </a>                   
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="listado" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Codigo Factura</th>                     
                        <th>Cliente</th> 
                        <th>Vendedor</th>
                        <th>Forma de Pago</th>
                        <th>Neto</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>                       
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ventas as $key => $venta)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $venta->codigo }}</td>
                        <td>{{ $venta->cliente->nombre }}</td>
                        <td>{{ $venta->vendedor->name }}</td>
                        <td>{{ $venta->forma_pago }}</td>
                        <td>$ {{ number_format($venta->neto, 2, '.', '') }}</td>
                        <td>$ {{ number_format($venta->total, 2, '.', '') }}</td>
                        <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i:s') }}</td>
                        <td>
                          <a href="{{ url('Venta/'.$venta->id) }}" class="btn btn-info btn-sm"><i class="fas fa-th"></i> Administrar Venta</a>
                         
                         
                        </td>
                      </tr>
                      @endforeach
                     
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Codigo Factura</th>                     
                        <th>Cliente</th> 
                        <th>Vendedor</th>
                        <th>Forma de Pago</th>
                        <th>Neto</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>                             
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
                        <h4 class="modal-title">Crear Nueva Venta</h4>
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
                                    <input type="hidden" class="form-control" placeholder="Ingresa Sucursal" name="id_vendedor"  value="{{ auth()->user()->id }}" required> 
                                    <input type="text" class="form-control" placeholder="Ingresa Sucursal" value="{{ auth()->user()->name }}" readonly> 
                                  </div>
                            </div>  
                            @if(auth()->user()->rol == 'Administrador')
                            <div class="col-12 col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <select class="form-control select2bs4" name="id_sucursal" required>
                                        <option value="">Seleccione Sucursal</option>
                                        @foreach ($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                        @endforeach
                                       
                                    </select>
                                </div>
                            </div>  
                            @else
                            <input type="hidden" class="form-control" placeholder="Ingresa Sucursal" name="id_sucursal" value="{{ auth()->user()->id_sucursal }}" required>
                            @endif   
                            
                            <div class="col-12 col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-plus"></i></span>
                                    </div>
                                    <select class="form-control select2bs4" name="id_cliente" required>
                                        <option value="">Seleccione Cliente</option>
                                        @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} - {{ $cliente->documento }}</option>
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