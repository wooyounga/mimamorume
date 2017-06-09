<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SnapShotController extends Controller
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
    public function index()
    {
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
        return view('monitor.snapshot')->with('notice',$notice);
    }
}
