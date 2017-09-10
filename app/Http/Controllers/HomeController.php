<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        if(Session::get('id')){
            if(Session::get('user_type') == '管理者'){
                return redirect('/dashboard');
            }
            else{
                $notice = \DB::table('notice')
                    ->join('user', 'notice.sender', '=', 'user.id')
                    ->where('notice.addressee_id', Session::get('id'))
                    ->orderBy('num', 'desc')->get();
                $count = \DB::table('notice')
                    ->where('addressee_id', Session::get('id'))
                    ->whereNull('notice_check')->count();
                $user = \DB::table('user')->where('id',Session::get('id'))->get();

                if($user[0]->user_type == '保護者'){
                    $contract = \DB::table('contract')->where('family_id',Session::get('id'))->get();
                }else{
                    $contract = \DB::table('contract')->where('sitter_id',Session::get('id'))->get();
                }
            }

            if($contract != '[]'){
//                return view('main.home')->with('notice',$notice);
		            return redirect('/task');
            }else{
                return redirect('/match')->with('notice',$notice);
            }

        }else{
            $alert = '誤った処理です';

            return redirect('/')->with('alert',$alert);
        }
    }
}
