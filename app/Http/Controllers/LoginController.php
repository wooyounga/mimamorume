<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

<<<<<<< HEAD
    public function create(){
        return view('user.login');
=======
    public function index(){
        if(Session::get('id')){
            $alert = '잘못된 접근입니다.';

            return redirect('/home')->with('alert',$alert);
        }else{
            return view('login.login');
        }
>>>>>>> 4bddb4193ae8d200ad2247b19f048568db04a62a
    }

    public function store(Request $request) {
        $user = \DB::table('user')->get();

        $user_id = $request -> get('id');
        $user_pw = $request -> get('pw');

        $check_id = false;
        $check_pw = false;

        for( $i = 0 ; $i< count($user) ; $i++) {
            if($user[$i]->id == $user_id){
                $check_id = true;
                if (Hash::check($user_pw, $user[$i]->pw)) {
                    $check_pw = true;
                }
            }
        }

        if($check_id != true ){
            return redirect()->back()->with('alert', '아이디가 맞지 않습니다.');
        }
        if($check_pw != true){
            return redirect()->back()->with('alert', '비밀번호가 맞지 않습니다.');
        }
        if($check_id == true && $check_pw == true){
<<<<<<< HEAD
            $notice = \DB::table('notice')->where('addressee_id', Session::get('id'))->get();
=======
>>>>>>> 4bddb4193ae8d200ad2247b19f048568db04a62a
            Session::set('id', $user_id);
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id',Session::get('id'))
                ->get();

            return view('main.home')->with('notice',$notice);
        }
    }

    public function destroy() {
      Session::flush();

      return redirect('/');
    }
}
