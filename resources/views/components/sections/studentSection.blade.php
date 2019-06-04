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
    <a class="nav-link" href="{{url("/students/registration")}}">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Inscripción</span>
    </a>
  </li>

@endsection