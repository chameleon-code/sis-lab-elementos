@extends('components.sections.adminSection')
@section('userContent')
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 font-weight-bold text-primary">{{$title or 'Horarios'}}</div>
                
                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                    @endif
                    <div class="">
                        <div class="col-sm-12 table-responsive text-center">
                            <div class="row">
                                <label>Laboratorio</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="laboratory" id="laboratory">
                                        @foreach ($laboratories as $item)
                                            <option class="form-control" value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach    
                                    </select>
                                </div>
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
                                            <tr class="" data-id="{{$item->id}}">
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
@endsection
@push('scripts')
    <script src="{{ asset('/vendor/horarios/js/auxiliarSchedule.js') }}"></script>
    <link href="{{ asset('/vendor/horarios/css/style.css') }}" rel="stylesheet">
@endpush