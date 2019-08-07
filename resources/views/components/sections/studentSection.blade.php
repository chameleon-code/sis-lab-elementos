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

  @if(App\Management::getActualManagement() != null)
    @if (App\Management::getActualManagement()->enable_inscription == 1)
    <!-- Heading -->
    <div class="sidebar-heading">
      Opciones
    </div>
    
    <li class="nav-item">
      <a class="nav-link" href="{{url("/students/registration")}}">
        <i class="fas fa-fw fa-calendar-alt"></i>
        <span>Inscripción</span>
      </a>
    </li>
    @endif
  @endif

@endsection