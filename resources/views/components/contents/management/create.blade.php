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
                      <h1 class="h4 text-gray-900 mb-4">Registrar Gestión</h1>
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
                    <form class="user" action="{{Route('managements.store')}}" method="post">
                        {{ csrf_field() }}
                        <label for='name' class="">Año</label>
                        <div class="form-group" {{ $errors->has('managements') ? 'has-error' : ''}}>
                                    <input  type="text"
                                    name="managements"
                                    id="managements"
                                    class="form-control col-md-12"
                                    placeholder="Gestión"
                                    value="{{ old('managements', $managements) }}" readonly>
                        </div>
                        <label for='name' class="">Gestión</label>
                        <div class="form-group" {{ $errors->has('semester') ? 'has-error' : ''}}>
                            <select class="form-control col-md-12" name="semester">
                                @foreach ($semesters as $item)
                                    <option class="form-control" value="{{$item}}">{{$item}}</option>
                                @endforeach
                        </select>
                        </div>
                        <br>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block col-md-12">Registrar</button>
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