@extends('components.sections.adminSection')
@section('userContent')

<script src="/js/generatekey.js"></script>
<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-0">


            <!-- Nested Row within Card Body -->
            <div class="center">

                    <div class="p-5">

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Registro de Auxiliar</h1>
                    </div>

                    <form class="user text-center" role="form" method="POST" action="{{ url('/admin/auxiliar/store') }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="{{ $errors->has('names') ? ' has-error' : '' }} col-sm-12 mb-3 mb-sm-0">

                                <input id="names" type="text" class="form-control form-control-user" name="names" value="{{ old('names') }}" placeholder="Nombres" required autofocus>

                                @if ($errors->has('names'))
                                    <span class="help-block">
                                   <strong>{{ $errors->first('names') }}</strong>
                               </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                        <div class="{{ $errors->has('first_name') ? ' has-error' : '' }} col-sm-6 mb-3 mb-sm-0">

                            <input id="first_name" type="text" class="form-control form-control-user" name="first_name" value="{{ old('first_name') }}" placeholder="Apellido Paterno" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                        </div>

                            <div class="group{{ $errors->has('second_name') ? ' has-error' : '' }} col-sm-6">

                                <input id="second_name" type="text" class="form-control form-control-user"
                                       name="second_name" value="{{ old('second_name') }}"
                                       placeholder="Apellido Materno" required autofocus>

                                @if ($errors->has('second_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('second_name') }}</strong>
                                    </span>
                                @endif
                        </div>

                    </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input id="email" type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}" placeholder="Dirección Email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-sm-6">
                                    <button type="button" class="btn btn-warning btn-user btn-block col-md-12" onclick="generatePassword();">Generar Contraseña</button>
                            </div>
                            
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-sm-6 mb-3 mb-sm-0">
    
                                    <input id="password" type="text" class="form-control form-control-user" name="password" placeholder="Contraseña" required>
                                    <input id="password-confirm" type="hidden" class="form-control form-control-user" name="password_confirmation" placeholder="Repetir Contraseña">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
<hr>
<hr>
                                <button type="submit" class="btn btn-mary btn-user btn-block">
                                    Registrar
                                </button>

                                <a class="btn btn-danger btn-user btn-block" href="{{ url('/admin/auxiliars') }}">Cancelar</a>
                    </form>

                </div>
            </div>
    </div>
</div>
</body>

@endsection