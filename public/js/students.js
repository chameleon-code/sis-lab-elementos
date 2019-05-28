function setGroups(item) {
    item.forEach(function(element){
        $('#groups').append("<option value='"+element.id+"'>"+element.name +" - "+ element.professor.names +" "+ element.professor.first_name+" "+ element.professor.second_name+"</option>");
    });
}
$(document).ready(function(){
    var rmv = true;
    document.getElementById('groups_ids').style.visibility = 'hidden';
    $('#subjects').change(function(event) {
        if(rmv){
            $(this).find('option').get(0).remove();
            rmv = false;
        }
        document.getElementById('groups_ids').style.visibility = 'visible';
        $('#groups').empty(); 
        $.ajax({
            url : 'http://127.0.0.1:8000/students/registration/getBlocksBySubjects/'+event.target.value+'',
            success: function (response){
                if(response.length == 0)
                    $('#groups').append("<option value=''> No existen grupos disponibles para la materia seleccionada </option>");
                else{                
                    for(i=0; i<response.length; i++){
                        setGroups(response[i].groups);
                    }
                    $('#block_id').attr('value',response[0].id);
                    }
                }
            });
        });
    $('#groups').change(function(event) {
        $.get('getGroup/'+event.target.value+'', function(response, groups){
            console.log(response);
            $('#block_id').attr('value',response.id);
        })
    });
});

