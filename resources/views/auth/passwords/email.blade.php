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
        <link rel="stylesheet" href="/css/about.css">

    </head>
    <body class="bg-gradient-success">
        <br>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-password-reset"></div>
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
                                        <form class="user"  role="form" method="POST" action="{{ url('/password/email') }}">
                                            {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="">Dirección de Correo</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                            {!! $errors -> first('email','<label style="color:crimson">:message</label>')!!} 
                                        </div>
                                        <br>
                                        <button id="login" type="submit" class="btn btn-primary btn-block">
                                                Solicitar Enlace
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
        <br>
        <footer>
                <div class="container my-auto">
                  <div class="copyright text-center my-auto" style="color: aliceblue;">
                     <h6 title="Si tienes alguna queja u observación, haz click aquí"><a href="/about" style="color: paleturquoise;">Contactanos</a></h6> 
                    <h6>Copyright &copy; Chameleon Code 2019</h6>
                  </div>
                </div>
        </footer>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
    </body>
</html>