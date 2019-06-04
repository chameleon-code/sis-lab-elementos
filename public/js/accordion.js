function showAccordion(id){

  console.log(id);

  //var acc = document.getElementsByClassName("accordion-body");
  //var i;

  var panel = $('#panel'+id);

  if($('#arrowAccordion'+id)[0].innerHTML == "˅")
  {
    $('#arrowAccordion'+id)[0].innerHTML = "&#707;";
    console.log("ocultando accordion");
    panel.hide();
  } else if($('#arrowAccordion'+id)[0].innerHTML == "˃") {
    $('#arrowAccordion'+id)[0].innerHTML = "&#709;";

    // for (i = 0; i < acc.length; i++) {
    //   acc[i].addEventListener("click", function() {
    //     this.classList.toggle("active");
    //     var panel = this.nextElementSibling;
    //     if (panel.style.maxHeight){
    //       panel.style.maxHeight = null;
    //     } else {
    //       panel.style.maxHeight = panel.scrollHeight + "px";
    //     } 
    //   });
    // }
    panel.show();

    console.log("mostrando accordion");
  }
}