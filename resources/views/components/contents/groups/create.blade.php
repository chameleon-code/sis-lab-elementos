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
                  <h1 class="h4 text-gray-900 mb-4">Creación de Grupos</h1>
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
                        
                            <form class="user" action="{{Route('groups.store')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group" {{ $errors->has('group') ? 'has-error' : ''}}>
                                    <label for="subject_matters_id" class="col-md-12 control-label">Materias</label>
                                    <select name="subject_matters_id" class="form-control col-md-12" id="subjects">
                                        <option value="">--Seleccione una materia--</option>
                                        @foreach ($subjectMatters as $subjectMatter)
                                            <option class="form-control" value="{{$subjectMatter->id}}">{{$subjectMatter->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                                    <label for='name' class="col-md-4 control-label">Nombre</label>
                                    <div id="contains">
                                        <input type="text" name="name" id="group-name" class="form-control col-md-12 form-control-plaintext" value="Seleccione una materia" readonly>
                                    
                                    </div>
                                </div>
                                <div class="form-group" {{ $errors->has('group') ? 'has-error' : ''}}>
                                        <label for="professor_id" class="col-md-12 control-label">Docentes: </label>
                                        <select class="form-control col-md-12" name="professor_id" id="professor_id">
                                            <option value="">--Seleccione una materia--</option>
                                        </select>
                                    </div>
                                
                                <div class="form-group">
                                     <button type="submit" class="col-md-12 btn btn-primary btn-user btn-block">Crear</button>
                                   
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
@push('scripts')
    <script src="{{ asset('js/dropdown.js') }}"></script>
@endpush