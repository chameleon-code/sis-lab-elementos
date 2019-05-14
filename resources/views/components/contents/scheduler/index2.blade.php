@extends('components.sections.adminSection')
@section('userContent')
<style>
@import url('/vendor/horarios/css/bootstrap-datetimepicker.css');
@import url('/vendor/horarios/css/font-awesome.min.css');
/* @import url('/vendor/horarios/css/bootstrap.min.css');
@import url('/vendor/horarios/css/animate.css'); */
    body{
	font-family: 'Maven Pro', sans-serif;
    background: url(images/bg.jpg) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;    
}
a{
	-moz-transition: all .2s ease-in;
    -o-transition: all .2s ease-in;
    -webkit-transition: all .2s ease-in;
    transition: all .2s ease-in;
    border: 1px solid #777;
    color: #777;
}
a:hover{
    color: #777;
}
button{
	-moz-transition: all .2s ease-in;
    -o-transition: all .2s ease-in;
    -webkit-transition: all .2s ease-in;
    transition: all .2s ease-in;
}
label {
	float: left;
    margin-top: 2px;
    margin-bottom: 0px;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px 3px 8px 3px;
}
.bootstrap-datetimepicker-widget a[data-action] {
    border: none;
}
.modal-backdrop {
    background-color: #AD0000;
}
.modal-content{
    float: left;
    width: 100%;	
}
.modal-header {
    background: #0A961A;
    color: #FFF;
    float: left;
    width: 100%;
}
.modal-body {
    float: left;
    width: 100%;
}
.modal-footer {
    float: left;
    width: 100%;
}
#menu{
    margin-top: 30px;
}
#days-chose{
	display: none;
}
#days-list{
    margin-top: 10px;
    margin-bottom: 5px;	
}
#days-list .day-option{
    display: inline-block;
    width: 13.5%;
    text-align: center;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    padding: 2px 0px 3px 0px;
}
.active-day,.active-day:hover,.active-day:focus,.active-day:active{
    border: 1px solid #EC901D;
    background: #EC901D;
    color: #fff;	
}
.error{
    float: left;
    width: 100%;
    color: #F50000;	
}
#mynew{
    margin-top: 30px;
    width: 100%;
    float: left;
    display: none;    
}
.td-time{
    width: 230px;
    text-align: center;    
}
.table-bordered {
    background: #FFF;
}
#alert-error{
    color: #fff;
    background: #C31313;
    position: absolute;
    font-size: 18px;
    border-radius: 4px;
    text-align: center;
    padding: 5px 15px;
    bottom: 15px;
    right: 15px;
    display: none;
    z-index: 9999999;  
}
#mynew .btn-group-xs>.btn, .btn-xs {
    padding: 0px 3px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 0px;
    margin: 5px auto;
}
.nopadding{
    padding: 0px;
}


.opacityelement{
    opacity: 0.5;
}
.addinfo{
    display: none;
}
.delinfo{
    display: none;
}
.label-desc{
    text-align: center;
    width: 100%;
    display: block;
    padding-top: 5px;
    padding-bottom: 5px;
    border-radius: 4px;
    color: #fff;
    font-weight: 100;
    font-size: 12px;  
}
.label-desc a{
    color: #FFF;
    float: right;
    margin-right: 5px;
    cursor: pointer; 
    border: none;
    display: none;   
}
.label-desc:hover a{
    display: block;
}
.horario-name{
    color: #FFF;
}
.purple-label{
   background: #8452D4;
   color: #FFF;
}
.red-label{
   background: #D45252;
   color: #FFF; 
}
.blue-label{
  background: #52B6D4;
  color: #FFF;    
}
.pink-label{
  background: #D659AA;
  color: #FFF;    
}
.green-label{
    background: #46BD28;
    color: #FFF;   
}
.horarioheader{
    color: #FFF;
    background: #5cb85c;    
}
.thead{
    font-size: 16px;
    background: #000;
    color: #FFF;
}
.td-time{
    background: #ffffff;
    color: #3392b7;
    font-size: 16px;
}
.hideedittime{
    display: none;
}
.td-line{
    width: 111px;
}
.panel{
    float: left;
    width: 100%;
}
.panel-body{
    float: left;
    width: 100%;
}
.panel-heading{
    float: left;
    width: 100%;
}
.panel-info>.panel-heading {
    color: #FFF;
    background-color: #31708f;
    border-color: #31708f;
}
.icon-clock-index{
    color: rgb(255, 255, 255);
    font-size: 7em;
    margin-top: 185px;
}
.modal-lg {
    width: 99%;
    margin-left: 0px;
}
#modalblue{
    background: #257dc7;
}
.changethetime{
    display: none;
}
.td-time:hover .changethetime{
    display: inline-block;
}
</style>
<script>
    // funcion no valid
function novalid(){
    $('#alert-error').addClass('animated bounce').fadeIn(500);
    setTimeout(function(){$('#alert-error').removeClass('animated bounce').fadeOut(500);},1500);
}


