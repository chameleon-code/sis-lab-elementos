$(document).ready(function() {
    url = "/schedule/records/1";
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
                response[i].professor + ', Materia: ' + response[i].subject + '">Bloque :' + response[i].blockid + '</dfn>' +
                ' <a data-id="' + response[i].id + '" class="deltasker"></a></label>');
        }
    });
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
                    response[i].professor + ', Materia: ' + response[i].subject + '">Bloque :' + response[i].blockid + '</dfn>' +
                    ' <a data-id="' + response[i].id + '" class="deltasker"></a></label>');
            }
        });
    });
});