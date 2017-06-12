<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CameraDataController extends Controller
{
    public function camera_data(Request $request) {
      \DB::table('camera_data')->insert([
        'data' => $request->get('camera_data'),
      ]);

      $camera_data = \DB::table('camera_data')->get();

      if($camera_data) {
       return view("1");
     } else {
       return view("-1");
     }
    }
}
