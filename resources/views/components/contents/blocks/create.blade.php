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
                  <h1 class="h4 text-gray-900 mb-4">Creación de Bloques</h1>
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
                        
                            <form class="user" action="{{Route('blocks.store')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group" {{ $errors->has('subject_matter_id') ? 'has-error' : ''}}>
                                    <label for="subject_matter_id" class="control-label">Materias</label>
                                    <select name="subject_matter_id" class="form-control col-md-12" id="subjects">
                                        @forelse ($subjectMatters as $subjectMatter)
                                            <option class="form-control" value="{{$subjectMatter->id}}">{{$subjectMatter->name}}</option>
                                        @empty
                                        <option class="form-control" value="">No existen materias registradas</option>
                                        @endempty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                                    <label for='name' class="control-label">Nombre: </label>
                                        <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group" {{ $errors->has('group_id') ? 'has-error' : ''}}>
                                        <label for="group_id" class="control-label">Grupo: </label>
                                        <a class="btn btn-md" id="addGroups" value="add"><i class="fa fa-plus" aria-hidden="true" aria-hidden="true"></i></a> </br></br>
                                        <div id="groups_container">
                                            <select class="form-control col-md-12" name="groups_id[]" id="group_id1">
                                                <option class="form-control" value="">-- Seleccione una materia --</option>
                                            </select>
                                            </br>
                                        </div>
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
    <script src="{{ asset('/js/addingObjs.js') }}"></script>
    <script src="{{ asset('/js/dropdown.js') }}"></script>
@endpush
