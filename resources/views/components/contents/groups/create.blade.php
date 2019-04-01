@extends('components.sections.adminSection')

@section('userContent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Creacion de grupos</div>
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
                        
                            <form class="form-horizontal" action="{{Route('groups.store')}}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                                    <label for='name' class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" id="group-name" class="form-control" value="{{old('name')}}">
                                    </div>
                                </div>

                                <div class="form-group" {{ $errors->has('group') ? 'has-error' : ''}}>
                                    <label for="management" class="col-md-4 control-label">Materias</label>
                                    <div class="col-md-6">
                                            <select name="subject_matters_id">
                                                @foreach ($subjectMatters as $subjectMatter)
                                                    <option class="form-control" value="{{$subjectMatter->id}}">{{$subjectMatter->name}}</option>
                                                @endforeach
                                           </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Enviar</button>
                                    </div>
                                </div>
                            </form>
                    </div>
            </div>
        </div>
    </div>
    
</div>
@endsection