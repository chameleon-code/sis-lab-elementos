@extends('components.sections.professorSection')
@section('userContent')

<style>
        .accordion-body:after {
            content: '\02228';
            color: #777;
            font-weight: bold;
            float: right;
            margin-left: 5px;
          }
</style>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="panel-heading my-2 font-weight-bold text-primary container">
                    Portafolios
                </div>

                <div class="container">
                    <strong>Estudiante: </strong> {{ $schedule->user->first_name.' '.$schedule->user->second_name.' '.$schedule->user->names }} <br>
                    <strong>Materia: </strong> {{ $schedule->group->subject->name }} <br>
                    <strong>Grupo: </strong> {{ $schedule->group->name }}
                </div>

                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success"><strong> {{Session::get('status_message')}} </strong></p>
                    @endif

                    @foreach ($sesions as $sesion)
                    <thead>
                            <tr>
                                @if(!empty($tasks_finisheds) &&$tasks_finisheds[$loop->index]->tasks > 0)       
                                <div class="accordion-body rounded row" style="cursor: default;"  data-id='sesion'>
                                    <div class="col-xl-12 col-md-12 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                            <strong style="color: gray;"> Sesión:&nbsp; </strong> {{ $sesion->number_sesion }}
                                                        </div>
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col-auto">
                                                                <div id="sesion{{ $sesion->id }}" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $tasks_finisheds[$loop->index]->tasks }}/{{ $sesion->tasks->count() }}</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($tasks_finisheds[$loop->index]->tasks * 100) / $sesion->tasks->count() }}%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                    <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1" onclick="showAccordion({{$sesion->id}})" style="cursor: pointer; width: 18px;"><strong id="arrowAccordion{{$sesion->id}}" style="color: gray; font-weight: bold;">&#709;</strong></div>
                                                </div>                                            
                                            </div>
                                        </div>                                            
                                    </div>                                            
                                </div>
                                
                            </tr>
                    </thead>
                    <div class="py-2" id="panel{{$sesion->id}}" style="max-height: 100%;">
                        @if (in_array($sesion->id ,array_pluck($tasks_finisheds, 'sesion_id'))) 
                            <input type="hidden" value="{{ $tasks_finisheds[$loop->index]->tasks }}" data-total="{{ $sesion->tasks->count() }}" data-sesion="{{ $tasks_finisheds[$loop->index]->sesion_id }}">
                        @endif
                    
                        @foreach ($tasks as $task)
                            @if ($task->sesion_id == $sesion->id)
                            
                                <div class="my-2 mx-2" style="font-size: 15px;">
                                    <div style="margin-top: 12px; margin-bottom: -15px;">
                                    <p> <strong> Estado de tarea: </strong> <a href="/professor/student/{{$schedule->student->id}}/task/{{$task->id}}">{{ $task->title }}</a> </p> </div>
                                    <div class="row" style="margin-top: -15px;">
                                        <div class="row" style="margin-left: 12px;" >
                                            @if (in_array($task->id, $student_tasks_ids))
                                                <div data-parent-id="panel{{$sesion->id}}"><strong> Entregado: &#10003  </strong></div>
                                                <div><strong data-id="score"> Puntuacion: {{ $student_tasks->where('task_id', $task->id)->first()->score }}</strong></div>
                                                @else
                                                <strong>Sin entregar &#10005</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div> <p> <strong> Límite de entrega: </strong> {{$sesion->date_end}} </p> </div>
                                </div>   
                            @endif
                        @endforeach
                    @else
                        @if(empty($tasks_finisheds))
                        <div class="alert alert-danger">
                                <b>El estudiante no realiz&oacute; ningua sesi&oacute;n!</b>
                        </div>
                        @break
                        @endif
                    @continue
                    @endif
                    </div>
                    @endforeach

                    <div class="modal fade" id="deleteSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Sesión</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                Las tareas pertenecientes a una sesión no serán elimindas. <br><br>
                            @foreach ($sesions as $sesion)
                                <p> Sesion {{ $sesion->number_sesion }} <input name={{ $sesion->id }} type="checkbox" class="float-right"> </p>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                        </div>
                    </div>
                    </div>


                    <div class="modal fade" id="addSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Añadir Sesión</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Se agregará la Sesión: {{ $sesion_max + 1 }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <form action="/sesions/store" method="POST">
                                {{csrf_field()}}
                                <input type="text" class="form-control" style="display: none;" name="block_id" value="1" required autofocus>
                                <input type="text" class="form-control" style="display: none;" name="number_sesion" value="{{ $sesion_max + 1 }}" required autofocus>
                                <button type="submit" class="btn btn-primary">Aceptar</button>  
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                    
                    <br>
                    <a href="/professor/students/list" class="btn btn-primary float-right"> Regresar </a>
                    <br><br>
        </div>
    </div>
</div>

<script src={{  asset("/js/accordion.js")  }}></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
</script>
@endsection