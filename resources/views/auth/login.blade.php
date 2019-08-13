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
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <link rel="stylesheet" href="/css/about.css">
        <script src="/js/preloadWindow/preload.js"></script>
    </head>
    <div id="overlay" style="background-color:black; opacity: 0.5; position:absolute; top:0; left:0; height:100%; width:100%; z-index:999"> <div class="row justify-content-center align-items-center" style="height: 100vh;"> <div class="preloader"></div> </div>  </div> 
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
                                            <div class="form-group">
                                                {!! Recaptcha::render() !!}
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="help-block">
                                                        <label style="color:crimson">{{ $errors->first('g-recaptcha-response') }}</label>
                                                    </span>
                                                @endif                                                 
                                            </div>
                                            {{-- {!! ReCaptcha::displaySubmit('register-form', 'Register', ['class' => 'btn btn-primary']) !!} --}}
                                            <button id="login" type="submit" class="btn btn-primary btn-block">
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
    </body>
</html>