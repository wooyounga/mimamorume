<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
      if(Session::get('user_type') == "관리자"){
	system('node /root/gohtml/mimamo/public/js/fcm.js'.'관리자가 로그인했습니다');
        $family = \DB::table('user')->where('user_type', '보호자')->get();
        $supporter = \DB::table('user')->where('user_type', '보호사')->get();
        $target = \DB::table('target')->get();
        $contract = \DB::table('contract')->get();
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

        return view('dashboard')->with('family', $family)->with('supporter', $supporter)->with('target', $target)->with('contract', $contract)
        ->with('count', $count)->with('notice', $notice);
      }
      else{
        $alert = '잘못된 접근입니다.';

        return redirect('/')->with('alert',$alert);
      }
    }
}
