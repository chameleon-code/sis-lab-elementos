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
                            <option class="optional" value="{{$block->block_id}}">{{$block->block_id}} - MateriaX</option>
                        @endforeach
                    </select>
                    @if ($sesions!=null)
                        @foreach ($blocks as $block)
                        <div id="block-{{$block->block_id}}" class="blocks-sesions">
                            <hr>
                            <div class="text-center">
                                    <label class="h5 text-gray-900 mb-4">Creación Automática de Sesiones</label>
                            </div>
                            <form class="user" action="">
                                <div class="row">
                                    <div class="form-group col-md-4 col-6">
                                        <label for='name' class="">Inicio de las Sesiones</label>
                                        <div>
                                            <input  type="text"
                                                    name="start_management"
                                                    id="inicio_fecha"
                                                    class="form-control col-md-12"
                                                    placeholder=""
                                                    value="{{$init}}" required readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-6">
                                        <label for='name' class="">Fin de las Sesiones</label>
                                        <div>
                                            <input  type="text"
                                                    name="end_management"
                                                    id="fin_fecha"
                                                    class="form-control col-md-12"
                                                    placeholder=""
                                                    value="{{$end}}" required readonly>
                                        </div>
                                    </div>
                                    @if (Agent::isMobile())
                                        <div class="form-group col-12">
                                                <button id="btn_aling" type="button" class="btn btn-warning btn-block col-md-12">
                                                        <i class="fas fa-magic"></i>
                                                        Autogenerar
                                                </button>
                                        </div> 
                                    @else
                                        <div class="form-group col-md-4 col-12">
                                                <label style="height: 1.015rem;"></label>
                                                <button id="btn_aling" type="button" class="btn btn-warning btn-block col-md-12">
                                                        <i class="fas fa-magic"></i>
                                                        Autogenerar 
                                                </button>
                                        </div>  
                                    @endif
                                </div>
                            </form>
                            <hr>
                            @foreach ($sesions as $sesion)
                                @foreach ($sesion as $s)
                                    @if ($s->block_id==$block->block_id)
                                        <br>
                                        {{$s}}
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
@endsection