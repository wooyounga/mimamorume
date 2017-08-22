<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
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
        $family = \DB::table('user')->where('user_type', '보호자')->get();
        $supporter = \DB::table('user')->where('user_type', '보호사')->get();
        $target = \DB::table('target')->get();
        $contract = \DB::table('contract')->get();

        return view('dashboard')->with('family', $family)->with('supporter', $supporter)->with('target', $target)->with('contract', $contract);
    }
}
