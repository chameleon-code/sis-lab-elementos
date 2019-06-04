@extends('components.sections.adminSection')

@section('userContent')
<script>
    $(".opcion").click(function()){

    }
</script>
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-10 col-md-9">
        <div class="card o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Creación de horario para un Bloque</h1>
                            </div>
                            @if (count($errors)>0)
                                <div class="alert alert-danger">
                                    <b>Ha ocurrido un error!</b>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="user" action="{{Route('schedule.create',['1'])}}" method="GET">
                                {{ csrf_field() }}
                                <label for='name' class="">Seleccione un Bloque</label>
                                <div class="form-group" {{ $errors->has('semester') ? 'has-error' : ''}}>
                                    <select class="form-control col-md-12" name="block_id">
                                        @foreach ($blocks as $item)
                                            <option class=".opcion" class="form-control" value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block col-md-12">Crear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection