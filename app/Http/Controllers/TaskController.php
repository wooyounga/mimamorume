<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Session;
=======
use Illuminate\Support\Facades\Session;
>>>>>>> 4bddb4193ae8d200ad2247b19f048568db04a62a

class TaskController extends Controller
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
        if(Session::get('id')){
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id',Session::get('id'))
                ->get();


            return view('task.task')->with('notice',$notice);
        }else{
            $alert = '잘못된 접근입니다.';

            return redirect('/')->with('alert',$alert);
        }
    }

    public function create(){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();
        $target = \DB::table('care')
            ->join('target','care.target_num','=','target.num')
            ->where('care.sitter_id',Session::get('id'))
            ->get();

        return view('task.logSpecForm')->with('target',$target)->with('notice',$notice);
    }
}
