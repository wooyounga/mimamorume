
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class GpsController extends Controller
{
    public function __construct() {
        $this->middleware('web');
    }

    public function getUserGps(Request $request) {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $targetNum = $request->input('phone');

	$target = \DB::table('target')
	    ->where('cellphone', $targetPhone)
	    ->get();
	$targetNum = $target[0]['num'];
	$targetAddressLat = $target[0]['latitude'];
	$targetAddressLon = $target[0]['longitude'];

	$gpsDistance = $this->calculateDistance($lat, $lng, $targetAddressLat, $targetAddressLon);
	if($gpsDistance >= 150) {
	    $this->gpsInsert($lat, $lng, $targetNum, 'out');
	    //push
	    system('node ./js/fcm.js'.'대상자가 외출했습니다.');
	} else {
	    $this->gpsInsert($lat, $lng, $targetNum, 'in');
    }

    //gps data insert in Database
    private function gpsInsert($lat, $lng, $targetNum, $status) {
 	\DB::table('gps_data')->insert([
	    'num' => null,
	    'latitude' => $lat,
	    'longitude' => $lng,
	    'target_num' => $targetNum,
	    'status' => $status,
	    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
	});
    }

    //distance of point to point
    private function calculateDistance($latitude, $longitude, $addressLat, $addressLon) {
	$targetAddressLat = $addressLat;
	$targetAddressLon = $addressLon;

	//return meter
	$R = 6378137;
	$dLat = deg2rad($latitude - $targetAddressLat);
	$dLon = deg2rad($longitude - $targetAddressLon);
	$a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($targetAddressLat)) * cos(deg2rad($latitude)) *
	    sin($dLon / 2) * sin($dLon / 2);
	$c = 2 * atan2(sqrt($a), sqrt(1 - $a));

	$distance = $R * $c;

	return $distance;
    }
}

