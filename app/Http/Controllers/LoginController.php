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
            $alert = '誤った処理です';

            return redirect('/task')->with('alert',$alert);
        }else{
            return view('main.welcome');
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
            return redirect()->back()->with('alert', 'アカウントが合わないです');
        }
        if($check_pw != true){
            return redirect()->back()->with('alert', 'パスワードが合わないです');
        }
        if($check_id == true && $check_pw == true){
            Session::set('id', $user_id);
            $user = \DB::table('user')
                ->where('id', Session::get('id'))
                ->get();
            Session::set('user_type', $user[0]->user_type);
            Session::set('name', $user[0]->name);

            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();
            $count = \DB::table('notice')
                ->where('addressee_id', Session::get('id'))
                ->whereNull('notice_check')->count();


            return redirect('/home')->with('notice',$notice)->with('count', $count);
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

       $username = $request -> input('id');
       $password = $request -> input('pw');



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

           /*$result = array('userid'=>$username, 'userpass'=>$password);
           echo json_encode($result);*/
           //Session::set('id', $username);

 //          $result = ["result" => ['id'=>$username, 'pw'=>$password]];
//           echo json_encode($result);
           echo "success";
       }else{
           echo "failure";
       }

   }
}
