// Input format -> timestamp, output format -> 00 month
function getDate(date){
    let day = date.charAt(8) + date.charAt(9);
    let month = "";
    switch(date.charAt(5) + date.charAt(6)){
        case '01':
            month = "Enero";
            break;
        case '02':
            month = "Febrero";
            break;
        case '03':
            month = "Marzo";
            break;
        case '04':
            month = "Abril";
            break;
        case '05':
            month = "Mayo";
            break;
        case '06':
            month = "Junio";
            break;
        case '07':
            month = "Julio";
            break;
        case '08':
            month = "Agosto";
            break;
        case '09':
            month = "Septiembre";
            break;
        case '10':
            month = "Octubre";
            break;
        case '11':
            month = "Noviembre";
            break;
        case '12':
            month = "Diciembre";
            break;
    }
    let year = date.charAt(0) + date.charAt(1) + date.charAt(2) + date.charAt(3);
    return day + ' ' + month + ' ' + year;
}

// Input format -> timestamp, output format -> 00:00
function getHour(date) {
    let hour = date.charAt(11) + date.charAt(12) + ':' + date.charAt(14) + date.charAt(15);
    return hour;
}