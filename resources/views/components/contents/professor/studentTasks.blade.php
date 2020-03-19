@extends('components.sections.professorSection')
@section('userContent')

<style>
    img {
        height: 34px;
        width: 34px;
    }
</style>

<script>
    var managements = {!! json_encode( $managements ) !!};
    var groups = {!! json_encode( $groups ) !!}
    var sesions = {!! json_encode( $sesions ) !!}
</script>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Prácticas </h6>
        </div>
        <div class="card-body">

            <div class="row px-2">
                <div class="col-sm-4 mb-2">
                    <label for="">Gestión: </label>
                    <select class="form-control" name="" id="management-selector" onchange="selectManagement()">
                        @foreach ($managements as $management)
                            <option class="optional" value="{{$management->id}}">{{$management->semester}}/{{$management->managements}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-8">
                    <label for="">Bloque: </label>
                    <select class="form-control" name="" id="block-selector" onchange="selectBlock()"></select>
                </div>
            </div>

            <hr class="my-2">

            <div class="row px-2">
                <div class="col-sm-3 mb-2">
                    <label for="">Grupo: </label>
                    <select class="form-control" name="" id="group-selector" onchange="selectGroup()"></select>
                </div>
                <div class="col-sm-3">
                    <label for="">Sesion: </label>
                    <select class="form-control" name="" id="sesion-selector" onchange=""></select>
                </div>
            </div>

            <br>

            <div id="practices-content" class="row px-2" style="display: none;">

                <div id="students-container" class="col-sm-6 my-4" style="overflow: auto;"></div>
                
                <div class="col-sm-6" style="">
                    <br><br>
                    Contenedor para las tareas
                </div>

            </div>
            
        </div>
    </div>
</div>
    
@endsection

@push('scripts')
    <script src="/js/accordion.js"></script>
    <script src="/js/studentTasks.js"></script>
@endpush