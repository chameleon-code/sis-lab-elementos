@extends('layouts.logged')
@section('content')

@php
    $management = App\Management::getActualManagement();
    $carbon = new \Carbon\Carbon();
    $actual_date = $carbon->now()->format('Y-m-d');
@endphp

@if(Agent::isMobile())
<!-- Divider -->
<hr class="sidebar-divider my-0">
<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <div class="nav-link" style="pointer-events: none !important;">
      <span> {{ substr($actual_date, 8, 2) }} {{ App\Management::getMonth($actual_date) }} <br> <strong> {{ $management->semester }}-{{ $management->managements }} </strong> </span> 
  </div>
</li>
@endif

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ url("/professor/graphics")}}">
      <i class="fas fa-chart-pie"></i>
      <span>Estadisticas de notas</span></a>
  </li>
  
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Opciones
  </div>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudent" aria-expanded="true" aria-controls="collapseStudent">
      <i class="fas fa-fw fa-users"></i>
      <span>Estudiantes</span>
    </a>
    <div id="collapseStudent" class="collapse" aria-labelledby="headingStudent" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="{{url("/professor/students/list")}}"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="{{ url("/professor/registerAssistance")}}"><i class="fas fa-clipboard-list"></i>  Registro de Asistencia</a>
        <a class="collapse-item" href="/portflies"><i class="far fa-folder"></i>  Portafolios</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="/sesions">
      <i class="fas fa-fw fa-calendar-day"></i>
      <span>Sesiones</span></a>
  </li>
{{-- 
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTasks" aria-expanded="true" aria-controls="collapseTasks">
      <i class="fas fa-fw fa-tasks"></i>
      <span>Prácticas</span>
    </a>
      <div id="collapseTasks" class="collapse" aria-labelledby="headingTasks" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Opciones:</h6>
          <a class="collapse-item" href="{{url('/tasks')}}"><i class="fas fa-cogs"></i>  Administrar</a>
          <a class="collapse-item" href="#"><i class="fas fa-check"></i> Calificar</a>
        </div>
      </div>
  </li> --}}



@endsection