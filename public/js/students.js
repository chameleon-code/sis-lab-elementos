var schedule_id;
var subject_matters_ids = new Array();
var student_schedule_id = undefined;

// function addSubjectMatterId(id) {
//     subject_matters_ids.push(id);
// }

$(document).ready(function() {
    // $('#info-inscription').hide();
    // $('#modal-footer').hide();

    // Para obtener las inscripciones del estudiante
    $.ajax({
        url : '/students/registration/getScheduleStudent',
        success: function (response){
            for(var i=0 ; i<subject_matters_ids.length ; i++)
            {
                $('#link-take-matter-'+subject_matters_ids[i]).show();
            }
            if(Object.keys(response).length != 0){
                for(var i=0 ; i<subject_matters_ids.length ; i++){
                    for(var j=0 ; j<Object.keys(response.schedule_student).length ; j++){
                        if(subject_matters_ids[i] == response.schedule_student[j].subject_matter_id){
                            $('#link-take-matter-'+response.schedule_student[j].subject_matter_id)[0].innerHTML = "Cambiar Horario";
                            $('#link-take-matter-'+response.schedule_student[j].subject_matter_id).hide();
                            $('#student-schedule-id-'+response.schedule_student[j].subject_matter_id)[0].value = response.schedule_student[j].id;
                            $('#link-remove-matter-'+response.schedule_student[j].subject_matter_id)[0].setAttribute("onclick", "sendStudentScheduleId("+response.schedule_student[j].id+")");
                            $('#link-remove-matter-'+response.schedule_student[j].subject_matter_id).show();
                            var grupo;
                            for(var k=0 ; k<Object.keys(response.groups).length ; k++){
                                if(response.groups[k].id == response.schedule_student[j].group_id){
                                    grupo = response.groups[k].name;
                                }
                            }
                            var docente;
                            for(var k=0 ; k<Object.keys(response.professors).length ; k++){
                                if(response.professors[k].professor_id == response.schedule_student[j].professor_id){
                                    docente = response.professors[k].names+' '+response.professors[k].first_name+' '+response.professors[k].second_name;
                                }
                            }
                            $('#subject-matter-'+response.schedule_student[j].subject_matter_id).append(
                                "<br><strong class='text-primary' style='font-size: 14px;'>Se encuentra inscrito en esta materia. <br> Grupo "+grupo+" - "+docente+"</strong>"
                            );
                        }
                    }
                }
            }
        },
        error: function() {
            console.log("No se ha podido obtener la información");
            alert("Error de conexión. Vuelva a intentarlo.");
        }
    });

});

function clearSelects(id) {
    var selects;
    var id_select = 1;
    while ($('#group_' + id_select)[0]) {
        if (id != id_select) {
            var select = $('#group_' + id_select)[0];
            select[0].selected = true;
        }
        id_select++;
    }
}

function infReg(item, id) {
    $('#no-schedules').remove();
    $('#body-table').empty();
    $('#group_id_input')[0].value = id;
    var select = $('#group_' + id)[0];
    if (select.options[select.selectedIndex].text !== "grupo") {
        $.ajax({
            url : '/students/registration/getGroupSchedules/'+select.value,
            beforeSend: function () {
                loading();
            },
            success: function (response){
                if(Object.keys(response).length > 0){
                    var cont = 1;
                    let longChecks = 0;
                    response.forEach(function(element) {
                        if(element.block_id == id) {
                            longChecks++;
                        }
                    });
                    var longitud_horarios = 0;
                    response.forEach(function(element) {
                        if(element.block_id == id) {
                            var day = element.schedule.day.name;
                            var hour = (element.schedule.hour.start).substr(0, 5) + " - " + (element.schedule.hour.end).substr(0, 5);
                            $('#schedules-table').show();
                            $('#body-table').append(
                                " <tr class='text-center'><td style='display: none;'>" + element.schedule.laboratory.name + "</td><td>" + day + "</td><td style='display: none;'>" + hour + "</td><td><div class='custom-control custom-checkbox small'><input type='checkbox' class='custom-control-input' id='Check" + cont + "' onclick='clearChecks(" + longChecks + ", " + cont + ", " + element.schedule_id + ", " + element.id + ")'><label class='custom-control-label' for='Check" + cont + "'></label></div></td></tr> "
                            );
                            cont++;
                            longitud_horarios++;
                        }
                    });
                    if(longitud_horarios == 0) {
                        endLoading();
                        $('#schedules-table').hide();
                        $('#schedules-table').after(
                            "<div id='no-schedules'> <strong> No hay horarios disponibles para este grupo. </strong> </div>"
                        );
                        $("#inf-reg-modal").modal("show");
                    } else {
                        endLoading();
                        $("#inf-reg-modal").modal("show");
                    }
                } else {
                    endLoading();
                    $('#schedules-table').hide();
                    $('#schedules-table').after(
                        "<div id='no-schedules'> <strong> No hay horarios disponibles para este grupo. </strong> </div>"
                    );
                    $("#inf-reg-modal").modal("show");
                }
            },
            error: function() {
                
                $('#schedules-table').hide();
                $('#schedules-table').after(
                    "<div id='no-schedules'> <strong> No hay horarios disponibles para este grupo. </strong> </div>"
                );
                alert("Error de conexión. Vuelva a intentarlo.");
            },
            timeout: 10000
        });

        $('#text_select_group')[0].setAttribute("style", "display: none;");
        $('#text_confirm_reg')[0].setAttribute("style", "");
        $('#btn_cancel')[0].setAttribute("style", "");
        $('#btn_confirm')[0].setAttribute("style", "");
        $('#subjectMatter_selected')[0].innerHTML = item.name;
        $('#group_selected')[0].innerHTML = select.options[select.selectedIndex].text;
        $('#group_id_input')[0].value = select.value;
    } else {
        $('#text_confirm_reg')[0].setAttribute("style", "display: none;");
        $('#btn_cancel')[0].setAttribute("style", "display: none;");
        $('#btn_confirm')[0].setAttribute("style", "display: none;");
        $('#text_select_group')[0].setAttribute("style", "");
        endLoading();
        $("#inf-reg-modal").modal("show");
    }
}

