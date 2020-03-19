@extends('components.sections.professorSection')
@section('userContent')

<script> blockGroups = {!! json_encode( $blockGroups ) !!} </script>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="panel-heading m-0 font-weight-bold text-primary container">Estudiantes </div>
                    {{-- <a href="/professor/practices/download" class="btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Descargar portafolios" onclick="loadProfile()" id="profile"><i class="fas fa-download"></i></a> --}}
                </div>
                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success"><strong> {{Session::get('status_message')}} </strong></p>
                    @endif
                    <div class="">
                        <div class="">
                            <div class="form-group" style="">
                                <div class="d-flex justify-content-between">
                                    <select name="group_id" class="form-control" id="groups" style="width: 30%;">
                                        @forelse ($groups as $group)
                                            @if ($loop->first)
                                                <option class="form-control" value="{{$group->id}}" selected> Grupo {{$group->name . " - " . $group->subject->name}}</option>
                                                @continue
                                            @endif
                                                <option class="form-control" value="{{$group->id}}"> Grupo {{$group->name . " - " . $group->subject->name}}</option>
                                            @empty
                                                <option class="form-control" value="">No tiene grupos relacionados con algun bloque</option>
                                            @endempty
                                        @endforelse
                                    </select>
                                    
                                    <br>
                                    <div class="form-group">
                                        <form class="mx-2" action="/downloadGroupRegister" method="get">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="group_id" value="" id="group_id">
                                            <button type="submit" class="btn btn-primary" data-toggle-2="tooltip" title="Descargar portafolio de grupo"><i class="fa fa-download" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="font-weight-bold text-info text-uppercase mx-2" style="font-size: 13.5px;"> <b id="actual-sesion-title">  </b> </div>
                            </div>
                            <div class="form-group" style="">
                                <select name="block_id" class="form-control" id="blocks" style="width: 30%;">
                                    @forelse ($blocks as $block)
                                        @if ($loop->first)
                                            <option class="form-control" value="{{$block->id}}" selected>{{$block->name}}</option>
                                            @continue
                                        @endif
                                            <option class="form-control" value="{{$block->id}}">{{$block->name}}</option>
                                        @empty
                                            <option class="form-control" value="">No tiene Bloques relacionados con el grupo</option>
                                        @endempty
                                    @endforelse
                                </select>
                                <br>
                                <select name="sesion_id" class="form-control" id="sesions" style="width: 30%;">
                                    @forelse ($sesions as $sesion)
                                        @if ($sesion->number_sesion == $actual_sesion)
                                            <option class="form-control" value="{{$sesion->id}}" selected> Sesion {{$sesion->number_sesion}}</option>
                                            @continue
                                        @endif
                                            <option class="form-control" value="{{$sesion->id}}"> Sesion {{$sesion->number_sesion}}</option>
                                        @empty
                                            <option class="form-control" value="">No tiene sesiones relacionados con algun bloque</option>
                                        @endempty
                                    @endforelse
                                </select>
                            </div>
                            <div id="table-container" class="col-sm-12 table-responsive">
                                <table class="table dataTable text-center table-striped table-secondary" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row" class="bg-dark">
                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 150px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Código SIS</font></font></th>
                                            <th class="sorting_desc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 230px;" aria-sort="descending"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Apellidos</font></font></th>
                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 200px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Nombres</font></font></th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 170px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tarea de sesión </font></font></th>
                                            <th class="text-center" data-orderable="false" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 80px;">  <font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Acciones</font></font></th>
                                        </tr>
                                    </thead>
                                    {{-- @foreach ($schedules as $item)
                                        <tr role="row" class="odd">
                                            <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->code_sis }}</font></font></td>
                                            <td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->first_name }} {{ $item->user->second_name }}</font></font></td>
                                            <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->names }}</font></font></td>
                                            <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Entregada</font></font></td>
                                            <td class="text-center" style="text-align: center; display: inline-flex;">
                                                <a href="#" class="btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick="loadProfile({{ $item->user }})" id="profile"><i class="fas fa-eye"></i></a>
                                                <a href="/professor/studentSesions/{{$item->id}}" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="tooltip" title="Historial de entregas"><i class="fas fa-briefcase"></i></a>
                                                <a href="/professor/studentSesions/{{$item->id}}" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="tooltip" title="Portafolios"><i class="fas fa-briefcase"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="studentProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" style="pointer-events: inherit;">
        <div class="card card-profile o-hidden border-0 my-3 rounded">
            <div style="background-image: url(/img/lab.jpg);" class="card-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black; margin-top: -5px;">
                    <span aria-hidden="true"><strong>&times;</strong></span>
                </button>
            </div>
            <div class="card-body text-center"><img src="/users/demo.png" class="card-profile-img">
                <h3 class="mb-3" id="namesProfile"></h3>
                <div><strong> Tipo de Usuario: </strong> <p> Estudiante </p></div>
                <div><strong> Código Sis: </strong> <p id="codeSisProfile"></p></div>
                <div><strong> Correo Electrónico: </strong> <p id="emailProfile"></p></div>
            </div>
        </div>
    </div>
