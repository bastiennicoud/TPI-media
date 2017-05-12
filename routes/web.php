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

Route::get('/', function () { return view('index'); });
Route::get('lastposts', function () { return view('index'); });
Route::get('newpost', function () { return view('index'); });
Route::get('myposts', function () { return view('index'); });
Route::get('login', function () { return view('index'); });
Route::get('register', function () { return view('index'); });
Route::get('post', function () { return view('index'); });
Route::get('myprofile', function () { return view('index'); });


Route::group(['prefix' => 'rest'], function () {

  Route::post('register', 'UsersauthController@register');
  Route::post('login', 'UsersauthController@login');
  Route::post('logged', 'UsersauthController@logged');
  Route::post('logout', 'UsersauthController@logout');

});
