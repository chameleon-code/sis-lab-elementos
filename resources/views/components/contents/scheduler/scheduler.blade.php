@extends('components.sections.adminSection')
@section('userContent')
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">

    <script src="https://cdn.dhtmlx.com/scheduler/edge/dhtmlxscheduler.js"></script>
    <link href="https://cdn.dhtmlx.com/scheduler/edge/dhtmlxscheduler.css"
          rel="stylesheet">

    <style type="text/css">
        html, body{
            height:100%;
            padding:0px;
            margin:0px;
            overflow: hidden;
        }

    </style>
</head>
<body>
        
<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;sha'>
    <div class="dhx_cal_navline">
        {{-- <div class="dhx_cal_prev_button" style="background-color: #1cc88a;color: #ffffff">&nbsp;</div>
        <div class="dhx_cal_next_button" style="background-color: #1cc88a;color: #ffffff">&nbsp;</div>
        <div class="dhx_cal_today_button" style="background-color: #4e73df;color: #ffffff"></div> --}}
        <div class="dhx_cal_date"></div>
        {{--<div class="dhx_cal_tab" name="day_tab"></div>--}}
        {{--<div class="dhx_cal_tab" name="week_tab"></div>--}}
        {{--<div class="dhx_cal_tab" name="month_tab"></div>--}}
        <div>
            <select class="browser-default custom-select">
                <option selected>Seleccionar Horario</option>
                <option value="1">Laboratorio 1</option>
                <option value="2">Laboratorio 2</option>
                <option value="3">Laboratorio 3</option>
                <option value="3">Laboratorio 4</option>
            </select>
        </div>

    </div>
    <div class="dhx_cal_header"></div>
    <div class="dhx_cal_data"></div>
</div>
<script type="text/javascript">
scheduler.templates.calendar_date = scheduler.date.date_to_str("%d");
    scheduler.config.xml_date = "%Y-%m-%d %H:%i:%s";
    //cambiar nombre de columna y especificar solo día
    scheduler.config.day_date = "%D";
    scheduler.config.first_hour = 7;
    scheduler.config.last_hour = 20;

    //scheduler.config.hour_size_px = 70;

    //prueba header
    //mygrid = new dhtmlXGridObject('gridbox');
    //scheduler.setHeader("Sales,Book title,Author,Price");
    //scheduler.init();

    //Establecer titulo del horario
    scheduler.templates.week_date = function(start, end){
        return "Laboratorio 1";
    };


    //intervalo horas
    scheduler.templates.hour_scale = function(date){
        if(date.getHours()%1==0)
            return scheduler.date.date_to_str(scheduler.config.hour_date)(date);

        return '';
    };

    //intervalo horas efectivo

    //nombre de dias en las clumnas


    // 0 refers to Sunday, 6 - to Saturday
    scheduler.ignore_week = function(date){
        if (date.getDay() == 0) //hides Saturdays and Sundays
            return true;
    };

    scheduler.setLoadMode("day");

    scheduler.init("scheduler_here", new Date(), "week");

    scheduler.load("/api/events", "json");
    var dp = new dataProcessor("/api/events");
    dp.init(scheduler);
    dp.setTransactionMode("REST");
</script>
</body>
@endsection