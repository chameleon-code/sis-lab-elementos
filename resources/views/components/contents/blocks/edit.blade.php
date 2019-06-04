@extends('components.sections.adminSection')

@section('userContent')
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-10 col-md-9">
      <div class="card o-hidden border-0 my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Edicion de Bloques</h1>
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
                            <form class="form-horizontal" action="{{Route('blocks.update',[$block->id])}}" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                {{ csrf_field() }}
                                <div class="form-group" {{ $errors->has('management') ? 'has-error' : ''}}>
                                    <label for="management" class="control-label">Gestión</label>
                                    <select class="form-control col-md-12" name="management_id">
                                            @forelse ($managements as $management)
                                            @if ($block->management_id == $management->id)
                                                <option class="form-control" value="{{$management->id}}" selected>{{$management->semester}}-{{$management->managements}}</option>
                                                @continue
                                            @endif
                                            <option class="form-control" value="{{$management->id}}">{{$management->semester}}-{{$management->managements}}</option>
                                            @empty
                                            <option class="form-control" value="">No existen gestiones registradas</option>
                                            @endempty
                                            @endforelse
                                    </select>
                                </div>
                                <div class="form-group" {{ $errors->has('subject_matter_id') ? 'has-error' : ''}}>
                                <label for="subject_matter_id" class="control-label">Materia</label>
                                <select name="subject_matter_id" class="form-control col-md-12" id="subjects">
                                    @forelse ($subjectMatters as $subjectMatter)
                                        @if ($block->groups->first()->subject->id == $subjectMatter->id)
                                            <option class="form-control" value="{{$subjectMatter->id}}" selected>{{$subjectMatter->name}}</option>    
                                            @continue
                                        @endif
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
                                        <a class="btn btn-md" id="removeGroup"><i class="fas fa-minus-circle"></i></a>  </br>
                                        <div id="groups_container" data-frm="2">
                                            @foreach ($block->groups as $item)
                                                <div id="divgroup{{ $loop->iteration }}"> 
                                                    <br>
                                                    <select class="form-control col-md-12" name="groups_id[]" id="group_id{{ $loop->iteration }}">
                                                    @forelse ($groups as $group)
                                                    @if ($item->id == $group->id)
                                                        <option value="{{ $group->id }}" class="form-control" selected>{{ $group->name . " - " . $group->professor->names . " " . $group->professor->first_name . " " . $group->professor->second_name}}</option>
                                                        @continue
                                                    @endif
                                                        <option value="{{ $group->id }}" class="form-control">{{ $group->name . " - " . $group->professor->names . " " . $group->professor->first_name . " " . $group->professor->second_name}}</option>
                                                    @empty
                                                        <option class="form-control" value=""> No existen grupos para la materia seleccionada</option>
                                                    @endforelse
                                                    </select>
                                                </div>   
                                            @endforeach
                                        </div>
                                </div>
                                <div class="form-group row">
                                        <div class="form-group col-md-6 col">
                                          <button type="submit" class="form-control btn btn-primary btn-block col-md-12">Guardar</button>
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
    <script src="{{ asset('/js/dropdown.js') }}"></script>
@endpush
