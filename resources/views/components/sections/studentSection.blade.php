@extends('layouts.logged')
@section('content')
  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ url("/home")}}">
      <i class="fas fa-fw fa-rocket"></i>
      <span>Actividades</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Interface
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInscription" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-scroll"></i>
      <span>Inscripción</span>
    </a>
    <div id="collapseInscription" class="collapse" aria-labelledby="headingInscription" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="{{url("/students/registration")}}">Bloque</a>
        <a class="collapse-item" href="">Horario</a>
      </div>
    </div>
  </li>

@endsection