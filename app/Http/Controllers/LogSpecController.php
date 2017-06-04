<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogSpecController extends Controller
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
        $log = \DB::table('work_log')
            ->join('work_content', 'work_log.num', '=', 'work_content.num')
            ->select('work_log.*', 'work_content.*')
            ->get();
        return view('task.logSpec')->with('log',$log);
    }

    public function show($num){
        $log = \DB::table('work_log')->where('num',$num)->get();
        $content = \DB::table('work_content')->where('num',$num)->get();
        $target_no = \DB::table('work_log')->where('num',$num)->value('targetNum');
        $target = \DB::table('target')->where('num',$target_no)->get();
        return view('task.logSpecView')->with('log',$log)->with('content',$content)->with('target',$target);
    }
}
