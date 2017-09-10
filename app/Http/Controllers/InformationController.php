<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
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
         $notice = \DB::table('notice')
             ->join('user', 'notice.sender', '=', 'user.id')
             ->where('notice.addressee_id', Session::get('id'))
             ->orderBy('num', 'desc')->get();
           $count = \DB::table('notice')
               ->where('addressee_id', Session::get('id'))
               ->whereNull('notice_check')->count();
         $user = \DB::table('user')->where('id', Session::get('id'))->get();

         return view('info.user.view')->with('user', $user)->with('notice', $notice)->with('count',$count);
       }

       public function user_modify() {
         $notice = \DB::table('notice')->join('user', 'notice.sender', '=', 'user.id')->where('notice.addressee_id',Session::get('id'))->get();
           $count = \DB::table('notice')
               ->where('addressee_id', Session::get('id'))
               ->whereNull('notice_check')->count();
         $user = \DB::table('user')->where('id', Session::get('id'))->get();

         return view('info.user.update')->with('user', $user)->with('notice', $notice)->with('count',$count);
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

      public function add_index() {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
          $count = \DB::table('notice')
              ->where('addressee_id', Session::get('id'))
              ->whereNull('notice_check')->count();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($user[0]->user_type == '保護者') {
          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

          return view('info.add.target.index')->with('target', $target)->with('notice', $notice)->with('count',$count);
        } else {
          $resume = \DB::table('resume')->where('sitter_id', Session::get('id'))->get();
          $license = \DB::table('license')->where('sitter_id', Session::get('id'))->get();

          return view('info.add.supporter.index')->with('resume', $resume)->with('license', $license)->with('notice', $notice)->with('count',$count);
        }
      }

      public function add_create() {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
          $count = \DB::table('notice')
              ->where('addressee_id', Session::get('id'))
              ->whereNull('notice_check')->count();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($user[0]->user_type == '保護者') {
          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->get();

          return view('info.add.target.create')->with('target', $target)->with('notice', $notice);
        } else {
          $resume_count = \DB::table('resume')->get();

          return view('info.add.supporter.create')->with('resume', $resume_count)->with('notice', $notice)->with('count',$count);
        }
      }

      public function add_store(Request $request) {
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($request->hasFile('profile_image')) {
          $profile_image = $request->file('profile_image');
          $filename = time().'.'.$profile_image->getClientOriginalExtension();
          Image::make($profile_image)->resize(210, 270)->save(public_path('/images/profile/'.$filename));
        } else {
          $filename = 'default.jpg';
        }

        if($user[0]->user_type == '保護者') {
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
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]);

          \DB::table('support')->insert([
            'family_id' => Session::get('id'),
            'target_num' => $request->input('num'),
          ]);

          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();
        } else {
          $resume = \DB::table('resume')->where('sitter_id', Session::get('id'))->get();

          \DB::table('resume')->insert([
            'num' => $request->input('num'),
            'profile_image' => $filename,
            'license' => $request->input('license'),
            'sitter_id' => Session::get('id'),
            'center' => $request->input('center'),
            'career' => $request->input('career'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ]);
        }

        return redirect('/addinfo');
      }

      public function add_view($num) {
          $notice = \DB::table('notice')->join('user', 'notice.sender', '=', 'user.id')->where('notice.addressee_id',Session::get('id'))->get();
          $count = \DB::table('notice')
              ->where('addressee_id', Session::get('id'))
              ->whereNull('notice_check')->count();
          $user = \DB::table('user')->where('id', Session::get('id'))->get();

          $target = \DB::table('target')->where('num', $num)->get();

          return view('info.add.target.view')->with('target', $target)->with('notice', $notice)->with('count',$count);
      }

      public function add_modify() {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
          $count = \DB::table('notice')
              ->where('addressee_id', Session::get('id'))
              ->whereNull('notice_check')->count();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($user[0]->user_type == '保護者') {
          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

          return view('info.add.target.update')->with('target', $target)->with('notice', $notice)->with('count',$count);
        } else {
          $resume = \DB::table('resume')->where('sitter_id', Session::get('id'))->get();

          return view('info.add.supporter.update')->with('resume', $resume)->with('notice', $notice)->with('count',$count);
        }
      }

      public function add_update(Request $request) {
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($request->hasFile('profile_image')) {
          $profile_image = $request->file('profile_image');
          $filename = time().'.'.$profile_image->getClientOriginalExtension();
          Image::make($profile_image)->resize(210, 270)->save(public_path('/images/profile/'.$filename));
        }

        if($user[0]->user_type == '保護者') {
          $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();
          $num = $request->num;

          \DB::table('target')->where('num', $num)->update([
            'profile_image' => $filename,
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
            'profile_image' => $filename,
            'license' => $request->input('license'),
            'center' => $request->input('center'),
            'career' => $request->input('career'),
          ]);
        }

        return redirect('/addinfo');
      }

      public function add_destroy() {
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($user[0]->user_type == '保護者') {
          \DB::table('support')->delete();
          \DB::table('target')->delete();
        } else {
          \DB::table('license')->delete();
        }

        return redirect('/addinfo');
      }

      public function add_license(Request $request) {
        \DB::table('license')->insert([
          'license_num' => $request->input('license_num'),
          'sitter_id' => Session::get('id'),
          'license_kind' => $request->input('license_kind'),
          'license_grade' => $request->input('license_grade'),
          'institution' => $request->input('institution'),
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return redirect('/addinfo');
      }

      /**************************     매칭 정보     **************************/

      public function match_index() {
        $notice = \DB::table('notice')->join('user', 'notice.sender', '=', 'user.id')->where('notice.addressee_id', Session::get('id'))->orderBy('num', 'desc')->get();
          $count = \DB::table('notice')
              ->where('addressee_id', Session::get('id'))
              ->whereNull('notice_check')->count();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if($user[0]->user_type == '保護者') {
          $match = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('family_id', Session::get('id'))->get();

          return view('info.match.supporter.list')->with('match', $match)->with('notice', $notice)->with('count',$count);
        } else {
          $match = \DB::table('care')->join('target', 'care.target_num', '=', 'target.num')->where('sitter_id', Session::get('id'))->get();

          return view('info.match..target.list')->with('match', $match)->with('notice', $notice)->with('count',$count);
        }
      }

      public function match_view($num) {
          $notice = \DB::table('notice')->join('user', 'notice.sender', '=', 'user.id')->where('notice.addressee_id',Session::get('id'))->get();
          $count = \DB::table('notice')
              ->where('addressee_id', Session::get('id'))
              ->whereNull('notice_check')->count();
          $user = \DB::table('user')->where('id', Session::get('id'))->get();

          if($user[0]->user_type == '保護者') {
            $match = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('family_id', Session::get('id'))->get();
            $contract = \DB::table('contract')->where('family_id', Session::get('id'))->get();

            return view('info.match.supporter.view')->with('match', $match)->with('contract', $contract)->with('notice', $notice);
          } else {
            $match = \DB::table('care')->join('target', 'care.target_num', '=', 'target.num')->where('sitter_id', Session::get('id'))->get();
            $contract = \DB::table('contract')->where('sitter_id', Session::get('id'))->get();

            return view('info.match.target.view')->with('match', $match)->with('contract', $contract)->with('notice', $notice)->with('count',$count);
          }
      }
}
