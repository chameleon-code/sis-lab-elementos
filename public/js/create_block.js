var actual_groups = [];
var count_group_selects = 1;

$(document).ready(function(){

    var container = document.getElementById('groups_container');

    $('#addGroups').click(function() {

        if( count_group_selects < actual_groups.length ) {
            count_group_selects++;
            $(container).append(
                '<div id="divgroup'+count_group_selects+'" ></br><select class="form-control col-md-12" name="groups_id[]" id="group_id'+count_group_selects+'"></select></div>'
            );
            var gpID = 'group_id' + count_group_selects;
            for(let i=0 ; i<actual_groups.length ; i++){
                let selected = "";
                if( count_group_selects == i+1 ) {
                    selected = "selected"
                }
                $('#'+gpID).append("<option value='"+actual_groups[i].id+"' "+selected+">"+actual_groups[i].name +" - "+ actual_groups[i].professor.names +" "+ actual_groups[i].professor.first_name+" "+ actual_groups[i].professor.second_name+"</option>");
            }
        }

    });

    $('#removeGroup').click(function(){
        if( count_group_selects > 1 ) {
            $('#divgroup'+count_group_selects).remove();
            count_group_selects--;
        }
    });

    if ( $('#group_id1 > option').length < 1 ) {
        $('#group_id1').append("<option value=''> Grupos no disponibles o asignados a otro bloque. </option>");
    }
});

function loadGroups() {

    $("#groups_container").empty();
    $('#groups_container').append(
        "<select class='form-control col-md-12' name='groups_id[]' id='group_id1'></select>"
    );
    actual_groups = [];

    if(groups.length > 0){
        for(let i=0 ; i<groups.length ; i++){
            registered = false;
            for(let j=0 ; j<block_groups.length ; j++) {
                if( block_groups[j].group_id == groups[i].id && block_groups[j].management_id+"" == $('#managements')[0].value ) {
                    registered = true;
                }
            }
            if( groups[i].subject.id+"" == $('#subjects')[0].value && !registered ) {
                $('#group_id1').append("<option value='"+groups[i].id+"'>"+groups[i].name +" - "+ groups[i].professor.names +" "+ groups[i].professor.first_name+" "+ groups[i].professor.second_name+"</option>");
                actual_groups.push( groups[i] );
            }
        }
    }

    if ( $('#group_id1 > option').length < 1 ) {
        $('#group_id1').append("<option value=''> Grupos no disponibles o asignados a otro bloque. </option>");
    }
    count_group_selects = 1;
};