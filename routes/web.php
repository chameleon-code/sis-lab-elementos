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

//calendario de eventos
Route::post('registerEvent', 'CalendarController@store');
Route::get('calendars', 'CalendarController@getAllEvents');
/*Run
php composer update
php artisan config:clear
*/

Route::resource('/admin/groups', 'GroupController');
Route::resource('/admin/blocks', 'BlockController');

//Sesiones
Route::get('/sesions', 'SesionController@index');
Route::post('/sesions/store', 'SesionController@store');

//Schedule
//Route::get('/horarios','ScheduleRecordController@create');


//Route::post('/admin/blocks/createSchedule','BlockScheduleController@store')->name('blockSchedule.store');
Route::get('/schedule/create/{block_id}','ScheduleRecordController@create')->name('schedule.create');
Route::post('/schedule/create/{block_id}','ScheduleRecordController@store');

Route::get('/schedule/records/{laboratory_id}','ScheduleRecordController@getRecords');
Route::delete('/schedule/records/delete/{id}','ScheduleRecordController@destroy')->name('schedule.destroy');
//Route::get('/admin/blocks/createSchedule','BlockScheduleController@create');
//Horarios con seleccion de bloques
Route::get('/schedule/create/','ScheduleRecordController@createSchedule');
Route::get('/schedule/groups/{block_id}','ScheduleRecordController@getGroups');

//graficos
Route::get('/graphics','GraphicController@index');
Route::get('/graphics/group/{group_id}','GraphicController@getTaskByGroupID');
