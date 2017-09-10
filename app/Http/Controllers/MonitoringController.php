<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use Illuminate\Support\Facades\Session;


class MonitoringController extends Controller
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
        if(Session::get('id')){
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();
            $count = \DB::table('notice')
                ->where('addressee_id', Session::get('id'))
                ->whereNull('notice_check')->count();

            return view('monitor.monitoring')->with('notice',$notice)->with('count',$count);
        }else{
            $alert = '誤った処理です.';

            return redirect('/')->with('alert',$alert);
        }
    }
}
