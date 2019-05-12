@extends('components.sections.professorSection')
@section('userContent')



<style>
    .accordion-body:after {
        content: '\02228';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
      }
      .active:after {
          content: '\02227';
      }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <div class="panel-heading my-2 font-weight-bold text-primary container">
                Administrar Prácticas
            </div>
            <div class="card-body">
                <thead>
                    <tr>
                        <div class="accordion-body bg-gray-300 border-bottom-primary rounded" style="margin-top: 8px;">
                            <strong style="color: gray;"> Sesión: </strong> 
                        </div>
                    </tr>
                </thead>
                <div class="panel" style="max-height: 106px;">
                    <div class="my-2 mx-2" style="border-bottom: 1px solid #b5b5b5; font-size: 15px;">
                        {{-- put your code to here bitch! --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>       

<script src="/js/accordion.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
</script>     
@endsection