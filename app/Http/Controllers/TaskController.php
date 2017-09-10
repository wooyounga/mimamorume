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
            $count = \DB::table('notice')
                ->where('addressee_id', Session::get('id'))
                ->whereNull('notice_check')->count();

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
            ])->with('count',$count);
        }else{
            $alert = '誤った処理です';

            // return redirect('/')->with('alert',$alert);
            return redirect('/');
        }
    }

    public function create(){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();
        $target = \DB::table('care')
            ->join('target','care.target_num','=','target.num')
            ->where('care.sitter_id',Session::get('id'))
            ->get();

        return view('task.logSpecForm')->with('target',$target)->with('notice',$notice)->with('count',$count);
    }
}
