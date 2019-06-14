@extends('components.sections.auxiliarSection')
@section('userContent')


    <script src="/js/generatekey.js"></script>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 py-4 font-weight-bold text-primary container">Asistencia de Estudiantes</div>

                <div class="col-sm-3">
                    <select class="form-control" name="bloques" id="select-labs" >
                        @foreach ($labs as $item)
                            <option class="form-control" value="{{$item->id}}">Laboratorio {{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success"><strong> {{Session::get('status_message')}} </strong></p>
                    @endif
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
        
                                                {{-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 69px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Email</font></font></th> --}}
        
                                                <th class="text-center" data-orderable="false"
                                                    rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">
                                                    <font style="vertical-align: inherit;"><font
                                                    style="vertical-align: inherit; color: white;">Asistencia</font></font></th>
                                            </tr>
                                            </thead>
                                            <tbody id="tablebody">        
                                            @forelse ($block_schedules as $bsch)
                                                @forelse ($bsch->students as $item)                                               
                                                <tr role="row" class="odd">
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->code_sis }}</font></font></td>
                                                    <td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->first_name }} {{ $item->user->second_name }}</font></font></td>
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->names }}</font></font></td>
                                                    <td class="text-center" style="text-align: center; display: flex;">
                                                        <a href="#" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle-2="tooltip" title="Marcar Asistencia" data-toggle="modal" data-target="#appModal" onclick="assistanceRegister({{$item}} , {{$bsch->id}})"><i class="far fa-check-square"></i></a>
                                                    </td>
                                                </tr>
                                                @empty
                                                @endforelse                                           
                                            @empty                                  
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="appModal" tabindex="-1" role="dialog" aria-labelledby="appModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="appModalLabel">Confirmacion de Asistencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>        
                    <div class="modal-body">
                        <form action="" id="registerStudent">
                            <p>Desea confirmar la asistencia del alumno? </p>
                            <input name="student_id" type="hidden" value="" id="student_id">
                            <input name="blockschedule_id" type="hidden" value="" id="blockschedule_id">
                        </form>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="modalAction">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>


@endsection

@push('scripts')
    <script src="{{ asset('/js/assistance.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@8')}}"></script>
@endpush
