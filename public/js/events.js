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
                if(res.res) {
                   Swal.fire(
                        'Evento guardado con exito!',
                        'Revisa tu calendario para verlo',
                        'success'
                    )
                    modal.modal('hide');
                    modal.find("input[type=text], input[type=time], textarea").val("");
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Algo salio mal...',
                        text: 'No se pudo guardar la informacion, vuelve a intentarlo',
                      })
                }
            }
        });
    });
});