<?php



Route::get('/', function () {
   return view('welcome');
});

Route::prefix('auth')->group(function () {
  Route::get('init', 'AppController@init');

  Route::post('login', 'AppController@login'); //envoyer la requete d'authentification
  Route::post('register', 'AppController@register');
  Route::post('logout', 'AppController@logout'); //envoyer la requete de deconnexion

  Route::post('/update/user', 'AppController@update'); //envoyer la requete de la mise à jour du profil utilisateur
  Route::post('/update/password/user', 'AppController@changePassword');


});
