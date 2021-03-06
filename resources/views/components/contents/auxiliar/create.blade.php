@extends('components.sections.adminSection')
@section('userContent')
<script src="/js/generatekey.js"></script>
<div id="overlay" style="background-color:black; opacity: 0.5; position:absolute; top:0; left:0; height:100%; width:100%; z-index:999"> <div class="row justify-content-center align-items-center" style="height: 100vh;"> <div class="preloader"></div> </div>  </div>
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-10 col-md-9">
      <div class="card o-hidden border-0 my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-12">
              <div class="px-5">
                <div class="text-center">
                    <br>
                  <h1 class="h4 text-gray-900 mb-4">Registrar Auxiliar</h1>
                </div>
                    <form class="user" role="form" method="POST" action="{{ url('/admin/auxiliars/store') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="">Nombres</label>
                                <input id="names" type="text" class="form-control col-md-12" name="names" value="{{ old('names') }}" required autofocus>
                                @if ($errors->has('names'))
                                    <span class="help-block text-danger"> {{ $errors->first('names') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Apellido Paterno</label>
                                <input id="first_name" type="text" class="form-control col-md-12" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                    @if ($errors->has('first_name'))
                                        <span class="help-block text-danger"> {{ $errors->first('first_name') }} </span>
                                    @endif
                            </div>
                            <div class="group col-sm-6">
                                <label for="">Apellido Materno</label>
                                <input id="second_name" type="text" class="form-control col-md-12" name="second_name" value="{{ old('second_name') }}" required autofocus>
                                    @if ($errors->has('second_name'))
                                        <span class="help-block text-danger"> {{ $errors->first('second_name') }} </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control col-md-12r" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block text-danger"> {{ $errors->first('email') }} </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="">Código SIS</label>
                                        <input id="code_sis" type="number" class="form-control" name="code_sis" value="{{ old('code_sis') }}" required>
                                        @if ($errors->has('code_sis'))
                                            <span class="help-block text-danger"> {{ $errors->first('code_sis') }} </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="">Tipo de Auxiliar</label>
                                        <select name="type" id="" class="form-control" >
                                            <option value="Regular">Regular</option>
                                            <option value="Asistencia">Asistencia</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="group col-md-6 ">
                                <label for="">Contraseña</label>
                            </div>
                        </div>                        
                        
                        <div class="form-group row"> 
                            <div class="form-group col-md-9">
                                    <input id="password" type="text" class="form-control col-sm-12" name="password" required onCopy="return false" readonly>
                                     @if ($errors->has('password'))
                                        <span class="help-block text-danger"> {{ $errors->first('password') }} </span>
                                    @endif
                            </div>
                            <div class="form-group col-md-3">
                                <button type="button" class="btn btn-warning btn-block col-md-12" onclick="generatePassword();"><i class="fas fa-key"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="group col-md-6 col-6">
                                <button id="register" type="submit" class="btn btn-primary btn-block col-md-12"> Registrar </button>
                            </div>
                            <div class="group col-md-6 col-6">
                                <a class="btn btn-danger btn-block col-md-12" href="{{ url('/admin/auxiliars') }}">Cancelar</a>
                            </div>
                            <br>
                            <br>
                            <br>
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