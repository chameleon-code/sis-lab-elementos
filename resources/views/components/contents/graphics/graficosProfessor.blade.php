@extends('components.sections.professorSection')
@section('userContent')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="panel-heading m-0 font-weight-bold text-primary">{{$title or 'Materia'}}</div>
            
            <div class="card-body">
                @if (Session::has('status_message'))
                    <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                @endif
                <div class="">
                    <div class="col-sm-12 table-responsive text-center">
                        <div class="row">
                            <label>Materia</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="subjectMatters" id="subjectMatters">
                                    @foreach ($subjectMatters as $item)
                                <option class="form-control" value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach    
                                </select>
                            </div>
                        </div>
                        <div class="m-1" id="subjectMatter"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="panel-heading m-0 font-weight-bold text-primary">{{$title or 'Grupo'}}</div>
            
            <div class="card-body">
                @if (Session::has('status_message'))
                    <p class="alert alert-success">{{Session::get('status_message')}}</p>                           
                @endif 
                <div class="">
                    <div class="col-sm-12 table-responsive text-center">
                        <div class="row">
                            <label>Grupo</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="groups" id="groups">
                                    @foreach ($groups as $item)
                                <option class="form-control" value="{{$item->id}}">{{$item->name}} - {{$item->subject->name}} - {{$item->professor->names}} {{$item->professor->first_name}} {{$item->professor->second_name}}</option>
                                    @endforeach    
                                </select>
                            </div>
                        </div>
                        <div class="m-1" id="group"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    </script>
@endsection
@push('scripts')
    <script src="{{ asset('/vendor/graficos/graficos.js') }}"></script>
    {{-- <link href="{{ asset('/vendor/horarios/css/style.css') }}" rel="stylesheet"> --}}
@endpush

