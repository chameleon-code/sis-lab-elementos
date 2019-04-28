$(document).ready(function(){
    var array = new Array();
            $.get("getGroupsId", function(response, subjects){
                for(i=0; i<response.length; i++){
                    array[i] = response[i];
                }
            });            
    $("#subjects").change(function(event){
        $.get("getGroups/"+event.target.value+"", function(response, subjects){
            $("#groups_container").empty();
            $('#groups_container').append(
                "<select class='form-control col-md-12' name='groups_id[]' id='group_id1'></select>"
            );
            var subjectID = $("#subjects :selected").attr("value");
            $.get("getGroups/"+subjectID+"", function(response, subjects){
                if(response.length > 0){
                    for(i=0; i<response.length; i++){
                        if( !array.includes(response[i].id)){
                            $('#group_id1').append("<option value='"+response[i].id+"'>"+response[i].name +" - "+ response[i].professor.names +" "+ response[i].professor.first_name+" "+ response[i].professor.second_name+"</option>");
                        }
                    }
                }
                else{
                    $('#group_id1').append("<option value=''>No existen grupos para la materia seleccionada</option>");
                }

            });
        })
    });
    /*$("#subjects").change(function(event){
        $.get("getProfessors/"+event.target.value+"", function(response, subjects){
            $('#professor_id').empty();
            for(i=0; i<response.length; i++){
                console.log(response[i]);
                $('#professor_id').append("<option value='"+response[i].id+"'>"+response[i].names +" "+ response[i].first_name +" "+ response[i].second_name+"</option>");
            }
        })
    });*/
});