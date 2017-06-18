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

    public function create() {
        if(Session::get('id')){
            $alert = '잘못된 접근입니다.';

            return redirect('/home')->with('alert',$alert);
        }else{
            return view('user.login');
        }
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
            Session::set('id', $user_id);
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id',Session::get('id'))
                ->get();

            return redirect('/home')->with('notice',$notice);
        }
    }

    public function destroy() {
      Session::flush();

      return redirect('/');
    }

   /* public function appLogin(Request $request){

      $user_id = $request -> get('id');
      $user_pw = $request -> get('pw');

      $user = \DB::table('user')->get();

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
          echo "0";
      }
      if($check_pw != true){
          echo "0";
      }
      if($check_id == true && $check_pw == true){
          echo "1";

          // return redirect('/home')->with('notice',$notice);
      }
      echo "2";
    }*/

   public function appLogin(Request $request){
    /*   $username = $_POST['userid'];
       $password = $_POST['userpass'];*/

       $username = $request -> get('id');
       $password = $request -> get('pw');
       //라우트에서 post로 설정해두고 리퀘스트 겟 -> 알아서 값 가져옴!!

       $user = \DB::table('user')->get();

       $check_id = false;
       $check_pw = false;

       for( $i = 0 ; $i< count($user) ; $i++) {
           if($user[$i]->id == $username){
               $check_id = true;
               if (Hash::check($password, $user[$i]->pw)) {
                   $check_pw = true;
               }
           }
       }


       if($check_id == true && $check_pw == true) {
           $result = array('userid'=>$username, 'userpass'=>$password);
           echo json_encode($result);
       }

   }
}
