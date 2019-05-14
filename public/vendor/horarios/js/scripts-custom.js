
// funcion no valid
function novalid(){
    $('#alert-error').addClass('animated bounce').fadeIn(500);
    setTimeout(function(){$('#alert-error').removeClass('animated bounce').fadeOut(500);},1500);
}


$('.verhorario').on('click', function(){

   var dataid = $(this).attr('data-id');
   var processsend = 'process=3&data='+dataid;

   $.ajax({
       type: 'POST',
       url: 'include/process.php',
       data: processsend,
       beforeSend: function(){
         $('#appenddata').html(' ');
       },
       success: function(data){
       	 $('#appenddata').html(data);
       	 $('#ViewHorario').modal('show');
//----------------------------------------------------------------------------------------------
                
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


                $('.deltasker').on('click', function(){
                         var element = $(this).parent();
                         element.addClass('animated bounceOut');
                         setTimeout(function(){element.remove();},1000);
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
                    var horario = $('#edithorariotabledata').html();
                    var iddata = $('#inputidedit').val();
                    var horariodata = 'process=4&nombre='+nombre+'&descripcion='+descripcion+'&horario='+horario+'&id='+iddata;

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
                            setTimeout(function(){$('#ViewHorario').modal('toggle');},1000);
                        },
                        error: function(){
                            novalid();
                        }

                    });

                });



//----------------------------------------------------------------------------------------------
       },
       error: function(){
         novalid();
       }
   });
});


$('.delhorario').on('click', function(){
  
   var horario = $(this).attr('data-id');
   var horariodata = 'process=5&dataid='+horario;
   var elemento = $('#trhorario'+horario);

   $.ajax({

       type: 'POST',
       url: 'include/process.php',
       data: horariodata,
        beforeSend: function(){
           elemento.find('button').prop('disabled', true);
           elemento.addClass('opacityelement');
        },
        success: function(){
           elemento.addClass('animated bounceOut');
           setTimeout(function(){elemento.remove();},1000)
        },
        error: function(){
            novalid();
        }   

   });
});