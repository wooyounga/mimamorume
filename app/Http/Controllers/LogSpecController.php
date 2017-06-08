<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();

        $user_type = \DB::table('user')->where('id',Session::get('id'))->get();

        if($user_type[0]->user_type == '보호사'){
            $log_id = \DB::table('care')->where('sitter_id',Session::get('id'))->get();
            if($log_id == '[]'){
                $log_user = Session::get('id');
            }else{
                $log_user = $log_id[0]->sitter_id;
            }

            $log = \DB::table('work_log')
                ->join('work_content', 'work_log.num', '=', 'work_content.log_num')
                ->where('work_log.sitter_id','=',$log_user)
                ->select('work_log.*', 'work_content.*')
                ->get();
        }else if($user_type[0]->user_type == '보호자'){
            $log_id = \DB::table('contract')->where('family_id',Session::get('id'))->get();
            if($log_id == '[]'){
                $log_user = Session::get('id');

                $log = \DB::table('work_log')
                    ->join('work_content', 'work_log.num', '=', 'work_content.log_num')
                    ->where('work_log.sitter_id','=',$log_user)
                    ->select('work_log.*', 'work_content.*')
                    ->get();
            }else{
                $log_user = $log_id[0]->family_id;

                $log = \DB::table('work_log')
                    ->join('work_content', 'work_log.num', '=', 'work_content.log_num')
                    ->join('contract', 'work_log.sitter_id' ,'=', 'contract.sitter_id')
                    ->where('work_log.sitter_id','=',$log_user)
                    ->select('work_log.*', 'work_content.*')
                    ->get();
            }
        }

        return view('task.logSpec')->with('log',$log)->with('user',$user_type)->with('notice',$notice);
    }

    public function show($num){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();


        $etc = \DB::table('work_log')
            ->join('work_content', 'work_log.num', '=', 'work_content.log_num')
            ->join('medicine_schedule', 'work_log.num', '=', 'medicine_schedule.num')
            ->select('work_log.*', 'work_content.*','medicine_schedule.*')
            ->get();/*
        $log = \DB::table('work_log')->where('num',$num)->get();
        $medicine = \DB::table('medicine_schedule')->where('num',$num)->get();
        $content = \DB::table('work_content')->where('num',$num)->get();*/
        $target_no = \DB::table('work_log')->where('num',$num)->get();
        $target = \DB::table('target')->where('num',$target_no[0]->target_num)->get();

        return view('task.logSpecView')->with('log',$etc)->with('target',$target)->with('notice',$notice);
    }
}
