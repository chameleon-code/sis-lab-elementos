//var schedules = undefined;
var blockGroups = undefined;
var block_id = undefined;

$('document').ready(function(){
    //console.log( schedules );
    //carga los grupos
    //loadGroup();
    loadSesionActual();
    
    $("#groups").change(function(event) {
        console.log("....................ejecutandodo grupo....................");
        var group_id = $('#groups option:selected').val();
        url = "/professor/blocks/" + group_id;
        loading();
        $.get(url, function(response, state) {
            //console.log(response);
            //materia
            $('#blocks').empty();
            //var materia = response[0].subject.name;
            //$('#materia').val(materia);
            for (f = 0; f < response.length; f++) {
                var block_id = response[f].id;
                var name =  response[f].name;
                var option = $('<option></option>').attr("value", response[f].id).text(name);
                option.attr("class", "form-control");
                $('#blocks').append(option);
            }
            var block_id = $('#blocks option:selected').val();
            //console.log(block_id +".."+ group_id);
            
            // url_schedule = "/professor/student/schedules/" + group_id + "/" +  block_id;
            // $.get(url_schedule, function(response, state) {
                console.log(block_id);
                url = "/professor/sesions/" + block_id;
                $.get(url, function(response, state) {
                    console.log("....................sesion....................");
                    console.log(response);
                    $('#sesions').empty();
                    response.sesions.forEach(element => {
                        var number_sesion = element.number_sesion;
                        var actual_sesion;
                        try {
                            actual_sesion = response.actual_sesion.number_sesion;
                            throw "myException"; // genera una excepción
                         }
                        catch (e) {
                            actual_sesion = 0;
                        }
                        console.log(number_sesion);
                        //console.log(number_sesion +"/"+ element.actual_sesion.number_sesion)
                        if(number_sesion == actual_sesion){
                            var option = $('<option></option>').attr("value", "denikin").text("Sesion "+number_sesion);
                            option.attr("class", "form-control");
                            option.attr("selected","true");
                            $('#sesions').append(option);
                        }else{
                            var option = $('<option></option>').attr("value", element.id).text("Sesion "+number_sesion);
                            option.attr("class", "form-control");
                            $('#sesions').append(option);
                        }
                    });
                    console.log("....................ejecutandodo Sesiones....................");
                    var group_id = $('#groups option:selected').val();
                    var block_id = $('#blocks option:selected').val();
                    var sesion_id = $('#sesions option:selected').val();
                    url = "/professor/students/sesion/"+group_id+"/"+block_id+"/"+ sesion_id;
                    $.get(url, function(response, state) {
                        console.log("....................eliminando tabla y creando....................");
                        console.log(response);
                        $('#dataTable').DataTable().clear().draw();
                        response.schedules.forEach(element => {
                            //console.log(element);
                            $('#dataTable').DataTable().row.add([
                                `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.code_sis }</font></font></td>`,
                                `<td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.first_name } ${ element.user.second_name }</font></font></td>`,
                                `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.names }</font></font></td>`,
                                `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.tarea_sesion }</font></font></td>`,
                                `<div class="text-center" style="display: flex;">
                                    <a href="#" class="btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick='loadProfile(${ JSON.stringify(element.user) })' id="profile"><i class="fas fa-eye"></i></a>
                                    <a href="/professor/studentSesions/${element.id}}" class="btn btn-success btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Portafolios" data-toggle="modal" data-target="#student-folder" onclick='loadFolder(${ JSON.stringify(element) })'><i class="fas fa-briefcase"></i></a>
                                </div>`
                            ]).draw();
                        });
                        endLoading();
                    });
                });
            // });
        });
        
    });
    $("#blocks").change(function(event) {
        loading();
        console.log("....................ejecutandodo bloque....................");
        // var group_id = $('#groups option:selected').val();
        var block_id = event.target.value;
            url = "/professor/sesions/" + block_id;
            $.get(url, function(response, state) {
                console.log(response);
                $('#sesions').empty();
                response.sesions.forEach(element => {
                    var number_sesion = element.number_sesion;
                    var actual_sesion;
                    try {
                        actual_sesion = response.actual_sesion.number_sesion;
                        throw "myException"; // genera una excepción
                    }
                    catch (e) {
                        // actual_sesion = 0;
                    }
                    console.log(actual_sesion);
                    if(number_sesion == actual_sesion){
                        var option = $('<option></option>').attr("value", "denikin").text("Sesion "+number_sesion);
                        option.attr("class", "form-control");
                        option.attr("selected","true");
                        $('#sesions').append(option);
                    }else{
                        var option = $('<option></option>').attr("value", element.id).text("Sesion "+number_sesion);
                        option.attr("class", "form-control");
                        $('#sesions').append(option);
                    }
                });
                console.log("....................ejecutandodo Sesiones....................");
                var group_id = $('#groups option:selected').val();
                var block_id = $('#blocks option:selected').val();
                var sesion_id = $('#sesions option:selected').val();
                url = "/professor/students/sesion/"+group_id+"/"+block_id+"/"+ sesion_id;
                $.get(url, function(response, state) {
                    //console.log(response);
                    $('#dataTable').DataTable().clear().draw();
                    console.log("....................eliminando tabla....................");
                    response.schedules.forEach(element => {
                        //console.log(element);
                        $('#dataTable').DataTable().row.add([
                            `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.code_sis }</font></font></td>`,
                            `<td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.first_name } ${ element.user.second_name }</font></font></td>`,
                            `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.names }</font></font></td>`,
                            `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.tarea_sesion }</font></font></td>`,
                            `<div class="text-center" style="display: flex;">
                                <a href="#" class="btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick='loadProfile(${ JSON.stringify(element.user) })' id="profile"><i class="fas fa-eye"></i></a>
                                <a href="/professor/studentSesions/${element.id}}" class="btn btn-success btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Portafolios" data-toggle="modal" data-target="#student-folder" onclick='loadFolder(${ JSON.stringify(element) })'><i class="fas fa-briefcase"></i></a>
                            </div>`
                        ]).draw();
                    });
                    endLoading();
                });
            });
    });
    $("#sesions").change(function(event) {
        loading();
        console.log("....................ejecutandodo Sesiones....................");
        var group_id = $('#groups option:selected').val();
        var block_id = $('#blocks option:selected').val();
        var sesion_id = $('#sesions option:selected').val();
        url = "/professor/students/sesion/"+group_id+"/"+block_id+"/"+ sesion_id;
        $.get(url, function(response, state) {
            //console.log(response);
            $('#dataTable').DataTable().clear().draw();
            console.log("....................eliminando tabla....................");
            response.schedules.forEach(element => {
                //console.log(element);
                $('#dataTable').DataTable().row.add([
                    `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.code_sis }</font></font></td>`,
                    `<td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.first_name } ${ element.user.second_name }</font></font></td>`,
                    `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.names }</font></font></td>`,
                    `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.tarea_sesion }</font></font></td>`,
                    `<div class="text-center" style="display: flex;">
                        <a href="#" class="btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick='loadProfile(${ JSON.stringify(element.user) })' id="profile"><i class="fas fa-eye"></i></a>
                        <a href="/professor/studentSesions/${element.id}}" class="btn btn-success btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Portafolios" data-toggle="modal" data-target="#student-folder" onclick='loadFolder(${ JSON.stringify(element) })'><i class="fas fa-briefcase"></i></a>
                    </div>`
                ]).draw();
            });
            endLoading();
        });
    });
});
function loadSesionActual(){

}
// function loadGroup() {
//     $('#group_id').removeAttr("value");
//     $('#group_id').attr("value", $('#groups')[0].value);
//     $('#dataTable').DataTable().clear().draw();
//     //console.log( $('#groups')[0].value );

