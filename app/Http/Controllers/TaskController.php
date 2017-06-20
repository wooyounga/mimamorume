<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();

            $targets = \DB::table('target')->get();

            $t_name = [];
            $i = 0;
            foreach ($targets as $target) {
              $t_name[$i] = $target->name;
              $i++;
            }

            return view('main.home')->with([
              'notice' => $notice,
              'targets' => $t_name
            ]);
        }else{
            $alert = '잘못된 접근입니다.';

            return redirect('/')->with('alert',$alert);
        }
    }

    public function create(){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $target = \DB::table('care')
            ->join('target','care.target_num','=','target.num')
            ->where('care.sitter_id',Session::get('id'))
            ->get();

        return view('task.logSpecForm')->with('target',$target)->with('notice',$notice);
    }
}
