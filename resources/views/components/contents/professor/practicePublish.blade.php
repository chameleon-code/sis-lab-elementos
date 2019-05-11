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
                    Prácticas
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
                    
                    <div class="panel" style="max-height: 106px;">
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
        </div>
    </div>
</div>

<script src="/js/accordion.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
</script>
@endsection