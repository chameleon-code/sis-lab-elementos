$(document).ready(function() {
    var iCnt = 1;
    var container = document.getElementById('groups_container');
    $('#addGroups').click(function() {
        var subjectID = $("#subjects :selected").attr("value");
        console.log($("#subjects :selected").attr("value"));
        if (iCnt <= 5) {                        
            iCnt = iCnt + 1;
            $(container).append(
                '</br><select class="form-control col-md-12" name="groups_id[]" id="group_id'+iCnt+'"></select>'
            );
            $.get("getGroups/"+subjectID+"", function(response, subjects){
                console.log(response);
                var gpID = 'group_id' + iCnt;
                for(i=0; i<response.length; i++){
                    console.log('Saludos');
                    $('#'+gpID).append("<option value='"+response[i].id+"'>"+response[i].name +" - "+ response[i].professor.names +" "+ response[i].professor.first_name+" "+ response[i].professor.second_name+"</option>");
                }
            });
        }
    });
    $('#removeGroup').click(function(){
        $('#group_id'+iCnt).remove();
        $('#groups_container br').remove();
        iCnt--;
    });
});