$(document).ready(function() {
  $(window).load(function() {
//=============================================================================


$('#time1').datetimepicker({
  format:'LT'
});

$('#time2').datetimepicker({
  format:'LT'
});

$('#days-list a').on('click', function(){
     var dias = $(this).attr('data-day');
     var dataset = $('#days-chose');
     var addday = dataset.val();
     var removeday = dataset.val().replace(dias+',', '');
     var dum = $(this); 
     if (dum.hasClass('active-day')){
         dum.removeClass('active-day');
         dataset.val(removeday);
         dataset.click();
     }else{
         dum.addClass('active-day');
         dataset.val(addday+dias+',');
         dataset.click();
     }
});


$('.cancel-new').on('click', function(){
      var dum = $('#days-list a');
      var chose = $('#days-chose');
      dum.removeClass('active-day');
      chose.val('');
      $('#horariofrm')[0].reset();

});




$('.create-horario').on('click', function(){
jQuery.validator.setDefaults({
  debug: true,
  success: "valid",
  ignore: []
});
var horariofrm = $('#horariofrm');
horariofrm.validate({
  rules: {
    nombre: "required",
    days: "required",
    descripcion: "required",
    tiempo1: "required",
    tiempo2: "required",
    minutos: "required"
  }
});
var dado = horariofrm.valid();
if (dado == true){

      var getdatos = horariofrm.serialize();
      var sender = 'process=1&'+getdatos;
      

      $.ajax({

         type: 'POST',
         url: 'include/process.php',
         data: sender,
         beforeSend: function(){
             $('#mynew').html('');
             $('#MyModal').modal('toggle');
             $('.cancel-new').click();
         },
         success: function(data){
             $('#clockindex').hide();
             $('#mynew').append(data);
             $('#mynew').addClass('animated zoomIn').fadeIn();
             setTimeout(function(){$('#mynew').removeClass('animated zoomIn');},1500);
         //----------------------------------------------------------------------------
               
                
                // Mostrar Boton Add
                $(".td-line").hover(
                  function() {
                    $(this).find('button').show();
                 },
                  function() {
                    $(this).find('button').hide();
                  }
                );

                // Agregar Informacion
                $('.addinfo').on('click', function(){
                     var dum = $(this).attr('data-row');
                     $('#DataEdit').modal('show');
                     $('#tede').val(dum);
                });


                // Borrar la tarea
                $('.delinfo').on('click', function(){
                     var dum = $(this).attr('data-row');
                     $('#'+dum).text('').removeClass('purple-label red-label blue-label pink-label').hide();
                });


                // Guardar Tarea
                $('.savetask').on('click', function(){
                     var tede = $('#tede').val();
                     var tasker = $('#nametask').val();
                     var color = $('#idcolortask option:selected').val();
                     $('#DataEdit').modal('toggle');
                     $('#'+tede).append('<label class="label-desc '+color+'">'+tasker+' <a class="deltasker"><i class="fa fa-times"></i></a></label>');
                     //$('#'+tede).text(tasker).addClass(color).show();
                     $('#taskfrm')[0].reset();


                     $('.deltasker').on('click', function(){
                         var element = $(this).parent();
                         element.addClass('animated bounceOut');
                         setTimeout(function(){element.remove();},1000);
                     });

                });



                $('.changethetime').on('click', function(){
                     var theparent = $(this).attr('data-time');
                     $('.hideedittime').hide();
                     $('.timeblock').show();
                     $('#parent'+theparent).hide();
                     $('#edit'+theparent).show();
                });

                $('.savetime').on('click', function(){
                     var savetime = $(this).attr('data-save');
                     var datasavetime = $('#input'+savetime).val();
                     $('#edit'+savetime).hide();
                     $('#parent'+savetime).show();
                     $('#data'+savetime).text(datasavetime);
                     $('#data'+savetime).addClass('animated flash');
                     setTimeout(function(){$('#data'+savetime).removeClass('flash');},1000);
                });

                $('.deleteblock').on('click', function(){
                     var block = $(this).attr('data-block');
                     $('#tr'+block).addClass('animated bounceOutLeft');
                     setTimeout(function(){$('#tr'+block).remove();},1000);
                });

                $('.canceledit').on('click', function(){
                     $('.hideedittime').hide();
                     $('.timeblock').show();   
                });


                $('.guardarhorario').on('click', function(){
                    
                    var btnsave = $(this);
                    var descripcion = $('#descripcioninput').val();
                    var nombre = $('#nombreinput').val();
                    var horario = $('#mynew').html();
                    var horariodata = 'process=2&nombre='+nombre+'&descripcion='+descripcion+'&horario='+horario;

                    $.ajax({

                        type: 'POST',
                        url: 'include/process.php',
                        data: horariodata,
                        beforeSend: function(){
                            btnsave.prop('disabled', true);
                            $('#horario-name').addClass('opacityelement');
                            $('#thetable').addClass('opacityelement');
                        },
                        success: function(){
                            $('#thetable').addClass('animated bounceOut');
                            btnsave.prop('disabled', false);
                            setTimeout(function(){window.location='lista.php'});

                        },
                        error: function(){
                            novalid();
                        }

                    });

                });
         //----------------------------------------------------------------------------
         },
         error: function(){
            novalid();
         }
      });

}else{
novalid();
}
});
//=============================================================================
    });
});

