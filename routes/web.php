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

// 최초 접속했을 때의 메인페이지
Route::get('/', 'WelcomeController@index');

Route::get('/home', 'HomeController@index');

Route::get('/match', 'MatchController@index');

Route::resource('/matching', 'MatchController@matching');

Route::get('/chart', 'ChartController@index');

Route::get('/logSpec', 'LogSpecController@index');

Route::get('/monitoring', 'MonitoringController@index');

Route::get('/snapshot', 'SnapShotController@index');

Route::get('/individual','IndividualController@index');

Route::get('/task', 'TaskController@index');

Route::get('/addinfo', 'AddInfoController@index');

Route::resource('match','MatchController');
Route::resource('logSpec','logSpecController');
Route::resource('task','TaskController');
Route::resource('individual','IndividualController');

Route::get('/matchAddressDb', function(){
  return view('match.matchAddressDb');
});

/* 회원가입 */
Route::get('auth/join', [
  'as' => 'join.create',
  'uses' => 'JoinController@create',
]);
Route::post('auth/join', [
  'as' => 'join.store',
  'uses' => 'JoinController@store',
]);
Route::get('auth/confirm/{code}', [
  'as' => 'join.confirm',
  'uses' => 'JoinController@confirm',
]);

/* 로그인 */
Route::get('auth/login', [
  'as' => 'login.create',
  'uses' => 'LoginController@create',
]);
Route::post('auth/login', [
  'as' => 'login.store',
  'uses' => 'LoginController@store',
]);
Route::get('auth/logout', [
  'as' => 'login.destroy',
  'uses' => 'LoginController@destroy',
]);
