@extends('components.sections.adminSection')
@section('userContent')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="panel-heading m-0 font-weight-bold text-primary"><strong>{{$title or 'Grupos'}}</strong></div>
            
            <div class="card-body">
                @if (Session::has('status_message'))
                    <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                @endif
                <div class="table-responsive table-striped table-secondary">
                    <div class="row">
                        <div class="col-sm-12">
                                <table class="table dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row" class="bg-dark">
                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 280px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Materia</font></font></th>

                                            <th class="sorting_desc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 150px;" aria-sort="descending"><font style="vertical-align: inherit; color: white;"><font style="vertical-align: inherit;">Nombre</font></font></th>

                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 200px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Docente</font></font></th>
                                            
                                            <th class="sorting text-center color: white;" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="2" aria-label="Age: activate to sort column ascending" style="width: 39px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white;">Acciones</font></font></th>
                                        </tr>
                                    </thead>
                                        
                                    <tbody> 
                                            @foreach ($groups as $item)
                                                <tr role="row" class="odd">
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->subject}}</font></font></td>
                                                    <td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->name}}</font></font></td>
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->professor->first_name ." ". $item->professor->second_name ." ". $item->professor->names}}</font></font></td>
                                                    
                                                    <td>
                                                        <a href="/admin/groups/{{$item->id}}/edit" class="btn btn-warning btn-circle btn-sm"> <i title="Modificar" class="fas fa-edit"></i> </a>
                                                    </td>
                                                    <td>
                                                        <form class="pull-right" action="{{route('groups.destroy',[$item->id])}}" method="POST">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <button class="btn btn-danger btn-circle btn-sm" type="submit"> <i title="Eliminar" class="fas fa-trash"></i> </button>
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