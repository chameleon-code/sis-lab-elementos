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
                Administrar Prácticas
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
                    <div class="panel" style="max-height: 100%;"> {{--expandir o no--}}
                        <div class="my-2 mx-2" style="border-bottom: 1px solid #b5b5b5; font-size: 15px;">
                            <form class="user" action="{{Route('tasks.create')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="group col-sm-12">
                                        <label for="">Título</label>
                                        <input id="title" name="title" type="text" class="form-control col-md-12" required autofocus>
                                </div>
                                <div class="group col-sm-12">
                                        <label for="">Descripción</label>
                                        <textarea name="description" id="description" class="form-control col-md-12" cols="30" rows="3" autofocus></textarea>
                                </div>
                                <div class="group col-sm-12">
                                        <label for="">
                                            Solo los siguientes formatos son admitidos: <strong>.zip .rar .pdf</strong> 
                                        </label>
                                </div>
                                <div class="group col-sm-12">
                                    <br>
                                    <input type="file" name="practice" style="margin-bottom:8px;" required>
                                </div>
                                <input type="text" name="sesion_id" value="{{$sesion->id}}" hidden>
                                <input type="text" name="number_sesion" value="{{$sesion->number_sesion}}" hidden>
                                @if (Agent::isMobile())
                                    <div class="group col-md-12 col-12">
                                        <button type="submit" class="btn btn-primary btn-block col-md-12" style="margin-bottom:10px;">Publicar</button>
                                    </div>
                                @else
                                    <div class="group col-md-4 col-4 offset-md-4 offset-4">
                                        <button type="submit" class="btn btn-primary btn-block col-md-12" style="margin-bottom:10px;">Publicar</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
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