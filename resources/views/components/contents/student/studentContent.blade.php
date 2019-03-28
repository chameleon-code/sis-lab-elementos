@extends('components.sections.studentSection')
@section('userContent')

    <content class="contentmin">
        <div class="container contentmin">
            <div class="row contentmin">
                <div class="col-2 ">
                    <ul class="nav flex-column">
                        @if(\App\User::navigation() == 'admin')
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ url('components/contents/student/'.$student->user_id.'/edit')}}">Editar</a>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                    Eliminar
                                </button>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-10">
                    <img src="{{ asset('0_200.png')}}" class="img-thumbnail d-block" alt="...">
                    <h3>
                        Estudiate :
                        <small class="text-muted">
                            {{ $student->nombres }}
                            {{ $estudiante->ap_paterno }}
                            {{ $estudiante->ap_materno }}
                        </small>
                        <br>
                        @if(\App\User::navigation() == 'admin')
                            Codigo SIS:
                            <small class="text-muted">
                                {{ $estudiante->codigo_sis }}
                            </small><br>
                            CI:
                            <small class="text-muted">
                                {{ $estudiante->ci }}
                            </small><br>
                        @endif
                        Carrera:
                        <small class="text-muted">
                            {{ $estudiante->carrera->nombre }}
                        </small>
                        <br>
                        Telefono:
                        <small class="text-muted">
                            {{ $estudiante->telefono }}
                        </small>
                        <br>

                    </h3>
                </div>
            </div>
        </div>
    </content>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">Eliminar Estudiante</h4>
                </div>
                <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST">
                    <input type="hidden" name="_method" value="delete"/>
                    {!! csrf_field() !!}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection