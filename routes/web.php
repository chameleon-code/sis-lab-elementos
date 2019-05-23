<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Laboratory;

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

Route::get('/', function () {
    return view('layouts.home');
});
Route::get('error', function () {
    return view('errors.404');
});
Route::get('register', function () {
    return view('layouts.register');
});

//roles
Route::get('admin', function () {
    return view('components.sections.adminSection');
});
Route::get('student', function () {
    return view('components.contents.student.studentSection');
});
Route::get('professor', function () {
    return view('components.sections.professorSection');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// child roles

Route::get('admin/lista', function () {
    return view('components.contents.admin.adminContent');
});

// Secciones

Route::get('auxiliar', function () {
    return view('components.sections.auxiliarSection');
});

// Horario

Route::get('scheduler', function () {
    $labs = Laboratory::all();
    $data = ['labs' => $labs];
    return view('components.contents.scheduler.scheduler', $data);
});
Route::get('scheduler/{id}', 'EventController@loadScheduler');
Route::get('scheduler2/{id}', 'EventController@loadScheduler2');


/*Run
php composer update
php artisan config:clear
*/

Route::resource('/admin/groups', 'GroupController');
Route::resource('/admin/blocks', 'BlockController');