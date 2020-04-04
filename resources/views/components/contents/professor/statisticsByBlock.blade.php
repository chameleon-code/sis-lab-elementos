@extends('components.sections.professorSection')
@section('userContent')

<script>
    var managements = {!! json_encode( $managements ) !!};
    var groups = {!! json_encode( $groups ) !!};
</script>

<div class="container-fluid">

    <div class="card shadow mb-3">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary" for=""> Estadísticas por bloque </h6>
        </div>
        <div class="card-body py-3">
            <div class="row px-2">
                <div class="col-sm-4 mb-2">
                    <label class="my-0" for=""> Gestión </label>
                    <select class="form-control" id="management-selector" onchange="selectManagement()">
                        @foreach ($managements as $management)
                            <option class="optional" value="{{ $management->id }}"> {{$management->semester}}/{{$management->managements}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-8">
                    <label class="my-0" for="">Bloque: </label>
                    <select class="form-control" name="" id="block-selector" onchange="selectBlock()"></select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Estado entrega de tareas </h6>
                </div>
                <div id="chart-donut-container" class="card-body"></div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Promedio de tareas calificadas </h6>
                </div>
                <div id="chart-donut-container-2" class="card-body"></div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Entregas por sesión </h6>
            </div>
            <div id="chart-area-container" class="card-body"></div>
        </div>
    </div>

</div>

<script src="/js/graphics/graphicsByBlock.js"></script>

@endsection

@push('scripts')
    <script src="/vendor/chart.js/Chart.min.js"></script>
@endpush