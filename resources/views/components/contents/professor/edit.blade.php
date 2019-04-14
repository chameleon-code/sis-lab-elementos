@extends('components.sections.adminSection')
@section('userContent')

<script src="/js/generatekey.js"></script>
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
                    <form class="user" role="form" method="POST" action="{{ Route('professor.update',[$user->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="{{ $errors->has('names') ? ' has-error' : '' }} col-sm-12">
                                <label for="">Nombres</label>
                                <input id="names" type="text" class="form-control" name="names" value="{{ old('names', $user->names) }}" placeholder="Nombres" required autofocus>
                                @if ($errors->has('names'))
                                    <span class="help-block"> {{ $errors->first('names') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                                <div class="group col-md-6 ">
                                  <label for="">Apellido Paterno</label>
                                </div>
                                <div class="group col-md-6 ">
                                    <label for="">Apellido Materno</label>                      
                                </div>  
                        </div>
                        <div class="form-group row">
                            <div class="{{ $errors->has('first_name') ? ' has-error' : '' }} col-sm-6 mb-3 mb-sm-0">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="Apellido Paterno" required autofocus>
                                    @if ($errors->has('first_name'))
                                        <span class="help-block"> {{ $errors->first('first_name') }} </span>
                                    @endif
                            </div>
                            <div class="group{{ $errors->has('second_name') ? ' has-error' : '' }} col-sm-6">
                                <input id="second_name" type="text" class="form-control" name="second_name" value="{{ old('second_name', $user->second_name) }}" placeholder="Apellido Materno" required autofocus>
                                    @if ($errors->has('second_name'))
                                        <span class="help-block"> {{ $errors->first('second_name') }} </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" placeholder="Correo Electrónico" required>
                            @if ($errors->has('email'))
                                <span class="help-block"> {{ $errors->first('email') }} </span>
                            @endif
                        </div>

                        <div class="form-group row"> 
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-sm-12 mb-3 mb-sm-0">
                                <label for="">Contraseña</label>
                                <input id="password" type="text" class="form-control" name="password" placeholder="Contraseña" value="{{ old('password')}}"  onCopy="return false" required>
                                @if ($errors->has('password'))
                                    <span class="help-block"> {{ $errors->first('password') }}</strong> </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group row"> 
                            <div class="group col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Modificar</button>
                            </div>
                            <div class="group col-md-6">
                                <a type="button" class="btn btn-danger btn-block" href="{{ url('/admin/professors') }}">Cancelar</a>        
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