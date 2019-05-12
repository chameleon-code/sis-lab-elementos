$(document).ready(function(){
    $('#subjects').change(function(event) {
        $('#blocks').empty();
        $.get("registration/getBlocksBySubjects/"+event.target.value+"", function(response, subjects){
            for(i=0; i<response.length; i++){
                $('#blocks').append("<option value='"+response[i].id+"'>"+response[i].name +"</option>");
            }
        });
    });
});