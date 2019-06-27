function activateObservation(sis,tId){
    var id ='#calification'+sis+'-'+tId;
    $(id).removeAttr('readonly');
}   
function saveObservation(sis,tId){
    var id ='#calification'+sis+'-'+tId;
    $(id).attr('readonly',true);
    var observations = $(id).val();
    $.ajax({
        url : window.location.origin+'/auxiliar/activities/update',
        type: 'POST',
        headers: {
            'x-csrf-token': $("meta[name=csrf-token]").attr('content')
        },
        data:{
            observation: observations,
            id: tId
        },
        success: function(result){
            console.log(result);
        }
    });
    console.log(observation);
}  