@extends('layouts.logged')
@section('content')
  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <li class="nav-item">
    <a class="nav-link" href="{{ url("/auxiliar/taskControl")}}">
      <i class="fas fa-fw fa-chalkboard-teacher"></i>
      <span>Control de Portafolio</span></a>
  </li>

@endsection