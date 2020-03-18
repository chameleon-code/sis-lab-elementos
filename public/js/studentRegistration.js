var schedule_id;
var subject_matters_ids = new Array();
var student_schedule_id = undefined;

// function addSubjectMatterId(id) {
//     subject_matters_ids.push(id);
// }

$(document).ready(function() {
    checkRegistrationSubject();
});

// Cambio de Horario
function verifyRegistration (subject_matter_id){
    if($('#link-take-matter-'+subject_matter_id)[0].innerText == "Inscribirse"){
        $('#form-registration')[0].setAttribute("action", "/students/registration/store");
    } else if ($('#link-take-matter-'+subject_matter_id)[0].innerText == "Cambiar Horario") {
        var schedule_student_id = $('#student-schedule-id-'+subject_matter_id)[0].value;
        var url = "/students/registration/edit/"+schedule_student_id+"";
        $('#form-registration')[0].setAttribute("action", url);
    }
}

//Para obtener el estado de inscripcion
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
    $('#body-schedules-table').empty();
    $.ajax({
        url : '/students/registration/getGroupSchedules/'+selected_group.id+'/'+selected_group.block_id,
        success: function (response){
            if(Object.keys(response).length > 0){
                response.forEach(function(block_schedule) {
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
                });
                $("#inf-reg-modal").modal("show");
            } else {
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
        }
    });
}

function clickCheck( block_schedule, block_schedules ) {
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

function checkRegistrationSubject() {
    for(let i=0 ; i<subjects.length ; i++) {
        $('#message-subject-'+subjects[i].id).empty();
        let registered = false;
        for(let j=0 ; j<student_schedules.length ; j++) {
            if( student_schedules[j].subject_matter_id == subjects[i].id ) {
                $("#selector-subject-"+subjects[i].id+" option[value="+student_schedules[j].group_id+"]").attr("selected",true);
                $("#selector-subject-"+subjects[i].id).prop( "disabled", true );
                $('#message-subject-'+subjects[i].id).append(
                    `
                    Ya se encuentra inscrito en esta materia. <br>
                    Grupo ${ student_schedules[j].group_name } - ${ student_schedules[j].professor_names } ${ student_schedules[j].professor_first_name } ${ student_schedules[j].professor_second_name }
                    `
                );
                registered = true;
                break;
            }
        }
        if( !registered ) {
            $('#subscription-btn-'+subjects[i].id).show();
        } else {
            $('#unsubscription-btn-'+subjects[i].id).show();
        }
    }
}

function removeSubscription( subject_id ) {
    $("#message-remove-subscription").empty();
    for(let i=0 ; i<student_schedules.length ; i++) {
        if( student_schedules[i].subject_matter_id == subject_id ) {
            $('#btn-unregister')[0].setAttribute("href", "/student/unregistration/"+student_schedules[i].student_schedule_id);
            $("#message-remove-subscription").append(
                `
                ¿Está seguro que desea retirar <b> ${ student_schedules[i].subject_matter_name } </b> ?
                <br><br>
                Podrá volver a realizar inscripciones en esta materia para los grupos habilitados.
                `
            );
            break;
        }
    }
}