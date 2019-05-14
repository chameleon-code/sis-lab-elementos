@extends('components.sections.adminSection')
@section('userContent')

<script src="/js/schedule/dhtmlxscheduler.js"></script>
<link href="/js/schedule/dhtmlxscheduler.css" rel="stylesheet">

<div class="container-fluid" style="height: 800px;">
        <div class="card shadow mb-4" style="height: 800px;">
            <div class="card-header py-3" style="height: 800px;">
                <div class="panel-heading m-0 font-weight-bold text-primary container">Horarios</div>
                <div class="card-body" style="height: 95%;">

                <div id="scheduler_here" class="dhx_cal_container" style='height:100%;'>
                    <div class="dhx_cal_navline">
                        {{-- <div class="dhx_cal_prev_button" style="background-color: #1cc88a;color: #ffffff">&nbsp;</div>
                        <div class="dhx_cal_next_button" style="background-color: #1cc88a;color: #ffffff">&nbsp;</div>
                        <div class="dhx_cal_today_button" style="background-color: #4e73df;color: #ffffff"></div> --}}
                        <div class="dhx_cal_date"></div>
                        {{--<div class="dhx_cal_tab" name="day_tab"></div>--}}
                        {{--<div class="dhx_cal_tab" name="week_tab"></div>--}}
                        {{--<div class="dhx_cal_tab" name="month_tab"></div>--}}
                        
                        <div class="form-group" {{ $errors->has('lab_id') ? 'has-error' : ''}} style="margin-top: -10px;">
                                <select name="lab_id" class="form-control col-md-12" id="labs" onchange="location = this.value;">
                                    <option value="">- Seleccione Laboratorio -</option>
                                    @forelse ($labs as $lab)
                                        <option class="form-control" value="/scheduler/{{$lab->id}}">{{'Laboratorio '.$lab->id}}</option>
                                    @empty
                                    <option class="form-control" value="">No existen bloques registrados</option>
                                    @endempty
                                    @endforelse
                                </select>
                        </div>
                    </div>
                    <div class="dhx_cal_header"></div>
                    <div class="dhx_cal_data"></div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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
        var title = 'Laboratorio ' + {!! json_encode($selected_lab) !!};
        return title;
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

    var api = '/scheduler2/'+{!! json_encode($selected_lab) !!};
    console.log(api);
    scheduler.load( api, 'json' );
    var dp = new dataProcessor("/api/events");
    dp.init(scheduler);
    dp.setTransactionMode("REST");
</script>
@endsection