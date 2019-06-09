@extends('components.sections.studentSection')
@section('userContent')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Actividades</h1>
        </div>
        {{$time}}
        <div class="row">
                <div class="col-xl-4 col-md-12 mb-4 col-12">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Asistencia</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">2/13</div>
                            </div>
                            <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 18%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
    
                <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Prácticas entregadas</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1/13</div>
                            </div>
                            <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 9.8%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
    
                <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Prácticas sin entregar</div>
                        <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1/13</div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 9.8%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Práctica de la Sesión</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, dignissimos eveniet ullam, asperiores distinctio quibusdam itaque veritatis 
                        deleniti nam iusto molestias provident minus sequi optio placeat eligendi 
                        cupiditate praesentium similique!
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic deleniti blanditiis alias accusantium, 
                        vel vitae eos inventore explicabo porro unde
                        possimus ab ullam labore at aut beatae numquam officia aliquid.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt nesciunt est at error, temporibus molestiae corporis veniam
                        laboriosam asperiores laudantium rerum. Ullam nihil repellat amet molestias, culpa esse dolorem. Corrupti?
                        <hr>
                        Practica disponible: <a href="https://www.google.com">Ejercicio 1.pdf</a>
                    </div>
                    </div>
                </div>
                
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Entregar Práctica</h6>
                    </div>
                    <div class="card-body">
                        <form class="user" method="POST" action="{{ url('/student/activities') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="group col-sm-12">
                                <label for="">Descripción</label>
                                <textarea name="description" class="form-control col-md-12" id="" cols="30" rows="2"></textarea>
                            </div>
                            <div class="group col-sm-12">
                                    <label for="">
                                        Procura subir un comprimido o archivador con tu ejercicio adentro, solo los siguientes formatos son admitidos: <strong>.zip .rar .tar.gz</strong> 
                                    </label>
                            </div>
                            <div class="group col-sm-12">
                                    <input type="file" name="practice" style="margin-bottom:10px;" >
                            </div>
                            @if (Agent::isMobile())
                                <div class="group col-md-12 col-12">
                                    <button type="submit" class="btn btn-primary btn-block col-md-12" style="margin-bottom:10px;">Entregar</button>
                                </div>
                            @else
                                <div class="group col-md-4 col-4 offset-md-4 offset-4">
                                    <button type="submit" class="btn btn-primary btn-block col-md-12" style="margin-bottom:10px;">Entregar</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    
@endsection