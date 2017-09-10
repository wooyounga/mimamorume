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

// 구인구직 서비스 라우트
Route::get('/destroy/{num}', 'MatchController@destroy');

Route::resource('/matching', 'MatchController@matching');

Route::get('/matchmodify/{num}', 'MatchController@matchModify');

//Route::get('/matchYes/{num}', 'MatchController@matchYes');

Route::get('/noticeDest/{num}', 'MatchController@noticeDest');

Route::post('/search', 'MatchController@search');

Route::get('/matchNo/{num}', 'MatchController@matchNo');

Route::get('/push', 'ChartController@pushCurl');

Route::get('/matchvideo','MatchController@matchvideo');

Route::get('/notice','MatchController@notice');

//대상자별 업무일지
Route::get('/logSpecTarget/{num}', 'LogSpecController@logSpecTarget');
Route::get('/logSpecFilter/{filter}/{num}', 'LogSpecController@logSpecFilter');
//대상자별 스냅샷
Route::get('/snapShotTarget/{num}', 'SnapShotController@snapShotTarget');

Route::get('/appIndex', 'LogSpecController@appIndex');

Route::get('/appmatching', 'MatchController@appMatching');

//send img to android
Route::get('/imageSend', 'SnapShotController@imageSend');

//d3.js AjaxRoute
Route::get('/chartData/', 'ChartController@jsonTransmit');

//chart value getRoute
Route::post('/chartBluetooth', 'ChartController@getBluetoothValue');
Route::get('/searchImage', 'SnapShotController@searchImage');

Route::get('/monitoring', 'MonitoringController@index');
Route::get('/chart', 'ChartController@index');
Route::get('/snapshot', 'SnapShotController@index');
Route::get('/snapShotFilter/{filter}/{num}', 'SnapShotController@snapShotFilter');

Route::resource('match','MatchController');
Route::resource('logSpec','LogSpecController');
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
Route::post('auth/applogin', 'LoginController@appLogin');

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

// 회원 정보 페이지
Route::get('/userinfo', 'InformationController@user_view');
Route::get('/userinfo/modify', 'InformationController@user_modify');
Route::post('/userinfo/update', 'InformationController@user_update');

// 추가 정보 페이지
Route::get('/addinfo', 'InformationController@add_index');
Route::get('/addinfo/create', 'InformationController@add_create');
Route::post('/addinfo/store', 'InformationController@add_store');
Route::get('/addinfo/view/{num}', 'InformationController@add_view');
Route::get('/addinfo/modify', 'InformationController@add_modify');
Route::post('/addinfo/update', 'InformationController@add_update');
Route::get('/addinfo/destroy', 'InformationController@add_destroy');
Route::post('/addinfo/license', 'InformationController@add_license');

// 구인구직 현황 페이지
Route::get('/matchinfo', 'InformationController@match_index');
Route::get('/matchinfo/view/{num}', 'InformationController@match_view');

// 전단지 페이지
Route::get('poster/create', 'PosterController@create');
Route::post('poster/store', 'PosterController@store');

Route::get('/camera_data', 'CameraDataController@camera_data');

// 달력 - 근무일정
Route::post('calmonth', 'CalendarController@calMonth');
Route::get('delcal', 'CalendarController@delCal');
Route::get('delallcal', 'CalendarController@delAllCal');
Route::resource('calendar', 'CalendarController');

// FCM Push
Route::resource('fcm', 'FCMController');

//gps
Route::get('gps', 'GpsController@getUserGps');

Route::get('/video', function () {
    // default => return view('welcome');
    return view('index');
});

Route::get('/dashboard', 'DashboardController@index');
