@extends('components.sections.adminSection')
@section('userContent')

<script src="/js/generatekey.js"></script>
<div class="container-fluid">
      <div class="card shadow mb-4">
          <div class="card-header py-3">

                <div class="panel-heading m-0 font-weight-bold text-primary"><strong>Auxiliares</strong></div>

              <div class="card-body">
                  @if (Session::has('status_message'))
                      <p class="alert alert-success"> <strong> {{Session::get('status_message')}} </strong> </p>
                  @endif
                  
                  <div class="table-responsive table-striped table-secondary">
                      <div class="row">
                          <div class="col-sm-12">
                                  <table class="table dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                      <thead class="">
                                          <tr role="row" class="bg-dark">
                                              <th class="sorting_asc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column ascending" style="width: 215px;"><font style="vertical-align: inherit;"><font style="color: white; vertical-align: inherit;">Ap. Paterno</font></font></th>

                                              <th class="sorting_asc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Position: activate to sort column ascending" style="width: 215px;" aria-sort="descending"><font style="vertical-align: inherit;"><font style="color: white; vertical-align: inherit;">Ap. Materno</font></font></th>

                                              <th class="sorting_asc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Office: activate to sort column ascending" style="width: 400px;"><font style="vertical-align: inherit;"><font color: white; style="color: white; vertical-align: inherit;">Nombres</font></font></th>

                                              <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="3" aria-label="Age: activate to sort column ascending"><font style="vertical-align: inherit;"><font style="color: white; vertical-align: inherit;">Acciones</font></font></th>
                                          </tr>
                                      </thead>
                                          <tbody>

                                                @foreach ($auxiliars as $item)

                                                  <tr role="row" class="odd">
                                                      <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->first_name }}</font></font></td>
                                                      <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->second_name }}</font></font></td>
                                                      <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->names }}</font></font></td>

                                                      <td class="text-center p-2">
                                                          <a href="/admin/auxiliars/profile/{{ $item->id }}" class="btn btn-info btn-circle btn-sm"><i title="Ver detalles" class="fas fa-eye"></i></a>
                                                      </td>

                                                    <td class="text-center p-2">
                                                            <a href="/admin/auxiliars/{{$item->id}}/edit" class="btn btn-warning btn-circle btn-sm"><i title="Modificar" class="fas fa-edit"></i></a>
                                                    </td>

                                                    <td class="text-center p-2">
                                                            <button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar{{ $item->id }}"> <i title="Eliminar" class="fas fa-trash"></i> </button>

                                                            <!-- Modal -->
                                                          <div class="modal fade" id="eliminar{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                              <div class="modal-dialog" role="document">
                                                              <div class="modal-content">
                                                                  <div class="modal-header">
                                                                  <h5 class="modal-title" id="exampleModalLabel"> Eliminar Auxiliar </h5>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                  </div>
                                                                  <div class="modal-body text-left">
                                                                      ¿Esta seguro que desea eliminar al auxiliar {{ $item->names }} {{ $item->first_name }}?
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                  <input type="hidden" id="id_auxiliar">
                                                                      <form action="{{route('auxiliar.destroy', [$item->id])}}" method="POST">
                                                                          {{csrf_field()}}
                                                                          {{method_field('DELETE')}}
                                                                      <button type="submit" class="btn btn-danger">Eliminar</button>
                                                                      </form>
                                                                  </div>
                                                              </div>
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
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/js/tables/jquery.min.js"></script>
  <script src="/js/tables/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/js/tables/jquery.easing.min.js"></script>

  <!-- Custom scripts all pages-->

  <!-- Page level plugins -->
  <script src="/js/tables/jquery.dataTables.min.js"></script>
  <script src="/js/tables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/js/tables/datatables-demo.js"></script>  

@endsection