//     blockGroups.forEach(element => {
//         if( element.group_id == $('#groups')[0].value ) {
//             block_id = element.block_id;
//         }
//     });
    
//     $.ajax({
//         url: '/professor/student/schedules/'+$('#groups')[0].value+'/'+block_id,
//         beforeSend: function () {
//             loading();
//         },
//         success: function( response ) {
//             endLoading();
//             //console.log( response );
//             $('#actual-sesion-title')[0].innerHTML = "Sesión " + response.actual_sesion.number_sesion;
//             response.schedules.forEach(element => {
//                 //console.log(element);
//                 $('#dataTable').DataTable().row.add([
//                     `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.code_sis }</font></font></td>`,
//                     `<td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.first_name } ${ element.user.second_name }</font></font></td>`,
//                     `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.names }</font></font></td>`,
//                     `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.tarea_sesion }</font></font></td>`,
//                     `<div class="text-center" style="display: flex;">
//                         <a href="#" class="btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick='loadProfile(${ JSON.stringify(element.user) })' id="profile"><i class="fas fa-eye"></i></a>
//                         <a href="/professor/studentSesions/${element.id}}" class="btn btn-success btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Portafolios" data-toggle="modal" data-target="#student-folder" onclick='loadFolder(${ JSON.stringify(element) })'><i class="fas fa-briefcase"></i></a>
//                     </div>`
//                 ]).draw();
//             });
//         },
//         error: function() {
//             endLoading();
//             alert("Error de conexión. Vuelva a intentarlo.");
//         },
//         timeout: 20000
//     });
// }
function loadFolder( studentSchedule ) {
    //console.log( studentSchedule );

    $('#input_schedule_id').removeAttr("value");
    $('#input_schedule_id').attr("value", studentSchedule.id);

    $('#student-data-folder').empty();
    $('#student-data-folder').append(
        `<div id="folder-name"><strong>Estudiante: </strong> ${ studentSchedule.user.first_name } ${ studentSchedule.user.second_name } ${ studentSchedule.user.names } </div>
        <div id="folder-cod-sis"><strong>Código SIS: </strong> ${ studentSchedule.user.code_sis } </div>
        <div id="folder-subject"><strong>Materia: </strong> ${ studentSchedule.group.subject.name } </div>
        <div id="folder-group"><strong>Grupo: </strong> ${ studentSchedule.group.name } </div>`
    );
    $('#sesions-student').empty();

    $.ajax({
        url: '/professor/students/getTasksStudent/'+studentSchedule.student_id+'/'+studentSchedule.blockschedule.block_id,
        success: function( response ) {
            // console.log( response );
            response.block_sesions.forEach( sesion => {
                sesion_tasks = [];
                title_task = "";
                response.block_tasks.forEach( task =>{
                    if( sesion.id == task.sesion_id ) {
                        title_task = ( Object.keys( sesion_tasks).length == 0 ) ? title_task + task.title : title_task + ", " + task.title;
                        sesion_tasks.push( task );
                    }
                });
                title_task = ( Object.keys( sesion_tasks ).length == 0 ) ? "Sin tareas" : title_task;
                // console.log( sesion_tasks );

                actual_sesion_tasks = [];
                for( let i=0 ; i<Object.keys( sesion_tasks ).length ; i++ ) {
                    for( let j=0 ; j<Object.keys( response.student_tasks).length ; j++ ) {
                        if( response.student_tasks[j].task.id == sesion_tasks[i].id ) {
                            actual_sesion_tasks.push( response.student_tasks[j] );
                        }
                    }
                }
                //console.log( Object.keys( actual_sesion_tasks ).length );
                description_task = "Sin observaciones.";
                fecha_entrega = "Ninguna";

                if( Object.keys( actual_sesion_tasks ).length == 1) {
                    fecha_entrega = ( actual_sesion_tasks[0].created_at ).substring( 11, 16 ) + " - " + ( actual_sesion_tasks[0].created_at ).substring( 8, 10 ) + " " + getMonth( actual_sesion_tasks[0].created_at );
                    if( actual_sesion_tasks[0].description != null ) {
                        description_task = actual_sesion_tasks[0].description;
                    }
                } else if( Object.keys( actual_sesion_tasks ).length > 1 ) {
                    description_task = "";
                    fecha_entrega = ( actual_sesion_tasks[0].created_at ).substring( 11, 16 ) + " - " + ( actual_sesion_tasks[0].created_at ).substring( 8, 10 ) + " " + getMonth( actual_sesion_tasks[0].created_at );
                    actual_sesion_tasks.forEach( task =>{
                        if( task.description != null ) {
                            description_task = description_task + "( " + task.task.title + " ) -> " + task.description + " ";
                        } else {
                            description_task = description_task + "( " + task.task.title + " ) -> Sin observaciones. ";
                        }
                    });
                }

                entregar_tarea = `<label class="m-0" style="color: green;"> <b> A tiempo </b> </label> &nbsp;
                <a href="#" download="" data-toggle-2='tooltip' title='Descargar Tarea'><i class="fa fa-download" aria-hidden="true"></i></a>`;

                var detail = "";
                var sesion_color = "warning";
                if( Object.keys( sesion_tasks ).length > 0 ) {
                    var sesion_color = "success";
                    detail = `<div class="py-0 px-3">
                                    <div class="" style="font-size: 13px;">
                                        <div>
                                            <b>Entrega:&nbsp;</b> ${ fecha_entrega }
                                        </div>
                                        <div> <b> Observación del Estudiante: </b> ${ description_task } </div>
                                    </div>
                                </div>`
                }
                $('#sesions-student').append(
                        `<div class="card border-left-${ sesion_color } shadow h-100 mx-2 mt-2 mb-2" style="margin-bottom: 0px;">
                            <div class="card-body py-2">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase">
                                            <strong style="color: gray;"> Sesión:&nbsp; </strong> <b> ${ sesion.number_sesion } </b>
                                            <br>
                                            <b> ${ title_task } </b>
                                        </div>
                                        <div class="row no-gutters align-items-center py-0">
                                            <div class="col-auto">
                                                <div id="sesion{sesion->id})" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">${ Object.keys( actual_sesion_tasks ).length }/${ Object.keys( sesion_tasks ).length }</div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: ${ (Object.keys( actual_sesion_tasks ).length * 100) / Object.keys( sesion_tasks ).length }%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ${ detail }
                        `
                );
            });
        },
        error: function () {
            alert("Error de conexión. Vuelva a intentarlo.");
        },
        timeout: 10000
    });
}

function getMonth(date){
    var resp;
    switch(date.charAt(5) + date.charAt(6)){
        case '01':
            resp = "Enero";
            break;
        case '02':
            resp = "Febrero";
            break;
        case '03':
            resp = "Marzo";
            break;
        case '04':
            resp = "Abril";
            break;
        case '05':
            resp = "Mayo";
            break;
        case '06':
            resp = "Junio";
            break;
        case '07':
            resp = "Julio";
            break;
        case '08':
            resp = "Agosto";
            break;
        case '09':
            resp = "Septiembre";
            break;
        case '10':
            resp = "Octubre";
            break;
        case '11':
            resp = "Noviembre";
            break;
        case '12':
            resp = "Diciembre";
            break;
    }
    return resp;
}