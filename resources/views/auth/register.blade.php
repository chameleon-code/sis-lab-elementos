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
        
                <title>Registro</title>
                <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
                    type="text/css">
                <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                <link href="/css/sb-admin-2.css" rel="stylesheet">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <script src="/js/preloadWindow/preload.js"></script>
                <link rel="stylesheet" href="/css/preloadWindow/preload.css"/>
                <link rel="stylesheet" href="/css/about.css">
        </head>

<body class="bg-gradient-success">
{{-- <div class="loader"></div> --}}
<div id="overlay" style="background-color:black; opacity: 0.5; position:absolute; top:0; left:0; height:100%; width:100%; z-index:999"> <div class="row justify-content-center align-items-center" style="height: 100vh;"> <div class="preloader"></div> </div>  </div>
<script src="/js/validateFields.js"></script>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registro de Estudiante</h1>
                        </div>
                        <form class="user" role="form" method="POST" action="{{ url('student/register') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Nombres</label>
                                <input type="text" class="form-control" name="names" value="{{ old('names')}}" required autofocus>
                                    {!! $errors -> first('names','<label style="color:crimson">:message</label>')!!} 
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <div class="">
                                            <label for="">Apellido Paterno</label>  
                                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name')}}" autofocus>
                                                {!! $errors -> first('first_name','<label style="color:crimson">:message</label>')!!}  
                                        </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <div class="">
                                          <label for="">Apellido Materno</label>  
                                          <input type="text" class="form-control" name="second_name" value="{{ old('second_name')}}" autofocus> 
                                            {!! $errors -> first('second_name','<label style="color:crimson">:message</label>')!!}  
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="">Correo Electrónico</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email')}}" required>
                                        {!! $errors -> first('email','<label style="color:crimson">:message</label>')!!} 
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="">
                                        <label for="">Código SIS</label>  
                                        <input type="number" class="form-control" name="code_sis" value="{{ old('code_sis')}}" required autofocus min="0">
                                            {!! $errors -> first('code_sis','<label style="color:crimson">:message</label>')!!}  
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="">
                                        <label for="">Cédula de Identidad</label>  
                                        <input type="number" class="form-control" name="ci" value="{{ old('ci')}}" required autofocus min="0"> 
                                        {!! $errors -> first('ci','<label style="color:crimson">:message</label>')!!}  
                                    </div>
                                </div>
                            </div>
                            <label for="">Contraseña</label>
                            <div class="form-group row">
                                <div class="col-md-10 col-sm-10 col-10">
                                    <input id="pass" type="password" class="form-control" name="password" required> 
                                </div>
                                <div class="col-md-2 col-sm-2 col-2">
                                    <button type="button" class="btn btn-secondary btn-circle" title="Revelar Contraseña" onclick="revelate();"><i id="eye" class="fa fa-eye"></i></button>
                                </div>
                            </div>
                            {!! $errors -> first('password','<label style="color:crimson">:message</label>')!!} 
                            <input type="text" name="mode" hidden value="register">
                            <br>
                            <div class="form-group" style="width: 10px;">
                                {!! Recaptcha::render() !!}
                                {!! $errors -> first('g-recaptcha-response','<label style="color:crimson">:message</label>')!!}                                                
                            </div>
                            <div class="form-group row">
                                    <div class="form-group col-md-6 col">
                                      <button type="submit" class="form-control btn btn-primary btn-block col-md-12">Registrar</button>
                                    </div>
                                    <div class="form-group col-md-6 col">
                                      <a class="form-control btn btn-danger btn-block col-md-12" href="{{ url('/') }}">Volver</a>    
                                    </div>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ url('/login') }}">¿Ya tienes una Cuenta?, Ingresa</a>
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



