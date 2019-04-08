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
                      <h1 class="h4 text-gray-900 mb-4">Crear Materia</h1>
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
                    <form class="user" action="{{Route('subjectmatters.store')}}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                            <label for='name' class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-12">
                                <input
                                    type="text"
                                    name="name"
                                    id="subjectmatter-name"
                                    class="form-control"
                                    value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="form-group" {{ $errors->has('management') ? 'has-error' : ''}}>
                            <label for="management" class="col-md-4 control-label">Gestión</label>
                            <div class="col-md-6">
                                <select name="managements_id">
                                    @foreach ($managements as $management)
                                    <option class="form-control" value="{{$management->id}}">{{$management->semester}}-{{$management->managements}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-user btn-block">Send</button>
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