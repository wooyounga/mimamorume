<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AddInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
      $getType = \DB::table('user')->where('id', Session::get('id'))->get();

        if($getType[0]->user_type == '보호자') {
          return view('addinfo.target')->with('notice', $notice);
        } else {
          return view('addinfo.license')->with('notice', $notice);
        }
    }

    public function addTarget() {

    }

    public function addLicense() {
      
    }
}
