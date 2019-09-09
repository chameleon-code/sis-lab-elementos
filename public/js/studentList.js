//var schedules = undefined;
var blockGroups = undefined;

$('document').ready(function(){
    //console.log( schedules );
    loadGroup();
    // var table = $('#dataTable').DataTable();
    // $('#groups').change(function(event){
    //     emptyProfile();
    //     var array = Array();
    //     var data = Array();
    //     $('#group_id').val(event.target.value);
    //     $.ajax({
    //         url: window.location.origin+'/professor/students/listByGroup/'+event.target.value+'',
    //         success: (response) => {
    //             array = response;
    //         },
    //     }).then( () => {
    //         table.destroy(); 
    //         table = $('#dataTable').DataTable({
    //             data: array,
    //             columns: [
    //                 { data: 'Codigo_Sis'},
    //                 { data: 'Apellidos'},
    //                 { data: 'Nombres'},
    //                 { data: 'Acciones',
    //                 render : function(data, type, row) {
    //                     return `<a href="#" class="buttons-icons btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick="loadProfile(${ data.student })"><i class="fas fa-eye"></i></a>
    //                             <a href="/professor/studentSesions/${data.schedule_id}" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="tooltip" title="Portafolios"><i class="fas fa-briefcase"></i></a>`
    //                     } 
    //                 }                      
    //             ]
    //         }).draw();
    //         console.log($('.buttons-icons').parent().attr('style','text-align: center; display: flex;').attr('class','text-center')); 
    //     });
    // });
});

function loadGroup() {
    $('#dataTable').DataTable().clear().draw();
    //console.log( $('#groups')[0].value );
    var block_id = undefined;
    blockGroups.forEach(element => {
        if( element.group_id == $('#groups')[0].value ) {
            block_id = element.block_id;
        }
    });
    $.ajax({
        url: '/professor/student/schedules/'+$('#groups')[0].value+'/'+block_id,
        beforeSend: function () {
            loading();
        },
        success: function( response ) {
            endLoading();
            //console.log( response );
            response.forEach(element => {
                //console.log(element);
                $('#dataTable').DataTable().row.add([
                    `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.code_sis }</font></font></td>`,
                    `<td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.first_name } ${ element.user.second_name }</font></font></td>`,
                    `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.user.names }</font></font></td>`,
                    `<td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ element.tarea_sesion }</font></font></td>`,
                    `<div class="text-center" style="display: flex;">
                        <a href="#" class="btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick="loadProfile(${ element.user })" id="profile"><i class="fas fa-eye"></i></a>
                        <a href="/professor/studentSesions/${element.id}}" class="btn btn-success btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Historial de entregas" data-toggle="modal" data-target="#student-folder"><i class="fas fa-list"></i></a>
                        <a href="/professor/studentSesions/${element.id}" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Portafolios"><i class="fas fa-briefcase"></i></a>
                    </div>`
                ]).draw();
            });
        },
        error: function() {
            endLoading();
            alert("Error de conexión. Vuelva a intentarlo.");
        },
        timeout: 20000
    });
    
}