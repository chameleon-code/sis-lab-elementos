$(document).ready(()=>{
    $('#bloques').change((event) => {        
        var array = Array();
        var table = $('#dataTable').DataTable();
        $.ajax({
            url: `http://localhost:8000/auxiliar/getStudentsByBlock/${event.target.value}`,
            success: (response)=>{
                array = response;
            }
        })
        .then(()=>{
            table.destroy(); 
            console.log(array)
            table = $('#dataTable').DataTable({
                data: array,
                columns: [
                    { data: 'Codigo_Sis'},
                    { data: 'Apellidos'},
                    { data: 'Nombres'},
                    { data: 'Asistencia',
                    render : function(data, type, row) {
                        console.log(data);
                        return `<label><input type="checkbox" id="cbox1" value="first_checkbox"> </label><br>`
                        } 
                    }                      
                ]
            }).draw();
        });
    });
});