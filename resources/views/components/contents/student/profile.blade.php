@extends('components.sections.professorSection')
@section('userContent')

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-10 col-md-9">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="px-5">
                        <div class="card card-profile o-hidden border-0 my-3">
                            <div style="background-image: url(https://demo.bootstrapious.com/admin-premium/1-4-5/img/photos/paul-morris-116514-unsplash.jpg);" class="card-header"></div>
                            {{-- <div class="card-body text-center"><img src="/users/{{ $user->img_path }}" class="card-profile-img"> --}}
                            <div class="card-body text-center">
                                <img class="card-profile-img" src=
                                @if($user->img_path != null)
                                "/storage/users/{{ $user->img_path }}"
                                @else
                                "/users/demo.png"
                                @endif
                                >
                                <h3 class="mb-3"> {{ $user->names }} {{ $user->first_name }} {{ $user->second_name }} </h3>
                                <p class=""> <strong> Tipo de Usuario: </strong> Estudiante </p>
                                <p class=""> <strong> Correo Electrónico: </strong> {{ $user->email }} </p>
                                <br>
                                <a href="{{url('/admin/professors')}}" class="btn btn-primary"> Regresar </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
