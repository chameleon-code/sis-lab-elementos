function assistanceRegister(id,bsch_id){
    $('#student_id').val(id);
    $('#blockschedule_id').val(bsch_id);
}
$(document).ready(()=>{
    var modal = $('#appModal');
    $('#select-labs').change((event) => {        
        var array = Array();
        var table = $('#dataTable').DataTable();
        $.ajax({
            url: window.location.origin+`auxiliar/getStudentList/${event.target.value}`,
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
                        if(data.assist === true){
                            return `<a href="#" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Marcar Asistencia" data-toggle="modal" data-target="#appModal" onclick="assistanceRegister(${data.student}, ${data.bsch_id})" id="student${data.student}"><i class="far fa-check-square"></i></a>`
                        }
                        else{
                            return `<a href="#" class="btn btn-success btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Estudiante registrado" data-toggle="modal" id="student${data.student}"><i class="far fa-check-square"></i></a>`
                        }
                    } 
                    }                      
                ]
            }).draw();
        });
    });
    $('#modalAction').click(function(event){
            console.log($("#registerEvent").serialize());
            $.ajax({
                url : window.location.origin+'auxiliar/assistance',
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
                            'Revisa en tu registro de asistencia',
                            'success'
                        );
                        modal.modal('hide');        
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
    $('#modalAction').click( ()=>{
        var modal = $('#appModal');
        var id = modal.find('#student_id').val();
        $('#student'+id).attr('class', 'btn btn-success btn-circle btn-sm mx-1');
        $('#student'+id).attr('title', 'Estudiante registrado');
        $('#student'+id).attr('data-target', '');
        $('#student'+id).attr('onclick', '');         
    });
});

