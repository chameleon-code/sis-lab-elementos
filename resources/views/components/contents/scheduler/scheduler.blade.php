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
        <div class="dhx_cal_prev_button" style="background-color: #1cc88a;color: #ffffff">&nbsp;</div>
        <div class="dhx_cal_next_button" style="background-color: #1cc88a;color: #ffffff">&nbsp;</div>
        <div class="dhx_cal_today_button" style="background-color: #4e73df;color: whitesmoke"></div>
        <div class="dhx_cal_date"></div>
        <div class="dhx_cal_tab" name="day_tab"></div>
        <div class="dhx_cal_tab" name="week_tab"></div>
        <div class="dhx_cal_tab" name="month_tab"></div>
    </div>
    <div class="dhx_cal_header"></div>
    <div class="dhx_cal_data"></div>
</div>
<script type="text/javascript">
    scheduler.config.xml_date = "%Y-%m-%d %H:%i:%s";
    scheduler.config.first_hour = 7;
    scheduler.config.last_hour = 20;

    scheduler.setLoadMode("day");

    scheduler.init("scheduler_here", new Date(), "week");

    scheduler.load("/api/events", "json");
    var dp = new dataProcessor("/api/events");
    dp.init(scheduler);
    dp.setTransactionMode("REST");
</script>
</body>
@endsection