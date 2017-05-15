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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/match', 'MatchController@index');

Route::get('/chart', 'ChartController@index');

Route::get('/logSpec', 'LogSpecController@index');

Route::get('/monitoring', 'MonitoringController@index');

Route::get('/snapshot', 'SnapShotController@index');

Route::get('/task', 'TaskController@index');

Route::resource('match','MatchController');
Route::resource('task','TaskController');

Route::get('/matchAddressDb', function(){
  return view('match.matchAddressDb');
});
