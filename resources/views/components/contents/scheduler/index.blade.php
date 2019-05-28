@extends('components.sections.adminSection')
@section('userContent')
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 font-weight-bold text-primary">{{$title or 'Gestión'}}</div>
                
                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                    @endif
                    <div class="">
                        <div class="col-sm-12 table-responsive text-center">
                            <div class="col-sm-3">
                                <select class="form-control" name="laboratory" id="laboratory">
                                    @foreach ($laboratories as $item)
                                        <option class="form-control" value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach    
                                </select>
                            </div>
                            <br>
                            <table class="table table-striped">
                                
                                <thead>
                                    <tr>
                                        <th class="text-dark" scope="row">Dias</th>
                                        @foreach ($days as $item)
                                            <th class="text-dark" data-days_id="{{$item->id}}">{{$item->name}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hours as $item)
                                            <tr class="" data-id="{{$item->id}}" >
                                                <td class="" data-hours_id="{{$item->id}}">{{$item->start}}-{{$item->end}}</td>
                                                <td class="td-line" >
                                                    <div id="r{{$item->id}}c1" class="col-sm-12 nopadding"></div>
                                                    <div class="col-sm-12 text-center">
                                                        <button id="edit-r{{$item->id}}c1" data-row="r{{$item->id}}c1" data-col="1" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </td>
                                                <td class="td-line" >
                                                    <div id="r{{$item->id}}c2" class="col-sm-12 nopadding"></div>
                                                    <div class="col-sm-12 text-center">
                                                        <button id="edit-r{{$item->id}}c2" data-row="r{{$item->id}}c2" data-col="2" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </td>
                                                <td class="td-line">
                                                    <div id="r{{$item->id}}c3" class="col-sm-12 nopadding"></div>
                                                    <div class="col-sm-12 text-center">
                                                        <button id="edit-r{{$item->id}}c3" data-row="r{{$item->id}}c3" data-col="3" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </td>
                                                <td class="td-line" >
                                                    <div id="r{{$item->id}}c4" class="col-sm-12 nopadding"></div>
                                                    <div class="col-sm-12 text-center">
                                                        <button id="edit-r{{$item->id}}c4" data-row="r{{$item->id}}c4" data-col="4" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </td>
                                                <td class="td-line" >
                                                    <div id="r{{$item->id}}c5" class="col-sm-12 nopadding"></div>
                                                    <div class="col-sm-12 text-center">
                                                        <button id="edit-r{{$item->id}}c5" data-row="r{{$item->id}}c5" data-col="5" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </td>
                                                <td class="td-line" >
                                                    <div id="r{{$item->id}}c6" class="col-sm-12 nopadding"></div>
                                                    <div class="col-sm-12 text-center">
                                                        <button id="edit-r{{$item->id}}c6" data-row="r{{$item->id}}c6" data-col="6" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                                    </div>
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

<!-- append modal set data -->
<div class="modal fade" id="DataEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumb-tack"></i>Agregar Horario</h4>
                <button type="button" class="close canceltask" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
            </div>
            <div class="modal-body">
              
              <form id="taskfrm">
              <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                 <label>Docente</label>
                <div class="col-md-13">
                    <select class="form-control" name="" id="nametask">
                        @foreach ($groups as $item)
                            <option class="form-control" value="{{$item->id}}" selected>{{$item->first()->professor->names}}</option>
                        @endforeach    
                    </select>
                </div>
                 <label>Color:</label>
                 <select class="form-control" id="idcolortask">
                    <option value="purple-label">Purpura</option>
                    <option value="red-label">Rojo</option>
                    <option value="blue-label">Azul</option>
                    <option value="pink-label">Rosa</option>
                    <option value="green-label">Verde</option>
                 </select> 
                <input id="tede" type="hidden" name="tede" >
                <input id="hours" type="hidden" name="hours">
                <input id="days" type="hidden" name="days">
                <input id="block_id" type="hidden" name="block_id" value="{{$block_id}}">
              </form>
        
            </div>
            <div class="modal-footer">
              <button type="button" class="savetask btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
              <button type="button" class="canceltask btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- append modal set data -->
@endsection
@push('scripts')
    <script src="{{ asset('/vendor/horarios/js/eventos.js') }}"></script>
    <link href="{{ asset('/vendor/horarios/css/style.css') }}" rel="stylesheet">
@endpush