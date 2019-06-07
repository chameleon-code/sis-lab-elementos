var sesion_id = undefined;

$(document).ready(function(){
    $('#formActivity').hide();
    $('#btnsTasks').hide();
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
}

function loadPractice(sesion_id){
    $('#sesionTasks').empty();  
    // $('#group_id_input')[0].value = id;
        
    $.ajax({
        url : '/professor/sesion/'+sesion_id+'/tasks',
        success: function (response){
            response.forEach(function(element){
                $('#sesionTasks').append(
                    "<div class='accordion-body bg-gray-300 rounded row my-2' style='cursor: default;'> <div class='container d-flex justify-content-between p-1' style=''> <div class='d-flex justify-content-start'> <strong> Título:&nbsp;</strong>"+element.title+" </div> <div class='d-flex justify-content-end'> <a href='#' class='mx-2' onclick='' data-toggle-2='tooltip' title='Editar actividad' data-toggle='modal' data-target='.bd-example-modal-lg' onclick=''><i class='fas fa-edit'></i></a> </div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div style=''> <strong> Descripción:&nbsp; </strong> <div id=''>"+element.description+"</div> </div> <div class='' style='margin-top: 15px;'> Archivo adjunto: <a href='"+element.task_path+element.task_file+"' target='_blank'>"+element.task_file+"</a> </div> </div> </div>"
                );
            });
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });
    
}

function storeTask(){
    // var file = $('#practice').prop('files');
    // var title = $('#title').val();
    // var description = $('#description').val();
    // var sesion_id = $('#sesion_id').val();

    var formData = new FormData($('#taskForm')[0]);
    //formData.append('practice', $('#practice')[0].files[0]);

    //var token = $("#token").val();

    // var data = {
    //     'file': file,
    //     'title': title,
    //     'description': description,
    //     'sesion_id': sesion_id
    // };
    console.log(formData);

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
                "<div class='accordion-body bg-gray-300 rounded row my-2' style='cursor: default;'> <div class='container d-flex justify-content-between p-1' style=''> <div class='d-flex justify-content-start'> <strong> Título:&nbsp;</strong>"+response.title+" </div> <div class='d-flex justify-content-end'> <a href='#' class='mx-2' onclick='' data-toggle-2='tooltip' title='Editar actividad' data-toggle='modal' data-target='.bd-example-modal-lg' onclick=''><i class='fas fa-edit'></i></a> </div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div style=''> <strong> Descripción:&nbsp; </strong> <div id=''>"+response.description+"</div> </div> <div class='' style='margin-top: 15px;'> Archivo adjunto: <a href='"+response.task_path+response.task_file+"' target='_blank'>"+response.task_file+"</a> </div> </div> </div>"
            );
        },
        error: function() {
            console.log("Algo salió mal");
        }
    });
}