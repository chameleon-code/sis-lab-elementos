$(document).ready(function() {
    var iCnt = 1;
    var container = document.getElementById('groups_container');
    var array = new Array();
            $.get("getGroupsId", function(response, subjects){
                for(i=0; i<response.length; i++){
                    array[i] = response[i];
                }
            });   
    $('#addGroups').click(function() {
        var subjectID = $("#subjects :selected").attr("value");
        if (iCnt <= 5) {                        
            iCnt = iCnt + 1;
            $(container).append(
                '<div id="divgroup'+iCnt+'" ></br><select class="form-control col-md-12" name="groups_id[]" id="group_id'+iCnt+'"></select></div>'
            );
            $.get("getGroups/"+subjectID+"", function(response, subjects){
                var gpID = 'group_id' + iCnt;
                for(i=0; i<response.length; i++){
                    if( !array.includes(response[i].id)){
                        $('#'+gpID).append("<option value='"+response[i].id+"'>"+response[i].name +" - "+ response[i].professor.names +" "+ response[i].professor.first_name+" "+ response[i].professor.second_name+"</option>");
                    }
                }
            });
        }
    });
    $('#removeGroup').click(function(){
        if(iCnt > 1){
            $('#divgroup'+iCnt).remove();
            iCnt--;
        }
    });
});