@extends('components.sections.studentSection')

@section('userContent')

                
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="panel-heading m-0 font-weight-bold text-primary container">Inscripción</div>
            <div class="card-body">                
                
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


                {{--  <form class="user" action="{{Route('student.reg.confirm')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group" {{ $errors->has('subject_matter_id') ? 'has-error' : ''}}>
                            <label for="subject_matter_id" class="control-label">Materia: </label>
                            <select name="subject_matter_id" class="form-control col-md-12" id="subjects">
                                <option class="form-control" value="">Seleccione una materia (opcional)</option>
                                @forelse ($subjectMatters as $subjectMatter)
                                    <option class="form-control" value="{{$subjectMatter->id}}">{{$subjectMatter->name}}</option>
                                @empty
                                <option class="form-control" value="">No existen materias registradas</option>
                                @endempty
                                @endforelse
                            </select>
                        </div>
                    <div class="form-group" {{ $errors->has('block_id') ? 'has-error' : ''}}>
                        <label for="block_id" class="control-label">Bloque / s:</label>
                        <select name="block_id" class="form-control col-md-12" id="blocks">
                            @forelse ($blocks as $block)
                                <option class="form-control" value="{{$block->id}}">{{$block->name}}</option>
                            @empty
                            <option class="form-control" value="">No existen bloques registrados</option>
                            @endempty
                            @endforelse
                        </select>
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
                            <form class="user" action="{{Route('student.reg.confirm')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group" {{ $errors->has('subject_matter_id') ? 'has-error' : ''}}>
                                        <label for="subject_matter_id" class="control-label">Materia: </label>
                                        <select name="subject_matter_id" class="form-control col-md-12" id="subjects">
                                            <option class="form-control" value=""> Seleccione una materia </option>
                                            @forelse ($subjectMatters as $subjectMatter)
                                                <option class="form-control" value="{{$subjectMatter->id}}">{{$subjectMatter->name}}</option>
                                            @empty
                                            <option class="form-control" value="">No existen materias registradas</option>
                                            @endempty
                                            @endforelse
                                        </select>
                                    </div>
                                <div class="form-group" {{ $errors->has('block_id') ? 'has-error' : ''}}>
                                    <input type="hidden" name="block_id" value="" id="block_id"/>
                                </div>

                                <div class="form-group" id="groups_ids" {{ $errors->has('group_id') ? 'has-error' : ''}}>
                                    <label for="group_id" class="control-label">Grupo / s:</label>
                                    <select name="group_id" class="form-control col-md-12" id="groups">
                                        {{--@forelse ($groups as $group)--}}
                                         {{--   <option class="form-control" value=""></option> --}}
                                        {{--@empty
                                        <option class="form-control" value="">No existen bloques registrados</option>
                                        @endempty
                                        @endforelse
                                    </select>
                                </div>
                                <br>

                    <div class="form-group row">
                        <div class="form-group col-md-6 col">
                            <button type="submit" class="form-control btn btn-primary btn-block col-md-12">Inscribirse</button>
                        </div>
                        <div class="form-group col-md-6 col">
                            <a class="form-control btn btn-danger btn-block col-md-12" href="{{ url('/home') }}">Cancelar</a>    
                        </div>
                    </div>
                </form>  --}}

                @foreach($subjectMatters as $item)
                    <div class="flex-row my-2 rounded card shadow">
                        <img class="" style="width:100px; height: 75px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;" src="/img/subjectMatter.jpg" alt="">
                        <div class="py-2 px-3" style="width: 65%;">
                            <strong> {{$item->name}} </strong>
                        </div>
                        <div class="py-3 px-2" style="width: 25%;">
                            <select name="group_id" class="form-control col-md-12" id="groups">
                                    <option class="form-control text-center" value="">grupo</option>
                                    @forelse ($groups as $group)
                                        <option class="form-control" value="{{$group->id}}">{{$group->name}}</option>
                                    @empty
                                    <option class="form-control" value="">No existen grupos para la materia seleccionada</option>
                                    @endempty
                                    @endforelse
                            </select>
                        </div>
                        <div class="py-3 px-3" style="width: 20%;">
                            <a class="float-right" href="#" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Horarios</a><br>
                            <a class="float-right" href="#" data-toggle="modal" data-target="#registration">Inscribirse</a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Horarios</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="registration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Inscripción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Se inscribirá en la matería: <strong>?</strong>, con el grupo: <strong>?</strong>.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Confirmar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('/js/students.js') }}"></script>
@endpush
