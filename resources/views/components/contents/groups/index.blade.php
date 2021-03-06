@extends('components.sections.adminSection')
@section('userContent')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="panel-heading m-0 font-weight-bold text-primary container">{{$title or 'Grupos'}}</div>
            
            <div class="card-body">
                @if (Session::has('status_message'))
                    <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                @endif
                <div class="">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                                <table class="table dataTable text-center table-striped table-secondary" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" >
                                    <thead>
                                        <tr role="row" class="bg-dark">
                                            <th class="sorting_desc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending"  aria-sort="descending" style="width: 15%;"><font style="vertical-align: inherit; color: white;"><font style="vertical-align: inherit;">Grupo</font></font></th>

                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" ><font style="vertical-align: inherit;" style="width: 35%;"><font style="vertical-align: inherit; color: white;">Materia</font></font></th>

                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" ><font style="vertical-align: inherit;" style="width: 40%;"><font style="vertical-align: inherit; color: white;">Docente</font></font></th>
                                            
                                            <th class="text-center" data-orderable="false" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" ><font style="vertical-align: inherit;" style="width: 10%;"><font style="vertical-align: inherit; color: white;">Acciones</font></font></th>
                                        </tr>
                                    </thead>
                                        
                                    <tbody> 
                                            @foreach ($groups as $item)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->name}}</font></font></td>
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->subject->name}}</font></font></td>
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->professor->first_name ." ". $item->professor->second_name ." ". $item->professor->names}}</font></font></td>
                                                    
                                                    <td class="text-center" style="text-align: center; display: inline-flex;">
                                                        <a href="/admin/groups/{{$item->id}}/edit" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="tooltip" title="Editar"> <i class="fas fa-edit"></i> </a>
                                                        <form class="pull-right" action="{{route('groups.destroy',[$item->id])}}" method="POST">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                <button class="btn btn-danger btn-circle btn-sm mx-1" type="submit" data-toggle="tooltip" title="Eliminar"> <i class="fas fa-trash"></i> </button>
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