@extends('components.sections.adminSection')
@section('userContent')
<script src="/js/generatekey.js"></script>
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-10 col-md-9">
      <div class="card o-hidden border-0 my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Registrar Estudiante</h1>
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
                        <form class="user" role="form" method="POST" action="{{ url('student/register') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Nombres</label>
                                <input type="text" class="form-control" name="names" value="{{ old('names')}}" required autofocus>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <div class="">
                                            <label for="">Apellido Paterno</label>  
                                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name')}}" required autofocus>
                                        </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <div class="">
                                            <label for="">Apellido Materno</label>  
                                            <input type="text" class="form-control" name="second_name" value="{{ old('second_name')}}"required autofocus> 
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="">Correo Electrónico</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email')}}" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="">
                                        <label for="">Código SIS</label>  
                                        <input type="number" class="form-control" name="code_sis" value="{{ old('code_sis')}}" required autofocus min="0">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="">
                                        <label for="">Cédula de Identidad</label>  
                                        <input type="number" class="form-control" name="ci" value="{{ old('ci')}}" required autofocus min="0"> 
                                    </div>
                                </div>
                            </div>
                            <label for="">Contraseña</label>
                            <div class="form-group row">
                                <div class="group col-md-9 col-sm-9 col-8">
                                    <input type="text" id="password" onCopy="return false" readonly class="form-control col-md-12" name="password" required>
                                </div>
                                <div class="group col-md-3 col-sm-3 col-4">
                                    <button type="button" class="btn btn-warning btn-block col-md-12" onclick="generatePassword();" title="Generar Contraseña"><i class="fas fa-key"></i></button>
                                </div>                
                            </div>  
                            <br>
                            <div class="form-group row">
                                    <div class="form-group col-md-6 col">
                                      <button type="submit" class="form-control btn btn-primary btn-block col-md-12">Registrar</button>
                                    </div>
                                    <div class="form-group col-md-6 col">
                                      <a class="form-control btn btn-danger btn-block col-md-12" href="{{ url('/admin/students') }}">Cancelar</a>    
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