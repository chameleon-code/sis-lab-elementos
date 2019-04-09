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
                      <h1 class="h4 text-gray-900 mb-4">Editar Materia</h1>
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
                            <form class="user" action="{{Route('subjectmatters.update',[$subjectMatter->id])}}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                                    <label for='name' class="col-md-4 control-label">Nombre</label>
                                    <input type="text" name="name" id="subjectmatter-name" 
                                    class="form-control col-md-12 form-control-user" 
                                    value="{{old('name',$subjectMatter->name)}}">
                                    {{-- {{old('descripcion',$subjectMatter->descripcion)}} --}}
                                </div>

                                <div class="form-group" {{ $errors->has('management') ? 'has-error' : ''}}>
                                    <label for="management" class="col-md-12 control-label">Gestión</label>
                                    <select class="form-control col-md-12" name="managements_id">
                                        @foreach ($managements as $management)
                                            @if ($management->id == $management_id)
                                            <option class="form-control" value="{{$management->id}}" selected>{{$management->semester}}-{{$management->managements}}</option>
                                            @continue
                                            @endif
                                            <option class="form-control" value="{{$management->id}}">{{$management->semester}}-{{$management->managements}}</option>
                                        @endforeach
                                        {{-- {{old('management_id',$management->managements_id) ? "" : ''}} --}}
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-user btn-block col-md-12">Editar</button>
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