<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

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
      $user = \DB::table('user')->where('id', Session::get('id'))->get();
      $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

      if($user[0]->user_type == '보호자') {
        return view('information.addinfo.target')->with('target', $target)->with('notice', $notice);
      } else {
        return view('information.addinfo.license')->with('license', $license)->with('notice', $notice);
      }
    }

    public function add_create() {
      $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
      $user = \DB::table('user')->where('id', Session::get('id'))->get();
      $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

      if($user[0]->user_type == '보호자') {
        return view('information.addinfo.addTarget')->with('target', $target)->with('notice', $notice);
      } else {
        return view('information.addinfo.addLicense')->with('license', $license)->with('notice', $notice);
      }
    }

    public function add_store(Request $request) {
      $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
      $user = \DB::table('user')->where('id', Session::get('id'))->get();
      $support = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

      $target = \App\Target::create([
        'name' => $request->input('name'),
        'profile_image' => $request->input('profile_image'),
        'age' => $request->input('age'),
        'gender' => $request->input('gender'),
        'telephone' => $request->input('telephone'),
        'cellphone' => $request->input('cellphone'),
        'zip_code' => $request->input('zip_code'),
        'main_address' => $request->input('main_address'),
        'rest_address' => $request->input('rest_address'),
        'latitude' => $request->input('latitude'),
        'longitude' => $request->input('longitude'),
        'disability_main' => $request->input('disability_main'),
        'disability_sub' => $request->input('disability_sub'),
        'comment' => $request->input('comment'),
      ]);

      if($user[0]->user_type == '보호자') {
        return redirect('information.addinfo.target')->with('target', $support)->with('notice', $notice);
      } else {
        return redirect('information.addinfo.license')->with('license', $license)->with('notice', $notice);
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
