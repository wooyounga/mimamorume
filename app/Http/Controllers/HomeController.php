<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Session;
=======
use Illuminate\Support\Facades\Session;
>>>>>>> 4bddb4193ae8d200ad2247b19f048568db04a62a

class HomeController extends Controller
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
    public function index()
    {
<<<<<<< HEAD
        $notice = \DB::table('notice')->where('addressee_id', Session::get('id'))->get();
=======
        if(Session::get('id')){
            /*
        $notice_db = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))->get();*/
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id',Session::get('id'))
                ->get();
>>>>>>> 4bddb4193ae8d200ad2247b19f048568db04a62a

            /*$notice_cont = \DB::table('user')
                ->join('resume', 'user.id', '=', 'resume.sitter_id')
                ->join('license', function ($join) {
                    $join->on('resume.sitter_id', '=', 'license.sitter_id')->orOn('resume.lisence', '=', 'license.license_num');
                })
                ->where('user.id',$notice_db[0]->id)->get();

            $notice_care = \DB::table('user')
                ->join('notice','user.id' , '=', 'notice.addressee_id')
                ->join('care', 'user.id', '=', 'care.sitter_id')
                ->join('target','care.target_num', '=', 'target.num')
                ->where('notice.addressee_id',$notice_db[0]->id)->get();*/


            return view('main.home')->with('notice',$notice);
        }else{
            $alert = '잘못된 접근입니다.';

            return redirect('/')->with('alert',$alert);
        }
    }
}
