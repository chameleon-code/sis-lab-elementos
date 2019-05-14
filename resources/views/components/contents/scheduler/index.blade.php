@extends('components.sections.adminSection')
@section('userContent')
<script>
    $(".td-line").hover(
        function() {
        $(this).find('button').show();
        },
        function() {
        $(this).find('button').hide();
        }
    );
</script>
<style>
        .boton{display:none;}
        </style>
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
                                <select class="form-control" name="" id="">
                                    @foreach ($laboratories as $item)
                                        <option class="form-control" value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @endforeach    
                                </select>
                            </div>
                            
                            <table class="table table-striped">
                                
                                <thead>
                                    <tr>
                                        <th class="text-dark" scope="row">Dias</th>
                                        @foreach ($days as $item)
                                            <th class="text-dark">{{$item->name}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($hours as $item)
                                    <tr class="" >
                                        <td class="hours">{{$item->start}}-{{$item->end}}</td>
                                        <td class="td-line"><button class="boton"></button></td>
                                        <td class="td-line">
                                                <div id="ma54901" class="col-sm-12 nopadding"></div>
                                                <div class="col-sm-12 text-center">
                                                   <button id="edit-ma54901" data-row="ma54901" class="addinfo btn btn-xs btn-primary" style="display: none;"><i class="fa fa-plus"></i></button>
                                                </div>
                                        </td>
                                        <td class="td-line"><button ></button></td>
                                        <td class="td-line"><button ></button></td>
                                        <td class="td-line"><button ></button></td>
                                        <td class="td-line"><button ></button></td>
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