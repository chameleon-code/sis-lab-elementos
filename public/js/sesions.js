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
}

function hideFormActivity(){
    $('#btnAddActivity').show();
    $('#formActivity').hide();
    $('#sesionTasks').show();
    $('#btnsTasks').hide();
}