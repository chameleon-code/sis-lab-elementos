@extends('components.sections.adminSection')

@section('userContent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar grupo</div>
                    <div class="panel-body">
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
                                <div class="col-md-6" {{ $errors->has('management') ? 'has-error' : ''}}>
                                    <label for="management" class="col-md-12 control-label">Gestión</label>
                                    <select class="form-control col-md-12" name="management_id">
                                            @foreach ($managements as $management)
                                            @if ($management->id == $group->management_id)
                                                <option class="form-control" value="{{$management->id}}" selected>{{ $management->semester}} - {{$management->managements}}</option>
                                            @continue
                                            @endif
                                            <option class="form-control" value="{{$management->id}}">{{$management->semester}}-{{$management->managements}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group" {{ $errors->has('subject_matter_id') ? 'has-error' : ''}}>
                                        <label for="subject_matter_id" class="col-md-4 control-label">Materia</label>
                                        <div class="col-md-6">
                                                <select name="subject_matter_id" class="form-control col-md-12" id="subject_matter_id">
                                                    @foreach ($subjectMatters as $subjectMatter)
                                                        @if ($subjectMatter->id == $group->subject_matter_id)
                                                            <option class="form-control" value="{{$subjectMatter->id}}" selected>{{ $subjectMatter->name }}</option>
                                                        @continue
                                                        @endif
                                                        <option class="form-control" value="{{$subjectMatter->id}}">{{ $subjectMatter->name }}</option> --}}
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" {{ $errors->has('name') ? 'has-error' : ''}}>
                                        <label for='name' class="col-md-4 control-label">Grupo: </label>
                                        <div id="contains">
                                            <input type="text" name="name" id="group-name" class="form-control-plaintext col-md-12 form-control-plaintext" value="{{ $group->name }}" readonly>
                                        
                                        </div>
                                    </div>
                                    <div class="col-md-6" {{ $errors->has('group') ? 'has-error' : ''}}>
                                            <label for="professor_id" class="col-md-12 control-label">Docentes: </label>
                                            <select class="form-control col-md-12" name="professor_id" id="professor_id">
                                                @foreach ($professors as $professor)
                                                @if ($professor->id == $group->professor_id)
                                                    <option class="form-control" value="{{$professor->id}}">{{$professor->first_name . " ". $professor->second_name . " " . $professor->names}} selected</option>
                                                    @continue
                                                @endif
                                                <option class="form-control" value="{{$professor->id}}">{{$professor->first_name . " ". $professor->second_name . " " . $professor->names}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Send</button>
                                    </div>
                                </div>
                            </form>
                    </div>
            </div>
        </div>
    </div>
    
</div>
@endsection