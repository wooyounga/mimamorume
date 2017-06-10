<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

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
        if(Session::get('id')){
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
                    //$log_user = $log_id[0]->family_id;
                    $user_target = \DB::table('contract')
                        ->join('support', 'contract.family_id', '=', 'support.family_id')
                        ->where('contract.family_id',Session::get('id'))
                        ->get();
                    $target_num = $user_target[0]->target_num;

                    $log = \DB::table('work_log')
                        ->join('work_content', 'work_log.num', '=', 'work_content.log_num')
                        ->where('work_log.target_num',$target_num)
                        ->select('work_log.*', 'work_content.*')
                        ->get();
                }
            }

            return view('task.logSpec')->with('log',$log)->with('user',$user_type)->with('notice',$notice);
        }else{
            $alert = '잘못된 접근입니다.';

            return redirect('/')->with('alert',$alert);
        }
    }

    public function show($num){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();


        $etc = \DB::table('work_log')
            ->join('work_content', 'work_log.num', '=', 'work_content.log_num')
            ->join('medicine_schedule', 'work_log.num', '=', 'medicine_schedule.log_num')
            ->where('work_log.num',$num)
            ->select('work_log.*', 'work_content.*','medicine_schedule.*')
            ->get();

        $target_no = \DB::table('work_log')->where('num',$num)->get();
        $target = \DB::table('target')->where('num',$target_no[0]->target_num)->get();

        return view('task.logSpecView')->with('log',$etc)->with('target',$target)->with('notice',$notice);
    }

    public function store(Request $request){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();

        \DB::table('work_log')->insert([
            'num' => null,
            'sitter_id'=>Session::get('id'),
            'target_num'=>$request->get('target_name'),
            'work_date'=> $request->get('date'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $work_log = \DB::table('work_log')->get();
        $count = count($work_log);
        $work_log_num = $work_log[$count-1]->num;

        \DB::table('work_content')->insert([
            'num'=>null,
            'log_num'=>$work_log_num,
            'content_type'=>$request->get('content_type'),
            'content'=>$request->get('content'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $time = explode(' ',$request->get('dateEnd'));

        \DB::table('medicine_schedule')->insert([
            'num' => null,
            'log_num' => $work_log_num,
            'medicine_name' => $request->get('medicine_name'),
            'start_date' => $request->get('dateStart'),
            'end_date' => $request->get('dateEnd'),
            'time' => $time[1],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

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

        $user_type = \DB::table('user')->where('id',Session::get('id'))->get();

        return view('task.logSpec')->with('log',$log)->with('user',$user_type)->with('notice',$notice);
    }
}
