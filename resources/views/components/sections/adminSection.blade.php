@extends('layouts.logged')
@section('content')
  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Inicio</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Tipos de Usuario
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfessors" aria-expanded="true" aria-controls="collapseProfessors">
      <i class="fas fa-fw fa-chalkboard-teacher"></i>
      <span>Docentes</span>
    </a>
    <div id="collapseProfessors" class="collapse" aria-labelledby="headingProfessors" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="buttons.html"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-plus-square"></i>  Crear</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuxiliars" aria-expanded="true" aria-controls="collapseAuxiliars">
      <i class="fas fa-fw fa-user-friends"></i>
      <span>Auxiliares</span>
    </a>
    <div id="collapseAuxiliars" class="collapse" aria-labelledby="headingAuxiliars" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="buttons.html"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-plus-square"></i>  Crear</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudents" aria-expanded="true" aria-controls="collapseStudents">
      <i class="fas fa-fw fa-users"></i>
      <span>Estudiantes</span>
    </a>
    <div id="collapseStudents" class="collapse" aria-labelledby="headingStudents" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="buttons.html"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-plus-square"></i>  Crear</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Academia
  </div>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubjects" aria-expanded="true" aria-controls="collapseSubjects">
      <i class="fas fa-fw fa-bookmark"></i>
      <span>Materias</span>
    </a>
    <div id="collapseSubjects" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="buttons.html"><i class="fas fa-eye"></i>  Ver</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-plus-square"></i>  Crear</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-edit"></i>  Editar</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-trash-alt"></i>  Eliminar</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManagments" aria-expanded="true" aria-controls="collapseManagments">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Gestiones</span>
    </a>
    <div id="collapseManagments" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="buttons.html"><i class="fas fa-eye"></i>  Ver</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-plus-square"></i>  Crear</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-edit"></i>  Editar</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-trash-alt"></i>  Eliminar</a>
      </div>
    </div>
  </li>
  
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGroups" aria-expanded="true" aria-controls="collapseGroups">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Grupos</span>
    </a>
    <div id="collapseGroups" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="buttons.html"><i class="fas fa-eye"></i>  Ver</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-plus-square"></i>  Crear</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-edit"></i>  Editar</a>
        <a class="collapse-item" href="cards.html"><i class="fas fa-trash-alt"></i>  Eliminar</a>
      </div>
    </div>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="charts.html">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Estadisticas</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="tables.html">
      <i class="fas fa-fw fa-shield-alt"></i>
      <span>Log</span></a>
  </li>

   <hr class="sidebar-divider d-none d-md-block">
@endsection