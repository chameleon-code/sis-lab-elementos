@extends('components.sections.studentSection')
@section('userContent')

   
    <div class="container-fluid">
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Actividades</h1>
        </div> --}}
        <div class="card shadow mb-4">
            <ul class="nav nav-tabs" role="tablist">
                @foreach ($sesions as $key=>$sesion)
                    <li class="nav-item">
                    @if ($key==0)
                        <a class="nav-link active" href="#{{str_replace(" ","",$sesion->subject)}}" role="tab" data-toggle="tab" aria-selected="true">{{$sesion->subject}}</a>
                    @else
                        <a class="nav-link" href="#{{str_replace(" ","",$sesion->subject)}}" role="tab" data-toggle="tab">{{$sesion->subject}}</a>
                    @endif
                    </li>
                @endforeach
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    @if ($sesions==[])
                        @if (count($errors)>0)
                            <div class="alert alert-warning">
                                @foreach ($errors->all() as $error)
                                    <label for="">{{$error}}</label>
                                @endforeach
                            </div>
                        @endif
                    @endif
                    @foreach ($sesions as $key=>$sesion)
                        @if ($key==0)
                            <div role="tabpanel" class="tab-pane fade in active show" id="{{str_replace(" ","",$sesion->subject)}}">
                        @else
                            <div role="tabpanel" class="tab-pane fade in" id="{{str_replace(" ","",$sesion->subject)}}">
                        @endif
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sesion</div>
                                        <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$sesion->sesion->number_sesion}}/{{$sesion->totalSesion}}</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{($sesion->sesion->number_sesion)/($sesion->totalSesion)*100}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <br>
                                <div class="text-center">
                                    <label class="h5 text-gray-900 mb-4">Prácticas de la Sesión</label>
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
                                @if ($sesion->tasks==[])
                                    <div class="alert alert-warning">
                                        <label for="">Aún no existen practicas para la sesión</label>
                                    </div>
                                @endif
                                @foreach ($sesion->tasks as $task)
                                    <div class="row">
                                        <div class="col-md-6 col-12 col-sm-12">
                                            <div class="accordion-body bg-gray-300 rounded row my-2" id="task1" style="cursor: default;">
                                                <div class="group col-sm-12">
                                                    <label class="h6"><b>{{$task->task->title}}</b></label>
                                                    <br>
                                                    <label for="">
                                                        {{$task->task->description}}
                                                    </label>
                                                    <br>
                                                    @if ( $task->task->task_file != null )
                                                        <label for="">
                                                            <b>Archivo adjunto:</b>  <a href="{{$task->task->task_path.$task->task->task_file}}">{{$task->task->task_file}}</a>
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 col-sm-12">
                                        @if ($task->done==[])
                                            <form class="user create-form" id="form-create-{{$task->task->id}}" method="POST" action="{{ url('/student/activities') }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="" name="task_id" value="{{$task->task->id}}" hidden>
                                                <input type="" name="block_id" value="{{$sesion->block_id}}" hidden>
                                                <input type="" name="sesion_number" value="{{$sesion->sesion->number_sesion}}" hidden>
                                                <input type="" name="schedule_id" value="{{$sesion->schedule_id}}" hidden>
                                                <div class="group col-sm-12">
                                                    <textarea name="description" placeholder="Descripción" class="form-control col-md-12" id="" cols="30" rows="2" style="margin-top: 0.5rem;"></textarea>
                                                </div>
                                                <div class="group col-sm-12">
                                                    <label for="">
                                                        <br>
                                                        Procura subir un comprimido o archivador con tu ejercicio adentro, los siguientes formatos son admitidos: <strong>.zip .rar</strong>
                                                        <br>
                                                    </label>
                                                    <div class="row">
                                                        @if (Agent::isMobile())
                                                            <div class="col-md-12 col-12 custom-file">
                                                                <input class="custom-file-input input-create-{{$task->task->id}}" id="practice" type="file" accept=".zip,.rar" name="practice" style="cursor: pointer;" required="">
                                                                <label class="custom-file-label" for="practice" style="margin: 0px 10px; color:darkslateblue;">Subir un archivo*</label>
                                                            </div>
                                                            <div class="col-md-12 col-12" style="margin-top: 1rem">
                                                                <button type="submit" class="btn btn-primary btn-block">Entregar</button>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                    <label class="error-label" id="error-create-{{$task->task->id}}" for="" style="color: crimson">Inserte un archivo <b>.zip</b> o <b>.rar</b></label>
                                                            </div>
                                                        @else
                                                            <div class="col-md-7 col-7 custom-file">
                                                                <input class="custom-file-input input-create-{{$task->task->id}}" id="practice" type="file" accept=".zip,.rar" name="practice" style="cursor: pointer;" required="">
                                                                <label class="custom-file-label" for="practice" style="margin: 0px 10px; color:darkslateblue;">Subir un archivo*</label>
                                                            </div>
                                                            <div class="col-md-5 col-5">
                                                                <button type="submit" class="btn btn-primary btn-block" style="z-index:5; position: relative;">Entregar</button>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <label class="error-label" id="error-create-{{$task->task->id}}" for="" style="color: crimson">Inserte un archivo <b>.zip</b> o <b>.rar</b></label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                        <div id="not-edit-{{$task->done->id}}">
                                            <div class="group col-sm-12">
                                                <b>Descripción: </b>{{$task->done->description}}
                                            </div>
                                            <div class="group col-sm-12">
                                                <b>Archivo: </b><a href="{{'/storage/'.$task->done->task_path.'/'.$task->done->task_name}}">{{$task->done->task_name}}</a>
                                            </div>
                                            <div class="group col-sm-12">
                                                <button type="button" class="btn btn-warning btn-block" onclick="showEdit({{$task->done->id}})">Modificar Entrega</button>
                                            </div>
                                        </div>
                                        <div class="to-edit" id="edit-{{$task->done->id}}">
                                            <div class="text-center">
                                                <label><b>Modificación de Entrega</b></label>
                                            </div>
                                            <form class="user edit-form" id="form-{{$task->done->id}}" method="POST" action="{{ Route('activity.update',[$task->done->id]) }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="" name="task_id" value="{{$task->task->id}}" hidden>
                                                <input type="" name="block_id" value="{{$sesion->block_id}}" hidden>
                                                <input type="" name="sesion_number" value="{{$sesion->sesion->number_sesion}}" hidden>
                                                <input type="" name="schedule_id" value="{{$sesion->schedule_id}}" hidden>
                                                <div class="group col-sm-12">
                                                    <textarea name="description" placeholder="Descripción" class="form-control col-md-12" id="" cols="30" rows="2" style="margin-top: 0.5rem;">{{$task->done->description}}</textarea>
                                                </div>
                                                <div class="group col-sm-12">
                                                    <label for="">
                                                        <br>
                                                        Procura subir un comprimido o archivador con tu ejercicio adentro, los siguientes formatos son admitidos: <strong>.zip .rar</strong>
                                                        <br>
                                                    </label>
                                                    <div class="row">
                                                        <div class="col-md-12 col-12 custom-file">
                                                            <input class="custom-file-input input-{{$task->done->id}}" id="practice" accept=".zip,.rar" type="file" name="practice" style="cursor: pointer;" required="">
                                                            <label class="custom-file-label" for="practice" style="margin: 0px 10px; color:darkslateblue;">Subir un archivo*</label>
                                                        </div>
                                                    </div>
                                                    <label class="error-label" id="error-{{$task->done->id}}" for="" style="color: crimson">Inserte un archivo <b>.zip</b> o <b>.rar</b></label>
                                                    <div class="row">
                                                        @if (Agent::isMobile())
                                                            <div class="col-md-6 col-6" style="margin-top: 0.5rem">
                                                                <button type="button" class="btn btn-danger btn-block" onclick="cancel({{$task->done->id}})">Cancelar</button>
                                                            </div>
                                                            <div class="col-md-6 col-6" style="margin-top: 0.5rem">
                                                                <button type="submit" class="btn btn-primary btn-block">Entregar</button>
                                                            </div>
                                                        @else
                                                            <div class="col-md-6 col-6" style="margin-top: 0.5rem">
                                                                <button type="button" class="btn btn-danger btn-block" onclick="cancel({{$task->done->id}})">Cancelar</button>
                                                            </div>
                                                            <div class="col-md-6 col-6" style="margin-top: 0.5rem">
                                                                <button type="submit" class="btn btn-primary btn-block" style="z-index:1; position: relative;">Entregar</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @endif
                                        </div>
                                    </div>
                                    <br>
                                    @if (next($sesion->tasks))
                                        <hr>                                    
                                    @endif
                                @endforeach
                            </div>
                    @endforeach                
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(reductString(fileName));
        });

        $(".to-edit").hide();

        $('.error-label').hide();

        $(".edit-form").submit(function(event){
            var a = this.id.split('-');
            a = a[a.length-1];
            var nameinput = '.input-'+a;
            var nameinput = $(nameinput).val().split("\\").pop();
            if(!verifyMimeType(nameinput)){
                event.preventDefault();
                console.log("verifique el mimetype");
                $('#error-'+a).show();
            }else{
                $('#error-'+a).hide();
            }
        });

        $(".create-form").submit(function(event){
            var a = this.id.split('-');
            a = a[a.length-1];
            var nameinput = '.input-create-'+a;
            var nameinput = $(nameinput).val().split("\\").pop();
            if(!verifyMimeType(nameinput)){
                event.preventDefault();
                $('#error-create-'+a).show();
            }else{
                $('#error-create-'+a).hide();
            }
        });

        function showEdit(string){
            var name = "#edit-"+string;
            var notEditName = "#not-edit-"+string;
            $(name).show();
            $(notEditName).hide();
        }

        function cancel(string){
            var name = "#edit-"+string;
            var notEditName = "#not-edit-"+string;
            $(name).hide();
            $(notEditName).show();
        }
        function reductString(string){
            if(string.length<=30){
                return string;
            }else{
                return string='..'+string.substring(string.length-28,string.length)
            }
        }
        function verifyMimeType(filename){
            res= false;
            filename = filename.split('.');
            if(filename[filename.length-1]=='zip' || filename[filename.length-1]=='rar'){
                res=true;
            }
            return res;
        }
    </script>
@endsection