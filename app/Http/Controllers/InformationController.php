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

       /**************************     회원 정보     **************************/

       public function user_view() {
         $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
         $user = \DB::table('user')->where('id', Session::get('id'))->get();

         return view('information.userinfo.user')->with('user', $user)->with('notice', $notice);
       }

       public function user_modify() {
         $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
         $user = \DB::table('user')->where('id', Session::get('id'))->get();

         return view('information.userinfo.updateUser')->with('user', $user)->with('notice', $notice);
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

         return redirect('/userinfo');
       }

       /**************************     추가 정보     **************************/

      public function add_view() {
        $notice = \DB::table('notice')->where('addressee_id', Session::get('id'))->get();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($user[0]->user_type == '보호자') {
          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

          return view('information.addinfo.target')->with('target', $target)->with('notice', $notice);
        } else {
          $resume = \DB::table('resume')->where('sitter_id', Session::get('id'))->get();
          $license = \DB::table('license')->where('sitter_id', Session::get('id'))->get();

          return view('information.addinfo.supporter')->with('resume', $resume)->with('license', $license)->with('notice', $notice);
        }
      }

      public function add_create() {
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($user[0]->user_type == '보호자') {
          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->get();

          return view('information.addinfo.addTarget')->with('target', $target)->with('notice', $notice);
        } else {
          $resume = \DB::table('resume')->where('sitter_id', Session::get('id'))->get();

          return view('information.addinfo.addSupporter')->with('resume', $resume)->with('notice', $notice);
        }
      }

      public function add_store(Request $request) {
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($request->hasFile('profile_image')) {
          $profile_image = $request->file('profile_image');
          $filename = time().'.'.$profile_image->getClientOriginalExtension();
          Image::make($profile_image)->resize(100, 130)->save(public_path('/images/profileImage'.$filename));
        }

        if($user[0]->user_type == '보호자') {
          \DB::table('target')->insert([
            'num' => $request->input('num'),
            'name' => $request->input('name'),
            'profile_image' => $filename,
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

          \DB::table('support')->insert([
            'family_id' => Session::get('id'),
            'target_num' => $request->input('num'),
          ]);

          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();
        } else {
          $resume = \DB::table('resume')->where('sitter_id', Session::get('id'))->get();

          if($request->hasFile('profile_image')) {
            $profile_image = $request->file('profile_image');
            $filename = time().'.'.$profile_image->getClientOriginalExtension();
            Image::make($profile_image)->resize(100, 130)->save(public_path('/images/profileImage'.$filename));
          }

          \DB::table('resume')->insert([
            'num' => null,
            'profile_image' => $filename,
            'sitter_id' => Session::get('id'),
            'center' => $request->input('center'),
            'career' => $request->input('career'),
          ]);
        }

        return redirect('/addinfo');
      }

      public function add_modify() {
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($user[0]->user_type == '보호자') {
          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

          return view('information.addinfo.updateTarget')->with('target', $target)->with('notice', $notice);
        } else {
          $resume = \DB::table('resume')->where('sitter_id', Session::get('id'))->get();

          return view('information.addinfo.updateSupporter')->with('resume', $resume)->with('notice', $notice);
        }
      }

      public function add_update(Request $request) {
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($user[0]->user_type == '보호자') {
          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();
          $num = $request->num;

          \DB::table('target')->where('num', $num)->update([
            'profile_image' => $request->input('profile_image'),
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
        } else {
          $resume = \DB::table('resume')->where('sitter_id', Session::get('id'))->get();

          \DB::table('resume')->where('sitter_id', Session::get('id'))->update([
            'profile_image' => $request->input('profile_image'),
            'center' => $request->input('center'),
            'career' => $request->input('career'),
          ]);
        }

        return redirect('/addinfo');
      }

      /**************************     매칭 정보     **************************/

      public function match_view() {
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();


        return view('information.matchinfo.matchingList')->with('notice', $notice);
      }
}
