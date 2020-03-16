var sesion_id = undefined;
var task_dom_id = undefined;
var task_dom_max_id = undefined;
var modificando_form = false;
var with_description = true;
var schedules = undefined;

$(document).ready(function(){
    $('#formActivity').hide();
    $('#btnsTasks').hide();
    $('#btnsEditTasks').hide();
    hideErrors();

    loadPracticeInfo();

    console.log( groups );
});

function showSesion(sesion){
    hideFormActivity();
    sesion_id = sesion.id;
    $('#sesionTitle')[0].innerHTML = "Guía Práctica de la <strong> sesión " + sesion.number_sesion + "</strong>";
}

function showFormActivity(){
    hideErrors();
    $('#title-form')[0].innerHTML = "Nueva tarea";
    $('#btnAddActivity').hide();
    $('#formActivity').show();
    $('#btnsTasks').show();
    $('#sesionTasks').hide();
    $('#sesion_id')[0].value = sesion_id;
    $('#title')[0].value = "";
    $('#description')[0].value = "";
}

function hideFormActivity(){
    $('#btnAddActivity').show();
    $('#formActivity').hide();
    $('#sesionTasks').show();
    $('#btnsTasks').hide();
    $('#btnsEditTasks').hide();
    // $('#title')[0].value = "";
    // $('#description')[0].value = "";
    // $('#practice')[0].value = "";
}

function loadPractice(sesion_id){
    $('#sesionTasks').empty();  
    // $('#group_id_input')[0].value = id;
        
    $.ajax({
        url : '/professor/sesion/'+sesion_id+'/tasks',
        beforeSend: loading(),
        success: function (response){
            if(Object.keys(response).length > 0){
                var i = 1;
                response.forEach(function(element){
                    var mes = getMonth(element.updated_at);
                    var dia = element.updated_at.charAt(8) + element.updated_at.charAt(9);
                    var hora = element.updated_at.charAt(11) + element.updated_at.charAt(12) + element.updated_at.charAt(13) + element.updated_at.charAt(14) +element.updated_at.charAt(15);
                    var dom_description;
                    if(element.description == "" || element.description == null) {
                        dom_description = "<div style='color: grey;'> <strong> Sin descripción </strong> </div>";
                    } else {
                        dom_description = "<div style=''> <strong> Descripción:&nbsp; </strong> <div id=''>"+element.description+"</div> </div>";
                    }
                    var file;
                    var link_file;
                    if(element.task_file == undefined || element.task_file == null) {
                        file = "ninguno";
                        link_file = "<span style='color: grey;'>"+file+"</span>";
                    } else {
                        file = element.task_file;
                        link_file = `<a href="/downloadPractice/${element.task_path}${element.task_file}" target='_blank'>${file}</a>`;
                        //href="{{'/downloadTask/'.$task->done->task_path.'/'.$task->done->task_name}}"
                    }
                    var dom_file = "<div class='' style='margin-top: 15px; margin-bottom: -10px;'> Archivo adjunto: "+link_file+" </div>"
                    if(element.updated_at.charAt(8) == 0){
                        dia = element.updated_at.charAt(9);
                    }
                    $('#sesionTasks').append(
                        "<div class='accordion-body bg-gray-300 rounded row my-2' id='task"+i+"' style='cursor: default;'> <div class='container d-flex justify-content-between p-1' style=''> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong> Título:&nbsp;</strong>"+element.title+" </div> <div class='d-flex justify-content-end'> <a href='#' id='btn-edit-task-"+i+"' class='mx-2' data-toggle-2='tooltip' title='Editar' onclick='editTask("+JSON.stringify(element)+", "+i+")'><i class='fas fa-edit'></i></a> <a href='#' id='btn-delete-task-"+i+"' class='mx-2' data-toggle-2='tooltip' title='Eliminar' onclick='deleteTask("+i+","+element.id+")'><i class='fas fa-trash'></i></a> </div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong style='margin-right: 15px;'> "+element.published_by+" </strong> "+dia+" "+mes+" "+hora+" </div> <div class='my-2 mx-1' style='font-size: 15px;'> "+dom_description+" "+dom_file+" </div> </div>"
                    );
                    task_dom_max_id = i;
                    i++;
                });
                endLoading();
                $("#practice-sesion-modal").modal("show");
            } else {
                endLoading();
                $("#practice-sesion-modal").modal("show");
                $('#sesionTasks').append(
                    "<div id='no-tasks' style='margin-bottom: 10px;'> <string> No hay tareas asignadas para esta sesión. </strong> </div>"
                );
            }
        },
        error: function() {
            endLoading();
            console.log("No se ha podido obtener la información");
            alert("Error de conexión. Vuelva a intentarlo.");
        },
        timeout: 10000
    });
    
}

