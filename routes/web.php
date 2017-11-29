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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Auth::routes();

Route::get('student', 'StudentPageController@index')->name('student');
Route::get('student/grades', 'StudentPageController@grades')->name('student.grades');
Route::post('student/grades', 'StudentPageController@gradesProcess')->name('student.grades.process');
Route::post('/report', 'StudentPageController@report')->name('report');

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/professor/edit', 'AdminController@editProfessor')->name('profedit');
Route::get('/professor/add', 'AdminController@addProfessor')->name('profadd');
Route::post('/professor/add', 'AdminController@addProfessorPost')->name('profaddp');
Route::delete('/professor/del{id}', 'AdminController@delProfessor')->name('profdel');
Route::post('/professor/edit', 'AdminController@process')->name('professor.room.process');

Route::get('schedule/add/step-one', 'AdminController@addScheduleStepOne')->name('schedule-step-1');
Route::get('schedule/add/step-two', 'AdminController@addScheduleStepTwo')->name('schedule-step-2');
Route::delete('schedule/add/step-del{id}', 'AdminController@addScheduleStepTwoPost')->name('schedule-step-2-del');
Route::post('schedule/add/save', 'AdminController@addScheduleStepSave')->name('schedule-save');

Route::get('teacher', 'TeacherRoomController@index')->name('teacher');
Route::post('teacher', 'TeacherRoomController@changedata');
Route::post('teacher/grades', 'TeacherRoomController@grades')->name('grades');
Route::post('teacher/ajaxgrades', 'TeacherRoomController@ajaxgrades');

Route::get('edit', 'AdminController@editPersonalData')->name('edit-get');
Route::post('edit', 'AdminController@editPersonalDataPost')->name('edit-post');

Route::get('groups', 'GroupsEditorController@index');
Route::get('groups{id}','GroupsEditorController@group');
Route::post('groups/ajaxgroup','GroupsEditorController@ajaxgroup');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('subject', 'SubjectController@index')->name('subject');
Route::get('subject/add', 'SubjectController@add')->name('subjectAdd');
Route::post('subject', 'SubjectController@added')->name('subjectAdded');
Route::delete('subject/del{id}', 'SubjectController@del')->name('subjectDel');

Route::get('studenteditor', 'StudentEditorController@index')->name('studentEditor');
Route::get('studenteditor/add', 'StudentEditorController@add')->name('studentEditorAdd');
Route::delete('studenteditor/del{id}', 'StudentEditorController@del')->name('studenteditorDel');
Route::get('studenteditor/add/new', 'StudentEditorController@added')->name('studentEditorAdded');
Route::post('/studenteditor/ajaxgroup', 'StudentEditorController@ajaxgroup'); //for ajax request
Route::post('studenteditor', 'StudentEditorController@process')->name('studenteditor.process');


Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');

