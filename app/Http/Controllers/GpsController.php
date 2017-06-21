<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GpsController extends Controller
{
    //

    public function getUserGps(Request $request) {
        $lat = $request->input('');
        $lng = $request->input('');
        $targetNum = $request->input('');
    }
}
