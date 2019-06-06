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
                        <div class="alert alert-danger">
                            <br>
                            <ul>Aun no esta asignado a un bloque</ul>
                        </div>
                    @else
                    <label for="">Bloque: </label>
                    <select class="form-control col-md-6 col-12"  name="" id="selector">
                        @foreach ($blocks as $block)
                            <option class="optional" value="{{$block->block_id}}">{{$block->block_id}}-MateriaX</option>
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
                                                                    <a href="#" class="mx-2" onclick="showSesion({{$s->number_sesion}})" data-toggle-2="tooltip" title="Guía práctica" data-toggle="modal" data-target=".bd-example-modal-lg" onclick=""><i class="fas fa-book-open"></i></a>
                                                                </div>
                                                                <div class="text-center" onclick="showAccordion({{$s->id}})" style="cursor: pointer; width: 18px;"><strong id="arrowAccordion{{$s->id}}" style="color: #8b8b8b; font-weight: bold;">&#709;</strong></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                        </thead>
                                        <div class="py-2" id="panel{{$s->id}}" style="max-height: 100%;">
                                            <div class="my-2 mx-2" style="font-size: 15px;">
                                                <div style="margin-top: 12px; margin-bottom: -15px;"> 
                                                    <p> <strong> Inicio: </strong> {{$s->date_start}} </p> 
                                                </div>
                                                <div style="margin-top: 12px; margin-bottom: -15px;"> 
                                                    <p> <strong> Fin: </strong>  {{$s->date_end}}</p> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @endif
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
                    <div class="accordion-body bg-gray-300 rounded row my-2" style="cursor: default;">
                        <div class="container d-flex justify-content-between p-1" style="">
                            <div class="d-flex justify-content-start">
                                <strong> Título:&nbsp;</strong> tarea 1
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="#" class="mx-2" onclick="" data-toggle-2="tooltip" title="Editar actividad" data-toggle="modal" data-target=".bd-example-modal-lg" onclick=""><i class="fas fa-edit"></i></a>
                            </div>
                        </div>

                        <div class="my-2 mx-1" style="font-size: 15px;">
                            <div style=""> 
                                <strong> Descripción:&nbsp; </strong>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae facilis, sed tempore laborum, dignissimos consequatur exercitationem aliquid ducimus iusto repellat impedit veniam nostrum vero aperiam odio qui asperiores ea labore!
                            </div>
                            <div class="" style="margin-top: 15px;">
                                Archivo adjunto: <a href="https://www.google.com">Ejercicio 1.pdf</a>
                            </div>
                        </div>

                    </div>
                    <div class="accordion-body bg-gray-300 rounded row" style="cursor: default;">
                            <div class="container d-flex justify-content-between p-1" style="">
                                <div class="d-flex justify-content-start">
                                    <strong> Título:&nbsp;</strong> tarea 2
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="mx-2" onclick="" data-toggle-2="tooltip" title="Editar actividad" data-toggle="modal" data-target=".bd-example-modal-lg" onclick=""><i class="fas fa-edit"></i></a>
                                </div>
                            </div>
    
                            <div class="my-2 mx-1" style="font-size: 15px;">
                                <div style=""> 
                                    <strong> Descripción:&nbsp; </strong>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae facilis, sed tempore laborum, dignissimos consequatur exercitationem aliquid ducimus iusto repellat impedit veniam nostrum vero aperiam odio qui asperiores ea labore!
                                </div>
                                <div class="" style="margin-top: 15px;">
                                    Archivo adjunto: <a href="https://www.google.com">Ejercicio 2.pdf</a>
                                </div>
                            </div>
                        </div>
                </div>

                    
                    <div class="my-1 mx-2" id="formActivity" style="font-size: 15px;">
                        <strong class="px-2"> Nueva Actividad </strong> <br><br>
                            <form class="user" action="{{Route('tasks.create')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="group col-sm-12">
                                        {{-- <label for="">Título</label> --}}
                                        <input id="title" name="title" type="text" class="form-control col-md-12" placeholder="Título" required autofocus>
                                </div>
                                <br>
                                <div class="group col-sm-12">
                                        {{-- <label for="">Descripción</label> --}}
                                        <textarea name="description" id="description" class="form-control col-md-12" cols="30" rows="5" placeholder="Descripción" autofocus></textarea>
                                </div>
                                <br>
                                <div class="group col-sm-12">
                                    <input type="file" name="practice" style="margin-bottom: 4px;" required>
                                    <br>
                                    Solo los siguientes formatos son admitidos: <strong>.zip .rar .pdf</strong><br>
                                </div>
                                <input type="text" name="sesion_id" value="" hidden>
                                <input type="text" name="number_sesion" value="" hidden>
                            </form>

                        </div>
            </div>
    
            <hr>
            
            <div class="text-center" id="footerModal">

                <div class="" style="margin-bottom: 20px;">
                    <a href="#" id="btnAddActivity" class="btn btn-primary btn-icon-split btn-sm" onclick="showFormActivity()">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Agregar actividad</span>
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
                            <button type="button" class="btn btn-primary btn-block btn-sm col-md-3 mx-2" style="">Guardar</button>
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
    </script>
    <script src="/js/accordion.js"></script>
    <script src="/js/sesions.js"></script>
@endsection
@push('scripts')
  <script src="{{ asset('js/datepicker/datepinker.js') }}"></script>
@endpush