$(document).ready(function(){
    $('#formActivity').hide();
    $('#btnsTasks').hide();
});

function showSesion(number){
    $('#sesionTitle')[0].innerHTML = "Guía Práctica de la <strong> sesión " + number + "</strong>";
}

function showFormActivity(){
    $('#btnAddActivity').hide();
    $('#formActivity').show();
    $('#btnsTasks').show();
    $('#sesionTasks').hide();

    //form
}

function hideFormActivity(){
    $('#btnAddActivity').show();
    $('#formActivity').hide();
    $('#sesionTasks').show();
    $('#btnsTasks').hide();
}

function loadPractice(sesion_id){
    console.log(sesion_id);

    $('#sesionTasks').empty();  
    // $('#group_id_input')[0].value = id;
        
    $.ajax({
        url : '/professor/sesion/'+sesion_id+'/tasks',
        success: function (response){
            response.forEach(function(element){
                console.log(element.description);
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