$(document).ready(function() {
    url = "/schedule/records/1";
    $.get(url, function(response, state) {
        console.log(response);
        $('#bloque').empty();
        for (f = 1; f < 11; f++) {
            for (c = 1; c < 7; c++) {
                $("#r" + f + "c" + c).empty();
            }
        }
        for (i = 0; i < response.length; i++) {
            var valorColor = 360 / (parseInt(response[i].blockid, 10));
            $("#r" + response[i].hour_id + "c" + response[i].day_id).append('<label class="label-desc" ' + 'style="color: #FFF;background:hsl(' + valorColor + ',100%,40%);">' + '<dfn title="Docente: ' +
                response[i].professor + ', Materia: ' + response[i].subject + '">' + response[i].name_block + '</dfn>' +
                ' <a data-id="' + response[i].id + '" class="deltasker"><i class="fa fa-times"></i></a></label>');
        }
        $('.deltasker').on('click', function(e) {
            e.preventDefault();
            $('#eliminarHorario').modal('show');
            var element = $(this).parent();
            var id = $(this).data('id');
            // console.log(id);
            $('.deleteSchedule').on('click', function(e) {
                element.addClass('animated bounceOut');
                url = '/schedule/records/delete/' + id;
                $('#eliminarHorario').modal('toggle');
                var form = $('#form-delete');
                //alert(form.attr('action'));
                var url = form.attr('action').replace(':ID_schedule', id);
                var data = form.serialize();
                // alert(data);
                element.fadeOut();
                $.post(url, data, function(result) {
                    //alert(result.status_message);
                    element.remove();
                }).fail(function() {
                    //alert('el horario no fue eliminado');
                    element.show();
                });
            });
        });
    });

    //// Mostrar Boton Add
    $(".td-line").hover(
        function() {
            var button = $(this).find('button');
            var dum = button.attr('data-row')
            var label = $('#' + dum).find('label');
            var cantidad = label.length;
            if (cantidad < 1) {
                $(this).find('button').show();
            }
        },
        function() {
            $(this).find('button').hide();
        }
    );
    // Agregar Informacion
    $('.addinfo').on('click', function(e) {
        e.preventDefault();
        var dum = $(this).attr('data-row');

        var label = $('#' + dum).find('label');
        var cantidad = label.length;

        if (cantidad < 1) {
            $('#DataEdit').modal('show');
            $('#tede').val(dum);

            var row = $(this).parents('tr');
            var hours_id = row.data('id');
            $('#hours').val(hours_id);
            var days_id = $(this).attr('data-col');
            $('#days').val(days_id);
        } else {
            console.log("ya no se puede añadir");
        }
    });
    // Borrar la Informacion
    // $('.delinfo').on('click', function() {
    //     var dum = $(this).attr('data-row');
    //     $('#' + dum).text('').removeClass('purple-label red-label blue-label pink-label').hide();
    // });
    //carga los horarios dinamica con el select de laboratorios
    $("#laboratory").change(function(event) {
        url = "/schedule/records/" + event.target.value;
        $.get(url, function(response, state) {
            //console.log(response);
            $('#bloque').empty();
            for (f = 1; f < 11; f++) {
                for (c = 1; c < 7; c++) {
                    $("#r" + f + "c" + c).empty();
                }
            }
            for (i = 0; i < response.length; i++) {
                var valorColor = 360 / (parseInt(response[i].blockid, 10));
                $("#r" + response[i].hour_id + "c" + response[i].day_id).append('<label class="label-desc" ' + 'style="color: #FFF;background:hsl(' + valorColor + ',100%,40%);">' + '<dfn title="Docente: ' +
                    response[i].professor + ', Materia: ' + response[i].subject + '">' + response[i].name_block + '</dfn>' +
                    ' <a data-id="' + response[i].id + '" class="deltasker"><i class="fa fa-times"></i></a></label>');
                $('.deltasker').on('click', function(e) {
                    e.preventDefault();
                    $('#eliminarHorario').modal('show');
                    var element = $(this).parent();
                    var id = $(this).data('id');
                    // console.log(id);
                    $('.deleteSchedule').on('click', function(e) {
                        element.addClass('animated bounceOut');
                        url = '/schedule/records/delete/' + id;
                        $('#eliminarHorario').modal('toggle');
                        var form = $('#form-delete');
                        //alert(form.attr('action'));
                        var url = form.attr('action').replace(':ID_schedule', id);
                        var data = form.serialize();
                        //alert(data);
                        element.fadeOut();
                        $.post(url, data, function(result) {
                            //alert(result.status_message);
                            element.remove();
                        }).fail(function() {
                            //alert('el horario no fue eliminado');
                            element.show();
                        });
                    });
                });
            }
        });
    });


    // Guardar Horario
    $('.savetask').on('click', function() {
        var tede = $('#tede').val();
        var tasker = $('#nametask').val();
        var color = $('#idcolortask').val();
        $('#DataEdit').modal('toggle');
        var docente = $('#nameDocente option:selected').text();
        // $('.deltasker').on('click', function() {
        //     var element = $(this).parent();
        //     element.addClass('animated bounceOut');
        //     setTimeout(function() { element.remove(); }, 1000);
        // });
        var block_name1 = $('#bloques option:selected').text();
        var block_name2 = $("#block_name").val();
        var block_name;
        if (block_name2 != null) {
            block_name = block_name2;
        } else {
            block_name = block_name1;
        }
        var materia = $("#materia").val();
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
            "professor": docente,
            "subject": materia,
            "block_id": block_id
        };
        //console.log(datos);
        var token = $("#token").val();
        $.ajax({
            url: route,
            headers: { "X-CSRF-TOKEN": token },
            type: 'POST',
            dataType: 'json',
            data: datos,
            success: function(data) {
                //alert(data.success);
                var valorColor = 360 / parseInt(block_id);
                $('#' + tede).append('<label class="label-desc" ' + 'style="color: #FFF;background:hsl(' + valorColor + ',100%,40%);">' + '<dfn title="Docente: ' + docente + ', Materia: ' + materia + '">' + block_name + '</dfn>' +
                    ' <a data-id="' + data.id + '" class="deltasker"><i class="fa fa-times"></i></a></label>');
                $('.deltasker').on('click', function(e) {
                    e.preventDefault();
                    $('#eliminarHorario').modal('show');
                    var element = $(this).parent();
                    var id = $(this).data('id');
                    // console.log(id);
                    $('.deleteSchedule').on('click', function(e) {
                        element.addClass('animated bounceOut');
                        url = '/schedule/records/delete/' + id;
                        $('#eliminarHorario').modal('toggle');
                        var form = $('#form-delete');
                        //alert(form.attr('action'));
                        var url = form.attr('action').replace(':ID_schedule', id);
                        var data = form.serialize();
                        //alert(data);
                        element.fadeOut();
                        $.post(url, data, function(result) {
                            //alert(result.status_message);
                            element.remove();
                        }).fail(function() {
                            //alert('el horario no fue eliminado');
                            element.show();
                        });
                    });
                });
            }
        });
    });
    //fin de guardar horario
    $("#bloques").change(function(event) {
        var id = $('#bloques option:selected').val();
        // console.log(id);
        $('#idcolortask').val(id);
        $('#block_id').val(id);
        url = "/schedule/groups/" + id;
        $.get(url, function(response, state) {
            console.log(response);
            //materia
            $('#nameDocente').empty();
            var materia = response[0].subject.name;
            $('#materia').val(materia);
            for (f = 0; f < response.length; f++) {
                var docente = response[f].professor;
                var docentName = docente.names + " " + docente.first_name + " " + docente.second_name;
                var option = $('<option></option>').attr("value", response[f].id).text(docentName);
                option.attr("class", "form-control");
                $('#nameDocente').append(option);
            }
        });
    });
})