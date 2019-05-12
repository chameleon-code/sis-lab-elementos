$(document).ready(function(){
    $('#subjects').change(function(event) {
        $.get("getGroupsName/"+event.target.value+"", function(response, subjects){
            $('#name').empty();
            console.log('Response: '+response);
                for(let i = 1; i<10; i++){                    
                    if(response.indexOf(i+"") == -1){
                        $('#name').append('<option class="form-control" value="Grupo '+i+'">'+ i +'</option>');
                    }
                }
        });
    });
});