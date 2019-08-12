@extends('components.sections.professorSection')
@section('userContent')

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
                                            <input type="hidden" name="group_id" value="{{ $group->id }}" id="group_id">
                                            <button type="submit" class="btn btn-primary" data-toggle-2="tooltip" title="Descargar portafolios"><i class="fa fa-download" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 table-responsive">
                                <table class="table dataTable text-center table-striped table-secondary" id="dataTable" width="100%"
                                       cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                       style="width: 100%;">
                                    <thead>
                                    <tr role="row" class="bg-dark">
                                        <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 230px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Código SIS</font></font></th>
                                        <th class="sorting_desc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 380px;" aria-sort="descending"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Apellidos</font></font></th>
                                        <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 380px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Nombres</font></font></th>
                                        {{-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 69px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Email</font></font></th> --}}
                                        <th class="text-center" data-orderable="false" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39px;">  <font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Acciones</font></font></th>
                                    </tr>
                                </thead>
                                <tbody id="tablebody">
                                    @foreach ($schedules as $item)
                                        <tr role="row" class="odd">
                                            <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->code_sis }}</font></font></td>
                                            <td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->first_name }} {{ $item->user->second_name }}</font></font></td>
                                            <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->names }}</font></font></td>
                                            <td class="text-center" style="text-align: center; display: inline-flex;">
                                                <a href="#" class="btn btn-info btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Ver Perfil" data-toggle="modal" data-target="#studentProfile" onclick="loadProfile({{ $item->user }})" id="profile"><i class="fas fa-eye"></i></a>
                                                <a href="/professor/studentSesions/{{$item->id}}" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="tooltip" title="Portafolios"><i class="fas fa-briefcase"></i></a>
                                            </td>
                                        </tr>
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