function storeTask(){
    $('#no-tasks').remove();
    var formData = new FormData($('#taskForm')[0]);
    var token = $("#token").val();
    $.ajax({
        url : '/professor/sesions/tasks/store',
        headers: { "X-CSRF-TOKEN": token },
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#practice-sesion-modal").modal("hide");
            loading();
        },
        success: (response) => {
            if(response.title && !(response.response == "error_file")){
                hideFormActivity();
                var mes = getMonth(response.updated_at);
                var dia = response.updated_at.charAt(8) + response.updated_at.charAt(9);
                var hora = response.updated_at.charAt(11) + response.updated_at.charAt(12) + response.updated_at.charAt(13) + response.updated_at.charAt(14) +response.updated_at.charAt(15);
                var dom_description;
                if(response.description == "") {
                    dom_description = "<div style='color: grey;'> <strong> Sin descripción </strong> </div>";
                } else {
                    dom_description = "<div style=''> <strong> Descripción:&nbsp; </strong> <div id=''>"+response.description+"</div> </div>";
                }
                var file;
                var link_file;
                if(response.task_file == undefined || response.task_file == null) {
                    file = "ninguno";
                    link_file = "<span style='color: grey;'>"+file+"</span>";
                } else {
                    file = response.task_file;
                    //link_file = "<a href='"+response.task_path+response.task_file+"' target='_blank'>"+file+"</a>";
                    link_file = `<a href="/downloadPractice/${response.task_path}${response.task_file}" target='_blank'>${file}</a>`;
                }
                var dom_file = "<div class='' style='margin-top: 15px; margin-bottom: -10px;'> Archivo adjunto: "+link_file+" </div>"
                if(response.updated_at.charAt(8) == 0){
                    dia = response.updated_at.charAt(9);
                }
                task_dom_max_id++;
                endLoading();
                $("#practice-sesion-modal").modal("show");
                $('#sesionTasks').append(
                    "<div class='accordion-body bg-gray-300 rounded row my-2' id=task"+task_dom_max_id+" style='cursor: default;'> <div class='container d-flex justify-content-between p-1' style=''> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong> Título:&nbsp;</strong>"+response.title+" </div> <div class='d-flex justify-content-end'> <a href='#' id='btn-edit-task-"+task_dom_max_id+"' class='mx-2' data-toggle-2='tooltip' title='Editar' onclick='editTask("+JSON.stringify(response)+", "+task_dom_max_id+")'><i class='fas fa-edit'></i></a> <a href='#' id='btn-delete-task-"+task_dom_max_id+"' class='mx-2' data-toggle-2='tooltip' title='Eliminar' onclick='deleteTask("+task_dom_max_id+","+response.id+")'><i class='fas fa-trash'></i></a> </div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong style='margin-right: 15px;'> "+response.published_by+" </strong> "+dia+" "+mes+" "+hora+" </div> <div class='my-2 mx-1' style='font-size: 15px;'> "+dom_description+" "+dom_file+" </div> </div>"
                );
            } else if (response.response == "no_title"){
                endLoading();
                $("#practice-sesion-modal").modal("show");
                $('#errors-form').empty();
                $('#errors-div').show();
                $('#errors-form').append("<li> Campo Título requerido. </li>");
            } else if (response.response == "error_file") {
                endLoading();
                $("#practice-sesion-modal").modal("show");
                $('#errors-form').empty();
                $('#errors-div').show();
                $('#errors-form').append("<li> Formato de archivo no aceptado </li>");
            }
        },
        error: function() {
            endLoading();
            console.log("Algo salió mal");
            $('#errors-form').empty();
            $('#errors-div').show();
            $('#errors-form').append("<li>Archivo con tamaño mayor a 2MB. </li>");
            alert("Error de conexión. Vuelva a intentarlo.");
        },
        timeout: 10000
    });
}

