@extends('components.sections.adminSection')

@section('userContent')

<script>
    var block_groups = {!! json_encode($block_groups) !!}
    var managements = {!! json_encode($managements) !!}
    var groups = {!! json_encode($groups) !!}
</script>

<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-10 col-md-9">
        <div class="card o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Creación de Bloques</h1>
                            </div>

                            @if (count($errors)>0)
                                <div class="alert alert-danger">
                                    <b>Ha ocurrido un error!</b>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="user" action="{{Route('blocks.store')}}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group" {{ $errors->has('management') ? 'has-error' : ''}}>
                                    <label for="management" class="control-label">Gestión</label>
                                    <select class="form-control col-md-12" name="management_id" id="managements" onchange="loadGroups()">
                                        @forelse ($managements as $management)
                                            <option class="form-control" value="{{$management->id}}">{{$management->semester}}/{{$management->managements}}</option>
                                        @empty
                                            <option class="form-control" value="">No existen gestiones registradas</option>
                                        @endempty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group" {{ $errors->has('subject_matter_id') ? 'has-error' : ''}}>
                                    <label for="subject_matter_id" class="control-label">Materia</label>
                                    <select name="subject_matter_id" class="form-control col-md-12" id="subjects" onchange="loadGroups()">
                                        @forelse ($subjectMatters as $subjectMatter)
                                            <option class="form-control" value="{{$subjectMatter->id}}">{{$subjectMatter->name}}</option>
                                        @empty
                                            <option class="form-control" value="">No existen materias registradas</option>
                                        @endempty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group" {{ $errors->has('group_id') ? 'has-error' : ''}}>
                                    <label for="group_id" class="control-label">Grupo: </label>
                                    <a class="btn btn-md" id="addGroups" value="add"><i class="fa fa-plus" aria-hidden="true" aria-hidden="true"></i></a>
                                    <a class="btn btn-md" id="removeGroup"><i class="fas fa-minus"></i></a>  </br>
                                    <div id="groups_container" data-frm="1">
                                        <select class="form-control col-md-12" name="groups_id[]" id="group_id1">
                                            @php
                                                $actual_groups = [];
                                            @endphp
                                            @forelse ($groups as $group)
                                                @php
                                                    $registered = false;
                                                    $last_index_managements = ( sizeof($managements)-1 > 0 ) ? sizeof($managements)-1 : 0;
                                                    foreach( $block_groups as $block_group ) {
                                                        if( $block_group->group_id == $group->id && $block_group->management_id == $managements[$last_index_managements]->id ) {
                                                            $registered = true;
                                                        }
                                                    }
                                                @endphp
                                                @if ( $group->subject->name == $subjectMatters[0]->name && !$registered )
                                                    <option value="{{ $group->id }}" class="form-control">{{ $group->name . " - " . $group->professor->names . " " . $group->professor->first_name . " " . $group->professor->second_name}}</option>
                                                    @php
                                                        array_push($actual_groups, $group);
                                                    @endphp
                                                @endif
                                            @empty
                                                <option class="form-control" value=""> Grupos no disponibles o asignados a otro bloque. </option>
                                            @endforelse
                                            <script> actual_groups = {!! json_encode($actual_groups) !!}; console.log( {!! json_encode($actual_groups) !!} ); </script>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="form-group col-md-6 col">
                                        <button type="submit" class="form-control btn btn-primary btn-block col-md-12">Crear</button>
                                    </div>
                                    <div class="form-group col-md-6 col">
                                        <a class="form-control btn btn-danger btn-block col-md-12" href="{{ url('/admin/blocks') }}">Cancelar</a>    
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script  src="{{ asset('/js/create_block.js') }}"></script>
@endpush
