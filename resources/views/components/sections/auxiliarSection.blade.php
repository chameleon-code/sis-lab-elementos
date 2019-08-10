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

  <li class="nav-item">
    <a class="nav-link" href="{{ url("/auxiliar/assistance")}}">
      <i class="fas fa-fw fa-chalkboard-teacher"></i>
      <span>Asistencia</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Academia
  </div>

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="{{ url("/auxiliar/schedule")}}">
      <i class="fas fa-fw fa-table"></i>
      <span>Horario</span></a>
  </li>
@endsection