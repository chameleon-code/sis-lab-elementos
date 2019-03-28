@extends('components.sections.adminSection')
@section('userContent')
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
                <form class="user" method="POST">
                  {!! csrf_field() !!}
                  <div class="form-group">
                        <input type="text" class="form-control col-md-12 form-control-user" id="exampleInputEmail" placeholder="Nombres" name="names">
                          {!! $errors -> first('names','<label style="color:crimson">:message</label>')!!} 
                  </div>    
                  <div class="form-group">
                        <input type="text" class="form-control col-md-12 form-control-user" id="exampleInputEmail" placeholder="Apellidos" name="lastnames">
                          {!! $errors -> first('lastnames','<label style="color:crimson">:message</label>')!!}  
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control col-md-12 form-control-user" id="exampleInputEmail" placeholder="Introduzca el correo" name="email">
                          {!! $errors -> first('email','<label style="color:crimson">:message</label>')!!} 
                  </div>
                  <button class="btn btn-warning btn-user btn-block col-md-12">Generar Contraseña</button>
                  <br>
                  <div class="form-group">
                    <input type="text" readonly class="form-control col-md-12 form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                          {!! $errors -> first('password','<label style="color:crimson">:message</label>')!!} 
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block col-md-12">Registrar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection