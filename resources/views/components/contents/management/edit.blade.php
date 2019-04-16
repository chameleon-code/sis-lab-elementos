
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
                      <h1 class="h4 text-gray-900 mb-4">Crear Gestión</h1>
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

                        <div class="form-group" {{ $errors->has('managements') ? 'has-error' : ''}}>
                            <label for="management" class="col-md-12 control-label">Gestión</label>
                            <input  type="text"
                                    name="managements"
                                    id="managements"
                                    class="form-control col-md-12 form-control-user"
                                    placeholder="Gestión"
                                    value="{{ old('managements', $management->managements) }}" readonly>
                        </div>
                        <div class="form-group" {{ $errors->has('semester') ? 'has-error' : ''}}>
                            <label for='name' class="col-md-12 control-label">Semestre</label>
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
                        <hr>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-user btn-block col-md-12">Crear</button>
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