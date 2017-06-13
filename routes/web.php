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

// 처음 보여지는 메인 페이지
Route::get('/', 'WelcomeController@index');

// 로그인 후 첫 페이지
Route::get('/home', 'HomeController@index');

// 추가 정보 페이지
Route::get('/addinfo', 'InformationController@addinfo');
Route::get('/addinfo/update', 'InformationController@add_modify');
Route::post('/addinfo/update', 'InformationController@add_update');

// 구인구직 서비스 라우트
Route::get('/match', 'MatchController@index');

Route::get('/destroy/{num}', 'MatchController@destroy');

Route::get('/matching/{num}/{target}/{date}', 'MatchController@matching');

Route::get('/matchYes/{num}', 'MatchController@matchYes');

Route::get('/noticeDest/{num}', 'MatchController@noticeDest');

Route::post('/search', 'MatchController@search');

Route::resource('/matchNo', 'MatchController@matchNo');

//대상자별 업무일지
Route::get('/logSpecTarget/{num}', 'LogSpecController@logSpecTarget');
//대상자별 스냅샷
Route::get('/snapShotTarget/{num}', 'SnapShotController@snapShotTarget');

//d3.js AjaxRoute
Route::get('/chartData/', 'ChartController@jsonTransmit');

//chart value getRoute
Route::get('/chartBluetooth', 'ChartController@getBluetoothValue');
Route::get('/searchImage', 'SnapShotController@searchImage');

Route::get('/searchImage', 'SnapShotController@searchImage');

Route::get('/individual','IndividualController@index');

Route::get('/monitoring', 'MonitoringController@index');
Route::get('/chart', 'ChartController@index');
Route::get('/snapshot', 'SnapShotController@index');


Route::get('/task', 'TaskController@index');

Route::get('/logSpec', 'LogSpecController@index');

Route::get('/individual','IndividualController@index');

Route::resource('/matching', 'MatchController@matching');
Route::resource('match','MatchController');
Route::resource('logSpec','logSpecController');
Route::resource('task','TaskController');
Route::resource('individual','IndividualController');

Route::get('/matchAddressDb', function() {
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

// 추가 정보 페이지
Route::get('/addinfo', 'InformationController@addinfo');
Route::get('/addinfo/update', 'InformationController@add_modify');
Route::post('/addinfo/update', 'InformationController@add_update');

Route::get('infomation/addinfo', [
  'as' => 'addinfo.create',
  'uses' => 'InformationController@add_create',
]);
Route::post('infomation/addinfo', [
  'as' => 'addinfo.store',
  'uses' => 'InformationController@add_store',
]);

// 구인구직 현황 페이지
Route::get('/matchinfo', 'InformationController@matchinfo');

// 회원 정보 페이지
Route::get('/userinfo', 'InformationController@userinfo');
Route::get('/userinfo/update', 'InformationController@user_modify');
Route::post('/userinfo/update', 'InformationController@user_update');

//Route::get('/camera_data', 'CameraDataController@camera_data');
