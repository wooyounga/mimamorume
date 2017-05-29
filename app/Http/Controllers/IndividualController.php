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
                ->join('contacts', 'users.id', '=', 'contacts.user_id')
                ->join('orders', 'users.id', '=', 'orders.user_id')
                ->select('users.*', 'contacts.phone', 'orders.price')
                ->get();
        }
        return view('individual.individual')->with('user', $user)->with('etc',$etc);
    }

    public function create()
    {
        return view('individual.individualForm');
    }
}
