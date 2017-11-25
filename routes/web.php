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
});

Route::get('student', 'StudentPageController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('subject', 'SubjectController@index')->name('subject');
Route::get('subject/add', 'SubjectController@add')->name('subjectAdd');
Route::post('subject', 'SubjectController@added')->name('subjectAdded');
Route::delete('subject/del{id}', 'SubjectController@del')->name('subjectDel');

Route::get('studenteditor', 'StudentEditorController@index')->name('studentEditor');
Route::get('studenteditor/add', 'StudentEditorController@add')->name('studentEditorAdd');
//Route::get('studenteditor/edit{id}', 'StudentEditorController@edit')->name('studenteditorEdit');
Route::delete('studenteditor/del{id}', 'StudentEditorController@del')->name('studenteditorDel');
Route::post('studenteditor', 'StudentEditorController@added')->name('studentEditorAdded');
//Route::post('studenteditor', 'StudentEditorController@edited')->name('studentEditorEdited');

Route::post('studenteditor/ajaxgroup', 'StudentEditorController@ajaxgroup'); //for ajax request


Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
