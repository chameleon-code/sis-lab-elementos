$(document).ready( function() { 
    selectManagement();
    fitContainers();
    $(window).resize( function() {
        fitContainers();
    });
});

function fitContainers() {
    if( $(window).width() < 1055 ) {
        $('#task-container').hide();
        $('#practices-content').removeClass('row');
        $('#students-container').removeClass('col-sm-6');
    } else {
        $('#practices-content').addClass('row');
        $('#students-container').addClass('col-sm-6');
        $('#task-container').show();
    }
}

function selectManagement() {
    $('#block-selector').empty();
    let display_blocks = []
    let no_blocks = true;
    for(let i=0 ; i<groups.length ; i++) {
        if( groups[i].management_id+"" == $('#management-selector')[0].value && !display_blocks.includes(groups[i].block_id) ) {
            $('#block-selector').append(
                `<option class="optional" value="${groups[i].block_id}"> ${ groups[i].block_name } ( ${ groups[i].subject.name } )</option>`
            );
            display_blocks.push(groups[i].block_id);
            no_blocks = false;
        }
    }
    if( no_blocks ) {
        $('#block-selector').append(
            `<option class="optional" value=""> Sin bloques </option>`
        );
    }
    selectBlock();
}

function selectBlock() {
    $('#group-selector').empty();
    let no_groups = true;
    for(let i=0 ; i<groups.length ; i++) {
        if( groups[i].management_id == $('#management-selector')[0].value && groups[i].block_id == $('#block-selector')[0].value ) {
            $('#group-selector').append(
                `<option class="optional" value="${groups[i].id}"> ${ groups[i].name } </option>`
            );
            no_groups = false;
        }
    }
    if( no_groups ) {
        $('#group-selector').append(
            `<option class="optional" value=""> Sin grupos </option>`
        );
    }
    selectGroup()
}

function selectGroup() {
    $('#sesion-selector').empty()
    let no_sesions = true;
    for(let i=0 ; i<sesions.length ; i++) {
        if( sesions[i].management_id == $('#management-selector')[0].value && sesions[i].block_id == $('#block-selector')[0].value && sesions[i].group_id == $('#group-selector')[0].value ) {
            $('#sesion-selector').append(
                `<option class="optional" value="${sesions[i].id}"> ${ sesions[i].number_sesion } </option>`
            );
            no_sesions = false;
        }
    }
    if( !no_sesions ) {
        $.ajax({
            url: '/professor/actualSesionBlock/'+$('#block-selector')[0].value,
            success: function( actual_sesion ) {
                if( actual_sesion ) {
                    $('#sesion-selector').val( actual_sesion.id );
                }
            },
            error: function() {
                //
            }
        });
    }
    if( no_sesions ) {
        $('#sesion-selector').append(
            `<option class="optional" value=""> Sin sesiones </option>`
        );
    }
    loadStudents()
}

function loadStudents() {
    $('#student-task-container').empty();
    $('#sesion-task-container').empty();
    $('#delivered-task-container').empty();
    $('#students-container').empty();
    $.ajax({
        url : '/professor/getStudentsByGroup/'+$('#group-selector')[0].value+'/'+$('#block-selector')[0].value+'/'+$('#management-selector')[0].value+'/'+$('#sesion-selector')[0].value,
        success: function ( response ){
            let students = response.students;
            if( students.length > 0 ) {
                $('#students-container').append(
                    `
                    <h6 class="m-0 font-weight-bold text-primary"> Estudiantes: <span> ${ students.length } </span> / <span class="text-success"> ${ Object.keys(response.students_with_task_ids).length } </span> / <span class="text-danger"> ${ students.length - Object.keys(response.students_with_task_ids).length } </span> </h6> <br>
                    `
                );
                for(let i=0 ; i<students.length ; i++) {
                    let status_task = "";
                    if( response.students_status_task[i] ){
                        status_task = `<b class="text-success"> Entrego </b>`;
                    } else {
                        status_task = `<b class="text-danger"> No entrego </b>`;
                    }
                    $('#students-container').append(
                        `
                        <div id="item-student-${ students[i].student_id }" class="item-student row mx-1 mb-0 py-1 border-bottom" onclick='viewSesionTask( ${ JSON.stringify(students[i]) } )' style="cursor: pointer;">
                            <div class="">
                                <img src="/users/demo.png" alt="">
                            </div>
                            <div class="mx-3" style="font-size: 0.8rem;">
                                <b> ${ students[i].first_name } ${ students[i].second_name } ${ students[i].names } </b> <br>
                                ${ status_task }
                            </div>
                        </div>
                        `
                    );
                }
                $('#students-container').css( 'height', $(window).height()*0.75 );
                $('#task-container').css( 'height', $(window).height()*0.75 );
                $('#practices-content').show();
            } else {
                // No hay estudiantes inscritos
                $('#students-container').css( 'height', "10px" );
                $('#task-container').css( 'height', "10px" );
                $('#practices-content').hide();
            }
        },
        error: function() {
            // No encontro grupos, por tanto no hay grupos ni bloques para la gestión
            $('#students-container').css( 'height', "10px" );
            $('#task-container').css( 'height', "10px" );
            $('#practices-content').hide();
        }
    });
}

