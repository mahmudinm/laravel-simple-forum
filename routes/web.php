<?php


/**
 * Home page
 */
Route::get('/', 'HomeController@index');
Route::get('/create_topic', 'HomeController@createTopic')->name('home.create_topic');
Route::post('/create_topic', 'HomeController@storeTopic')->name('home.store_topic');


/**
 * Admin Dashboard
 */
Route::get('/admin', 'Admin\DashboardController@index')->name('admin.dashboard'); 
Route::group([
  'prefix' => 'admin', 
  'namespace' => 'Admin',
  'as' => 'admin.'
], function(){
  
  Route::resource('forums', 'ForumsController',[
    'except' => ['show']
  ]);

  Route::get('categories/pdf', 'CategoriesController@pdf')->name('categories.pdf');
  Route::resource('categories', 'CategoriesController',[
    'except' => ['show']
  ]);
});

/**
 * Forum pages
 */
Route::resource('forums', 'ForumsController',[
  'only' => 'show'
]);
Route::resource('forums.categories', 'CategoriesController', [
  'only' => 'show'
]);


/**
 * Topic And Comment Pages
 */
Route::resource('forums.categories.topics', 'TopicsController',[
  'only' => ['create', 'store']
]);
Route::resource('topics', 'TopicsController', [
  'only' => ['show', 'edit', 'update']
]);
Route::post('/topics/{slug}/postStar', 'TopicsController@postStar')->name('topics.star');
Route::resource('topics.comments', 'CommentsController',[
  'except' => ['index', 'show', 'destroy']
]);



/**
 * Profile pages
 */
Auth::routes();
Route::get('/profile/password', 'ProfileController@editPassword')->name('profile.edit_password');
Route::post('/profile/password', 'ProfileController@updatePassword')->name('profile.update_password');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile/update', 'ProfileController@update')->name('profile.update');

/**
 * Message pages
 */

Route::get('/profile/message', 'MessageController@index')->name('profile.message.index');
Route::resource('profile.message', 'MessageController', [
  'except' => ['index','edit','destroy']
]);
Route::get('/profile/{id}', 'ProfileController@show')->name('profile.show');


