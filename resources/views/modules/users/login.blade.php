@extends('welcome')

@section('login')

    <style type="text/css">
        .login-page,
        .register-page {
            background: linear-gradient(rgba(0,0,0,1), rgba(0,30,50,1));
        }
        .login-page #back {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(storage/plantilla/back.png);
            background-size: cover;
            overflow: hidden;
            z-index: -1;
        }
        
    </style>

    <div id="back"></div>

    <div class="login-box">
        <div class="login-logo">
          <img src="{{ url('storage/plantilla/logo-blanco-bloque.png') }}" class="img-responsive"
               style="padding: 30px 100px 0px 100px; width: 100%; height: auto;">
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Ingresar al Sistema</p>
        
            <form action="{{ route('login') }}" method="post">
                @csrf
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">                
                <!-- /.col -->
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
                <!-- /.col -->
              </div>

              @error('email')
                <br>
                <div class="alert alert-danger">
                  Error con el email o la contraseña
                </div>
                  
              @enderror

              @if($errors->has('estado'))
                <br>
                <div class="alert alert-danger">
                  {{ $errors->first('estado') }}
                </div>
              @endif
            </form>      
          
        
           
          </div>
          <!-- /.login-card-body -->
        </div>
    </div>

@endsection