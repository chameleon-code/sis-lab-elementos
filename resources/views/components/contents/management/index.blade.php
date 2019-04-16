@extends('components.sections.adminSection')
@section('userContent')
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 font-weight-bold text-primary"><strong>{{$title or 'Gestión'}}</strong></div>
                
                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                    @endif
                    <div class="table-responsive table-striped table-secondary">
                        <div class="col-sm-12">
                            <table class="table dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row" class="bg-dark">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 200px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Gestion</font></font></th>

                                            <th class="sorting_desc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 100px;" aria-sort="descending"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Semestre</font></font></th>

                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 200px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fecha de creación</font></font></th>
                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 200px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fecha Actualizacion</font></font></th>

                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="2" aria-label="Start date: activate to sort column ascending" style="width: 88px;"><font style="vertical-align: inherit;"><font style="color: white; vertical-align: inherit;">Acciones</font></font></th>
                                        </tr>
                                    </thead>
                                        <tbody> 
                                            @foreach ($managements as $item)
                                                <tr role="row" class="odd">
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->managements}}</font></font></td>
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->semester}}</font></font></td>
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->created_at}}</font></font></td>
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->updated_at}}</font></font></td>
                                                    <td class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        <a href="/admin/management/{{$item->id}}/edit" class="btn btn-warning btn-circle btn-sm"> <i title="Modificar" class="fas fa-edit"></i> </a>
                                                    </font></font></td>
                                                    <td class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            <button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar{{ $item->id }}"> <i title="Eliminar" class="fas fa-trash"></i> </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="eliminar{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel"> Eliminar Gestión </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body text-left">
                                                                            ¿Esta seguro que desea eliminar la Gestión {{ $item->name }}?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                        <input type="hidden" id="id_auxiliar">
                                                                            <form class="pull-right" action="{{route('managements.destroy',[$item->id])}}" method="POST">
                                                                                {{csrf_field()}}
                                                                                {{method_field('DELETE')}}
                                                                                <button class="btn btn-danger btn-user btn-block" type="submit">Borrar</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </font></font></td>
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
@endsection