function loadStudentList(){
    console.log($('#select-labs')[0].value);

    $.ajax({
        url : 'http://localhost:8000/auxiliar/getStudentList/'+$('#select-labs')[0].value,
        success: function (response){
            console.log(response);

            // $.ajax({
            //     url : "http://localhsot:8000/auxiliar/",
            //     success: function (response) {

            //     },
            //     error: function() {

            //     }
            // });





        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });
}
