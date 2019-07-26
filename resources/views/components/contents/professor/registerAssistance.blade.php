@extends('components.sections.professorSection')
@section('userContent')


    <script src="/js/generatekey.js"></script>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="panel-heading m-0 py-4 font-weight-bold text-primary container">Registro de Asistencia</div>

                <div class="col-md-5 col-sm-5 col-12">
                    <select class="form-control" name="bloques" id="select-labs">
                        @forelse ($groups as $item)
                            <option class="form-control" value="{{$item->id}}">Grupo {{$item->name .' - '. $item->subject->name}}</option>
                        @empty
                            <option value="">No tiene grupos relacionados con algun bloque</option>
                        @endforelse
                    </select>
                </div>

                <div class="card-body">
                    @if (Session::has('status_message'))
                        <p class="alert alert-success"><strong> {{Session::get('status_message')}} </strong></p>
                    @endif
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table class="table dataTable text-center table-striped table-secondary" id="dataTableRegister"
                                       width="100%"
                                       cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                       style="width: 100%;">
                                    <thead>
                                    <tr role="row" class="bg-dark">
                                        <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Name: activate to sort column ascending"
                                            style="width: 230px;"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit; color: white;">Código SIS</font></font>
                                        </th>
                                        <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Name: activate to sort column ascending"
                                            style="width: 230px;"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit; color: white;">Nombre</font></font>
                                        </th>
                                        @forelse ($sesions as $sesion)
                                            <th class="sorting mgx-1" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Office: activate to sort column ascending"
                                            style="width: 380px;"><font style="vertical-align: inherit;"><font
                                                        style="vertical-align: inherit; color: white;">{{ $loop->iteration }}</font></font>
                                            </th>
                                        @empty
                                            
                                        @endforelse
                                    </tr>
                                    </thead>
                                    <tbody id="tablebody">
                                        @foreach ($schedules as $item)
                                            <tr role="row" class="odd">
                                                <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->code_sis }}</font></font></td>
                                                <td class="mgx-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $item->user->first_name }} {{ $item->user->second_name }} {{ $item->user->names }}</font></font></td>
                                                @forelse ($sesions as $sesion)
                                                    @if (in_array($sesion->id ,array_pluck($item->student->assistances->toArray(), 'sesion_id')))
                                                        <td>x</td>
                                                    @else  
                                                        <td >-</td>    
                                                    @endif                                                  
                                                @empty                                                    
                                                @endforelse
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
@endsection

@push('scripts')
    <script src="{{ asset('/js/assistance.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@8')}}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js')}}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js')}}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('')}}"></script>
@endpush
