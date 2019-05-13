$(document).ready(function(){
    var iCnt = 1;
    var container = document.getElementById('groups_container');
    $("#subjects").change(function(event){
        iCnt = 1;
        $.get("getGroups/"+event.target.value+"", function(response, subjects){
            $("#groups_container").empty();
            $('#groups_container').append(
                "<select class='form-control col-md-12' name='groups_id[]' id='group_id1'></select>"
            );
            var subjectID = $("#subjects :selected").attr("value");
            $.get("getGroups/"+subjectID+"", function(response, subjects){
                if(response.length > 0){
                    for(i=0; i<response.length; i++){
                            $('#group_id1').append("<option value='"+response[i].id+"'>"+response[i].name +" - "+ response[i].professor.names +" "+ response[i].professor.first_name+" "+ response[i].professor.second_name+"</option>");
                        }
                }
                else{
                    $('#group_id1').append("<option value=''>No existen grupos para la materia seleccionada</option>");
                }

            });
        })
    });
    $('#addGroups').click(function() {
        var subjectID = $("#subjects :selected").attr("value");
        $.get("getGroups/"+subjectID+"", function(response, subjects){
            if (iCnt < response.length) {                            
            iCnt = iCnt + 1;  
            $(container).append(
                '<div id="divgroup'+iCnt+'" ></br><select class="form-control col-md-12" name="groups_id[]" id="group_id'+iCnt+'"></select></div>'
            );                
            var gpID = 'group_id' + iCnt;
            for(i=0; i<response.length; i++){
                $('#'+gpID).append("<option value='"+response[i].id+"'>"+response[i].name +" - "+ response[i].professor.names +" "+ response[i].professor.first_name+" "+ response[i].professor.second_name+"</option>");
            }
        }
        });
    });
    $('#removeGroup').click(function(){
        if(iCnt > 1){
            $('#divgroup'+iCnt).remove();
            iCnt--;
        }
    });
});