<?php

use Illuminate\Support\Facades\Auth;

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
    return view('layouts.home');
});
Route::get('admin', function () {
    return view('layouts.logged');
});
Route::get('error', function () {
    return view('errors.404');
});
Route::get('register', function () {
    return view('layouts.register');
});
Route::get('login', function () {
    return view('layouts.login');
});


//roles
Route::get('admin', function () {
    return view('components.sections.adminSection');
});
Route::get('student', function () {
    return view('components.sections.studentSection');
});
Route::get('professor', function () {
    return view('components.sections.professorSection');
});
Route::get('auxiliar', function () {
    return view('components.sections.auxiliarSection');
});
//child roles
Route::get('admin/lista', function () {
    return view('components.contents.admin.adminContent');
});

//registro de materias
Auth::routes();
Route::get('/admin/registrarMateria','SubjectMatterController@index');
Route::get('/admin/gestion','ManagementController@index');