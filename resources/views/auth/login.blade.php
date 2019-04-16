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

        <title>Ingresar</title>
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
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Bienvenido Nuevamente</h1>
                                        </div>
                                        <form class="user"  role="form" method="POST" action="{{ url('/login') }}">
                                                {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="">Dirección de Correo</label>
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    id="email"
                                                    aria-describedby="emailHelp"
                                                    name="email"
                                                    value="{{ old('email') }}"
                                                    required autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Contraseña</label>
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    id="password"
                                                    name="password"
                                                    required>
                                                                                                       
                                            </div>
                                            {!! $errors -> first('email','<label style="color:crimson">:message</label>')!!} 
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-block">
                                                    Ingresar
                                            </button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="{{ url('/password/reset') }}">
                                                ¿Olvidaste tu Contraseña?
                                            </a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="{{ url('/register') }}">Crea una Cuenta</a>
                                        </div>
                                        <div class="text-center">
                                                <a class="small" href="{{ url('/') }}">Volver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    </body>

</html>