function deleteTask(id_dom_task, id_task){
    $('#btn-edit-task-'+id_dom_task).hide();
    $('#btn-delete-task-'+id_dom_task).hide();
    $('#task'+id_dom_task).after(
        "<div class='d-flex justify-content-center' id='confirm-delete-task"+id_dom_task+"' style='margin-bottom: 15px;'> <button type='button' class='btn btn-danger btn-block btn-sm col-md-3 mx-2' style='' onclick='destroyTask("+id_dom_task+", "+id_task+")'>Eliminar</button> <button type='button' class='btn btn-secondary btn-block btn-sm col-md-3 mx-2' style='margin-top: 0px;' onclick='cancelDelete("+id_dom_task+")'>Cancelar</button> <input type='hidden' name='_token' value='{{csrf_token()}}' id='token_h'> </div> "
    );
}

function destroyTask(id_dom_task, id_task){
    //var token = $("#token").val();
    $.ajax({
        url : '/professor/task/delete/'+id_task,
        beforeSend: function () {
            loading();
            $("#practice-sesion-modal").modal("hide");
        },
        //headers: { "X-CSRF-TOKEN": token },
        success: function (response){
            $('#task'+id_dom_task).remove();
            $('#confirm-delete-task'+id_dom_task).remove();
            // $('#sesionTasks').append(
            //     "<div id='no-tasks' style='margin-bottom: 10px;'> <string> No hay tareas asignadas para esta sesión. </strong> </div>"
            // );
            endLoading();
            $("#practice-sesion-modal").modal("show");
        },
        error: function() {
            endLoading();
            $("#practice-sesion-modal").modal("show");
            console.log("No se pudo realizar la operación");
            alert("Error de conexión. Vuelva a intentarlo.");
        },
        timeout: 10000
    });
}

function cancelDelete(id_dom_task){
    $('#confirm-delete-task'+id_dom_task).remove();
    $('#btn-edit-task-'+id_dom_task).show();
    $('#btn-delete-task-'+id_dom_task).show();
}

function editTask(task, i){
    showFormActivity();
    $('#title-form')[0].innerHTML = "Edición de tarea";
    task_dom_id = i;
    $('#btnsTasks').hide();
    $('#btnsEditTasks').show();
    $('#title')[0].value = task.title;
    $('#description')[0].value = task.description;
    $('#sesion_id')[0].value = task.sesion_id;
    $('#task_id')[0].value = task.id;
}

function storeEditedTask(){
    var formData = new FormData($('#taskForm')[0]);
    var token = $("#token").val();
    $.ajax({
        url : '/professor/sesions/tasks/edit',
        headers: { "X-CSRF-TOKEN": token },
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            loading();
            $("#practice-sesion-modal").modal("hide");
        },
        success: (response) => {
            if(response.title){
                hideFormActivity();
                //$('#task'+task_dom_id).remove();
                var mes = getMonth(response.updated_at);
                var dia = response.updated_at.charAt(8) + response.updated_at.charAt(9);
                var hora = response.updated_at.charAt(11) + response.updated_at.charAt(12) + response.updated_at.charAt(13) + response.updated_at.charAt(14) +response.updated_at.charAt(15);
                var dom_description;
                if(response.description == "") {
                    dom_description = "<div style='color: grey;'> <strong> Sin descripción </strong> </div>";
                } else {
                    dom_description = "<div style=''> <strong> Descripción:&nbsp; </strong> <div id=''>"+response.description+"</div> </div>";
                }
                var file;
                var link_file;
                if(response.task_file == undefined || response.task_file == null) {
                    file = "ninguno";
                    link_file = "<span style='color: grey;'>"+file+"</span>";
                } else {
                    file = response.task_file;
                    //link_file = "<a href='"+response.task_path+response.task_file+"' target='_blank'>"+file+"</a>";
                    link_file = `<a href="/downloadPractice/${response.task_path}${response.task_file}" target='_blank'>${file}</a>`;
                }
                var dom_file = "<div class='' style='margin-top: 15px; margin-bottom: -10px;'> Archivo adjunto: "+link_file+" </div>"
                if(response.updated_at.charAt(8) == 0){
                    dia = response.updated_at.charAt(9);
                }
                endLoading();
                $("#practice-sesion-modal").modal("show");
                $('#task'+(task_dom_id)).replaceWith(
                    "<div class='accordion-body bg-gray-300 rounded row my-2' id='task"+task_dom_id+"' style='cursor: default;'> <div class='container d-flex justify-content-between p-1' style=''> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong> Título:&nbsp;</strong>"+response.title+" </div> <div class='d-flex justify-content-end'> <a href='#' id='btn-edit-task-"+task_dom_id+"' class='mx-2' data-toggle-2='tooltip' title='Editar' onclick='editTask("+JSON.stringify(response)+", "+task_dom_id+")'><i class='fas fa-edit'></i></a> <a href='#' id='btn-delete-task-"+task_dom_id+"' class='mx-2' data-toggle-2='tooltip' title='Eliminar' onclick='deleteTask("+task_dom_id+","+response.id+")'><i class='fas fa-trash'></i></a> </div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong style='margin-right: 15px;'> "+response.published_by+" </strong> "+dia+" "+mes+" "+hora+" </div> <div class='my-2 mx-1' style='font-size: 15px;'> "+dom_description+" "+dom_file+" </div> </div>"
                );
            } else if (response.response == "no_title"){
                endLoading();
                $("#practice-sesion-modal").modal("show");
                $('#errors-form').empty();
                $('#errors-div').show();
                $('#errors-form').append("<li> Campo Título requerido. </li>");
            } else if (response.response == "error_file") {
                endLoading();
                $("#practice-sesion-modal").modal("show");
                $('#errors-form').empty();
                $('#errors-div').show();
                $('#errors-form').append("<li> Formato de archivo no aceptado </li> <li>Archivo con tamaño mayor a 2MB. </li>");
            }
        },
        error: function() {
            endLoading();
            console.log("Algo salió mal");
            alert("Error de conexión. Vuelva a intentarlo.");
        },
        timeout: 10000
    });
}

