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
    //return view('layout/vueTest');
});

Route::group(['prefix' => 'ToDoList'], function () {
        Route::put('/','ToDoIndexController@jobDone');
        Route::post('/','ToDoIndexController@jobIn');
        Route::get('/hello', 'ToDoIndexController@test');
        Route::post('/Users','ToDoIndexController@addUser');
        Route::delete('/','ToDoIndexController@jobKill');
        //Route::get('/Users', 'ToDoIndexController@getUsers');
        // 符合「/admin/users」URL
});

Route::get('/ToDoList', 'ToDoIndexController@index');
//Route::delete('/ToDoList/{ToDoLists}', 'ToDoIndexController@jobKill');
Route::post('/ToDoList/Users','ToDoIndexController@addUser');
Route::get('/ToDoList/Users', 'ToDoIndexController@queryUsers');
