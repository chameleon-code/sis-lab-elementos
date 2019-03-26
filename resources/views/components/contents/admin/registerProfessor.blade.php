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
                <form class="user">
                  <div class="form-group">
                        <input type="text" class="form-control col-md-12 form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Nombres">
                  </div>    
                  <div class="form-group">
                        <input type="text" class="form-control col-md-12 form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Apellidos">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control col-md-12 form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Introduzca el correo">
                  </div>
                  <a href="index.html" class="btn btn-warning btn-user btn-block col-md-12">
                    Generar Contraseña
                  </a>
                  <br>
                  <div class="form-group">
                    <input type="password" class="form-control col-md-12 form-control-user" id="exampleInputPassword" placeholder="Password">
                  </div>
                  <a href="index.html" class="btn btn-primary btn-user btn-block col-md-12">
                    Registrar
                  </a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
@endsection