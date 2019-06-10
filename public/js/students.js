// function setGroups(item) {
//     item.forEach(function(element){
//         $('#groups').append("<option value='"+element.id+"'>"+element.name +" - "+ element.professor.names +" "+ element.professor.first_name+" "+ element.professor.second_name+"</option>");
//     });
// }
// $(document).ready(function(){
//     var rmv = true;
//     document.getElementById('groups_ids').style.visibility = 'hidden';
//     $('#subjects').change(function(event) {
//         if(rmv){
//             $(this).find('option').get(0).remove();
//             rmv = false;
//         }
//         document.getElementById('groups_ids').style.visibility = 'visible';
//         $('#groups').empty(); 
//         $.ajax({
//             url : 'http://127.0.0.1:8000/students/registration/getBlocksBySubjects/'+event.target.value+'',
//             success: function (response){
//                 if(response.length == 0)
//                     $('#groups').append("<option value=''> No existen grupos disponibles para la materia seleccionada </option>");
//                 else{                
//                     for(i=0; i<response.length; i++){
//                         setGroups(response[i].groups);
//                     }
//                     $('#block_id').attr('value',response[0].id);
//                     }
//                 }
//             });
//         });
//     $('#groups').change(function(event) {
//         $.get('getGroup/'+event.target.value+'', function(response, groups){
//             console.log(response);
//             $('#block_id').attr('value',response.id);
//         })
//     });
// });

var schedule_id;
var subject_matters_ids = new Array();

function addSubjectMatterId(id){
    subject_matters_ids.push(id);
}

$(document).ready(function(){
    $('#info-inscription').hide();
    $('#modal-footer').hide();

    $.ajax({
        url : 'http://localhost:8000/students/registration/getScheduleStudent',
        success: function (response){
            if(Object.keys(response).length != 0){
                for(var i=1 ; i<=subject_matters_ids.length ; i++){
                    for(var j=0 ; j<Object.keys(response).length ; j++){
                        if(subject_matters_ids[i-1] == response[j].subject_matter_id){
                            $('#subject-matter-'+i).append(
                                "<br><strong class='text-primary' style='margin-top: 10px;'>Se encuentra inscrito en esta materia.</strong>"
                            );
                        }
                    }
                }
            }
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });
});

function clearSelects(id){
    var selects;
    var id_select = 1;
    while($('#group_'+id_select)[0]){
        if(id != id_select){
            var select = $('#group_'+id_select)[0];
            select[0].selected = true;
        }
        id_select++;
    }
}

function infReg(item, id){
    $('#body-table').empty();
    $('#group_id_input')[0].value = id;
    var select = $('#group_' + id)[0];
    if(select.options[select.selectedIndex].text !== "grupo"){
        $.ajax({
            url : 'http://localhost:8000/students/registration/getGroupSchedules/'+select.value,
            success: function (response){
                console.log(response);
                var cont = 1;
                response.forEach(function(element){
                    var day;
                    switch (element.day_id){
                        case 1:
                            day = 'Lunes';
                            break;
                        case 2:
                            day = 'Martes';
                            break;
                        case 3:
                            day = 'Miércoles';
                            break;
                        case 4:
                            day = 'Jueves';
                            break;
                        case 5:
                            day = 'Viernes';
                            break;
                        case 6:
                            day = 'Sábado';
                            break;
                    }

                    var hour;
                    switch (element.hour_id){
                        case 1:
                            hour = '06:45 - 08:15';
                            break;
                        case 2:
                            hour = '08:15 - 09:45';
                            break;
                        case 3:
                            hour = '09:45 - 11:15';
                            break;
                        case 4:
                            hour = '11:15 - 12:45';
                            break;
                        case 5:
                            hour = '12:45 - 14:15';
                            break;
                        case 6:
                            hour = '14:15 - 15:45';
                            break;
                        case 7:
                            hour = '15:45 - 17:15';
                            break;
                        case 8:
                            hour = '17:15 - 18:45';
                            break;
                        case 9:
                            hour = '18:45 - 20:15';
                            break;
                        case 10:
                            hour = '20:15 - 21:45';
                            break;
                    }

                    $('#body-table').append(
                        " <tr class='text-center'><td>"+element.laboratory_id+"</td><td>"+day+"</td><td>"+hour+"</td><td><div class='custom-control custom-checkbox small'><input type='checkbox' class='custom-control-input' id='Check"+cont+"' onclick='clearChecks("+response.length+", "+cont+", "+element.schedule_record_id+", "+element.block_schedule_id+")'><label class='custom-control-label' for='Check"+cont+"'></label></div></td></tr> "
                    );
                    cont++;
                });
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });

        $('#text_select_group')[0].setAttribute("style", "display: none;");
        $('#text_confirm_reg')[0].setAttribute("style", "");
        $('#btn_cancel')[0].setAttribute("style", "");
        $('#btn_confirm')[0].setAttribute("style", "");
        $('#subjectMatter_selected')[0].innerHTML = item.name;
        $('#group_selected')[0].innerHTML = select.options[select.selectedIndex].text;
        $('#group_id_input')[0].value = select.value;
    } else {
        $('#text_confirm_reg')[0].setAttribute("style", "display: none;");
        $('#btn_cancel')[0].setAttribute("style", "display: none;");
        $('#btn_confirm')[0].setAttribute("style", "display: none;");
        $('#text_select_group')[0].setAttribute("style", "");
    }
}

function clearChecks(longChecks, idCheck, schedule_record_id, block_schedule_id){
    if($('#Check'+idCheck)[0].checked == 1){
        $('#block_schedule_id')[0].value = block_schedule_id;
        schedule_id = schedule_record_id;
        for(var i=1 ; i<= longChecks; i++){
            if(i != idCheck){
                $('#Check'+i)[0].checked = 0;
            }
        }
    } else {
        schedule_id = undefined;
        $('#block_schedule_id')[0].value = null;
    }
    console.log(schedule_id);
    if(schedule_id != undefined){
        $('#info-inscription').show();
        $('#modal-footer').show();
    }else{
        $('#info-inscription').hide();
        $('#modal-footer').hide();
    }
}