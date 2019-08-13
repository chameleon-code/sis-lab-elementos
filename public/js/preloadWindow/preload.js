$(document).ready(function() {
    $("#overlay").fadeOut();
});
$(document).on('submit','form.user',function(){
    $("#overlay").fadeIn("slow");    
});