</script>

<link href='https://fonts.googleapis.com/css?family=Maven+Pro' rel='stylesheet' type='text/css'>
   <!-- menu -->
   <div id="menu" class="col-md-12 text-right">
    <div class="container">
        <a class="btn btn-primary" href="lista.php"><i class="fa fa-calendar" aria-hidden="true"></i> Lista de Horarios</a>
        <button class="btn btn-warning" data-toggle="modal" data-target="#myModal"><i class="fa fa-calendar-check-o"></i> Nuevo Horario</button>
    </div>
  </div>
  <!-- menu -->


  <!-- container -->
    <div class="container">
     <div id="clockindex" class="col-sm-12 text-center">
       <i class="fa fa-calendar-plus-o icon-clock-index animated infinite pulse" aria-hidden="true"></i>
     </div>
     <div id="mynew" class="col-sm-12">
        
     </div>
    </div>
  <!-- container -->



<!-- modal nuevo horario -->
<div class="modal fade animated bounceInLeft" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close cancel-new" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Nuevo Horario</h4>
        </div>
        <div class="modal-body">
      
        <form id="horariofrm">
          <label>Nombre:</label>
          <input class="form-control" type="text" name="nombre" >
          <label>Descripción:</label>
          <textarea class="form-control" name="descripcion" rows="3"></textarea>
          <label>Dias:</label>
          <div id="days-list" class="col-sm-12">
             <a data-day="1" class="day-option">Lunes</a>
             <a data-day="2" class="day-option">Martes</a>
             <a data-day="3" class="day-option">Miercoles</a>
             <a data-day="4" class="day-option">Jueves</a>
             <a data-day="5" class="day-option">Viernes</a>
             <a data-day="6" class="day-option">Sabado</a>
             <a data-day="7" class="day-option">Domingo</a>
          </div>
          <input id="days-chose" class="form-control" type="text" name="days" >
          <label>Inicio:</label>
          <input class="form-control" type="text" id="time1" name="tiempo1">
          <label>Final:</label>
          <input class="form-control" type="text" id="time2" name="tiempo2">
          <label>Dividir Entre:</label>
          <select class="form-control" name="minutos">
              <option></option>
              <option value="35">35 Minutos</option>
              <option value="45">45 minutos</option>
              <option value="60">1 Hora</option>
          </select>
       </form>

    </div>
    <div class="modal-footer">
      <button type="button" class="create-horario btn btn-success"><i class="fa fa-calendar-check-o"></i> Crear</button>
      <button type="button" class="cancel-new btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
    </div>
  </div>
</div>
</div>
<!-- modal nuevo horario -->

  
<!-- append modal set data -->
<div class="modal fade" id="DataEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close canceltask" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
      <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumb-tack"></i> Agregar Tarea</h4>
    </div>
    <div class="modal-body">
      
      <form id="taskfrm">
         <label>Tarea</label>
         <input class="form-control" type="text" id="nametask" >
         <label>Color:</label>
         <select class="form-control" id="idcolortask">
            <option value="purple-label">Purpura</option>
            <option value="red-label">Rojo</option>
            <option value="blue-label">Azul</option>
            <option value="pink-label">Rosa</option>
            <option value="green-label">Verde</option>
         </select> 
        <input id="tede" type="hidden" name="tede" >
      </form>

    </div>
    <div class="modal-footer">
      <button type="button" class="savetask btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
      <button type="button" class="canceltask btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
    </div>
  </div>
</div>
</div>
<!-- append modal set data -->




<!-- alert danger -->
<div id="alert-error"><i class="fa fa-times fa-2x"></i></div>
<!-- alert danger -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/vendor/horarios/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
{{-- <script src="/vendor/horarios/js/bootstrap.min.js"></script> --}}
    <!-- datetimepicker -->
<script src="/vendor/horarios/js/moment-with-locales.js"></script>
<script src="/vendor/horarios/js/bootstrap-datetimepicker.js"></script>
    <!-- validate -->
<script src="/vendor/horarios/js/jquery.validate.min.js"></script>
<script src="/vendor/horarios/js/additional-methods.min.js"></script>
    <!-- script -->
{{-- <script src="/vendor/horarios/js/script.js"></script> --}}

{{-- Bootstrap --}}
{{-- <script src="/vendor/bootstrap/js/bootstrap.min.js"></script> --}}
@endsection