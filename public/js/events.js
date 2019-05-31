$(document).ready(function(){
    console.log('hi');
    var eventos = [
        {start: '2019-05-21', end: '2019-05-28', summary: "Event #2", mask: true},
        ];
    $('#start').datepicker({
        firstDay: 1,
        monthNames: ['Enero', 'Febreo', 'Marzo',
            'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre',
            'Octubre', 'Noviembre', 'Diciembre'
        ],
        dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        dateFormat: 'yy-mm-dd'
    }); 
    /*$('#hour').timepicker({
        'minTime': '2:00pm',
        'maxTime': '11:30pm',
        'showDuration': true
    }); */  
    $('#calendar').calendar({
        events: eventos,
        months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
         'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
         daysMin: ['LUN', 'MAR', 'MIER', 'JUE', 'VIE', 'SAB', 'DOM'],
         dayLetter: ['L', 'M', 'M', 'J', 'V', 'S', 'D'],
    });
    var modal = $('#appModal');
    $('#addEvent').on('click', function(e) {
        e.preventDefault();
        modal.find('.modal-title').text("Añadir Evento");
        modal.find('#modalAction').text("Añadir Evento").show();        
        modal.modal();
    });
    $('#modalAction').click(function(event){
        console.log($("#registerEvent").serialize());
        $.ajax({
            url : 'http://127.0.0.1:8000/registerEvent',
            type: 'POST',
            headers: {
                'x-csrf-token': $("meta[name=csrf-token]").attr('content')
            },
            data: {
                info: $("#registerEvent").serialize()
            },
            success: (res) => {
                console.log(res);
                if(res.res) {
                    modal.find('#modalAction').hide();
                    modal.find('.modal-body').html('<div class="alert alert-success">Evento creado correctamente</div>');
                } else {
                    modal.find('.modal-body').html('<div class="alert alert-danger">Ha ocurrido un error creando el evento</div>');
                }
            }
        });
    });
});