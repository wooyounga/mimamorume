<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class InformationController extends Controller {
    /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct() {
          $this->middleware('web');
      }

      /**
       * Show the application dashboard.
       *
       * @return \Illuminate\Http\Response
       */

    public function addinfo() {
      $notice = \DB::table('notice')->where('addressee_id', Session::get('id'))->get();
      $user = \DB::table('user')->where('id', Session::get('id'))->get();1903813

      if($user[0]->user_type == '보호자') {
        return view('information.addinfo.target')->with('target', $target)->with('notice', $notice);
      } else {
        return view('information.addinfo.license')->with('license', $license)->with('notice', $notice);
      }
    }

    public function add_modify() {
      $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
      $user = \DB::table('user')->where('id', Session::get('id'))->get();

      if($user[0]->user_type == '보호자') {
        return view('information.addinfo.updateTarget')->with('notice', $notice);
      } else {
        return view('information.addinfo.updateLicense')->with('notice', $notice);
      }
    }

    public function matchinfo() {
      $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();

      return view('information.matchinfo.matchingList')->with('notice', $notice);
    }

    public function userinfo() {
      $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
      $user = \DB::table('user')->where('id', Session::get('id'))->get();

      return view('information.userinfo.userInfo')->with('user', $user)->with('notice', $notice);
    }

    public function user_modify() {
      $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
      $user = \DB::table('user')->where('id', Session::get('id'))->get();

      return view('information.userinfo.updateUserInfo')->with('user', $user)->with('notice', $notice);
    }

    public function user_update(Request $request) {
      $this->validate($request, [
        'name' => 'required|max:255',
        'pw' => 'required|min:6|confirmed',
        'email' => 'required|email|max:255',
        'telephone' => 'required|max:50',
        'cellphone' => 'required|max:50',
        'zip_code' => 'required|max:50',
        'main_address' => 'required|max:50',
        'rest_address' => 'max:50',
      ]);

      $user = \App\User::where('id', Session::get('id'))->first()->update([
        'name' => $request->input('name'),
        'pw' => bcrypt($request->input('pw')),
        'email' => $request->input('email'),
        'telephone' => $request->input('telephone'),
        'cellphone' => $request->input('cellphone'),
        'zip_code' => $request->input('zip_code'),
        'main_address' => $request->input('main_address'),
        'rest_address' => $request->input('rest_address'),
      ]);

      return redirect('/home');
    }
}
