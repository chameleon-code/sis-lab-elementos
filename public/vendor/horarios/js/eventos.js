$(document).ready(function() {
    url = "/schedule/records/1";
    $.get(url, function(response, state) {
        //console.log(response);
        $('#bloque').empty();
        for (f = 1; f < 8; f++) {
            for (c = 1; c < 7; c++) {
                $("#r" + f + "c" + c).empty();
            }
        }
        for (i = 0; i < response.length; i++) {
            $("#r" + response[i].hour_id + "c" + response[i].day_id).append('<label class="label-desc ' + response[i].color + '">' + " tasker" + ' <a data-id="' + response[i].id + '" class="deltasker"><i class="fa fa-times"></i></a></label>');
            $('.deltasker').on('click', function() {
                var element = $(this).parent();
                var id = $(this).data('id');
                console.log(id);
                element.addClass('animated bounceOut');
                url = '/schedule/records/delete/' + id;
                var token = $("#token").val();
                $.ajax({
                    type: 'POST',
                    headers: { "X-CSRF-TOKEN": token },
                    url: url,
                    // data: { 'id': id, '_token': token },
                    dataType: 'json',
                });
                setTimeout(function() {
                    element.remove();
                }, 1000);
            });
        }
    });
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
        var days_id = $(this).attr('data-col');
        $('#days').val(days_id);
    });

    // Borrar la Informacion
    $('.delinfo').on('click', function() {
        var dum = $(this).attr('data-row');
        $('#' + dum).text('').removeClass('purple-label red-label blue-label pink-label').hide();
    });
    //carga los horarios dinamica con el select de laboratorios
    $("#laboratory").change(function(event) {
        url = "/schedule/records/" + event.target.value;
        $.get(url, function(response, state) {
            //console.log(response);
            $('#bloque').empty();
            for (f = 1; f < 8; f++) {
                for (c = 1; c < 7; c++) {
                    $("#r" + f + "c" + c).empty();
                }
            }
            for (i = 0; i < response.length; i++) {
                $("#r" + response[i].hour_id + "c" + response[i].day_id).append('<label class="label-desc ' + response[i].color + '">' + " tasker" + ' <a class="deltasker"><i class="fa fa-times"></i></a></label>');
                $('.deltasker').on('click', function() {
                    var element = $(this).parent();
                    element.addClass('animated bounceOut');
                    setTimeout(function() { element.remove(); }, 1000);
                });
            }
        });
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

        var laboratory = $('#laboratory option:selected').val();
        var hours = $('#hours').val();
        var days = $('#days').val();
        var block_id = $("#block_id").val();
        //alert(days);
        var route = "/schedule/create/1"
        var datos = {
            "laboratory_id": laboratory,
            "day_id": days,
            "hour_id": hours,
            "color": color,
            "block_id": block_id
        };
        var token = $("#token").val();
        $.ajax({
            url: route,
            headers: { "X-CSRF-TOKEN": token },
            type: 'POST',
            dataType: 'json',
            data: datos,
            // success:function(data){
            //     alert(data.success);
            // }  
        });
    });
    //fin de guardar horario

    //guardar a la base de datos
    $('.guardarhorario').on('click', function() {

        var btnsave = $(this);
        var descripcion = $('#descripcioninput').val();
        var nombre = $('#nombreinput').val();
        var horario = $('#mynew').html();
        var horariodata = 'process=2&nombre=' + nombre + '&descripcion=' + descripcion + '&horario=' + horario;

    });
});