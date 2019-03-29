@extends('layouts.app')

@section('content')

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">

        <div class="card-body p-0">

            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>


                    <div class="col-lg-7">
                    <div class="p-5">

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Registro de Estudiante</h1>
                    </div>

                    <form class="user" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="{{ $errors->has('names') ? ' has-error' : '' }} col-sm-6 mb-3 mb-sm-0">

                                <input id="names" type="text" class="form-control form-control-user" name="names"
                                       value="{{ old('names') }}" placeholder="Nombres" required autofocus>

                                @if ($errors->has('names'))
                                    <span class="help-block">
                                   <strong>{{ $errors->first('names') }}</strong>
                               </span>
                                @endif
                            </div>

                        <div class="{{ $errors->has('first_name') ? ' has-error' : '' }} col-sm-6 mb-3 mb-sm-0">

                            <input id="first_name" type="text" class="form-control form-control-user" name="first_name"
                                   value="{{ old('first_name') }}" placeholder="Apellido Paterno" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                        </div>

                            <div class="group{{ $errors->has('second_name') ? ' has-error' : '' }} col-sm-6">

                                <input id="second_name" type="text" class="form-control form-control-user"
                                       name="second_name" value="{{ old('second_name') }}"
                                       placeholder="Apellido Materno" required autofocus>

                                @if ($errors->has('second_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('second_name') }}</strong>
                                    </span>
                                @endif
                        </div>

                    </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input id="email" type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}" placeholder="Dirección Email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row">\
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-sm-6 mb-3 mb-sm-0">

                                <input id="password" type="password" class="form-control form-control-user" name="password" placeholder="Contraseña" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="col-sm-6">
                                <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Repetir Contraseña" required>
                            </div>
                        </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Registrar
                                </button>
                    </form>

                    <hr>
              <div class="text-center">
                  <a class="small" href="#">Olvidaste tu Contraseña?</a>
              </div>
              <div class="text-center">
                <a class="small" href="{{ url('/login') }}">Ya tienes una Cuenta? Ingresa!</a>
              </div>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

@endsection