function clearChecks(longChecks, idCheck, schedule_record_id, block_schedule_id) {
    if ($('#Check' + idCheck)[0].checked == 1) {
        $('#block_schedule_id')[0].value = block_schedule_id;
        schedule_id = schedule_record_id;
        for (var i = 1; i <= longChecks; i++) {
            if (i != idCheck) {
                $('#Check' + i)[0].checked = 0;
            }
        }
    } else {
        schedule_id = undefined;
        $('#block_schedule_id')[0].value = null;
    }
    if (schedule_id != undefined) {
        $('#info-inscription').show();
        $('#modal-footer').show();
    } else {
        $('#info-inscription').hide();
        $('#modal-footer').hide();
    }
}

function sendStudentScheduleId(id){
    $('#btn-unregister')[0].setAttribute("href", "/student/unregistration/"+id);
}

function studentScheduleId(id){
    student_schedule_id = id;
}

function verifyRegistration (subject_matter_id){
    if($('#link-take-matter-'+subject_matter_id)[0].innerText == "Inscribirse"){
        $('#form-registration')[0].setAttribute("action", "/students/registration/store");
    } else if ($('#link-take-matter-'+subject_matter_id)[0].innerText == "Cambiar Horario") {
        var schedule_student_id = $('#student-schedule-id-'+subject_matter_id)[0].value;
        var url = "/students/registration/edit/"+schedule_student_id+"";
        $('#form-registration')[0].setAttribute("action", url);
    }
}

