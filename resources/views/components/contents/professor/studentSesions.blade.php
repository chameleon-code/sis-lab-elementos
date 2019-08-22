@extends('components.sections.professorSection')
@section('userContent')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <div class="d-flex justify-content-between">
                <div class="panel-heading my-2 font-weight-bold text-primary container py-2">Portafolio</div>
                @if (!empty($tasks_finisheds))
                    <form action="/download" method="get">
                        {{ csrf_field() }}
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        <strong><button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Descargar portafolio" style="margin-top: 11px; margin-right: 18px;"><i class="fa fa-download" aria-hidden="true"></i></button></strong>
                    </form>
                @endif
            </div>

            <div class="container">
                <strong>Estudiante: </strong> {{ $schedule->user->first_name.' '.$schedule->user->second_name.' '.$schedule->user->names }} <br>
                <strong>Materia: </strong> {{ $schedule->group->subject->name }} <br>
                <strong>Grupo: </strong> {{ $schedule->group->name }} <br>
            </div>

                <div class="card-body">
                @if (Session::has('status_message'))
                    <p class="alert alert-success"><strong> {{Session::get('status_message')}} </strong></p>
                @endif

                @foreach ($sesions as $sesion)
                <thead>
                    <tr>
                    @if(!empty($tasks_finisheds) &&$tasks_finisheds[$loop->index]->tasks > 0)   

                                <div class="card border-left-success shadow h-100" style="margin-bottom: 0px;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    <strong style="color: gray;"> Sesión:&nbsp; </strong> {{ $sesion->number_sesion }}
                                                    <br>
                                                    @if ($tasks_finisheds[$loop->index]->assist == 1)
                                                        <strong>Realizado en clase</strong>
                                                        @else
                                                        <strong>Realizado en casa</strong>
                                                    @endif
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
                                        {{--  <div class="d-flex justify-content-end">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" onclick="showAccordion({{$sesion->id}})" style="cursor: pointer; width: 18px;"><strong id="arrowAccordion{{$sesion->id}}" style="color: gray; font-weight: bold;">&#709;</strong></div>
                                        </div>                                              --}}
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
                
                        <div class="d-flex justify-content-between bd-highlight" style="">
                            
                            <div class="mx-2" style="font-size: 15px;">
                                <div style="margin-top: 12px; margin-bottom: -15px;">
                                    {{-- <p> <strong> Estado de tarea: </strong> <a href="/professor/student/{{$schedule->student->id}}/task/{{$task->id}}">{{ $task->title }}</a> </p> --}}
                                    <p> <strong> Tarea: </strong> {{ $task->title }}</p>
                                </div>                                
                                <div class="row" style="margin-top: -15px;">
                                    <div class="row" style="margin-left: 12px;" >
                                        @if (in_array($task->id, $student_tasks_ids))
                                        <div data-parent-id="panel{{$sesion->id}}">
                                            <strong>Entrega:&nbsp;</strong>
                                                @if ($tasks_finisheds[$loop->parent->index]->assist == 1 && $student_tasks->where('task_id', $task->id)->first()->in_time != 'no')
                                                   <label style="color: green;"> A tiempo</label>
                                                @else
                                                   <label style="color: orangered;"> Fuera de tiempo el dia {{ $student_tasks->where('task_id', $task->id)->first()->updated_at }} </label>
                                                @endif
                                                &#10003                                           
                                        </div><br>
                                        <div><strong> <a href="/downloadTask/{{ $student_tasks->where('task_id', $task->id)->first()->task_path}}/{{$student_tasks->where('task_id', $task->id)->first()->task_name  }}" download="{{ $student_tasks->where('task_id', $task->id)->first()->task_name }}" data-toggle-2='tooltip' title='Descargar Tarea'><i class="fa fa-download" aria-hidden="true"></i></a></strong></div>
                                        {{--  <div><strong data-id="score"> Puntuacion: {{ $student_tasks->where('task_id', $task->id)->first()->score }}</strong></div>  --}}
                                        @else
                                            <strong>Entrega:&nbsp;</strong> 
                                            <label style="color: red;"> Sin entregar &#10005</label>
                                        @endif
                                    </div>
                                </div>
                                <div> <strong> Límite de entrega: </strong> {{$sesion->date_end}} </div>
                            </div>

                            <div class="py-3 px-4" style="font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';">
                                <div class="" style="margin-bottom: 0px;">
                                    Puntuación:
                                </div><br>
                                @if (in_array($task->id, $student_tasks_ids))
                                <div class="text-center" style="font-size: 20px; margin-top: -20px;">
                                    <strong  id="score-task-number-{{$student_tasks->where('task_id', $task->id)->first()->id}}" style="margin-right: 5px;"> {{ $student_tasks->where('task_id', $task->id)->first()->score }} </strong>
                                    <a href='#' id='student-task-{{ $student_tasks->where('task_id', $task->id)->first()->id }}' class='' data-toggle-2='tooltip' title='Agregar nota' data-toggle="modal" data-target="#add-score" onclick='addScore({{ $student_tasks->where('task_id', $task->id)->first()->id }})' style="margin-left: 5px;"><i class='fas fa-edit'></i></a>
                                </div>
                                @else
                                <div class="text-center" style="font-size: 20px; margin-top: -20px;">
                                    <strong> - </strong>
                                </div>
                                @endif
                            </div>

                        </div>
                        @endif
                
                    @endforeach
                
                @else
                    @if(empty($tasks_finisheds))
                        <div class="alert alert-danger">
                            <b>El estudiante no realiz&oacute; ninguna sesi&oacute;n!</b>
                        </div>
                        @break
                    @endif
                    @continue
                @endif
                </div>
                @endforeach

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
            <a href="/professor/students/list" class="btn btn-primary float-right mx-3"> Regresar </a>
            <br><br>
        </div>
    </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="add-score" role="dialog" style="margin-left: 25%;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Agregar nota</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="form-score">
                {{csrf_field()}}
                <input type="number" class="form-control" id="task_score" name="task_score" style="width: 200px; margin-left: 30px;">
                <input type="number" class="form-control" id="student_task_id" name="student_task_id" hidden>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="storeScore()">Guardar</button>
        </div>
      </div>
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

@push('scripts')
    <script src="{{ asset('js/evaluationStudents.js') }}"></script>
@endpush