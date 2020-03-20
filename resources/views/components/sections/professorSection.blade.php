@extends('layouts.logged')
@section('content')

@php
    $management = App\Management::getActualManagement();
    $carbon = new \Carbon\Carbon();
    $actual_date = $carbon->now()->format('Y-m-d');
@endphp

@if(Agent::isMobile())
  <hr class="sidebar-divider my-0">
  <li class="nav-item">
  <div class="nav-link" style="pointer-events: none !important;">
  @if($management != null)
    <span> {{ substr($actual_date, 8, 2) }} {{ App\Management::getMonth($actual_date) }} <br> <strong> {{ $management->semester }}-{{ $management->managements }} </strong> </span> 
  @else
    <span> {{ substr($actual_date, 8, 2) }} {{ App\Management::getMonth($actual_date) }} </span> 
  @endif
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
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudent" aria-expanded="false" aria-controls="collapseStudent">
      <i class="fas fa-fw fa-users"></i>
      <span>Estudiantes</span>
    </a>
    <div id="collapseStudent" class="collapse" aria-labelledby="headingStudent" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="{{url("/professor/students/list")}}"><i class="fas fa-list"></i>  Listar</a>
        {{-- <a class="collapse-item" href="{{ url("/professor/registerAssistance")}}"><i class="fas fa-clipboard-list"></i>  Registro de Asistencia</a> --}}
        <a class="collapse-item" href="/deliveredTasks"><i class="fas fa-book"></i>  Practicas</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="/sesions">
      <i class="fas fa-fw fa-calendar-day"></i>
      <span>Sesiones</span></a>
  </li>
@endsection