@extends('components.sections.adminSection')
@section('userContent')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="panel-heading m-0 font-weight-bold text-primary">{{$title or 'users'}}</div>
            
            <div class="card-body">
                @if (Session::has('status_message'))
                    <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                @endif
                <div class="table-responsive">
                    
                        <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 99px;">
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Gestion</font></font></th>

                                            <th class="sorting_desc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 137px;" aria-sort="descending"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Semestre</font></font></th>

                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 69px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fecha de creación</font></font></th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 39px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fecha Actualizacion</font></font></th>

                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 88px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Editar</font></font></th>
                                            
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 57px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Eliminar</font></font></th>
                                        </tr>
                                    </thead>
                                        <tbody> 
                                            @foreach ($managements as $item)
                                                <tr role="row" class="odd">
                                                    <td class=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->managements}}</font></font></td>
                                                    <td class="sorting_1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->semester}}</font></font></td>
                                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->created_at}}</font></font></td>
                                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->updated_at}}</font></font></td>
                                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        <a href="/admin/management/{{$item->id}}/edit" class="btn btn-warning btn-user btn-block">Edit</a>
                                                    </font></font></td>
                                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        <form class="pull-right" action="{{route('managements.destroy',[$item->id])}}" method="POST">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <button class="btn btn-danger btn-user btn-block" type="submit">Borrar</button>
                                                        </form>
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