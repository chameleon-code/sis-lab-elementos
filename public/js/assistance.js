function assistanceRegister(id,bsch_id){
    //console.log(nombres);
    //$('#registerStudent > p').text('Desea confirmar la asistencia del alumno' +nombres + ' '+apellidos+ '?');
    $('#student_id').val(id);
    $('#blockschedule_id').val(bsch_id);
}

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
                        //console.log(row.Nombres);
                        return `<a href="#" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Marcar Asistencia" data-toggle="modal" data-target="#appModal" onclick="assistanceRegister(${data.student}, ${data.bsch_id})"><i class="far fa-check-square"></i></a>`
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
    $('#dataTable > .btn-warning').click( ()=>{
        console.log('hi');
    });
});

