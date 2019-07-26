@extends('components.sections.professorSection')
@section('userContent')

{{-- <style>
        .accordion-body:after {
            content: '\02228';
            color: #777;
            font-weight: bold;
            float: right;
            margin-left: 5px;
            margin-top: -1px;
          }
        .active:after {
            content: '\02227';
        }
</style> --}}

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Sesiones</h6>
            </div>
                <div class="card-body">
                    @if ($blocks==null)
                        <div class="alert alert-warning">
                            <br>
                            <ul>Aun no esta asignado a un bloque</ul>
                        </div>
                    @else
                    <label for="">Bloque: </label>
                    <select class="form-control col-md-6 col-12"  name="" id="selector">
                        @foreach ($blocks as $key => $block)
                            <option class="optional" value="{{$block->block_id}}">{{$block->block_id}} - {{$subjects[$key]}}</option>
                        @endforeach
                    </select>
                    @if ($sesions!=null)
                        @foreach ($blocks as $block)
                        <div id="block-{{$block->block_id}}" class="blocks-sesions">
                            <hr>
                            <div class="text-center">
                                <label class="h5 text-gray-900 mb-4">Generación Automática de Sesiones</label>
                            </div>
                            @if (count($errors)>0)
                            <div class="alert alert-danger">
                                <b>Ha ocurrido un Error!</b>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form class="user" action="/sesions/store" method="POST">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="form-group col-md-4 col-6">
                                        <label for='name' class="">Inicio de las Sesiones</label>
                                        <div>
                                            <input  type="text"
                                                    name="date_start"
                                                    id="inicio_fecha"
                                                    class="form-control col-md-12"
                                                    placeholder=""
                                                    value="{{$start}}" required readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-6">
                                        <label for='name' class="">Fin de las Sesiones</label>
                                        <div>
                                            <input  type="text"
                                                    name="date_end"
                                                    id="fin_fecha"
                                                    class="form-control col-md-12"
                                                    placeholder=""
                                                    value="{{$end}}" required readonly>
                                        </div>
                                    </div>
                                    <input name="block_id" value="{{$block->block_id}}"hidden>
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
                            <hr>
                            <div class="text-center">
                                    <label class="h5 text-gray-900 mb-4">Sesiones</label>
                            </div>
                            @if (empty($sesions[0][0]))
                                <div class="alert alert-warning">
                                    Aun no tiene sesiones en este bloque
                                </div>
                            @endif
                            
                            @foreach ($sesions as $sesion)
                            @php
                                $i = 0;
                            @endphp
                                @foreach ($sesion as $s)
                                    @if ($s->block_id==$block->block_id)
                                        <thead>
                                                <tr>
                                                    <div class="accordion-body bg-gray-300 rounded row" style="cursor: default;">
                                                        <div class="container d-flex justify-content-between p-1" style="">
                                                            <div class="d-flex justify-content-start">
                                                                <strong style="color: gray;"> Sesión:&nbsp; </strong> {{ $s->number_sesion }}
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <div class="mx-4">
                                                                    <a href="#" class="mx-2" onclick="showSesion({{$s}}), loadPractice({{$s->id}})" data-toggle-2="tooltip" title="Guía práctica" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-book-open"></i></a>
                                                                </div>
                                                                <div class="text-center" onclick="showAccordion({{$s->id}})" style="cursor: pointer; width: 18px;"><strong id="arrowAccordion{{$s->id}}" style="color: #8b8b8b; font-weight: bold;">&#709;</strong></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                        </thead>

                                        <div id="panel{{$s->id}}">
                                            <div class="d-flex justify-content-between">
                                                <div id="sesion-dates{{$s->id}}" class="col-xl-5 py-1 px-2 my-1 mx-1 card shadow" style="font-size: 15px;"></div>
                                                    
                                                <div class="col-xl-7 mt-1 pl-0" style="padding-right: 12px;">
                                                    <div class="card shadow m-0">
                                                        <div class="card-body" style="padding: 8px;">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col">
                                                                    <div class="text-xs font-weight-bold text-info text-uppercase">Tareas entregadas</div>
                                                                    <div class="row no-gutters align-items-center">
                                                                        <div class="col-auto">
                                                                            <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800">{{ $tasks_by_sesion[$i] }}/{{ $block_registered }}</div>
                                                                        </div>
                                                                        <div class="col">
                                                                        <div class="progress progress-sm mr-2">
                                                                            @php
                                                                                $porcent_tasks = ($tasks_by_sesion[$i] * 100) / $block_registered;
                                                                            @endphp
                                                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $porcent_tasks }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <script>
                                            var start_month = getSesionMonth({!! json_encode($s->date_start) !!});
                                            $('#sesion-dates'+{!! json_encode($s->id) !!}).append(`<div> <strong> Inicio: </strong> ${start_month} </div>`);
                                            var end_month = getSesionMonth({!! json_encode($s->date_end) !!});
                                            $('#sesion-dates'+{!! json_encode($s->id) !!}).append(`<div> <strong> Fin: </strong> ${end_month} </div>`);
                                        </script>
                                        
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            @endforeach
                        </div>
                        @endforeach
                    @endif
                </div>
            @endif
        </div>
    </div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                        {{-- <label for="">Título</label> --}}
                                        <input id="title" name="title" type="text" class="form-control col-md-12" placeholder="Título (*)" required autofocus>
                                </div>
                                <br>
                                {{--  <div class='custom-control custom-checkbox small' style="margin-left: 13px; margin-top:-12px; margin-bottom: 5px;">
                                    <input type='checkbox' class='custom-control-input' id='checkbox-description' onclick='showHideTaskForm()'>
                                    <label class='custom-control-label' for='checkbox-description'>Descripción</label>
                                </div>  --}}
                                <div class="group col-sm-12">
                                        {{-- <label for="">Descripción</label> --}}
                                        <textarea name="description" id="description" class="form-control col-md-12" cols="30" rows="6" placeholder="Descripción" style="resize: none;" autofocus></textarea>
                                </div>
                                <br>
                                <div class="group col-sm-12 custom-file container" style="padding: 0px 20px;">
                                    <input class="custom-file-input" id="practice" type="file" name="practice" style="margin-bottom: 4px; cursor: pointer;" required>
                                    <label class="custom-file-label" for="practice" style="margin: 0px 10px;">Subir un archivo</label>
                                    <br>
                                    Solo los siguientes formatos son admitidos: <strong>.zip .rar .pdf</strong><br>
                                </div>
                                {{--  @if (count($errors)>0)  --}}
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
                                            {{--  <li>{{$error}}</li>  --}}
                                        </ul>
                                    </div>
                                {{--  @endif  --}}
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
                    @if (Agent::isMobile())
                        <div class="d-flex justify-content-center bd-highlight mb-3">
                            <button type="button" class="btn btn-primary btn-block btn-sm p-2 bd-highlight" style="">Guardar</button>
                            <button type="button" class="btn btn-secondary btn-block btn-sm p-2 bd-highlight" style="">Cancelar</button>
                        </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-block btn-sm col-md-3 mx-2" style="" onclick="storeTask()">Guardar</button>
                            <button type="button" class="btn btn-secondary btn-block btn-sm col-md-3 mx-2" style="margin-top: 0px;" onclick="hideFormActivity()">Cancelar</button>
                        </div>
                    @endif
                </div>
                
                <div id="btnsEditTasks" style="margin-bottom: 25px;">
                    @if (Agent::isMobile())
                        <div class="d-flex justify-content-center bd-highlight mb-3">
                            <button type="button" class="btn btn-primary btn-block btn-sm p-2 bd-highlight" style="">Guardar</button>
                            <button type="button" class="btn btn-secondary btn-block btn-sm p-2 bd-highlight" style="">Cancelar</button>
                        </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-block btn-sm col-md-3 mx-2" style="" onclick="storeEditedTask()">Guardar</button>
                            <button type="button" class="btn btn-secondary btn-block btn-sm col-md-3 mx-2" style="margin-top: 0px;" onclick="hideFormActivity()">Cancelar</button>
                        </div>
                    @endif
                </div>

                {{-- <form method="POST" action="{{ url('/students/registration/store') }}">
                    {{ csrf_field() }}
                    <input id="block_schedule_id" type="number" name="block_schedule_id" style="display: none;">
                    <input id="group_id_input" type="number" name="group_id" style="display: none;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btn_confirm">Confirmar</button>
                </form> --}}

            </div>
        </div>
    </div>
    </div>
    
    <script>
        $('.blocks-sesions').hide();
        $( '#selector' ).change(function() {
            $('select option:selected').each(function() {
                $('.blocks-sesions').hide();
                $('#block-'+$(this).attr('value')).show();
            });
        });
        var firts_id = $( "#selector option:selected" ).attr('value');
        $('#block-'+firts_id).show();

        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <script src="/js/accordion.js"></script>
@endsection

@push('scripts')
    <script src="/js/sesions.js"></script>
    <script src="{{ asset('js/datepicker/datepinker.js') }}"></script>
@endpush