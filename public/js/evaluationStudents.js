function addScore(id){
    $('#student_task_id')[0].value = id;
}

function storeScore(){
    var formData = new FormData($('#form-score')[0]);
    console.log($('#student_task_id')[0].value);
    var student_task_id = ('#student_task_id')[0].value;
    var task_score = $('#task_score')[0].value;
    // console.log($("#form-score").serialize());
    $.ajax({
        url : 'http://localhost:8000/professor/sesions/tasks/store/score',
        type: 'POST',
        headers: {
            'x-csrf-token': $("meta[name=csrf-token]").attr('content')
        },
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
            console.log("se guardó: " + response);
            //$('#score-task-number-'+response.id).empty();
            $('#score-task-number-'+response.id)[0].innerHTML = response.score;
        },
        error: function(){

        }
    });
}