</div>

{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#student-folder">Large modal</button> --}}

<div id="student-folder" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="panel-heading font-weight-bold text-primary">Portafolio</div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-between">
                <div id="student-data-folder" class="pl-2" style="font-size: 14px;">
                    {{-- <div id="folder-name"><strong>Estudiante: </strong> </div>
                    <div id="folder-cod-sis"><strong>Código SIS: </strong> </div>
                    <div id="folder-subject"><strong>Materia: </strong> </div>
                    <div id="folder-group"><strong>Grupo: </strong> </div> --}}
                </div>
                <form action="/download" method="get">
                    {{ csrf_field() }}
                    <input id="input_schedule_id" type="hidden" name="schedule_id" value="0">
                    <strong><button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Descargar Portafolio" style="margin-top: 11px; margin-right: 18px;"><i class="fa fa-download" aria-hidden="true"></i></button></strong>
                </form>
            </div>

            <div id="sesions-student" class="my-3">

                <div class="card border-left-success shadow h-100 mx-2 mt-2 mb-2" style="margin-bottom: 0px;">
                    <div class="card-body py-1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase">
                                    <strong style="color: gray;"> Sesión:&nbsp; </strong> 8
                                    <br>
                                    {{-- @if ($tasks_finisheds[$loop->index]->assist == 1)
                                        <strong>Realizado en clase</strong>
                                    @else
                                        <strong>Realizado en casa</strong>
                                    @endif --}}
                                    <strong>Realizado en casa</strong>
                                </div>
                                <div class="row no-gutters align-items-center py-0">
                                    <div class="col-auto">
                                        {{-- <div id="sesion{sesion->id})" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $tasks_finisheds[$loop->index]->tasks }}/{{ $sesion->tasks->count() }}</div> --}}
                                        <div id="sesion{sesion->id})" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1/10</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            {{-- <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($tasks_finisheds[$loop->index]->tasks * 100) / $sesion->tasks->count() }}%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> --}}
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-0 px-3">
                        {{-- @if (in_array($task->id, $student_tasks_ids)) --}}
                    <div class="" style="font-size: 13px;">
                        {{-- @if ($tasks_finisheds[$loop->parent->index]->assist == 1 || $student_tasks->where('task_id', $task->id)->first()->in_time != 'no') --}}
                        <div> <strong> Tarea: </strong> Titulo de tarea </div>
                        <div>
                            <b>Entrega:&nbsp;</b>
                            <label class="m-0" style="color: green;"> A tiempo</label> &nbsp;
                            {{-- <label style="color: red;">Sin entregar &#10005</label> --}}
                            {{-- <strong> <a href="/downloadTask/{{ $student_tasks->where('task_id', $task->id)->first()->task_path}}/{{$student_tasks->where('task_id', $task->id)->first()->task_name  }}" download="{{ $student_tasks->where('task_id', $task->id)->first()->task_name }}" data-toggle-2='tooltip' title='Descargar Tarea'><i class="fa fa-download" aria-hidden="true"></i></a></strong> --}}
                            <a href="#" download="" data-toggle-2='tooltip' title='Descargar Tarea'><i class="fa fa-download" aria-hidden="true"></i></a>
                        </div>
                        <div> <b> Observación del Estudiante: </b> ... </div>
                        {{-- @else
                            <label style="color: orangered;"> Fuera de tiempo el dia {{ $student_tasks->where('task_id', $task->id)->first()->updated_at }} </label>
                        @endif --}}
                    </div>
                </div>
                
            </div>

        </div>
    </div>
  </div>
</div>

<script>
    function loadProfile(item){
        document.getElementById('namesProfile').innerHTML=item.names+' '+item.first_name+' '+item.second_name;
        document.getElementById('codeSisProfile').innerHTML=item.code_sis;
        document.getElementById('emailProfile').innerHTML=item.email;
    }
    function emptyProfile(){
        document.getElementById('namesProfile').innerHTML="";
        document.getElementById('codeSisProfile').innerHTML="";
        document.getElementById('emailProfile').innerHTML="";
    }
</script>

@endsection

@push('scripts')
    <script src="{{ asset('js/studentList.js') }}"></script>
@endpush