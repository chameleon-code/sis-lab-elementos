<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/prueba', function () {
    return view('/layouts/app');
});
Route::get('/logged', function () {
    return view('/partials/navigations/logged');
});

Route::get('/logged/users', function () {
    return view('/partials/navigations/usuarios');
});

Route::get('/', function () {
    return view('/home');
});
Route::get('/admin', function () {
    return view('/partials/navigations/admin');
});
Route::get('/error', function () {
    return view('errors.404');
});