@extends('components.sections.studentSection')

@section('userContent')

<style>
    @media screen and (max-width: 1150px) {
        #img-matter {
            display:none;
        }
        .card-matter {
            height: 105px !important;
        }
    }

    @media screen and (max-width: 688px) {
        .card-matter {
            height: 150px !important;
        }
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="panel-heading m-0 font-weight-bold text-primary">Inscripción</div>
                <div class="mx-3">
                    <a class="py-1" href="#" style="font-size: 14px; width: 100px;" onclick="status()"> Estado de Inscripción </a>
                </div>
            </div>

            @if(isset($error))
                <div id="schedule-error" class="alert alert-danger mt-3 mb-0">
                    <div class="d-flex justify-content-between">
                        <b>Horario no disponible.</b>
                        <a style="color: #78261f;" href="#" onclick="$('#schedule-error').hide()"> <i class="fa fa-times"></i> </a>
                    </div>
                    <ul class="m-0">
                        <li>{{ $error }}</li>
                    </ul>
                </div>
            @endif

            <div class="card-body">
                @php
                    $id_select = 1;
                @endphp
                
                <script> console.log( {!! json_encode($subjectMatters) !!} ); </script>
                @forelse($subjectMatters as $item)
                    @php
                        $groups_sm = App\Group::where("subject_matter_id", "=", $item->id)->get();
                    @endphp
                    <div class="d-flex justify-content-between my-2 px-1 rounded shadow card-matter" style="height: 90px;">
                        <div class="row">
                            <img id="img-matter" class="" style="width:100px; height: 100%; border-top-left-radius: 5px; border-bottom-left-radius: 5px;" src="/img/subjectMatter.jpg" alt="">
                            <div class="my-2 mx-3" id="subject-matter-{{$item->id}}" style="font-size: 15px;">
                                <strong> {{$item->name}} </strong>
                            </div>
                        </div>
                        <div class="" style="width: 35%;">
                            <div class="py-1 px-1" style="">
                                <select name="group_id" class="form-control col-md-12 my-1" id="group_{{ $id_select }}" onchange="clearSelects({{ $id_select }})" style="">
                                    <option class="form-control text-center" value="">grupo</option>
                                        @forelse ($groups_sm as $group)
                                            <option class="form-control" value="{{$group->id}}">{{$group->name ." - " . $group->professor->names ." " . $group->professor->first_name." " . $group->professor->second_name }}</option>
                                        @empty
                                            <option class="form-control" value="">No existen grupos para la materia seleccionada</option>
                                        @endempty
                                        @endforelse
                                </select>
                            </div>
                            <div id="option-inscriptions" class="mx-2 row px-1" style="font-size: 14px;">
                                <input id="student-schedule-id-{{$item->id}}" type="number" name="student_schedule_id" style="display: none;">
                                <a id="link-remove-matter-{{$item->id}}" class="" href="#" class="btn btn-primary" data-toggle="modal" data-target="#unregistration" style="display: none; margin-right: 10px;">Retirar Materia</a>
                                <a id="link-take-matter-{{$item->id}}" class="" href="#" class="btn btn-primary" onclick="infReg({{ $item }}, {{ $id_select }}), $('#modal-footer').hide(), $('#info-inscription').hide(), verifyRegistration({{$item->id}})" style="display: none;">Inscribirse</a><br>
                            </div>
                        </div>
                    </div>
                    @php
                        $id_select++;
                    @endphp
                @empty
                    <hr>
                    <div class="alert alert-warning"> No existe oferta de materias para la gestión actual </div>
                @endforelse

            </div>
        </div>
    </div>
</div>

<div id="inf-reg-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content container">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Seleccione un día de trabajo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="text_confirm_reg">

                <table id="schedules-table" class="table table-striped table-light table-responsive" style="">
                    <thead class="">
                        <tr class="text-center">
                            <th class="text-dark" scope="col" style="width: 0%; display: none;">Laboratorio</th>
                            <th class="text-dark" scope="col" style="width: 350px;">Día</th>
                            <th class="text-dark" scope="col" style="width: 0%; display: none;">Periodo</th>
                            <th class="text-dark" style="width: 350px;" scope="col">Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody id="body-table"></tbody>
                </table>
                
                <hr>
                    
                <div id="info-inscription">
                    Se inscribirá en la matería: <strong id="subjectMatter_selected">?</strong>, con el grupo: <strong id="group_selected">?</strong>.
                </div>
            </div>
            
            <div class="modal-body" id="text_select_group" style="display: none;">
                Debe seleccionar un grupo.
            </div>
            
            <div class="modal-footer" id="modal-footer">
                <form id="form-registration" method="POST" action="{{ url('/students/registration/store') }}">
                    {{ csrf_field() }}
                    <input id="block_schedule_id" type="number" name="block_schedule_id" style="display: none;">
                    <input id="group_id_input" type="number" name="group_id" style="display: none;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btn_confirm">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unregistration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Retirar Materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea retirar la materia?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-danger" id="btn-unregister"> Confirmar </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="infoInscription" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estado de inscripción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="info-ins" class="modal-body"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('/js/students.js') }}"></script>
@endpush
