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
          .active:after {
              content: '\02227';
          }
</style>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="panel-heading my-2 font-weight-bold text-primary container">
                    Portafolios
                </div>

                <div class="container">
                    <strong>Estudiante: </strong> {{ $user->first_name.' '.$user->second_name.' '.$user->names }} <br>
                    <strong>Materia: </strong> {{ $subject_matter->name }} <br>
                    <strong>Grupo: </strong> {{ $group->name }}
                </div>

                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success"><strong> {{Session::get('status_message')}} </strong></p>
                    @endif

                    @foreach ($sesions as $sesion)
                    <thead>
                        <tr>
                            <div class="accordion-body bg-gray-300 border-bottom-primary rounded" style="margin-top: 8px;">
                                <strong style="color: gray;"> Sesión: </strong> {{ $sesion->number_sesion }}
                            </div>
                        </tr>
                        
                    </thead>
                    
                    <div class="panel">
                        @foreach ($tasks as $task)
                            @if($task->sesion_id == $sesion->id)
                                <div class="my-2 mx-2" style="border-bottom: 1px solid #b5b5b5; font-size: 15px;">
                                        <div style="margin-top: 12px; margin-bottom: -15px;"> <p> <strong> Estado de tarea: </strong> <a href="/professor/student/{{$student->id}}/task/{{$task->id}}">{{ $task->title }}</a> </p> </div>
                                        <div class="row" style="margin-top: -15px;">
                                            <div class="row" style="margin-left: 12px;">
                                                <strong> Entregado: &#10003 &#10005 </strong>
                                            </div>
                                        </div>
                                        <div> <p> <strong> Límite de entrega: </strong> {{$task->end}} </p> </div>
                                </div>
                            @endif
                        @endforeach
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