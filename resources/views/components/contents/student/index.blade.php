@extends('components.sections.studentSection')
@section('userContent')

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 font-weight-bold text-primary">Estudiantes</div>

                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success">{{Session::get('status_message')}}</p>
                    @endif
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                       cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                       style="width: 100%;">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Name: activate to sort column ascending"
                                            style="width: 99px;"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Ap. Paterno</font></font></th>

                                        <th class="sorting_desc" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Position: activate to sort column ascending"
                                            style="width: 137px;" aria-sort="descending"><font
                                                    style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Ap. Materno</font></font></th>

                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Office: activate to sort column ascending"
                                            style="width: 69px;"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Nombres</font></font></th>

                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Office: activate to sort column ascending"
                                            style="width: 69px;"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Email</font></font></th>

                                        <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="3" aria-label="Age: activate to sort column ascending"
                                            style="width: 39px;"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit;">Acciones</font></font></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($students as $student)

                                        <tr role="row" class="odd">
                                            <td class=""><font style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">{{ $student->first_name }}</font></font>
                                            </td>
                                            <td class="sorting_1"><font style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">{{ $student->second_name }}</font></font>
                                            </td>
                                            <td><font style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">{{ $student->names }}</font></font>
                                            </td>
                                            <td><font style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">{{ $student->email }}</font></font>
                                            </td>

                                            <td style="width: 40px;" class="text-center">
                                                <a href="#" class="btn btn-info btn-circle"><i title="Ver detalles"
                                                                                               class="fas fa-eye"></i></a>
                                            </td>
                                            <td style="width: 40px;" class="text-center">
                                                <a href="#" class="btn btn-warning btn-circle"><i title="Modificar"
                                                                                                  class="fas fa-edit"></i></a>
                                            </td>
                                            <td style="width: 40px;" class="text-center">
                                                <form action="{{route('student.destroy',[$student->id])}}" method="POST">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button class="btn btn-danger btn-circle" type="submit"><i
                                                                title="Eliminar" class="fas fa-trash"></i></button>
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
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">

                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection