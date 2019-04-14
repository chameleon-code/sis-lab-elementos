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
                <form class="user" method="POST" action="">
                  {!! csrf_field() !!}
                  <div class="form-group">
                        <input type="text" class="form-control col-md-12 form-control-user" placeholder="Nombres" name="names" required autofocus>
                          {!! $errors -> first('names','<label style="color:crimson">:message</label>')!!} 
                  </div>    
                  <div class="form-group row">
                      <div class="group col-md-6 ">
                        <input type="text" class="form-control form-control-user" placeholder="Apellido Paterno" name="first_name" required autofocus>
                          {!! $errors -> first('first_name','<label style="color:crimson">:message</label>')!!}  
                      </div>
                      <div class="group col-md-6 ">
                          <input type="text" class="form-control form-control-user" placeholder="Apellido Materno" name="second_name" required autofocus> 
                          {!! $errors -> first('second_name','<label style="color:crimson">:message</label>')!!}  
                      </div>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control col-md-12 form-control-user" placeholder="Correo Electrónico" name="email" required>
                          {!! $errors -> first('email','<label style="color:crimson">:message</label>')!!} 
                  </div>
                  <div class="form-group row">
                    <div class="group col-md-9">
                        <input type="text" id="password" onCopy="return false" readonly class="form-control col-md-12 form-control-user"  placeholder="Contraseña" name="password" required>
                        {!! $errors -> first('password','<label style="color:crimson">:message</label>')!!} 
                    </div>
                    <div class="group col-md-3">
                        <button type="button" class="btn btn-warning btn-user btn-block col-md-12" onclick="generatePassword();" title="Generar Contraseña"><i class="fas fa-key"></i></button>
                    </div>                
                  </div>  
                  <br>
                  <div class="form-group row">
                      <div class="group col-md-6 ">
                        <button type="submit" class="btn btn-primary btn-user btn-block col-md-12">Registrar</button>
                      </div>
                      <div class="group col-md-6 ">
                        <a type="submit" class="btn btn-danger btn-user btn-block col-md-12" href="{{ url('/admin/professors') }}">Cancelar</a>    
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