<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Restablecimiento de Contraseña</title>
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
            type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="/css/sb-admin-2.css" rel="stylesheet">
    </head>
    <body class="bg-gradient-success">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-password-reenter"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Restablecer Contraseña</h1>
                                        </div>
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <form class="user" role="form" method="POST" action="{{ url('/password/reset') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="form-group">
                                                <label>Dirección de Correo</label>
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                                                    {!! $errors -> first('email','<label style="color:crimson">:message</label>')!!}
                                            </div>
                                            <div class="form-group">
                                                <label for="password"> Contraseña</label>
                                                <input id="password" type="password" class="form-control" name="password" required>
                                                {!! $errors -> first('password','<label style="color:crimson">:message</label>')!!} 
                                            </div>
                                            <div class="form-group">
                                                <label for="password-confirm">Confirmar Contraseña</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                {!! $errors -> first('password_confirmation','<label style="color:crimson">:message</label>')!!} 
                                            </div>
                                            <br>
                                            <button id="login" type="submit" class="btn btn-primary btn-block">
                                                    Restablecer
                                            </button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                                <a class="small" href="{{ url('/') }}">Inicio</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
    </body>
</html>