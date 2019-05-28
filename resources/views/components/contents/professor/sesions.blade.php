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
            @if ($blocks==null)
                <div class="alert alert-danger">
                    <b>Alerta</b>   
                    <ul>Aun no esta asignado a un bloque</ul>
                </div>
            @else
                <div class="card-body">
                    <label for="">Bloque: </label>
                    <select class="form-control col-md-3 col-3"  name="" id="selector">
                        @foreach ($blocks as $block)
                            <option class="optional" value="{{$block->block_id}}">{{$block->block_id}}</option>
                        @endforeach
                    </select>
                    @if ($sesions!=null)
                        @foreach ($blocks as $block)
                        <div id="block-{{$block->block_id}}" class="blocks-sesions">
                            bloque {{$block->block_id}}
                            <br>
                            @foreach ($sesions as $sesion)
                                @foreach ($sesion as $s)
                                    @if ($s->block_id==$block->block_id)
                                        {{$s}}
                                        <form class="user" action="">
                                            <div class="row">
                                                    <div class="form-group col-md-6 col-6">
                                                        <label for='name' class="">Inicio de la Gestión</label>
                                                        <div>
                                                            <input  type="text"
                                                                    name="start_management"
                                                                    id="inicio_fecha"
                                                                    class="form-control col-md-12"
                                                                    placeholder=""
                                                                    value="" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-6">
                                                        <label for='name' class="">Fin de la Gestión</label>
                                                        <div>
                                                            <input  type="text"
                                                                    name="end_management"
                                                                    id="fin_fecha"
                                                                    class="form-control col-md-12"
                                                                    placeholder=""
                                                                    value="" required readonly>
                                                        </div>
                                                    </div>
                                            </div>
                                        </form>
                                        <br>
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
                $('#block-'+$(this).text()).show();
            });
        });
    </script>
@endsection