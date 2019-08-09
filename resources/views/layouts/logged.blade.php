<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="author" content="">

  <title>En Sesión</title>

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">
  -->
  <link href="/css/sb-admin-2.css" rel="stylesheet">
  <link href="/css/profile.css" rel="stylesheet">
  <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="/js/jquery-ui-1.12.1/jquery-ui.css" />
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="/js/jquery-ui-1.12.1/jquery-ui.js"></script>
  <script src="/js/preloadWindow/preload.js"></script>
  <link rel="stylesheet" href="/css/preloadWindow/preload.css"/>
 
  @stack('scripts')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <ul id="accordionSidebar" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion  
      @if(Agent::isMobile())
        toggled
      @endif
      "
      >
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-0">
            {{-- <i class="fab fa-staylinked"></i> --}}
            <i class="fas fa-laptop-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
        @if (Auth::user()->role_id == 1)
            Administrador
        @endif  
        @if (Auth::user()->role_id == 2)
            Docente
        @endif 
        @if (Auth::user()->role_id == 3)
            Auxiliar
        @endif
        @if (Auth::user()->role_id == 4)
            Estudiante
        @endif
        </div>
      </a>
      @yield('content')
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>



    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->


        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @if (Auth::guest())
              <span class="mr-2 d-none d-lg-inline text-gray-600 small"> Invitado </span>
              <img class="img-profile rounded-circle" src="/users/demo.png">
              @else
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->names }} </span>
                <img class="img-profile rounded-circle" src="
                @if(Auth::user()->img_path != null)
                /storage/users/{{ Auth::user()->img_path }}
                @else
                /users/demo.png
                @endif
                ">
              @endif


            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profile">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Perfil
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Cerrar Sesión
              </a>
            </div>
          </li>

        </ul>

      </nav>
      <!-- End of Topbar -->

      @yield('userContent')

      <!-- Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <h6 title="Si tienes alguna queja u observación, haz click aquí"><a href="/about">Contactanos</a><h6> 
            <span>Copyright &copy; Chameleon Code 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Realmente desea cerrar sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona <b>Cerrar Sesión</b> si desea salir de su cuenta.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="{{ url('/logout') }}"
          onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar Sesión</a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document" style="pointer-events: inherit;">
    <div class="card card-profile o-hidden border-0 my-3 rounded">
        <div style="background-image: url(/img/lab.jpg);" class="card-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black; margin-top: -5px;">
            <span aria-hidden="true"><strong>&times;</strong></span>
          </button>
        </div>
        <div class="card-body text-center"><img src="/users/demo.png" class="card-profile-img">
            <h3 class="mb-3"> {{ Auth::user()->names }} {{ Auth::user()->first_name }} {{ Auth::user()->second_name }} </h3>
            <p class=""> <strong> Tipo de Usuario: </strong>
              @if(Auth::user()->role_id == 1)
                Administrador
              @elseif(Auth::user()->role_id == 2)
                Docente
              @elseif(Auth::user()->role_id == 3)
                Auxiliar
              @elseif(Auth::user()->role_id == 4)
                Estudiante
              @endif
            </p>
            <p class=""> <strong> Código Sis: </strong> {{ Auth::user()->code_sis }} </p>
            <p class=""> <strong> Correo Electrónico: </strong> {{ Auth::user()->email }} </p>
            <a href="#" class="btn-sm btn-primary"> Editar Información </a>
        </div>
    </div>
  </div>
</div>


  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.js"></script>

  <!-- Page level plugins -->
  <script src="/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/js/demo/chart-area-demo.js"></script>
  <script src="/js/demo/chart-pie-demo.js"></script>
  <script src="/js/demo/chart-bar-demo.js"></script>
  <!-- Page level plugins -->
  <script src="/vendor/datatables/jquery.dataTables.js"></script>
  <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Page level custom scripts -->
  <script src="/js/datatables-demo.js"></script>
</body>

</html>
