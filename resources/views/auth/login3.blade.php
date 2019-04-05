
<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
            
                <div class="card o-hidden border-0 shadow-lg my-5"></div>
                <div class="card-body p-0">

                    <!-- Nested Row within Card Body -->
                    <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        
                    <div class="col-lg-6">
                            <div class="p-5">
                              <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Hola!</h1>
                              </div>
                            </div>
                   

                        <form class="user" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

                                    <input id="email" type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}" placeholder="Dirección Email" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                    <input id="password" type="password" class="form-control form-control-user" name="password" placeholder="Contraseña" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input class="custom-control-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="customCheck">Recordar</label>
                                </div>
                            </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Ingresar
                                    </button>
                        </form>
                        <hr>
                        <div class="text-center">
                                <a class="small" href="{{ url('/password/reset') }}"> Olvidaste tu Contraseña? </a>
                        </div>

                        <div class="text-center">
                            <a class="small" href="{{ url('/register') }}">Crea una Cuenta!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>