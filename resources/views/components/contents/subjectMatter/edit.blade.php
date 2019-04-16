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
                                <label for="">Nombre</label>
                                <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                                    <input type="text" name="name" id="subjectmatter-name" 
                                    class="form-control col-md-12" 
                                    value="{{old('name',$subjectMatter->name)}}"
                                    placeholder="Nombre">
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block col-md-12">Editar</button>
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