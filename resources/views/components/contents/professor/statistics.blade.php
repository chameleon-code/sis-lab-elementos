@extends('components.sections.professorSection')
@section('userContent')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Control</h1>
    <p class="mb-4">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates dolores atque incidunt, quo quibusdam repudiandae temporibus, sed earum dicta sapiente voluptatum ut mollitia culpa ab natus delectus. Numquam, quae mollitia?
    </p>

    <!-- Content Row -->
    <div class="row">

      <div class="col-xl-8 col-lg-7">

        <!-- Area Chart -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rendimiento Estudiantil</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myAreaChart"></canvas>
            </div>
            <hr>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Placeat ut odit unde rem neque dolor voluptatum commodi consequuntur, ali.
          </div>
        </div>

        <!-- Bar Chart -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Crecimiento Estudiantil</h6>
          </div>
          <div class="card-body">
            <div class="chart-bar">
              <canvas id="myBarChart"></canvas>
            </div>
            <hr>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque incidunt possimus totam? Dignissimos velit enim unde inventore porro possimus omn.
          </div>
        </div>

      </div>

      <!-- Donut Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tareas</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-pie pt-4">
              <canvas id="myPieChart"></canvas>
            </div>
            <hr>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis tempore volu. Ectetur adipisicing elit. Corpori
          </div>
        </div>
      </div>
    </div>

</div>
@include('components.contents.partials.eventsCalendar')
@endsection
@push('scripts')
    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script src="{{ asset('/js/events.js') }}"></script>
    <script src="{{ asset("https://cdn.jsdelivr.net/npm/sweetalert2@8") }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/calendar.css') }}">
@endpush