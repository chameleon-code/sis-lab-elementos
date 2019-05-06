@extends('components.sections.studentSection')

@section('userContent')
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-10 col-md-9">
      <div class="card o-hidden border-0 my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Inscripción</h1>
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

                                <div class="form-group" {{ $errors->has('group_id') ? 'has-error' : ''}}>
                                    <label for="group_id" class="control-label">Grupo / s:</label>
                                    <select name="group_id" class="form-control col-md-12" id="groups">
                                        @forelse ($groups as $group)
                                            <option class="form-control" value="{{$group->id}}">{{$group->name}}</option>
                                        @empty
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
                                        <a class="form-control btn btn-danger btn-block col-md-12" href="{{ url('/admin/blocks') }}">Cancelar</a>    
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
@push('scripts')
    <script src="{{ asset('/js/addingObjs.js') }}"></script>
    <script src="{{ asset('/js/dropdown.js') }}"></script>
@endpush
