@extends('components.sections.professorSection')
@section('userContent')

<script>
    var managements = {!! json_encode( $managements ) !!};
    var groups = {!! json_encode( $groups ) !!}
</script>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sesiones</h6>
        </div>
        <div class="card-body">
            
            @if ( sizeof( $groups ) > 0 )

                <div class="">
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <label for="">Gestión: </label>
                            <select class="form-control" name="" id="management-selector" onchange="selectManagement(), setSesionsOfSelectedBlock()">
                                @foreach ($managements as $management)
                                    <option class="optional" value="{{$management->id}}">{{$management->semester}}/{{$management->managements}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label for="">Bloque: </label>
                            <select class="form-control" name="" id="block-selector" onchange="setSesionsOfSelectedBlock()">
                                {{-- @php
                                    $display_blocks = [];
                                    $last_index_managements = ( sizeof($managements)-1 >= 0 ) ? sizeof($managements)-1 : 0; // PUEDE QUE SEA AQUI!!!!!!!!!!!!
                                @endphp
                                @foreach ($groups as $group)
                                    @if( $group->management_id == $managements[$last_index_managements]->id && !in_array($group->block_id, $display_blocks) )
                                        <option class="optional" value="{{$group->block_id}}"> {{ $group->block_name }} ( {{ $group->subject->name }} )</option>
                                        @php
                                            array_push($display_blocks, $group->block_id);
                                        @endphp
                                    @endif
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="text-center" id="sesions-title"></div>

                <div id="sesions-container" class=""></div>


                <form id="form-auto-sesions" class="user" action="/sesions/store" method="POST" style="display: none;">
                    {{csrf_field()}}
                    <div class="alert alert-warning"> Aun no tiene sesiones en este bloque </div>
                    <div class="row">
                        <div class="form-group col-md-4 col-6">
                            <label for='name' class="">Inicio de las Sesiones</label>
                            <div>
                                <input type="text" name="date_start" id="inicio_fecha" class="form-control col-md-12" placeholder="" value="" required readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-6">
                            <label for='name' class="">Fin de las Sesiones</label>
                            <div>
                                <input type="text" name="date_end" id="fin_fecha" class="form-control col-md-12" placeholder="" value="" required readonly>
                            </div>
                        </div>
                        <input name="block_id" id="input-block-id" value="" hidden>
                        @if (Agent::isMobile())
                            <div class="form-group col-12">
                                <button id="btn_aling" type="submit" class="btn btn-warning btn-block col-md-12">
                                    <i class="fas fa-magic"></i>
                                    Autogenerar
                                </button>
                            </div> 
                        @else
                            <div class="form-group col-md-4 col-12">
                                <label style="height: 1.015rem;"></label>
                                <button id="btn_aling" type="submit" class="btn btn-warning btn-block col-md-12">
                                    <i class="fas fa-magic"></i>
                                    Autogenerar 
                                </button>
                            </div>  
                        @endif
                    </div>
                </form>

            @else

                <div class="alert alert-warning"> No se encuentra asignado a un bloque. </div>

            @endif

        </div>
    </div>
</div>

<div id="practice-sesion-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sesionTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-1 px-3" id="text_confirm_reg">
                <div class="px-1" id="sesionTasks">
                </div>

                <div class="my-1 mx-2" id="formActivity" style="font-size: 15px;">
                    <strong id="title-form" class="px-2"> </strong> <br><br>
                    <form class="user" id="taskForm" action="" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                        <div class="group col-sm-12">
                            <input id="title" name="title" type="text" class="form-control col-md-12" placeholder="Título (*)" autofocus>
                        </div>
                        <br>
                        <div class="group col-sm-12">
                            <textarea name="description" id="description" class="form-control col-md-12" cols="30" rows="6" placeholder="Descripción" style="resize: none;" autofocus></textarea>
                        </div>
                        <br>
                        <div class="group col-sm-12 custom-file container" style="padding: 0px 20px;">
                            <input class="custom-file-input" id="practice" type="file" name="practice" style="margin-bottom: 4px; cursor: pointer;" required>
                            <label class="custom-file-label" for="practice" style="margin: 0px 10px;">Subir un archivo</label> <br>
                            Solo los siguientes formatos son admitidos: <strong>.zip .rar .pdf</strong><br>
                        </div>
                        <div class="alert alert-danger" id="errors-div" style="padding-top: 10px; padding-bottom: 0px; margin: 10px 10px 0px 10px">
                            <div class="container d-flex justify-content-between p-1" style="">
                                <div class="d-flex justify-content-start" style="padding-left: 3px;">
                                    <b style="">Ha ocurrido un error!</b>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" id="btn-delete-task-3" class="mx-2" data-toggle-2="tooltip" onclick="hideErrors()"> <i class="fas fa-times" style="color: darkred;"> </i> </a> 
                                </div>
                            </div>
                            <ul id="errors-form">
                            </ul>
                        </div>
                        <input type="number" id="sesion_id" name="sesion_id" value="" hidden>
                        <input type="number" id="task_id" name="task_id" value="" hidden>
                    </form>
                </div>
            </div>
            
            <div class="text-center" id="footerModal">
                <div class="" style="margin-bottom: 20px;">
                    <a href="#" id="btnAddActivity" class="btn btn-primary btn-icon-split btn-sm" onclick="showFormActivity()">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Agregar tarea</span>
                    </a>
                </div>

                <div id="btnsTasks" style="margin-bottom: 25px;">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-block btn-sm col-md-3 mx-2" style="" onclick="storeTask()">Guardar</button>
                        <button type="button" class="btn btn-secondary btn-block btn-sm col-md-3 mx-2" style="margin-top: 0px;" onclick="hideFormActivity()">Cancelar</button>
                    </div>
                </div>
                
                <div id="btnsEditTasks" style="margin-bottom: 25px;">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-block btn-sm col-md-3 mx-2" style="" onclick="storeEditedTask()">Guardar</button>
                        <button type="button" class="btn btn-secondary btn-block btn-sm col-md-3 mx-2" style="margin-top: 0px;" onclick="hideFormActivity()">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

@endsection

@push('scripts')
    <script src="/js/accordion.js"></script>
    <script src="/js/sesions.js"></script>
    <script src="{{ asset('js/datepicker/datepinker.js') }}"></script>
@endpush