function status(){
    $('#info-ins').empty();
    $.ajax({
        url : '/students/registration/getScheduleStudent',
        beforeSend: function() {
            loading();
        },
        success: function (response){
            if(Object.keys(response.schedule_student).length > 0){
                var matter = undefined;
                var group_name = undefined;
                var professor = undefined;
                var day = undefined;
                var hour = undefined;
                var lab;
                for(var i=0 ; i<Object.keys(response.schedule_student).length ; i++){
                    for(var j=0 ; j<Object.keys(response.subject_matters).length ; j++){
                        if(response.subject_matters[j].id == response.schedule_student[i].subject_matter_id){
                            matter = response.subject_matters[j].name;
                            console.log(matter);
                        }
                    }
                    for(var j=0 ; j<Object.keys(response.groups).length ; j++){
                        if(response.groups[j].id == response.schedule_student[i].group_id){
                            group_name = response.groups[j].name;
                        }
                    }
                    for(var j=0 ; j<Object.keys(response.professors).length ; j++){
                        if(response.professors[j].professor_id == response.schedule_student[i].professor_id){
                            professor = response.professors[j].names + " " + response.professors[j].first_name + " " + response.professors[j].second_name;
                        }
                    }
                    for(var j=0 ; j<Object.keys(response.block_schedules).length ; j++){
                        if(response.block_schedules[j].id == response.schedule_student[i].block_schedule_id){
                            day = response.block_schedules[j].schedule.day.name;
                            hour = (response.block_schedules[j].schedule.hour.start).substr(0, 5) + " - " + (response.block_schedules[j].schedule.hour.end).substr(0, 5);
                            lab = response.block_schedules[j].schedule.laboratory.name;
                        }
                    }
                    $('#info-ins').append(
                        //`<div class='accordion-body bg-gray-300 rounded row my-2' style='cursor: default;'> <div class='container d-flex justify-content-between px-1' style=''> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong class='py-0 my-0'> Materia:&nbsp;</strong> ${ matter } </div> </div> <div class='my-0 mx-1' style='font-size: 15px;'> <div class='d-flex justify-content-start' style='padding-left: 3px; display: none !important;'> <strong class='py-0 my-0'> Laboratorio:&nbsp; </strong> ${ lab } </div> <div class='d-flex justify-content-start' style='padding-left: 2px;'> Grupo ${ group_name } - ${ professor } </div> <div class='' style='font-size: 15px; padding-left: 2px;'> ${ day } ${ hour } </div> </div> </div>`
                        `<div class='accordion-body bg-gray-300 rounded row my-2' style='cursor: default;'> <div class='container d-flex justify-content-between px-1' style=''> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong class='py-0 my-0'> Materia:&nbsp;</strong> ${ matter } </div> </div> <div class='my-0 mx-1' style='font-size: 15px;'> <div class='d-flex justify-content-start' style='padding-left: 3px; display: none !important;'> <strong class='py-0 my-0'> Laboratorio:&nbsp; </strong> ${ lab } </div> <div class='d-flex justify-content-start' style='padding-left: 2px;'> Grupo ${ group_name } - ${ professor } </div> <div class='' style='font-size: 15px; padding-left: 2px;'> ${ day } </div> </div> </div>`
                    )
                    endLoading();
                    $("#infoInscription").modal("show");
                }
            } else {
                $('#info-ins').append(
                    "<div> No cuenta con materias inscritas. </div>"
                );
                endLoading();
                $("#infoInscription").modal("show");
            }
        },
        error: function(){
            console.log("Ha ocurrido un error.");
            alert("Error de conexión. Vuelva a intentarlo.");
        },
        timeout: 10000
    });
}

// function dayById(day_id){
//     day = undefined;
//     switch (day_id) {
//         case 1:
//             day = 'Lunes';
//             break;
//         case 2:
//             day = 'Martes';
//             break;
//         case 3:
//             day = 'Miércoles';
//             break;
//         case 4:
//             day = 'Jueves';
//             break;
//         case 5:
//             day = 'Viernes';
//             break;
//         case 6:
//             day = 'Sábado';
//             break;
//     }
//     return day;
// }

// function hourById(hour_id){
//     hour = undefined;
//     switch (hour_id) {
//         case 1:
//             hour = '06:45 - 08:15';
//             break;
//         case 2:
//             hour = '08:15 - 09:45';
//             break;
//         case 3:
//             hour = '09:45 - 11:15';
//             break;
//         case 4:
//             hour = '11:15 - 12:45';
//             break;
//         case 5:
//             hour = '12:45 - 14:15';
//             break;
//         case 6:
//             hour = '14:15 - 15:45';
//             break;
//         case 7:
//             hour = '15:45 - 17:15';
//             break;
//         case 8:
//             hour = '17:15 - 18:45';
//             break;
//         case 9:
//             hour = '18:45 - 20:15';
//             break;
//         case 10:
//             hour = '20:15 - 21:45';
//             break;
//     }
//     return hour;
// }



///////////////////////////////////////////////////////////////////

