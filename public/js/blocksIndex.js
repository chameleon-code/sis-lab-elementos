var actualCheck = undefined;
var actualId = undefined;

function registrationMessage(item){
    $("#enable-content").empty(); $("#enable-content").hide();
    $("#disable-content").empty(); $("#disable-content").hide();
    actualCheck = "#checkbox-" + item.id;
    actualId = item.id;
    if($("#checkbox-"+item.id)[0].checked == 1){
        $("#enable-content").append(`Se habilitara el bloque ${item.name} para la gestion en curso`);
        $("#enable-content").show();
        $("#checkbox-"+item.id)[0].checked = 0;
    } else {
        $("#disable-content").append(`Se deshabilitara el bloque ${item.name} para la gestion en curso`);
        $("#disable-content").show();
        $("#checkbox-"+item.id)[0].checked = 1;
    }
}

function enableOrDisableCheck(){
    if($(actualCheck)[0].checked == 0){
        $(actualCheck)[0].checked = 1;
        enableRegistration();
    } else {
        $(actualCheck)[0].checked = 0;
        disableRegistration();
    }
}

function enableRegistration(){
    $.ajax({
        url : '/admin/blocks/setStatus/'+actualId+'/1',
        success: function (response){
            
        },
        error: function(){
            console.log("Ha ocurrido un error");
        }
    });
}

function disableRegistration(){
    $.ajax({
        url : '/admin/blocks/setStatus/'+actualId+'/0',
        success: function (response){
            
        },
        error: function(){
            console.log("Ha ocurrido un error");
        }
    });
}