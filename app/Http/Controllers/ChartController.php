<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function __construct()
    {

        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) {
        $pulseData = $request->input('sensorVal');

        return view('monitor.chart')->with('pulseData', $pulseData);
    }
}
