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


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/create_thread', 'HomeController@createThread')->name('home.create_thread');
Route::post('/create_thread', 'HomeController@storeThread')->name('home.store_thread');

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
Route::resource('forums.categories.threads', 'ThreadsController',[
  'except' => 'show'
]);

Route::resource('threads', 'ThreadsController', [
  'only' => ['show', 'edit', 'update']
]);
Route::post('/threads/{slug}/postStar', 'ThreadsController@postStar')->name('threads.star');

Route::resource('threads.comments', 'CommentsController');

Route::resource('profile', 'ProfileController');