function infoRegistration( subject_id ) {
    $('#info-inscription').hide();
    $('#modal-footer').hide();
    let selected_group = null;
    for(let i=0 ; i<groups.length ; i++) {
        if( $('#selector-subject-'+subject_id)[0].value == groups[i].id ) {
            selected_group = groups[i];
            break;
        }
    }


    // $('#no-schedules').remove();
    $('#body-schedules-table').empty();
    // $('#group_id_input')[0].value = id;
    // var select = $('#group_' + id)[0];

    // if (select.options[select.selectedIndex].text !== "grupo") {
        $.ajax({
            url : '/students/registration/getGroupSchedules/'+selected_group.id+'/'+selected_group.block_id,
            // beforeSend: function () {
            //     loading();
            // },
            success: function (response){

                if(Object.keys(response).length > 0){

                    // var cont = 1;
                    // let longChecks = 0;
                    // response.forEach(function(element) {
                    //     if(element.block_id == id) {
                    //         longChecks++;
                    //     }
                    // });
                    // var longitud_horarios = 0;

                    response.forEach(function(block_schedule) {
                        //if(element.block_id == id) {

                            let day = block_schedule.schedule.day.name;
                            let hour = ( block_schedule.schedule.hour.start ).substr(0, 5) + " - " + (block_schedule.schedule.hour.end).substr(0, 5);
                            $('#body-schedules-table').show();
                            $('#body-schedules-table').append(
                                `
                                <tr class='text-center'>
                                    <td style='display: none;'> ${ block_schedule.schedule.laboratory.name } </td>
                                    <td> ${ day } </td>
                                    <td style='display: none;'> ${ hour } </td>
                                    <td>
                                        <div class='custom-control custom-checkbox small'>
                                            <input type='checkbox' class='custom-control-input' id='check-block-schedule-${ block_schedule.schedule.id }' onclick='clickCheck( ${ JSON.stringify( block_schedule ) }, ${ JSON.stringify( response ) } )'>
                                            <label class='custom-control-label' for='check-block-schedule-${ block_schedule.schedule.id }'></label>
                                        </div>
                                    </td>
                                </tr>
                                `
                            );
                            // <input type='checkbox' class='custom-control-input' id='check${ block_schedule.schedule.id }' onclick='clearChecks( ${ longChecks }, ${ cont }, ${ element.schedule_id }, ${ element.id } )'></input>
                            // cont++;
                            // longitud_horarios++;

                        //}
                    });

                    $("#inf-reg-modal").modal("show");

                    // if(longitud_horarios == 0) {
                    //     endLoading();
                    //     $('#schedules-table').hide();
                    //     $('#schedules-table').after(
                    //         "<div id='no-schedules'> <strong> No hay horarios disponibles para este grupo. </strong> </div>"
                    //     );
                    //     $("#inf-reg-modal").modal("show");
                    // } else {
                    //     endLoading();
                    //     $("#inf-reg-modal").modal("show");
                    // }

                } else {

                    $('#schedules-table').hide();
                    $('#schedules-table').after(
                        "<div id='no-schedules'> <strong> No hay horarios disponibles para este grupo. </strong> </div>"
                    );
                    $("#inf-reg-modal").modal("show");

                    // endLoading();
                    // $('#schedules-table').hide();
                    // $('#schedules-table').after(
                    //     "<div id='no-schedules'> <strong> No hay horarios disponibles para este grupo. </strong> </div>"
                    // );
                    // $("#inf-reg-modal").modal("show");
                }
            },
            error: function() {
                
                $('#schedules-table').hide();
                $('#schedules-table').after(
                    "<div id='no-schedules'> <strong> No hay horarios disponibles para este grupo. </strong> </div>"
                );
                alert("Error de conexión. Vuelva a intentarlo.");
            },
            timeout: 10000
        });

        $('#text_select_group')[0].setAttribute("style", "display: none;");
        $('#text_confirm_reg')[0].setAttribute("style", "");
        $('#btn_cancel')[0].setAttribute("style", "");
        $('#btn_confirm')[0].setAttribute("style", "");
        // $('#subjectMatter_selected')[0].innerHTML = item.name;
        // $('#group_selected')[0].innerHTML = select.options[select.selectedIndex].text;
        // $('#group_id_input')[0].value = select.value;
    // } else {
    //     $('#text_confirm_reg')[0].setAttribute("style", "display: none;");
    //     $('#btn_cancel')[0].setAttribute("style", "display: none;");
    //     $('#btn_confirm')[0].setAttribute("style", "display: none;");
    //     $('#text_select_group')[0].setAttribute("style", "");
    //     endLoading();
    //     $("#inf-reg-modal").modal("show");
    // }
}

function clickCheck( block_schedule, block_schedules ) {
    //console.log( block_schedule );
    $('#info-inscription').hide();
    $('#modal-footer').hide();

    if( $('#check-block-schedule-'+block_schedule.schedule_id)[0].checked == 1 ) {
        for(let i=0 ; i<block_schedules.length ; i++) {
            if( block_schedules[i].schedule_id != block_schedule.schedule_id ) {
                $('#check-block-schedule-'+block_schedules[i].schedule_id)[0].checked = 0;
            }
        }
        $('#input_block_schedule_id')[0].value = block_schedule.id;
        $('#input_group_id')[0].value = block_schedule.group_id;
        $('#selected-subject-name').html( block_schedule.schedule.subject );
        $('#selected-group-name').html( block_schedule.group_name );
        $('#info-inscription').show();
        $('#modal-footer').show();
    } else {
        // si esta marcado y desmarcamos
        for(let i=0 ; i<block_schedules.length ; i++) {
            if( block_schedules[i].schedule_id != block_schedule.schedule_id ) {
                $('#check-block-schedule-'+block_schedules[i].schedule_id)[0].checked = 0;
            }
        }
        $('#input_block_schedule_id')[0].value = null;
        $('#input_group_id')[0].value = null;
        $('#info-inscription').hide();
        $('#modal-footer').hide();
    }
}