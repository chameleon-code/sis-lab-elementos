@extends('components.sections.professorSection')
@section('userContent')

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 font-weight-bold text-primary">
                    <h5 style="margin-left: 20px;"><strong>Sesiones</strong></h5>
                    <a href="#" class="btn btn-primary btn-icon-split btn-sm float-right" style="margin-top: -34px; margin-right: 20px;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Añadir Sesión</span>
                    </a>
                </div>

                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success"><strong> {{Session::get('status_message')}} </strong></p>
                    @endif
                          
                        {{-- <div class="accordion-body bg-gray-300 border-bottom-primary" style="margin-top: 8px;">Sesión 1</div>
                        <div class="panel">
                            <div class="my-3 mx-2" style="border-bottom: 1px solid #b5b5b5;"><a href="#">Tarea 1</a><br></div>
                            <div class="my-3 mx-2" style="border-bottom: 1px solid #b5b5b5;"><a href="#">Tarea 2</a><br></div>
                            <div class="my-3 mx-2" style="border-bottom: 1px solid #b5b5b5;"><a href="#">Tarea 3</a><br></div>
                        </div>

                        <div class="accordion-body bg-gray-300 border-bottom-primary" style="margin-top: 8px;">Sesión 2</div>
                        <div class="panel">
                            <div class="my-3 mx-2" style="border-bottom: 1px solid #b5b5b5;"><a href="#">Tarea 1</a><br></div>
                            <div class="my-3 mx-2" style="border-bottom: 1px solid #b5b5b5;"><a href="#">Tarea 2</a><br></div>
                            <div class="my-3 mx-2" style="border-bottom: 1px solid #b5b5b5;"><a href="#">Tarea 3</a><br></div>
                        </div> --}}

                    @foreach ($sesions as $sesion)
                    <thead>
                        <tr>
                            <div class="accordion-body bg-gray-300 border-bottom-primary" style="margin-top: 8px;">
                                <tr>
                                    <th class=""> Sesión: {{ $sesion->number_sesion }} </th>
                                </tr>
                            </div>
                        </tr>
                        
                    </thead>
                    
                    <div class="panel">
                        @foreach ($tasks as $task)
                            @if($task->sesion_id == $sesion->id)
                                <div class="my-3 mx-2 row" style="border-bottom: 1px solid #b5b5b5; font-size: 15px;">
                                    <tr>
                                        <th><p> Tarea: {{ $task->title }} </p></th>
                                        <th> <strong>&nbsp|</strong>&nbsp Entregados: <div class="progress progress-sm mb-2 mx-2" style="margin-top: 7px;"><div class="progress-bar" role="progressbar" style="width: 80px;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="14"></div></div> 0/14 </th>
                                        <th><strong>&nbsp|</strong>&nbsp Fecha de entrega: {{$task->end}}</th>
                                    </tr>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @endforeach
                    
        </div>
    </div>
</div>

<script src="/js/accordion.js"></script>

@endsection