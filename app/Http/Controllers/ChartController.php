<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();


        $pulseData = $request->input('sensorVal');

        return view('monitor.chart')->with('pulseData', $pulseData)->with('notice',$notice);
    }
}
