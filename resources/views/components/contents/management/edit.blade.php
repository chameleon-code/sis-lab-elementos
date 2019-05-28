
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
                      <h1 class="h4 text-gray-900 mb-4">Editar Gestión</h1>
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
                    <form class="user" action="{{Route('managements.update',[$management->id])}}" method="post">
                        {{ csrf_field() }}
                        <label for="management">Gestión</label>
                        <div class="form-group" {{ $errors->has('managements') ? 'has-error' : ''}}>
                            <input  type="text"
                                    name="managements"
                                    id="managements"
                                    class="form-control col-md-12"
                                    placeholder="Gestión"
                                    value="{{ old('managements', $management->managements) }}" readonly>
                        </div>
                        <label for='name'>Semestre</label>
                        <div class="form-group" {{ $errors->has('semester') ? 'has-error' : ''}}>
                            <select class="form-control col-md-12" name="semester">
                                @foreach ($semesters as $item)
                                            @if ($management->semester== $item)
                                            <option class="form-control" value="{{$item}}" selected>{{$item}}</option>
                                            @continue
                                            @endif
                                            <option class="form-control" value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 col-6">
                              <label for='name' class="">Inicio de Gestión</label>
                              <div>
                                  <input  type="text"
                                          name="start_management"
                                          id="inicio_fecha"
                                          class="form-control col-md-12"
                                          placeholder=""
                                          value="{{ old('start_management',$management->start_management) }}" required readonly>
                              </div>
                          </div>
                          <div class="form-group col-md-6 col-6">
                              <label for='name' class="">Fin de Gestión</label>
                              <div>
                                  <input  type="text"
                                          name="end_management"
                                          id="fin_fecha"
                                          class="form-control col-md-12"
                                          placeholder=""
                                          value="{{ old('end_management',$management->end_management) }}" required readonly>
                              </div>
                          </div>
                        </div>
                        <hr>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-user btn-block col-md-12">Modificar</button>
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