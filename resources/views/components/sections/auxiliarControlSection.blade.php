@extends('layouts.logged')
@section('content')
  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <li class="nav-item">
    <a class="nav-link" href="{{ url("/auxiliar/taskControl")}}">
      <i class="fas fa-fw fa-chalkboard-teacher"></i>
      <span>Control de Portafolio</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Academia
  </div>

  <li class="nav-item">
    <a class="nav-link" href="{{ url("/auxiliar/schedule")}}">
      <i class="fas fa-fw fa-table"></i>
      <span>Horario</span></a>
  </li>
@endsection