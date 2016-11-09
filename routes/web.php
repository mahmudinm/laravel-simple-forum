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

Route::get('/home', 'HomeController@index');

Route::group([
  'prefix' => 'admin', 
  'namespace' => 'Admin',
  'as' => 'admin.'
], function(){
  Route::resource('forums', 'ForumsController');
  Route::resource('categories', 'CategoriesController');
});

Route::resource('forums', 'ForumsController');
Route::resource('forums.categories', 'CategoriesController');
Route::resource('threads', 'ThreadsController');