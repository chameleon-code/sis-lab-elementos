$('document').ready(function(){
    var table = $('#dataTable').DataTable();
    $('#groups').change(function(event){
        var array = Array();
        var data = Array();
        $.ajax({
            url: 'http://127.0.0.1:8000/professor/students/listByGroup/'+event.target.value+'',
            success: (response) => {
                array = response;
            },
        }).then( () => {
            table.destroy();
            console.log(array);
            table = $('#dataTable').DataTable({
                data: array,
                columns: [
                    { data: 'Codigo_Sis'},
                    { data: 'Apellidos'},
                    { data: 'Nombres'},
                    { data: 'Acciones',
                    render : function(data, type, row) {
                        console.log(data);
                        return `<a href="#" class="btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick="loadProfile(${ data })"><i class="fas fa-eye"></i></a>
                        <a href="/professor/studentSesions/${data.id}" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="tooltip" title="Portafolios"><i class="fas fa-briefcase"></i></a>`
                        } 
                    }                      
                ]
            }).draw();
        });
    });
});