@extends('components.sections.studentSection')
@section('userContent')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Actividades</h1>
        </div>
        @if (count($errors)>0)
        <div class="alert alert-warning">
            <b>Ha ocurrido un Error!</b>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
                <div class="col-xl-4 col-md-12 mb-4 col-12">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Asistencia</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">2/13</div>
                            </div>
                            <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
    
                <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Prácticas entregadas</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1/13</div>
                            </div>
                            <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 9.8%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
    
                <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Prácticas sin entregar</div>
                            <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1/13</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 9.8%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
        
        <div class="card shadow mb-4">
            <ul class="nav nav-tabs" role="tablist">
                {{-- <li class="nav-item">
                  <a class="nav-link" href="#profile" role="tab" data-toggle="tab">profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#buzz" role="tab" data-toggle="tab">buzz</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#references" role="tab" data-toggle="tab">references</a>
                </li> --}}
                @foreach ($sesions as $key=>$sesion)
                    {{-- active --}}
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
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($sesion->sesion->number_sesion)/($sesion->totalSesion)*100}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                @foreach ($sesion->tasks as $task)
                                <div class="col-12 col-sm-12" style="margin-bottom: 1rem;">
                                    <form class="user" method="POST" action="{{ url('/student/activities') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="accordion-body bg-gray-300 rounded row my-2" id="task1" style="cursor: default;">
                                            <div class="group col-sm-12">
                                                <label ><b>{{$task->title}}</b></label>
                                                <br>
                                                <label for="">
                                                    {{$task->description}}
                                                </label>
                                                <br>
                                                <label for="">
                                                    Archivo adjunto: <a href="{{$task->task_path.$task->task_file}}">{{$task->task_file}}</a>
                                                </label>
                                            </div>
                                        </div>
                                        <input type="" name="task_id" value="{{$task->id}}" hidden>
                                        <input type="" name="block_id" value="{{$sesion->block_id}}" hidden>
                                        <input type="" name="sesion_number" value="{{$sesion->sesion->number_sesion}}" hidden>
                                        <input type="" name="schedule_id" value="{{$sesion->schedule_id}}" hidden>
                                        <div class="group col-sm-12">
                                            <label for="" style="word-wrap: break-word;">Descripción</label>
                                            <textarea name="description" class="form-control col-md-12" id="" cols="30" rows="2"></textarea>
                                        </div>
                                        <div class="group col-sm-12">
                                            <label for="">
                                                <br>
                                                Procura subir un comprimido o archivador con tu ejercicio adentro, solo los siguientes formatos son admitidos: <strong>.zip .rar .tar.gz</strong>
                                                <br>
                                            </label>
                                            <div class="row">
                                                
                                                @if (Agent::isMobile())
                                                    <div class="col-md-12 col-12 custom-file">
                                                        <input class="custom-file-input" id="practice" type="file" name="practice" style="cursor: pointer;" required="">
                                                        <label class="custom-file-label" for="practice" style="margin: 0px 10px; color:darkslateblue;">Subir un archivo</label>
                                                    </div>
                                                    <div class="col-md-12 col-12" style="margin-top: 1rem">
                                                        <button type="submit" class="btn btn-primary btn-block" >Entregar</button>
                                                    </div>
                                                @else
                                                    <div class="col-md-7 col-7 custom-file">
                                                        <input class="custom-file-input" id="practice" type="file" name="practice" style="cursor: pointer;" required="">
                                                        <label class="custom-file-label" for="practice" style="margin: 0px 10px; color:darkslateblue;">Subir un archivo</label>
                                                    </div>
                                                    <div class="col-md-5 col-5">
                                                        <button type="submit" class="btn btn-primary btn-block" >Entregar</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>             
                                @endforeach
                            </div>
                        </div>
                    @endforeach                
                    {{--<div role="tabpanel" class="tab-pane fade in" id="buzz">bbb</div>
                    <div role="tabpanel" class="tab-pane fade in active" id="references">ccc</div> --}}
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