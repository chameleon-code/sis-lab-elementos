$(document).ready(()=>{
    var modal = $('#appModal');
    $('#select-labs').change((event) => {        
        var array = Array();
        var table = $('#dataTable').DataTable();
        $.ajax({
            url: `http://localhost:8000/auxiliar/getStudentList/${event.target.value}`,
            success: (response)=>{
                array = response;
            }
        })
        .then(()=>{
            table.destroy(); 
            console.log(array)
            table = $('#dataTable').DataTable({
                data: array,
                buttons:'selectCells',
                columns: [
                    { data: 'Codigo_Sis'},
                    { data: 'Apellidos'},
                    { data: 'Nombres'},
                    { data: 'Asistencia',
                    render : function(data, type, row) {
                        console.log(data);
                        return `<a href="#" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Marcar Asistencia" data-toggle="modal" data-target="#appModal" data-student="1" onclick="assistanceRegister(${data.student_id} , ${data.bsch_id})"><i class="far fa-check-square"></i></a>`
                        } 
                    }                      
                ]
            }).draw();
        });
    });
    $('#modalAction').click(function(event){
            console.log($("#registerEvent").serialize());
            $.ajax({
                url : 'http://localhost:8000/auxiliar/assistance',
                type: 'POST',
                headers: {
                    'x-csrf-token': $("meta[name=csrf-token]").attr('content')
                },
                data: {
                    info: $("#registerStudent").serialize()
                },
                success: (res) => {
                    if(res.res) {
                       Swal.fire(
                            'Registro de estudiante exitoso!',
                            'Revisalo en tu registro de asistencia',
                            'success'
                        )
                        modal.modal('hide');
                        modal.find("input").val("");                    
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Algo salio mal...',
                            text: 'No se pudo guardar la informacion, vuelve a intentarlo',
                          })
                    }
                }
            });
        });
});

function assistanceRegister(id1, id2){
    $('#student_id').val(id1);
    $('#blockschedule_id').val(id2);
}
