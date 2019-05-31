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

                @php
                    $id_select = 1;
                @endphp
                @foreach($subjectMatters as $item)
                @php
                    $groups_sm = App\Group::where("subject_matter_id", "=", $item->id)->get();
                @endphp
                    <div class="flex-row my-2 rounded card shadow">
                        <img class="" style="width:100px; height: 80px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;" src="/img/subjectMatter.jpg" alt="">
                        <div class="py-2 px-3" style="width: 65%;">
                            <strong> {{$item->name}} </strong>
                        </div>
                        <div class="py-3 px-2" style="width: 25%;">
                            <select name="group_id" class="form-control col-md-12" id="group_{{ $id_select }}" onchange="clearSelects({{ $id_select }})">
                                    <option class="form-control text-center" value="">grupo</option>
                                    @forelse ($groups_sm as $group)
                                        <option class="form-control" value="{{$group->id}}">{{$group->name}}</option>
                                    @empty
                                    <option class="form-control" value="">No existen grupos para la materia seleccionada</option>
                                    @endempty
                                    @endforelse
                            </select>
                        </div>
                        <div class="py-4 px-3" style="width: 20%;">
                            <a class="float-right" href="#" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="confirmReg({{ $item }}, {{ $id_select }})">Inscribirse</a><br>
                            {{--  <a class="float-right" href="#" data-toggle="modal" data-target="#registration" onclick="confirmReg({{ $item }}, {{ $id_select }})">Inscribirse</a>  --}}
                        </div>
                    </div>
                @php
                    $id_select++;
                @endphp
                @endforeach

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Seleccione un horario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="text_confirm_reg">

                <table class="table table-striped table-secondary">
                        <thead class="bg-dark">
                          <tr class="text-center">
                            <th scope="col">Laboratorio</th>
                            <th scope="col">Día</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Seleccionar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="text-center">
                            <td>1</td>
                            <td>Martes</td>
                            <td>8:15 - 9-45</td>
                            <td>
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1"></label>
                                </div>
                            </td>
                          </tr>
                          <tr class="text-center">
                            <td>1</td>
                            <td>Viernes</td>
                            <td>11:15 - 12-45</td>
                            <td>
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2"></label>
                                </div>
                            </td>
                          </tr>
                          <tr class="text-center">
                            <td>4</td>
                            <td>Jueves</td>
                            <td>14:15 - 9-45</td>
                            <td>
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3"></label>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>

                      <hr>

            Se inscribirá en la matería: <strong id="subjectMatter_selected">?</strong>, con el grupo: <strong id="group_selected">?</strong>.
            </div>
            <div class="modal-body" id="text_select_group" style="display: none;">
                Seleccione un grupo.
            </div>
    
            
            <div class="modal-footer">
                <form method="POST" action="{{ url('/students/registration/confirm') }}">
                    {{ csrf_field() }}
                    <input id="group_id_input" type="number" name="group_id" style="display: none;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btn_confirm">Confirmar</button>
                </form>
          </div>
    </div>
  </div>
</div>
{{--  
<div class="modal fade" id="registration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Inscripción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="text_confirm_reg">
        Se inscribirá en la matería: <strong id="subjectMatter_selected">?</strong>, con el grupo: <strong id="group_selected">?</strong>.
        </div>
        <div class="modal-body" id="text_select_group" style="display: none;">
            Seleccione un grupo.
        </div>

        
        <div class="modal-footer">
            <form method="POST" action="{{ url('/students/registration/confirm') }}">
                {{ csrf_field() }}
                <input id="group_id_input" type="number" name="group_id" style="display: none;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn_confirm">Confirmar</button>
            </form>
      </div>
    </div>
  </div>
</div>  --}}

<script>
    function clearSelects(id){
        var selects;
        var id_select = 1;
        while(document.getElementById('group_'+id_select)){
            if(id != id_select){
                var select = document.getElementById('group_'+id_select);
                select[0].selected = true;
            }
            id_select++;
        }
    }

    function confirmReg(item, id){
        var select = document.getElementById('group_' + id);
        if(select.options[select.selectedIndex].text !== "grupo"){
            document.getElementById('text_select_group').setAttribute("style", "display: none;");
            document.getElementById('text_confirm_reg').setAttribute("style", "");
            document.getElementById('btn_cancel').setAttribute("style", "");
            document.getElementById('btn_confirm').setAttribute("style", "");
            document.getElementById('subjectMatter_selected').innerHTML = item.name;
            document.getElementById('group_selected').innerHTML = select.options[select.selectedIndex].text;
            document.getElementById('group_id_input').value = select.value;
        } else {
            document.getElementById('text_confirm_reg').setAttribute("style", "display: none;");
            document.getElementById('btn_cancel').setAttribute("style", "display: none;");
            document.getElementById('btn_confirm').setAttribute("style", "display: none;");
            document.getElementById('text_select_group').setAttribute("style", "");
        }
    }
</script>

@endsection

@push('scripts')
    <script src="{{ asset('/js/students.js') }}"></script>
@endpush
