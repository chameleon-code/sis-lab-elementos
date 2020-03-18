@extends('components.sections.studentSection')

@section('userContent')

<style>
    #tittle-card-subject {
        background-image: linear-gradient(180deg, #1cc88a 5%, #466feb 100%);
        display: flex;
        align-items: center;
        border-top-left-radius: 2%;
        border-bottom-left-radius: 2%;
        font-size: 0.75rem;
    }
</style>

<script>
    var groups = {!! json_encode($groups) !!};
    var subjects = {!! json_encode($subjects) !!};
    var student_schedules = {!! json_encode($student_schedules) !!};
</script>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <div class="d-flex justify-content-between">
                <div class="panel-heading m-0 font-weight-bold text-primary">Inscripción</div>
                <div class="mx-3">
                    <a class="py-1" href="#" style="font-size: 14px; width: 100px;" onclick="status()"> Estado de Inscripción </a>
                </div>
            </div>

            <div class="card-body">

                @forelse( $subjects as $subject )
                    <div class="card shadow rounded mb-4" style="padding: 0px 12px;">
                        <div class="row">
                            <div id="tittle-card-subject" class="col-sm-3 text-center text-xs font-weight-bold text-info text-uppercase text-light py-2">
                                <b class=""> {{ $subject->name }} </b>
                            </div>
                            <div class="col-sm-9" style="font-size: 0.8rem;">
                                <div class="card-block px-2 pt-3 pb-2">
                                    <select class="form-control mb-2" name="" id="selector-subject-{{ $subject->id }}">
                                        @forelse ($groups as $group)
                                            @if ($group->subject_matter_id == $subject->id)
                                                <option value="{{ $group->id }}"> Grupo {{ $group->name }} - {{ $group->professor->names }} {{ $group->professor->first_name }} {{ $group->professor->second_name }} </option>
                                            @endif
                                        @empty
                                            <option value="">no hay grupos jaja</option>
                                        @endforelse
                                    </select>
                                    <b id="message-subject-{{ $subject->id }}" class='text-primary mt-4' style='font-size: 13px;'></b>
                                    <br>
                                    <div class="d-flex justify-content-between" style="font-size: 0.9rem;">
                                        <div></div>
                                        <div class="mt-2">
                                            <input id="student-subscription-subject-{{$subject->id}}" type="number" name="student_subscription-subject" hidden>
                                            <a id="subscription-btn-{{ $subject->id }}" href="#" class="" onclick="infoRegistration({{ $subject->id }})" style="display: none;"> Inscribirse </a>
                                            <a id="unsubscription-btn-{{ $subject->id }}" href="#" class="" onclick="removeSubscription({{ $subject->id }})" data-toggle="modal" data-target="#unregistration" style="display: none;"> Retirar materia </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
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
                    <tbody id="body-schedules-table"></tbody>
                </table>
                
                <hr>
                    
                <div id="info-inscription" style="display: none;">
                    Proceder con la inscripción <strong id="selected-subject-name">?</strong>, grupo <strong id="selected-group-name">?</strong> ?
                </div>
            </div>
            
            <div class="modal-body" id="text_select_group" style="display: none;">
                Debe seleccionar un grupo.
            </div>
            
            <div class="modal-footer" id="modal-footer" style="display: none;">
                <form id="form-registration" method="POST" action="{{ url('/students/registration/store') }}">
                    {{ csrf_field() }}
                    <input id="input_block_schedule_id" type="number" name="block_schedule_id" style="display: none;">
                    <input id="input_group_id" type="number" name="group_id" style="display: none;">
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
            <div id="message-remove-subscription" class="modal-body"></div>
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
    <script src="{{ asset('/js/studentRegistration.js') }}"></script>
@endpush
