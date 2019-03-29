@extends('components.sections.adminSection')

@section('userContent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Subject-Mattter Create</div>
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
                        
                            <form class="form-horizontal" action="{{Route('subjectmatters.edit',[$subjectMatter->subject_matters_id])}}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                                    <label for='name' class="col-md-4 control-label">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" id="subjectmatter-name" class="form-control" value="{{old('name',$subjectMatter->name)}}">
                                    </div>{{old('descripcion',$subjectMatter->descripcion)}}
                                </div>

                                <div class="form-group" {{ $errors->has('management') ? 'has-error' : ''}}>
                                    <label for="management" class="col-md-4 control-label">Management</label>
                                    <div class="col-md-6">
                                            <select name="managements_id">
                                                @foreach ($managements as $management)
                                                    {{-- <option class="form-control" value="{{$management->managements_id}}">{{$management->semester}}-{{$management->managements}}</option> --}}
                                                @endforeach
                                                {{-- {{old('management_id',$management->managements_id) ? "" : ''}} --}}
                                            </select>
                                    </div>
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