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

  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlocks" aria-expanded="true" aria-controls="collapseBlocks">
        <i class="fas fa-fw fa-address-card"></i>
        <span>Inscripción</span>
      </a>
      <div id="collapseBlocks" class="collapse{{Cache::get('block_nav')}}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Opciones:</h6>
          <a class="collapse-item" href="{{url("/students/registration")}}"><i class="fas fa-book"></i> Materia </a>
          <a class="collapse-item" href="#"><i class="fas fa-calendar"></i> Elegir Horarios </a>
        </div>
      </div>
  </li>

@endsection