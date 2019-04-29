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
                  
                  <div class="">
                      <div class="row">
                          <div class="col-sm-12">
                                  <table class="table table-responsive dataTable table-striped table-secondary" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%; margin-top: 15px; margin-bottom: 35px;">
                                      <thead class="">
                                          <tr role="row" class="bg-dark">
                                              <th class="sorting_asc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column ascending" style="width:230px;"><font style="vertical-align: inherit;"><font style="color: white; vertical-align: inherit;">Código SIS</font></font></th>

                                              <th class="sorting_asc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Position: activate to sort column ascending" style="width: 380px;" aria-sort="descending"><font style="vertical-align: inherit;"><font style="color: white; vertical-align: inherit;">Apellidos</font></font></th>

                                              <th class="sorting_asc mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Office: activate to sort column ascending" style="width: 380px;"><font style="vertical-align: inherit;"><font color: white; style="color: white; vertical-align: inherit;">Nombres</font></font></th>

                                              <th class="text-center" data-orderable="false" id="arrow-hide" rowspan="1" colspan="1" style="background: none;" ><font style="vertical-align: inherit;"><font style="color: white; vertical-align; inherit;">Acciones</font></font></th>
                                          </tr>
                                      </thead>
                                          <tbody>

                                                @foreach ($auxiliars as $item)

                                                  <tr role="row" class="odd">
                                                      <td class="mgx-1"><font style="vertical-align: inherit; "><font style="vertical-align: inherit;">{{ $item->code_sis }}</font></font></td>
                                                      <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->first_name }} {{ $item->second_name }}</font></font></td>
                                                      <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->names }}</font></font></td>

                                                      <td class="p-2" style="text-align: center; display: flex;">
                                                          <a href="/admin/auxiliars/profile/{{ $item->id }}" class="btn btn-info btn-circle btn-sm mx-1"><i title="Ver detalles" class="fas fa-eye"></i></a>
                                                        
                                                          <a href="/admin/auxiliars/{{$item->id}}/edit" class="btn btn-warning btn-circle btn-sm mx-1"><i title="Modificar" class="fas fa-edit"></i></a>

                                                          <button type="button" class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="modal" data-target="#eliminar{{ $item->id }}"> <i title="Eliminar" class="fas fa-trash"></i> </button>

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

              <script>
                $.noConflict();
                jQuery( document ).ready(function( $ ) {
                    $('#dataTable').DataTable();
                });
                // Code that uses other library's $ can follow here.
              </script>

              {{-- <div class="row justify-content-center">
                {{ $auxiliars->links() }}
              </div> --}}
          </div>
      </div>
  </div>

@endsection