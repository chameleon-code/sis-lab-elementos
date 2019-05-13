function setGroups(item) {
    console.log(item);
    //$('#groups').empty();
    item.forEach(function(element){
        $('#groups').append("<option value='"+element.id+"'>"+element.name +" - "+ element.professor.names +" "+ element.professor.first_name+" "+ element.professor.second_name+"</option>");
    });
}
$(document).ready(function(){
    $('#subjects').change(function(event) {
        $('#blocks').empty();
        $('#groups').empty();
        $.get("registration/getBlocksBySubjects/"+event.target.value+"", function(response, subjects){
            for(i=0; i<response.length; i++){
                $('#blocks').append("<option value='"+response[i].id+"'>"+response[i].name +"</option>");
            }
            setGroups(response[0].groups);
        });

    });
    $('#blocks').change(function(event) {
        $('#groups').empty();
        $.get("registration/getGroups/"+event.target.value+"", function(response, subjects){
            setGroups(response);
        });
    });
});

