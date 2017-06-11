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

// 회원 로그인과 관련된 라우트를 생성하는 도우미 파사드
// 로그인, 비밀번호 찾기, 비밀번호 리셋, 회원가입 컨트롤러 등
Auth::routes();

Route::auth();

Route::get('/login', 'LoginController@index');

Route::get('/home', 'HomeController@index');

Route::get('/match', 'MatchController@index');

Route::resource('/matching', 'MatchController@matching');

Route::get('/chart', 'ChartController@index');

Route::get('/logSpec', 'LogSpecController@index');

Route::get('/monitoring', 'MonitoringController@index');

Route::get('/snapshot', 'SnapShotController@index');

//d3.js AjaxRoute
Route::get('/chartData', 'ChartController@jsonTransmit');

//chart value getRoute
Route::get('/chartBluetooth', 'ChartController@getBluetoothValue');

Route::get('/individual','IndividualController@index');

Route::get('/task', 'TaskController@index');

Route::resource('match','MatchController');
Route::resource('logSpec','logSpecController');
Route::resource('task','TaskController');
Route::resource('individual','IndividualController');
Route::resource('login','LoginController');

Route::get('/matchAddressDb', function(){
  return view('match.matchAddressDb');
});
