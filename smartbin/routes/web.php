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
Route::get('/map', 'mapcontroller@index');
Route::get('/route/{id}', 'mapcontroller@route');
Route::get('/fire', 'mapcontroller@fire');
Route::get('/clean', 'mapcontroller@clean');
Route::get('/maintenancemap', 'mapcontroller@maintenancemap');
Route::get('/maintenancerep', 'mapcontroller@maintenancerep');
Route::get('/apiget', 'mapcontroller@apiget');
Route::resource('issues', 'IssueController');
Route::get('/hide/{id}', 'IssueController@hide');
