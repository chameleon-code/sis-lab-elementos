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
                @if ($blockGroup==null)
                    <div class="alert alert-danger">
                        <b>Alerta</b>   
                        <ul>Aun no esta asignado a un bloque</ul>
                    </div>
                @else
                <div class="panel-heading my-2 font-weight-bold text-primary container">
                    Sesiones
                    <select name="" id="">
                        @foreach ($block as $blocks)
                            
                        @endforeach
                    </select>

                    <div class="float-right">
                        <a href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#deleteSesion">
                                <span class="icon text-white-50" data-toggle="tooltip" title="Quitar Sesión">
                                    <i class="fas fa-minus"></i>
                                </span>
                            </a>
                            
                            <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#addSesion">
                                <span class="icon text-white-50" data-toggle="tooltip" title="Añadir Sesión">
                                    <i class="fas fa-plus"></i>
                                </span>
                            </a>
                    </div>
                </div>

                <div class="container">
                        <strong>Bloque: </strong> {{ $blockGroup->block_id }}
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
                    
                    <div class="panel" style="max-height: 100%;">
                        @foreach ($tasks as $task)
                            @if($task->sesion_id == $sesion->id)
                                <div class="my-2 mx-2" style="border-bottom: 1px solid #b5b5b5; font-size: 15px;">
                                    <div style="margin-top: 12px; margin-bottom: -15px;"> <p> <strong> Tarea: </strong> <a href="#">{{ $task->title }}</a> </p> </div>
                                        <div class="row" style="margin-top: -15px; margin-bottom: -15px;">
                                            <div class="row" style="margin-left: 12px;">
                                                <strong> Entregados: </strong>
                                                <div class="progress progress-sm bg-gray-400" style="margin-top: 8px; margin-left: 15px; margin-right: 10px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 80px; margin-right: 30px;" aria-valuenow="8" aria-valuemin="0" aria-valuemax="14"></div>
                                                </div>
                                            </div>
                                            <p style="margin-left: 12px;"> 8/14 </p>
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
                                        <input type="text" class="form-control" style="display: none;" name="block_id" value="{{ $blockId }}" required autofocus>
                                        <input type="text" class="form-control" style="display: none;" name="number_sesion" value="{{ $sesion_max + 1 }}" required autofocus>
                                        <button type="submit" class="btn btn-primary">Aceptar</button>  
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                @endif
            </div>
        </div>

<script src="/js/accordion.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
</script>
@endsection