$(document).ready(function(){
    $('#subjects').change(function(event) {
        $.get("getGroupsName/"+event.target.value+"", function(response, subjects){
            $('#name').empty();
                for(let i = 1; i<=15; i++){                    
                    if(response.indexOf(i) == -1){
                        $('#name').append('<option class="form-control" value="'+i+'">'+ i +'</option>');
                    }
                }
        });
    });
});