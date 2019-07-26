@extends('components.sections.professorSection')
@section('userContent')
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            </div>
                <div class="card-body">
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                    <table class="table dataTable text-center table-striped table-secondary" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" >
                                        <thead>
                                            <tr role="row" class="bg-dark">
                                                <th class="sorting_desc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending"  aria-sort="descending" style="width: 15%;"><font style="vertical-align: inherit; color: white;"><font style="vertical-align: inherit;">Numero de grupo</font></font></th>
    
                                                <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" ><font style="vertical-align: inherit;" style="width: 35%;"><font style="vertical-align: inherit; color: white;">Materia</font></font></th>
                                                
                                                <th class="text-center" data-orderable="false" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" ><font style="vertical-align: inherit;" style="width: 10%;"><font style="vertical-align: inherit; color: white;">Descargar</font></font></th>
                                            </tr>
                                        </thead>
                                            
                                        <tbody> 
                                                @foreach ($groups as $item)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1 mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->name}}</font></font></td>
                                                        <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->subject->name}}</font></font></td>
                                                        <td class="row pt-2" style="text-align: center; display: flex;">
                                                            <form class="mx-auto" action="/downloadGroupRegister" method="get">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="group_id" value="{{ $item->id }}">
                                                                <button type="submit" class="btn btn-primary" data-toggle-2="tooltip" title="Descargar portafolios"><i class="fa fa-download" aria-hidden="true"></i></button>
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
@endsection