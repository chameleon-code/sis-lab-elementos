@extends('components.sections.adminSection')
@section('userContent')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="panel-heading m-0 font-weight-bold text-primary">{{$title or 'Lista de Bloques'}}</div>
            
            <div class="card-body">
                @if (Session::has('status_message'))
                    <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                @endif
                <div class="">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                                <table class="table dataTable text-center table-striped table-secondary" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row" class="bg-dark">
                                            <th class="sorting mx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 100px;" aria-sort="descending"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Id</font></font></th>
                                            
                                            <th class="sorting_desc mx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 200px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Materia</font></font></th>
                                            
                                            <th class="sorting mx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 400px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Grupo / s</font></font></th>

                                            <th class="text-center" data-orderable="false" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Acciones</font></font></th>
                                        </tr>
                                    </thead>
                                        {{-- <tfoot>
                                          <tr><th rowspan="1" colspan="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nombre</font></font></th><th rowspan="1" colspan="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Materia</font></font></th><th rowspan="1" colspan="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fecha de Actualización</font></font></th><th rowspan="1" colspan="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ver</font></font></th><th rowspan="1" colspan="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Editar</font></font></th><th rowspan="1" colspan="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Eliminar</font></font></th></tr>
                                        </tfoot> --}}
                                        <tbody> 
                                            @foreach ($blocks as $item)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1 mx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->name}}</font></font></td>

                                                    <td class="mx-1">
                                                        @forelse ($item->groups as $group)
                                                            @if($loop->first)
                                                                {{$group->subject}}
                                                            @endif
                                                        @empty
                                                            No existen grupos en el bloque
                                                        @endforelse
                                                    </td>
                                                    
                                                    <td>
                                                        @forelse ($item->groups as $group)
                                                            {{ $group->name . " - " . $group->professor->names . " " . $group->professor->first_name . " " . $group->professor->second_name }} <br>
                                                        @empty
                                                            No existen grupos en el bloque
                                                        @endforelse
                                                    </td>
                                                    
                                                    <td class="text-center" style="text-align: center; display: flex;">
                                                        <a href="/admin/groups/{{$item->id}}/edit" class="btn btn-warning btn-circle btn-sm mx-1"><i title="Modificar" class="fas fa-edit"></i></a>

                                                        <form class="pull-right" action="{{route('groups.destroy',[$item->id])}}" method="POST">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                <button class="btn btn-danger btn-circle btn-sm mx-1" type="submit"><i title="Eliminar" class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                    
                                                </tr>
                                          @endforeach
                                            
                                        </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection