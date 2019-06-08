var sesion_id = undefined;

$(document).ready(function(){
    $('#formActivity').hide();
    $('#btnsTasks').hide();
    $('#btnsEditTasks').hide();
});

function showSesion(sesion){
    hideFormActivity();
    sesion_id = sesion.id;
    $('#sesionTitle')[0].innerHTML = "Guía Práctica de la <strong> sesión " + sesion.number_sesion + "</strong>";
}

function showFormActivity(){
    $('#btnAddActivity').hide();
    $('#formActivity').show();
    $('#btnsTasks').show();
    $('#sesionTasks').hide();

    $('#sesion_id')[0].value = sesion_id;
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
        success: function (response){
            var i = 1;
            response.forEach(function(element){
                $('#sesionTasks').append(
                    "<div class='accordion-body bg-gray-300 rounded row my-2' id='task"+i+"' style='cursor: default;'> <div class='container d-flex justify-content-between p-1' style=''> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong> Título:&nbsp;</strong>"+element.title+" </div> <div class='d-flex justify-content-end'> <a href='#' id='btn-edit-task-"+i+"' class='mx-2' data-toggle-2='tooltip' title='Editar' onclick='editTask("+JSON.stringify(element)+")'><i class='fas fa-edit'></i></a> <a href='#' id='btn-delete-task-"+i+"' class='mx-2' data-toggle-2='tooltip' title='Eliminar' onclick='deleteTask("+i+","+element.id+")'><i class='fas fa-trash'></i></a> </div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div class='d-flex justify-content-start' style='padding-left: 3px;'> <strong> Última modificación:&nbsp; </strong> <div id=''>"+element.published_by+"</div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div style=''> <strong> Descripción:&nbsp; </strong> <div id=''>"+element.description+"</div> </div> <div class='' style='margin-top: 15px; margin-bottom: -10px;'> Archivo adjunto: <a href='"+element.task_path+element.task_file+"' target='_blank'>"+element.task_file+"</a> </div> </div> </div>"
                );
                i++;
            });
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });
    
}

function storeTask(){
    var formData = new FormData($('#taskForm')[0]);

    $.ajax({
        url : 'http://localhost:8000/professor/sesions/tasks/store',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
            console.log(response);
            hideFormActivity();
            $('#sesionTasks').append(
                "<div class='accordion-body bg-gray-300 rounded row my-2' style='cursor: default;'> <div class='container d-flex justify-content-between p-1' style=''> <div class='d-flex justify-content-start'> <strong> Título:&nbsp;</strong>"+response.title+" </div> <div class='d-flex justify-content-end'> <a href='#' class='mx-2' onclick='editTask("+response.id+")' data-toggle-2='tooltip' title='Editar actividad' data-toggle='modal' data-target='.bd-example-modal-lg' onclick=''><i class='fas fa-edit'></i></a> </div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div style=''> <strong> Descripción:&nbsp; </strong> <div id=''>"+response.description+"</div> </div> <div class='' style='margin-top: 15px;'> Archivo adjunto: <a href='"+response.task_path+response.task_file+"' target='_blank'>"+response.task_file+"</a> </div> </div> </div>"
            );
        },
        error: function() {
            console.log("Algo salió mal");
        }
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
        //headers: { "X-CSRF-TOKEN": token },
        success: function (response){
            $('#task'+id_dom_task).remove();
            $('#confirm-delete-task'+id_dom_task).remove();
        },
        error: function() {
            console.log("No se pudo realizar la operación");
        }
    });
}

function cancelDelete(id_dom_task){
    $('#confirm-delete-task'+id_dom_task).remove();
    $('#btn-edit-task-'+id_dom_task).show();
    $('#btn-delete-task-'+id_dom_task).show();
}

function editTask(task){
    showFormActivity();
    $('#btnsTasks').hide();
    $('#btnsEditTasks').show();
    $('#title')[0].value = task.title;
    $('#description')[0].value = task.description;
    $('#sesion_id')[0].value = task.sesion_id;
    $('#task_id')[0].value = task.id;
}

function storeEditedTask(){
    var formData = new FormData($('#taskForm')[0]);
    $.ajax({
        url : 'http://localhost:8000/professor/sesions/tasks/edit',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
            console.log("editando: " + response.title);
            //hideFormActivity();
            //$('#sesionTasks').append(
            //    "<div class='accordion-body bg-gray-300 rounded row my-2' style='cursor: default;'> <div class='container d-flex justify-content-between p-1' style=''> <div class='d-flex justify-content-start'> <strong> Título:&nbsp;</strong>"+response.title+" </div> <div class='d-flex justify-content-end'> <a href='#' class='mx-2' onclick='editTask("+response.id+")' data-toggle-2='tooltip' title='Editar actividad' data-toggle='modal' data-target='.bd-example-modal-lg' onclick=''><i class='fas fa-edit'></i></a> </div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div style=''> <strong> Descripción:&nbsp; </strong> <div id=''>"+response.description+"</div> </div> <div class='' style='margin-top: 15px;'> Archivo adjunto: <a href='"+response.task_path+response.task_file+"' target='_blank'>"+response.task_file+"</a> </div> </div> </div>"
            //);
        },
        error: function() {
            console.log("Algo salió mal");
        }
    });

    hideFormActivity();
}