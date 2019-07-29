function checkAssistance(id, bsch_id){
    console.log('check #student'+id);
    $('#student'+id).attr('onclick', `assistanceRegister(${id}, ${bsch_id}, 0)`);  
}
function uncheckAssistance(id, bsch_id){
    console.log('uncheck #student'+id);
    $('#student'+id).attr('onclick', `assistanceRegister(${id}, ${bsch_id}, 1)`); 
}
function assistanceRegister(id, bsch_id, status){
    var param = {
        'blockschedule_id': bsch_id,
        'student_id': id,
        'status': status
    };
    $.ajax({
        url : window.location.origin+'/auxiliar/assistance',
        type: 'POST',
        headers: {
            'x-csrf-token': $("meta[name=csrf-token]").attr('content')
        },
        data: param,
        success: (res) => {
            if(res.res) {
                if(status == 1){
                    checkAssistance(param['student_id'], param['blockschedule_id']); 
                }   
                else{
                    uncheckAssistance(param['student_id'], param['blockschedule_id']);
                }           
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Algo salio mal...',
                    text: 'No se pudo guardar la informacion, vuelve a intentarlo',
                  })
            }
        }
    });
}
$(document).ready(()=>{
    $('#dataTableRegister').DataTable( {
        "columnDefs": [
            {
                "targets": [ 1 ],
                "visible": false,
                "searchable": false
            }
        ],
        dom: 'Bfrtip',
        buttons: [
                'pdf'
        ]
    } );
    $('#select-labs').change((event) => {        
        var array = Array();
        var table = $('#dataTable').DataTable();
        $.ajax({
            url: window.location.origin+`/auxiliar/getStudentList/${event.target.value}`,
            success: (response)=>{
                array = response;
            }
        })
        .then(()=>{
            table.destroy(); 
            console.log(array);
            table = $('#dataTable').DataTable({
                data: array,
                columns: [
                    { data: 'Codigo_Sis'},
                    { data: 'Apellidos'},
                    { data: 'Nombres'},
                    { data: 'Asistencia',
                        render: function(data, type, row) {
                            if(data.assist === true){
                                return `<input type="checkbox" class="form-check-input" id="student${data.student}" onclick="assistanceRegister(${data.student} , ${data.bsch_id}, 0)" checked>`
                            }
                            else{
                                return `<input type="checkbox" class="form-check-input" id="student${data.student}" onclick="assistanceRegister(${data.student} , ${data.bsch_id}, 1)" >`
                            }
                        } 
                    }                      
                ]
            }).draw();
        });
    });
});

