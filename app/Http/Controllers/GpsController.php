<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class GpsController extends Controller
{
    //
    public function __construct() {
        $this->middleware('web');
    }

    public function getUserGps(Request $request) {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $targetNum = $request->input('phone');
	
        \DB::table('gps_data')->insert([
            'num' => null,
            'latitude' => $lat,
            'longitude' => $lng,
            'target_num' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
