@extends('components.sections.auxiliarControlSection')
@section('userContent')

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 font-weight-bold text-primary container">Control de Portafolios</div>
                <br>
                <div class="card-body">
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                    <table class="table dataTable text-center table-striped table-secondary" id="dataTable" width="100%"
                                        cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                        style="width: 100%;">
                                    <thead>
                                    <tr role="row" class="bg-dark">
                                        <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Name: activate to sort column ascending"
                                            style="width: 230px;"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit; color: white;">Código SIS</font></font></th>

                                        <th class="sorting_desc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Position: activate to sort column ascending"
                                            style="width: 380px;" aria-sort="descending"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit; color: white;">Apellidos</font></font></th>

                                        <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Office: activate to sort column ascending"
                                            style="width: 380px;"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit; color: white;">Nombres</font></font></th>

                                        <th class="text-center" data-orderable="false"
                                            rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">
                                            <font style="vertical-align: inherit;"><font
                                            style="vertical-align: inherit; color: white;">Acciones</font></font></th>
                                    </tr>
                                    </thead>
                                    <tbody>  
                                    @foreach ($list as $item) 
                                        @foreach ($item->students as $student)
                                            <tr role="row" class="odd">
                                                <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $student->student->code_sis }}</font></font></td>
                                                <td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $student->student->first_name }} {{ $student->student->second_name }}</font></font></td>
                                                <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $student->student->names }}</font></font></td>
                                                <td class="text-center" style="text-align: center; display: flex;">
                                                    <button class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="modal" title="Ver Portafolio" data-target="#student{{$student->student->code_sis}}"><i class="fas fa-briefcase"></i></button>
                                                    <div class="modal fade studentModal" id="student{{$student->student->code_sis}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Verificar Portafolio</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body text-left">
                                                                    @foreach ($student->studentTasks as $task)
                                                                    <div class="accordion-body bg-gray-300 rounded row my-2" id="task1" style="cursor: default;"> 
                                                                        <div class="container d-flex justify-content-between p-1" style="">
                                                                            <div class="d-flex justify-content-start"> <strong> Título:&nbsp;</strong>{{$task->title}} </div>
                                                                            <div class="d-flex justify-content-end"> 
                                                                                <a href="#" title="Dejar una observación" style="margin-right: 3px;">
                                                                                    <i class="fas fa-edit" onclick="activateObservation({{$student->student->code_sis}},{{$task->id}});"></i>
                                                                                </a>
                                                                                <a href="#" title="Guardar observación">
                                                                                    <i class="fas fa-save" onclick="saveObservation({{$student->student->code_sis}},{{$task->id}});"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="container d-flex justify-content-between p-1" style="">
                                                                            <div class="d-flex justify-content-start"><strong>Descripción:&nbsp;</strong>{{$task->description}}</div>
                                                                        </div>
                                                                        <div class="container d-flex justify-content-between p-1" style="">
                                                                            <div class="d-flex justify-content-start">Archivo adjunto:&nbsp; 
                                                                                <a href="{{'/storage/'.$task->task_path.'/'.$task->task_name}}">{{$task->task_name}}</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="calification container d-flex justify-content-between p-1" style="">
                                                                            @if ($task->observation=='')
                                                                                <textarea id="calification{{$student->student->code_sis}}-{{$task->id}}" name="observation" id="" cols="3" rows="2" class="form-control">{{$task->observation}}</textarea>
                                                                            @else
                                                                                <textarea id="calification{{$student->student->code_sis}}-{{$task->id}}" name="observation" id="" cols="3" rows="2" class="form-control" readonly>{{$task->observation}}</textarea>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                <div class="modal-footer">
                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
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
</script>
@endsection

