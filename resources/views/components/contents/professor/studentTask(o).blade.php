@extends('components.sections.professorSection')
@section('userContent')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        

        <div class="row">

            <div class="col-lg-12">

                <div class="card shadow mb-4">
                    <div class="align-items-center justify-content-between m-0 p-3">
                        <strong>Estudiante: </strong> {{ $user->first_name.' '.$user->second_name.' '.$user->names }} <br>
                        <strong>Materia: </strong> {{ $subject_matter->name }} <br>
                        <strong>Grupo: </strong> {{ $group->name }}
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"> {{ $task->title }} </h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        {{ $task->description }}
                        <hr>
                        Practica disponible: <a href="#">Ejercicio 1.pdf</a>
                    </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Estado de la Tarea </h6>
                    </div>
                    <div class="card-body">
                        Aqui un mensaje adjunto con la tarea del estudiante.
                        <form class="form-group" method="POST" action="{{ url('/student/activities') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                    <br>
                                    <a href="/storage/folders/2019-1/Bloque 1/Tabla Tarea 2.pdf">Ej1</a>
                            </div>
                            <hr>
                            <div class="col-md-4 offset-md-4">
                                    <a class="btn btn-primary btn-block" href="">
                                            Regresar
                                    </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    
@endsection