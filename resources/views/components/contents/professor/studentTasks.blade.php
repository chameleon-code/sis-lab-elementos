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
                    <label class="my-0" for="">Gestión: </label>
                    <select class="form-control" name="" id="management-selector" onchange="selectManagement()">
                        @foreach ($managements as $management)
                            <option class="optional" value="{{$management->id}}">{{$management->semester}}/{{$management->managements}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-8">
                    <label class="my-0" for="">Bloque: </label>
                    <select class="form-control" name="" id="block-selector" onchange="selectBlock()"></select>
                </div>
            </div>

            <hr class="my-2">

            <div class="row px-2">
                <div class="col-sm-3 mb-2">
                    <label class="my-0" for="">Grupo: </label>
                    <select class="form-control" name="" id="group-selector" onchange="selectGroup()"></select>
                </div>
                <div class="col-sm-3">
                    <label class="my-0" for="">Sesion: </label>
                    <select class="form-control" name="" id="sesion-selector" onchange="loadStudents()"></select>
                </div>
            </div>

            <br>

            <div id="practices-content" class="row px-2 mb-3" style="display: none;">

                <div id="students-container" class="col-sm-6 py-1 my-0" style="overflow: auto;"></div>
                
                <div id="task-container" class="col-sm-6 py-1 px-2" style="overflow: auto; font-size: 0.85rem;">
                    
                    <h6 class="m-0 font-weight-bold text-primary"> Tareas entregadas </h6>

                    <div id="student-task-container"></div>
                    <div id="sesion-task-container" class="mb-4"></div>
                    <div id="delivered-task-container"></div>

                </div>

            </div>
            
        </div>
    </div>
</div>

{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#task-modal">Large modal</button> --}}

<div id="task-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="font-size: 0.9rem;">
            <div class="modal-header">
                <h6 class="m-0 font-weight-bold text-primary"> Tareas entregadas </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="px-2" id="student-task-container-2"></div>
                <div class="px-2" id="sesion-task-container-2" class="mb-4"></div>
                <div class="mt-4" id="delivered-task-container-2"></div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="/js/accordion.js"></script>
    <script src="/js/dateConversor.js"></script>
    <script src="/js/studentTasks.js"></script>
@endpush