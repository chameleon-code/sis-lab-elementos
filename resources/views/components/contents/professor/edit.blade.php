@extends('components.sections.adminSection')
@section('userContent')

<script src="/js/generatekey.js"></script>
<div class="loader"></div>
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-10 col-md-9">
      <div class="card o-hidden border-0 my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Registrar Docente</h1>
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
                    <form class="user" role="form" method="POST" action="{{ Route('professor.update',[$user->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="{{ $errors->has('names') ? ' has-error' : '' }} col-sm-12">
                                <label for="">Nombres</label>
                                <input id="names" type="text" class="form-control" name="names" value="{{ old('names', $user->names) }}" placeholder="Nombres" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="{{ $errors->has('first_name') ? ' has-error' : '' }} col-sm-6 mb-3 mb-sm-0">
                                <label for="">Apellido Paterno</label>
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="Apellido Paterno" required autofocus>
                            </div>
                            <div class="group{{ $errors->has('second_name') ? ' has-error' : '' }} col-sm-6">
                                <label for="">Apellido Materno</label>
                                <input id="second_name" type="text" class="form-control" name="second_name" value="{{ old('second_name', $user->second_name) }}" placeholder="Apellido Materno" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" placeholder="Correo Electrónico" required>
                        </div>
                        <div class="form-group">
                            <label for="">Código SIS</label>
                            <input type="number" class="form-control"  value="{{ old('code_sis', $user->code_sis) }}" name="code_sis" required autofocus>
                        </div>
                        <div class="form-group row"> 
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-sm-12 mb-3 mb-sm-0">
                                <label for="">Contraseña</label>
                                <input id="password" type="text" class="form-control" name="password" placeholder="Contraseña" value="{{ old('password')}}"  onCopy="return false" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row"> 
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Modificar</button>
                            </div>
                            <div class="form-group col-md-6">
                                <a class="btn btn-danger btn-block" href="{{ url('/admin/professors') }}">Cancelar</a>        
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