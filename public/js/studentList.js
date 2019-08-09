$('document').ready(function(){
    var table = $('#dataTable').DataTable();
    $('#groups').change(function(event){
        emptyProfile();
        var array = Array();
        var data = Array();
        $('#group_id').val(event.target.value);
        $.ajax({
            url: window.location.origin+'/professor/students/listByGroup/'+event.target.value+'',
            success: (response) => {
                array = response;
            },
        }).then( () => {
            table.destroy(); 
            table = $('#dataTable').DataTable({
                data: array,
                columns: [
                    { data: 'Codigo_Sis'},
                    { data: 'Apellidos'},
                    { data: 'Nombres'},
                    { data: 'Acciones',
                    render : function(data, type, row) {
                        return `<a href="#" class="buttons-icons btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick="loadProfile(${ data.student })"><i class="fas fa-eye"></i></a>
                                <a href="/professor/studentSesions/${data.schedule_id}" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="tooltip" title="Portafolios"><i class="fas fa-briefcase"></i></a>`
                        } 
                    }                      
                ]
            }).draw();
            console.log($('.buttons-icons').parent().attr('style','text-align: center; display: flex;').attr('class','text-center')); 
        });
    });
});