function viewSesionTask( student ) {
    $('.item-student').each(function() {
        $(this).removeClass('bg-gray-200');
    });
    $('#item-student-'+student.student_id).addClass('bg-gray-200');
    $('#student-task-container').empty();
    $('#sesion-task-container').empty();
    $('#delivered-task-container').empty();
    $('#student-task-container-2').empty();
    $('#sesion-task-container-2').empty();
    $('#delivered-task-container-2').empty();
    $.ajax({
        url : '/professor/getStudentTask/'+student.student_id+'/'+$('#sesion-selector')[0].value,
        success: function ( response ){
            console.log( response );
            if( $(window).width() < 1055 ) {
                // Mostrar en modal
                $('#task-modal').modal('show');
                $('#student-task-container-2').append(
                    `
                    <div class="mt-0 mb-0"> <b> ${ student.first_name } ${ student.second_name } ${ student.names } </b> </div>
                    <div class="my-0"> <b> ${ student.code_sis } </b> </div>
                    <div class="my-0"> <b> ${ student.email } </b> </div>
                    <div class="mb-3 mt-0"> <b> Día de trabajo: &nbsp; </b> Día </div>
                    `
                );
                for(let i=0 ; i<response.sesion_tasks.length ; i++ ) {
                    $('#sesion-task-container-2').append(
                        `
                        <div> <b> Tarea de la sesión: </b> &nbsp; ${ response.sesion_tasks[i].title } </div>
                        <div> ${ response.sesion_tasks[i].description } </div>
                        <div class="mb-1 border-bottom"> <b> Archivo </b>:&nbsp; <a href="/downloadPractice/${ response.sesion_tasks[i].task_path }/${ response.sesion_tasks[i].task_file }"> ${ response.sesion_tasks[i].task_file } </a> </div>
                        `
                    );
                }
                if( response.tasks.length > 0 ) {
                    for(let i=0 ; i<response.tasks.length ; i++) {
                        let in_time = ( response.tasks[i].in_time == "yes" ) ? "<b class='text-success'> (A tiempo) </b>" : "<b class='text-danger'> (Con retraso) </b>";
                        $('#delivered-task-container-2').append(
                            `
                            <div class="card shadow mb-2">
                                <div class="p-3">
                                    <div> <b> Archivo </b>:&nbsp; <a href="/downloadPractice/${ response.tasks[i].task_path }/${ response.tasks[i].task_name }"> ${ response.tasks[i].task_name } </a> </div>
                                    <div> <b> Entrega: </b> &nbsp; ${ getDate( response.tasks[i].updated_at ) } - ${ getHour( response.tasks[i].updated_at ) } ${ in_time } </div>
                                    <div> <b> Comentario: </b> &nbsp; ${ response.tasks[i].description } </div>
                                </div>
                            </div>
                            `
                        );
                    }
                } else {
                    //no hay tareas
                    $('#delivered-task-container-2').append( 
                        `
                        <div class="alert alert-warning"> Ninguna entrega </div>
                        `
                    );
                }
            } else {
                // Mostrar en container
                $('#student-task-container').append(
                    `
                    <div class="mt-3 mb-0"> <b> ${ student.first_name } ${ student.second_name } ${ student.names } </b> </div>
                    <div class="my-0"> <b> ${ student.code_sis } </b> </div>
                    <div class="my-0"> <b> ${ student.email } </b> </div>
                    <div class="mb-3 mt-0"> <b> Día de trabajo: &nbsp; </b> Día </div>
                    `
                );
                for(let i=0 ; i<response.sesion_tasks.length ; i++ ) {
                    $('#sesion-task-container').append(
                        `
                        <div> <b> Tarea de la sesión: </b> &nbsp; ${ response.sesion_tasks[i].title } </div>
                        <div> ${ response.sesion_tasks[i].description } </div>
                        <div class="mb-1 border-bottom"> <b> Archivo </b>:&nbsp; <a href="/downloadPractice/${ response.sesion_tasks[i].task_path }/${ response.sesion_tasks[i].task_file }"> ${ response.sesion_tasks[i].task_file } </a> </div>
                        `
                    );
                }
                if( response.tasks.length > 0 ) {
                    for(let i=0 ; i<response.tasks.length ; i++) {
                        let in_time = ( response.tasks[i].in_time == "yes" ) ? "<b class='text-success'> (A tiempo) </b>" : "<b class='text-danger'> (Con retraso) </b>";
                        $('#delivered-task-container').append(
                            `
                            <div class="card shadow mb-2">
                                <div class="p-3">
                                    <div> <b> Archivo </b>:&nbsp; <a href="/downloadPractice/${ response.tasks[i].task_path }/${ response.tasks[i].task_name }"> ${ response.tasks[i].task_name } </a> </div>
                                    <div> <b> Entrega: </b> &nbsp; ${ getDate( response.tasks[i].updated_at ) } - ${ getHour( response.tasks[i].updated_at ) } ${ in_time } </div>
                                    <div> <b> Comentario: </b> &nbsp; ${ response.tasks[i].description } </div>
                                </div>
                            </div>
                            `
                        );
                    }
                } else {
                    //no hay tareas
                    $('#delivered-task-container').append( 
                        `
                        <div class="alert alert-warning"> Ninguna entrega </div>
                        `
                    );
                }
            }
        },
        error: function() {
        }
    });

}