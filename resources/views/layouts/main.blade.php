<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('/js/jquery.js') }}"></script>  
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    @stack('scripts')
    <title>SIS-LAB</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    @stack('styles')
    @yield('header')
</head>
<body>
        @include('partials.navigation') 
        @yield('content')
        @include('partials.footer')
</body>    
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
</html>