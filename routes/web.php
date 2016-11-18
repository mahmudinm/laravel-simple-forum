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


Route::get('/', 'HomeController@index');
Route::get('/create_topic', 'HomeController@createTopic')->name('home.create_topic');
Route::post('/create_topic', 'HomeController@storeTopic')->name('home.store_topic');


Route::get('/admin', 'Admin\DashboardController@index')->name('admin.dashboard'); 
Route::group([
  'prefix' => 'admin', 
  'namespace' => 'Admin',
  'as' => 'admin.'
], function(){
  Route::resource('forums', 'ForumsController');

  Route::get('categories/pdf', 'CategoriesController@pdf')->name('categories.pdf');
  Route::resource('categories', 'CategoriesController');
});

// 
Route::resource('forums', 'ForumsController',[
  'only' => 'show'
]);
Route::resource('forums.categories', 'CategoriesController', [
  'only' => 'show'
]);
Route::resource('forums.categories.topics', 'TopicsController',[
  'only' => ['create', 'store']
]);
Route::resource('topics', 'TopicsController', [
  'only' => ['show', 'edit', 'update']
]);

Route::post('/topics/{slug}/postStar', 'TopicsController@postStar')->name('topics.star');
Route::resource('topics.comments', 'CommentsController',[
  'except' => ['index', 'show']
]);

Auth::routes();
Route::get('/profile/password', 'ProfileController@editPassword')->name('profile.edit_password');
Route::post('/profile/password', 'ProfileController@updatePassword')->name('profile.update_password');
Route::resource('profile', 'ProfileController');
Route::resource('profile.message', 'MessageController');

