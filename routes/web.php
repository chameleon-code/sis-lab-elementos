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
Route::get('/about', function () {
    return view('layouts.about');
});
Route::get('error', function () {
    return view('errors.404');
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
})->middleware('auth');

// Secciones

Route::get('auxiliar', function () {
    return view('components.sections.auxiliarSection');
})->middleware('auth');

// Horario

Route::get('scheduler', function () {
    $labs = Laboratory::all();
    $data = ['labs' => $labs];
    return view('components.contents.scheduler.scheduler', $data);
})->middleware('auth');
Route::get('scheduler/{id}', 'EventController@loadScheduler')->middleware('auth');
Route::get('scheduler2/{id}', 'EventController@loadScheduler2')->middleware('auth');

//calendario de eventos
Route::post('registerEvent', 'CalendarController@store')->middleware('auth');
Route::get('calendars', 'CalendarController@getAllEvents')->middleware('auth');
/*Run
php composer update
php artisan config:clear
*/

Route::resource('/admin/groups', 'GroupController');
Route::resource('/admin/blocks', 'BlockController');

//Sesiones
Route::get('/sesions', 'SesionController@index')->middleware('auth');
Route::post('/sesions/store', 'SesionController@store')->middleware('auth');

//Schedule
//Route::get('/horarios','ScheduleRecordController@create');


//Route::post('/admin/blocks/createSchedule','BlockScheduleController@store')->name('blockSchedule.store');
Route::get('/schedule/create/{block_id}','ScheduleRecordController@create')->name('schedule.create')->middleware('auth','admin');
Route::post('/schedule/create/{block_id}','ScheduleRecordController@store')->middleware('auth','admin');

Route::get('/schedule/records/{laboratory_id}','ScheduleRecordController@getRecords')->middleware('auth','admin');
Route::delete('/schedule/records/delete/{id}','ScheduleRecordController@destroy')->name('schedule.destroy')->middleware('auth','admin');
//Route::get('/admin/blocks/createSchedule','BlockScheduleController@create');
//Horarios con seleccion de bloques
Route::get('/schedule/create/','ScheduleRecordController@createSchedule')->middleware('auth','admin');
Route::get('/schedule/groups/{block_id}','ScheduleRecordController@getGroups')->middleware('auth','admin');

//graficos
Route::get('/admin/graphics','GraphicController@index')->middleware('auth');
Route::get('/graphics/group/{group_id}','GraphicController@getTaskByGroupID')->middleware('auth');
Route::get('/graphics/subjectMatter/{subject_id}','GraphicController@getTaskBySubjectMatterId')->middleware('auth');
Route::get('/graphics/management/{management_id}','GraphicController@getTaskByManagemenId')->middleware('auth');
//descargas
Route::get('/download', 'DownloadTaskController@downloadTask')->middleware('auth');
Route::get('/downloadGroupRegister', 'DownloadTaskController@downloadGroupPortfolies')->middleware('auth');

//portafolios
Route::get('/portflies','ProfessorController@downloadPortflies')->middleware('auth');
Route::get('/professor/graphics','GraphicController@indexProfessor')->middleware('auth');

Route::get('/downloadPractice/{any}','DownloadsController@practiceDowload')->where('any', '.*')->middleware('auth');
Route::get('/downloadTask/{any}','DownloadsController@taskDownload')->where('any', '.*')->middleware('auth');