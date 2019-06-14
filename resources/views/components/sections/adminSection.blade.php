@extends('layouts.logged')
@section('content')

<script>

</script>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="/admin">
      <i class="fas fa-fw fa-home"></i>
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
    <a class="nav-link collapsed" id="professors" href="#" data-toggle="collapse" data-target="#collapseProfessors" aria-expanded="true" aria-controls="collapseProfessors">
      <i class="fas fa-fw fa-chalkboard-teacher"></i>
      <span>Docentes</span>
    </a>
    <div id="collapseProfessors" class="collapse{{Cache::get('professor_nav')}}" aria-labelledby="headingProfessors" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="{{ url("/admin/professors")}}"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="{{ url("/admin/professors/create")}}" id="createProfessor"><i class="fas fa-plus"></i>  Crear</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuxiliars" aria-expanded="true" aria-controls="collapseAuxiliars">
      <i class="fas fa-fw fa-user-friends"></i>
      <span>Auxiliares</span>
    </a>
    <div id="collapseAuxiliars" class="collapse{{Cache::get('auxiliar_nav')}}" aria-labelledby="headingAuxiliars" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="/admin/auxiliars"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="/admin/auxiliars/create"><i class="fas fa-plus"></i>  Crear</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudents" aria-expanded="true" aria-controls="collapseStudents">
      <i class="fas fa-fw fa-users"></i>
      <span>Estudiantes</span>
    </a>
    <div id="collapseStudents" class="collapse{{Cache::get('student_nav')}}" aria-labelledby="headingStudents" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="{{url('/admin/students')}}"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="{{url('/admin/student/create')}}"><i class="fas fa-plus"></i>  Crear</a>
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
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManagments" aria-expanded="true" aria-controls="collapseManagments">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Gestiones</span>
    </a>
    <div id="collapseManagments" class="collapse{{Cache::get('management_nav')}}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="{{url('/admin/managements')}}"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="{{url('/admin/management/create')}}"><i class="fas fa-plus"></i>  Crear</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubjects" aria-expanded="true" aria-controls="collapseSubjects">
      <i class="fas fa-fw fa-bookmark"></i>
      <span>Materias</span>
    </a>
    <div id="collapseSubjects" class="collapse{{Cache::get('subject_matter_nav')}}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="{{url('/admin/subjectmatters')}}"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="{{url('/admin/subjectmatter/create')}}"><i class="fas fa-plus"></i>  Crear</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGroups" aria-expanded="true" aria-controls="collapseGroups">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Grupos</span>
    </a>
    <div id="collapseGroups" class="collapse{{Cache::get('group_nav')}}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opciones:</h6>
        <a class="collapse-item" href="{{url('/admin/groups')}}"><i class="fas fa-list"></i>  Listar</a>
        <a class="collapse-item" href="{{url('/admin/groups/create')}}"><i class="fas fa-plus"></i>  Crear</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlocks" aria-expanded="true" aria-controls="collapseBlocks">
        <i class="fas fa-fw fa-boxes"></i>
        <span>Bloques</span>
      </a>
      <div id="collapseBlocks" class="collapse{{Cache::get('block_nav')}}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Opciones:</h6>
          <a class="collapse-item" href="{{url('/admin/blocks')}}"><i class="fas fa-list"></i>  Listar</a>
          <a class="collapse-item" href="{{url('/admin/blocks/create')}}"><i class="fas fa-plus"></i>  Crear</a>
        </div>
      </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-address-card"></i>
      <span>Inscripciones</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{url('/schedule/create/')}}">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Horario</span>
    </a>
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
@section('userContent')
    {{-- @include('components.contents.partials.eventsCalendar') --}}
@endsection
@push('scripts')
    {{-- <script src="{{ asset('/js/calendar.js') }}"></script>
    <script src="{{ asset('/js/events.js') }}"></script> --}}
    <script src="{{ asset("https://cdn.jsdelivr.net/npm/sweetalert2@8") }}"></script>
    {{-- <link rel="stylesheet" href="{{ asset('/css/calendar.css') }}"> --}}
@endpush
