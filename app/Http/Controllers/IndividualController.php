<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndividualController extends Controller
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
        $user = \DB::table('user')->where('id', 'user1')->get();
        if($user[0]->userType == '보호사'){
            $etc = DB::table('resume')
                ->join('user', 'resume.sitterId', '=', 'user.id')
                ->join('license', function ($join) {
                    $join->on('resume.sitterId', '=', 'license.sitterId')->orOn('resume.lisence', '=', 'license.licenseNum');
                })
                ->select('user.*', 'resume.*','license.*')
                ->get();
        }else{
            $etc = DB::table('users')
                ->join('target', 'users.id', '=', 'target.user_id')
                ->select('users.*', 'target.*')
                ->get();
        }
        return view('individual.individual')->with('user', $user)->with('etc',$etc);
    }

    public function create()
    {
        $user = \DB::table('user')->where('id', 'user1')->get();
        if($user[0]->userType == '보호사'){
            $etc = DB::table('resume')
                ->join('user', 'resume.sitterId', '=', 'user.id')
                ->join('license', 'resume.sitterId', '=', 'license.sitterId')
                ->select('user.*', 'resume.*','license.*')
                ->get();
        }else{
            $etc = DB::table('user')
                ->join('target', 'user.id', '=', 'target.user_id')
                ->select('user.*', 'target.*')
                ->get();
        }
        return view('individual.individualForm')->with('user', $user)->with('etc',$etc);
    }

    public function update(Request $request,$id){
/*        $etc = DB::table('user')->findOrFail($id);

        $etc->update([
            'name' => $request->get('name'),
            'id' => $request->get('id'),
            'pw' => $request->get('pw'),
            'age' => $request->get('age'),
            'gender' => $request->get('gender'),
            'telephone' => $request->get('phone'),
            'cellphone' => $request->get('cellphone'),
            'email' => $request->get('email'),


        ]);*/
    }
}
