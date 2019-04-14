$(document).ready(function(){
    $("#subjects").change(function(event){
        $.get("getGroups/"+event.target.value+"", function(response, subjects){
            $("#groups_container").empty();
            $('#group_id1').empty();
            $('#group_id1').append("<input type='text' name='name' class='col-md-12 form-control-plaintext' value='Grupo "+(response + 1)+"' readonly>");
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