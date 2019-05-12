<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sis-Lab</title>
  <link rel="shortcut icon" href="/img/favicon.png"/>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.css" rel="stylesheet">
  
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light navbar-expand-lg">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Sis-Lab</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li><a id="login" class="btn btn-primary col-11" href=" {{ url('/login') }} ">Ingresa</a></li>
          <li><a class="btn btn-success col-11" href=" {{ url('/register') }} ">Regístrate</a></li>
        </ul>
      </div>
  </nav> 

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Sistema de Administración de Horarios de Laboratorio</h1>
        </div>
      </div>
    </div>
  </header>
  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          
          <p class="text-muted small mb-4 mb-lg-0">&copy; Chameleon Code 2019</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-google fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
