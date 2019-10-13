<?php



Route::get('/', function () {
   return view('welcome');
});

Route::prefix('auth')->group(function () {
  Route::get('init', 'AppController@init');

  Route::post('login', 'AppController@login');
  Route::post('register', 'AppController@register');
  Route::post('logout', 'AppController@logout');

  Route::post('/update/user', 'AppController@update');
  Route::post('/update/password/user', 'AppController@changePassword');


});
