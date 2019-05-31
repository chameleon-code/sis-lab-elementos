$(document).ready(function(){
    console.log('hi');
    var eventos = [
        {start: '2019-05-01', end: '2019-05-07', summary: "Event #1", mask: true},
        {start: '2019-05-21', end: '2019-05-28', summary: "Event #2", mask: true},
        ];
        
    $('#calendar').calendar({
        events: eventos,
        months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
         'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
         daysMin: ['LUN', 'MAR', 'MIER', 'JUE', 'VIE', 'SAB', 'DOM'],
         dayLetter: ['L', 'M', 'M', 'J', 'V', 'S', 'D'],
    });
});