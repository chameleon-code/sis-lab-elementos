@extends('components.sections.auxiliarControlSection')
@section('userContent')

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 font-weight-bold text-primary container">Control de Portafolios</div>
                <br>
                <div class="col-sm-3">
                    <select class="form-control" name="bloques" id="select-labs" >
                        @foreach ($list as $item)
                            <option class="form-control" value="{{$item->laboratory->id}}">Laboratorio {{$item->laboratory->name}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- @foreach ($list as $item)
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                        <table class="table dataTable text-center table-striped table-secondary" id="dataTable" width="100%"
                                            cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                            style="width: 100%;">
                                        <thead>
                                        <tr role="row" class="bg-dark">
                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Name: activate to sort column ascending"
                                                style="width: 230px;"><font style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit; color: white;">Código SIS</font></font></th>

                                            <th class="sorting_desc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 380px;" aria-sort="descending"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit; color: white;">Apellidos</font></font></th>

                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 380px;"><font style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit; color: white;">Nombres</font></font></th>

                                            <th class="text-center" data-orderable="false"
                                                rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">
                                                <font style="vertical-align: inherit;"><font
                                                style="vertical-align: inherit; color: white;">Acciones</font></font></th>
                                        </tr>
                                        </thead>
                                        <tbody>   
                                            {{-- <tr role="row" class="odd">
                                                <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">hola</font></font></td>
                                                <td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">hi</font></font></td>
                                                <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">lol</font></font></td>
                                                <td class="text-center" style="text-align: center; display: flex;">
                                                                                                        
                                                </td>
                                            </tr> --}}
                                            {{-- @foreach ($item->students as $student)
                                                <tr role="row" class="odd">
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $student->student->code_sis }}</font></font></td>
                                                    <td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $student->student->first_name }} {{ $student->student->second_name }}</font></font></td>
                                                    <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $student->student->names }}</font></font></td>
                                                    <td class="text-center" style="text-align: center; display: flex;">
                                                                                                            
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </div>

@endsection
