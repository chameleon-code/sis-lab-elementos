$(document).ready( function() { 
    selectManagement();
});

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
    if( no_sesions ) {
        $('#sesion-selector').append(
            `<option class="optional" value=""> Sin sesiones </option>`
        );
    }
    loadStudents()
}

function loadStudents() {
    $('#students-container').empty();
    $.ajax({
        url : '/professor/getStudentsByGroup/'+$('#group-selector')[0].value+'/'+$('#block-selector')[0].value+'/'+$('#management-selector')[0].value,
        success: function ( response ){
            students = response.students;
            if( response.actual_sesion ) {
                $('#sesion-selector').val( response.actual_sesion.id )
            }
            if( students.length > 0 ) {
                for(let i=0 ; i<students.length ; i++) {
                    $('#students-container').append(
                        `
                        <div class="row mx-1 mb-1 py-1 border-bottom" style="cursor: pointer;">
                            <div class="">
                                <img src="/users/demo.png" alt="">
                            </div>
                            <div class="mx-3" style="font-size: 0.8rem;">
                                <b> ${ students[i].first_name } ${ students[i].second_name } ${ students[i].names } </b> <br>
                                ${ students[i].code_sis }
                            </div>
                        </div>
                        `
                    );
                }
                $('#students-container').css( 'height', $(window).height()*0.75 );
                $('#practices-content').show();
            } else {
                // No hay estudiantes inscritos
                $('#students-container').css( 'height', "10px" );
                $('#practices-content').hide();
            }
        },
        error: function() {
            // No encontro grupos, por tanto no hay grupos ni bloques para la gestión
            $('#students-container').css( 'height', "10px" );
            $('#practices-content').hide();
        }
    });
}