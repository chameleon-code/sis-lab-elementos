@extends('components.sections.adminSection')
@section('userContent')

<script>
    
    // $( function() {
    //     $(".sortable" ).sortable({
    //         placeholder: "ui-state-highlight"
    //     });
    //     $(".sortable" ).disableSelection();
    // } );

    // $(function() {
    //   $( "#sortable" ).sortable({
    //     revert: true
    //   });
    // $( ".hours" ).draggable({
    //     disabled: true
    // })
      $( "#draggable" ).draggable({
        connectToSortable: ".sortable",
        helper: "clone",
        revert: "invalid"
      });
      $( "tr, td" ).disableSelection();
    });
</script>

<script>
    $( function() {
      $( ".sortable" ).sortable({
        revert: true,
        connectWith: ".connectedSortable"
      }).disableSelection();
    } );
</script>

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
                                    <td class="">Item 1</td>
                                    <td class="">Item 2</td>
                                    <td class="">Item 3</td>
                                    <td class="">Item 4</td>
                                    <td class=""></td>
                                    <td class=""></td>
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