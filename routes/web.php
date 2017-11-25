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


Auth::routes();

Route::get('student', 'StudentPageController@index');
Route::get('teacher', 'TeacherRoomController@index');
Route::post('teacher', 'TeacherRoomController@changedata');
Route::get('groups', 'GroupsEditorController@index');
Route::get('groups{id}','GroupsEditorController@group');
Route::post('groups/ajaxgroup','GroupsEditorController@ajaxgroup');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

