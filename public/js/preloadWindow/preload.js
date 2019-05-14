$(document).ready(function() {
    $(".loader").fadeOut();
});
$(document).on('submit','form.user',function(){
    $(".loader").fadeIn("slow");    
});