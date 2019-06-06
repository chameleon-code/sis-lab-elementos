$(function() {
    $("#inicio_fecha").datepicker({
        firstDay: 1,
        monthNames: ['Enero', 'Febrero', 'Marzo',
            'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre',
            'Octubre', 'Noviembre', 'Diciembre'
        ],
        dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        dateFormat: 'yy-mm-dd'
    });
});
$(function() {
    $("#fin_fecha").datepicker({
        firstDay: 1,
        monthNames: ['Enero', 'Febrero', 'Marzo',
            'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre',
            'Octubre', 'Noviembre', 'Diciembre'
        ],
        dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        dateFormat: 'yy-mm-dd'
    });
});