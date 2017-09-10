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
      if(Session::get('user_type') == "管理者"){
	system('node /root/gohtml/mimamo/public/js/fcm.js'.'管理者がログインしました');
        $family = \DB::table('user')->where('user_type', '保護者')->get();
        $supporter = \DB::table('user')->where('user_type', '介護職員')->get();
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
        $alert = '誤った処理です';

        return redirect('/')->with('alert',$alert);
      }
    }
}
