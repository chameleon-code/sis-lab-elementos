var actualCheck = undefined;
var actualId = undefined;

function registrationMessage(item){
    $("#enable-content").empty(); $("#enable-content").hide();
    $("#disable-content").empty(); $("#disable-content").hide();
    actualCheck = "#checkbox-" + item.id;
    actualId = item.id;
    if($("#checkbox-"+item.id)[0].checked == 1){
        $("#enable-content").append(" Se habilitarán las inscripciones para la gestión <strong>"+item.semester+"-"+item.managements+".</strong> ");
        $("#enable-content").show();
        $("#checkbox-"+item.id)[0].checked = 0;
    } else {
        $("#disable-content").append(" Se deshabilitarán las inscripciones para la gestión <strong>"+item.semester+"-"+item.managements+".</strong> ");
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
    console.log("habilitando inscripción para: " + actualId);
}

function disableRegistration(){
    console.log("deshabilitando inscripción para: " + actualId);
}