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
                                <h1 class="h4 text-gray-900 mb-4">Registro de Grupos de Materias</h1>
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
                                <form class="form-horizontal" action="{{Route('groups.update',[$group->id])}}" method="post">
                                        <input type="hidden" name="_method" value="PUT">
                                        {{ csrf_field() }}
                                    <div class="form-group" {{ $errors->has('subject_matter_id') ? 'has-error' : ''}}>
                                        <label for="subject_matter_id" class="control-label">Materia</label>
                                        <select name="subject_matter_id" class="form-control col-md-12" id="subjects">
                                            @forelse ($subjectMatters as $subjectMatter)
                                                @if ($subjectMatter->id == $group->subject->id)
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
                                    <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                                        <label for='name' class="control-label">Grupo: </label>
                                            <select class="form-control col-md-12" name="name" id="name">
                                                @foreach ($groupNames as $item)
                                                    @if ($loop->first)
                                                        <option class="form-control" value="{{ $item }}" selected>{{ $item }}</option>
                                                        @continue
                                                    @endif  
                                                    <option class="form-control" value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group" {{ $errors->has('professor_id') ? 'has-error' : ''}}>
                                            <label for="professor_id" class="control-label">Docentes: </label>
                                            <select class="form-control col-md-12" name="professor_id" id="professor_id">
                                                @foreach ($professors as $professor)
                                                @if ($professor->id == $group->professor->id)
                                                    <option class="form-control" value="{{$professor->id}}" selected>{{$professor->first_name . " ". $professor->second_name . " " . $professor->names}}</option>
                                                    @continue
                                                @endif
                                                <option class="form-control" value="{{$professor->id}}">{{$professor->first_name . " ". $professor->second_name . " " . $professor->names}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <br>
                                    <div class="form-group">
                                            <button type="submit" class="col-md-12 btn btn-primary btn-block">Guardar</button>                                   
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