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
                    "<div class='accordion-body bg-gray-300 rounded row my-2' style='cursor: default;'> <div class='container d-flex justify-content-between p-1' style=''> <div class='d-flex justify-content-start'> <strong> Título:&nbsp;</strong>"+element.title+" </div> <div class='d-flex justify-content-end'> <a href='#' class='mx-2' onclick='' data-toggle-2='tooltip' title='Editar actividad' data-toggle='modal' data-target='.bd-example-modal-lg' onclick=''><i class='fas fa-edit'></i></a> </div> </div> <div class='my-2 mx-1' style='font-size: 15px;'> <div style=''> <strong> Descripción:&nbsp; </strong> <div id=''>"+element.description+"</div> </div> <div class='' style='margin-top: 15px;'> Archivo adjunto: <a href='https://www.google.com'>Ejercicio 2.pdf</a> </div> </div> </div>"
                );
            });
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });
    
}

function storeTask(){
    $.ajax({
        url : 'http://localhost:8000/professor/sesions/tasks/store',
        type: 'POST',
        headers: {
            'x-csrf-token': $("meta[name=csrf-token]").attr('content')
        },
        data: {
            info: $("#taskForm").serialize()
        },
        success: (res) => {
            if(res.res) {
               Swal.fire(
                    'Tarea guardada con exito!',
                    '---------',
                    'success'
                ).then((result) => {
                    updateEvents();
                })
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Algo salio mal...',
                    text: 'No se pudo guardar la informacion, vuelve a intentarlo',
                  })
            }
        }
    });

    console.log($("#taskForm").serialize());
}