function showHideTaskForm(){
    if($('#checkbox-description')[0].checked == 1) { 
        $('#description').show();
        with_description = true;
    } else {
        $('#description').hide();
        with_description = false;
    }
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

function getSesionMonth(date) {
    var day = date.charAt(8) + date.charAt(9);
    if(day.charAt(0) == '0') {
        day = day.charAt(1);
    }
    var month = getMonth(date);
    var year = date.substring(0, 4);

    return day + ' ' + month + ' ' + year;
}

function hideErrors(){
    $('#errors-div').hide();
    $('#errors-form').empty();
}

function selectBlock(blocks) {
    // let select = $("#block-selector")[0];
    
    // blocks.forEach(function (block) {
    //     if(select.value == block.block_id) {
    //         $("#block-"+block.block_id).show();
    //     } else {
    //         $("#block-"+block.block_id).hide();
    //     }
    // });
}

function displayIndexSesionByBlock(blocks) {
    $("#block-"+blocks[0].block_id).show();
}

function loadPracticeInfo() {
    $.ajax({
        url : "/professor/practices/info",
        success: function (response){
            for(i=0 ; i<Object.keys(response.sesions).length ; i++) {
                $("#sesion-badge-"+response.sesions[i].id).append('<span class="badge badge-danger badge-counter">'+ response.quantity_sesion_tasks[response.sesions[i].id] +'</span>');
            }
            for(i=0 ; i<Object.keys(response.sesions).length ; i++) {
                proportion_task = $("#proportion-tasks-"+response.sesions[i].id)[0].innerHTML;
                $("#proportion-tasks-"+response.sesions[i].id)[0].innerHTML = response.tasks_by_sesion[response.sesions[i].id] + ( proportion_task ).substring(1, proportion_task.length);
                if(proportion_task.substring(2, proportion_task.length) != 0) {
                    porcent = (response.tasks_by_sesion[response.sesions[i].id] * 100) / proportion_task.substring(2, proportion_task.length);
                } else {
                    porcent = 0;
                }
                $("#porcent-tasks-"+response.sesions[i].id)[0].setAttribute("style", "width: "+ porcent +"%;");
            }
        },
        error: function() {
            console.log("Ha ocurrido un error.");
            alert("Error de conexión. Vuelva a intentarlo.");
        },
        //timeout: 30000
    });
}

function selectManagement() {
    // console.log( $('#management-selector')[0].value );

    $('#block-selector').empty();

    let display_blocks = []

    for(let i=0 ; i<groups.length ; i++) {
        if( groups[i].management_id+"" == $('#management-selector')[0].value && !display_blocks.includes(groups[i].block_id) ) {
            $('#block-selector').append(
                `<option class="optional" value="${groups[i].block_id}"> ${ groups[i].block_name } ( ${ groups[i].subject.name } )</option>`
            );
            display_blocks.push(groups[i].block_id);
        }
    }
}