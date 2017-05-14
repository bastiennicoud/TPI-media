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


// -----------------------------------------------------------------------------
// Routes de l'application
// Ces routes retournent toutes l'application complète (Vue.js)
// En théorie on utilise que la premiére
// mais si on est ammené a utiliser un autre url que la racinne directement
// sans passer par le routeur Vue.js, le serveur nous renvoie l'application
// et une vois chargé, vue nous affiche la bonne page
// -----------------------------------------------------------------------------
Route::get('/', function () { return view('index'); });
Route::get('lastposts', function () { return view('index'); });
Route::get('newpost', function () { return view('index'); });
Route::get('myposts', function () { return view('index'); });
Route::get('login', function () { return view('index'); });
Route::get('register', function () { return view('index'); });
Route::get('post', function () { return view('index'); });
Route::get('myprofile', function () { return view('index'); });



// -----------------------------------------------------------------------------
// Routes de l'api, que je vais appeler via ajax
// toutes ses routes sont uniquement apelées via ajax, et retournent des
// tableaux JSON
// -----------------------------------------------------------------------------
Route::group(['prefix' => 'rest'], function () {

  // -------------------------------------------
  // Routes liées a l'utilisateur
  // -------------------------------------------

  // Inscription d'un utilisateur
  Route::post('register', 'UsersauthController@register');
  // Connexion
  Route::post('login', 'UsersauthController@login');
  // Verifie si l'utilisateur est loggé
  Route::post('logged', 'UsersauthController@logged');
  // Retourne les infos de base sur l'utilisateur loggé
  Route::post('user', 'UsersauthController@user');
  // Déconnecte l'utilisateur
  Route::post('logout', 'UsersauthController@logout');
  // Pour modifier le nom d'utilisateur
  Route::post('modifyname', 'UsersauthController@modifyname');
  // Pour modifier son e-mail
  Route::post('modifyemail', 'UsersauthController@modifyemail');
  // Pour modifier son mot de passe
  Route::post('modifypass', 'UsersauthController@modifypass');


  // -------------------------------------------
  // Routes liées aux posts
  // -------------------------------------------

  // Création d'un nouveau post (article)
  Route::post('post', 'PostsController@newpost');
  // Modification d'un post esistant
  Route::patch('post/{id}', 'PostsController@editpost');


  // -------------------------------------------
  // Routes liées a l'upload d'images
  // -------------------------------------------

  // Modifie la photo de profile
  Route::post('newprofilephoto', 'ImagesController@newprofilephoto');

});
