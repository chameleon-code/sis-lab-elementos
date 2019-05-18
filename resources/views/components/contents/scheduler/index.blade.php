@extends('components.sections.adminSection')
@section('userContent')
<script>
$(document).ready(function(){
    //// Mostrar Boton Add
    $(".td-line").hover(
        function() {
        $(this).find('button').show();
        },
        function() {
        $(this).find('button').hide();
        }
    );
    // Agregar Informacion
    $('.addinfo').on('click', function() {
        var dum = $(this).attr('data-row');
        $('#DataEdit').modal('show');
        $('#tede').val(dum);

        var row = $(this).parents('tr');
        var hours_id = row.data('id');
        $('#hours').val(hours_id);

        var col = $this.parents();
        //alert(hours_id);
    });

    // Borrar la Informacion
    $('.delinfo').on('click', function() {
        var dum = $(this).attr('data-row');
        $('#' + dum).text('').removeClass('purple-label red-label blue-label pink-label').hide();
    });

    // Guardar Horario
    $('.savetask').on('click', function() {
        var tede = $('#tede').val();
        var tasker = $('#nametask').val();
        var color = $('#idcolortask option:selected').val();
        $('#DataEdit').modal('toggle');
        $('#' + tede).append('<label class="label-desc ' + color + '">' + tasker + ' <a class="deltasker"><i class="fa fa-times"></i></a></label>');
        //$('#'+tede).text(tasker).addClass(color).show();
        $('#taskfrm')[0].reset();


        $('.deltasker').on('click', function() {
            var element = $(this).parent();
            element.addClass('animated bounceOut');
            setTimeout(function() { element.remove(); }, 1000);
        });

        var row = $(this).parents('tr');
        var hours_id = row.data('id');
        //alert(hours_id);

        var route = "/schedule/create/1"
        var datos = {
            "laboratory_id" : 1,
            "day_id"        : 1,
            "hour_id"       : 1,
            "availability"  : 1,
            "block_id"      : 1
        };
        var token =$("#token").val();
        $.ajax({
            url : route,
            headers: {"X-CSRF-TOKEN": token},
            type: 'POST',
            dataType: 'json',
            data : datos,
            // success:function(data){
            //     alert(data.success);
            // }  
        });
        // $.post(url,data,function (result){
        //     alert("guardado");
        // });

    });
    //fin de guardar horario

    //guardar a la base de datos
    $('.guardarhorario').on('click', function() {

        var btnsave = $(this);
        var descripcion = $('#descripcioninput').val();
        var nombre = $('#nombreinput').val();
        var horario = $('#mynew').html();
        var horariodata = 'process=2&nombre=' + nombre + '&descripcion=' + descripcion + '&horario=' + horario;
        
        // $.ajax({

        //     type: 'POST',
        //     url: 'include/process.php',
        //     data: horariodata,
        //     beforeSend: function() {
        //         btnsave.prop('disabled', true);
        //         $('#horario-name').addClass('opacityelement');
        //         $('#thetable').addClass('opacityelement');
        //     },
        //     success: function() {
        //         $('#thetable').addClass('animated bounceOut');
        //         btnsave.prop('disabled', false);
        //         setTimeout(function() { window.location = 'lista.php' });

        //     },
        //     error: function() {
        //         novalid();
        //     }

        // });

    });
});

</script>
<style>
        /* .boton{display:none;} */
</style>
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 font-weight-bold text-primary">{{$title or 'Gestión'}}</div>
                
                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                    @endif
                    <div class="">
                        <div class="col-sm-12 table-responsive text-center">
                            <div class="col-sm-3">
                                <select class="form-control" name="" id="">
                                    @foreach ($laboratories as $item)
                                        <option class="form-control" value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @endforeach    
                                </select>
                            </div>
                            
                            <table class="table table-striped">
                                
                                <thead>
                                    <tr>
                                        <th class="text-dark" scope="row">Dias</th>
                                        @foreach ($days as $item)
                                            <th class="text-dark" data-days_id="{{$item->id}}">{{$item->name}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($hours as $item)
                                    <tr class="" data-id="{{$item->id}}" >
                                        <td class="" data-hours_id="{{$item->id}}">{{$item->start}}-{{$item->end}}</td>
                                        <td class="td-line">
                                            <div id="r{{$item->id}}c1" class="col-sm-12 nopadding"></div>
                                            <div class="col-sm-12 text-center">
                                                <button id="edit-r{{$item->id}}c1" data-row="r{{$item->id}}c1" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="td-line">
                                            <div id="r{{$item->id}}c2" class="col-sm-12 nopadding"></div>
                                            <div class="col-sm-12 text-center">
                                                <button id="edit-r{{$item->id}}c2" data-row="r{{$item->id}}c2" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="td-line">
                                            <div id="r{{$item->id}}c3" class="col-sm-12 nopadding"></div>
                                            <div class="col-sm-12 text-center">
                                                <button id="edit-r{{$item->id}}c3" data-row="r{{$item->id}}c3" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="td-line">
                                            <div id="r{{$item->id}}c4" class="col-sm-12 nopadding"></div>
                                            <div class="col-sm-12 text-center">
                                                <button id="edit-r{{$item->id}}c4" data-row="r{{$item->id}}c4" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="td-line">
                                            <div id="r{{$item->id}}c5" class="col-sm-12 nopadding"></div>
                                            <div class="col-sm-12 text-center">
                                                <button id="edit-r{{$item->id}}c5" data-row="r{{$item->id}}c5" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="td-line">
                                            <div id="r{{$item->id}}c6" class="col-sm-12 nopadding"></div>
                                            <div class="col-sm-12 text-center">
                                                <button id="edit-r{{$item->id}}c6" data-row="r{{$item->id}}c6" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- append modal set data -->
<div class="modal fade" id="DataEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumb-tack"></i>Agregar Horario</h4>
                <button type="button" class="close canceltask" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
            </div>
            <div class="modal-body">
              
              <form id="taskfrm">
              <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                 <label>Docente</label>
                <div class="col-md-13">
                    <select class="form-control" name="" id="nametask">
                        @foreach ($laboratories as $item)
                            <option class="form-control" value="{{$item->id}}" selected>{{$item->name}}</option>
                        @endforeach    
                    </select>
                </div>
                 <label>Color:</label>
                 <select class="form-control" id="idcolortask">
                    <option value="purple-label">Purpura</option>
                    <option value="red-label">Rojo</option>
                    <option value="blue-label">Azul</option>
                    <option value="pink-label">Rosa</option>
                    <option value="green-label">Verde</option>
                 </select> 
                <input id="tede" type="hidden" name="tede" >
                <input id="hours" type="hidden" name="hours">
                <input id="days" type="hidden" name="days">
              </form>
        
            </div>
            <div class="modal-footer">
              <button type="button" class="savetask btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
              <button type="button" class="canceltask btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- append modal set data -->
@endsection