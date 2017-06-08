<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class MatchController extends Controller
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
        $match = \DB::table('matching_post')->get();
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();


        return view('match.match')->with('match',$match)->with('notice',$notice);
    }

    public function create(){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();


        return view('match.matchForm')->with('notice',$notice);
    }

    public function store(Request $request){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();


        \DB::table('matching_post')->insert([
            'num' => null,
            'user_id' => Session::get('id'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_type' => $request->get('subject'),
            'gender' => $request->get('gender'),
            'age' => $request->get('age'),
            'disability' => $request->get('disability'),
            'work_day' => $request->get('week'),
            'work_period' => $request->get('period'),
            'view' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $match = \DB::table('matching_post')->get();

        return view('match.match')->with('match',$match)->with('notice',$notice);
    }

    public function show($num){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();

        $match = \DB::table('matching_post')->where('num',$num)->get();

        $view = $match[0]->view;

        \DB::table('matching_post')->where('num',$num)->update([
            'view' => $view+1
        ]);

        return view('match.matchView')->with('match',$match)->with('notice',$notice);
    }

    public function matching($num){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();

        $user = \DB::table('matching_post')->where('num',$num)->get();
        $user_id = $user[0]->user_id;
        $content = '매칭신청이 왔습니다. 발신자 : '.Session::get('id');

        $notice_log = \DB::table('notice')->where('sender',Session::get('id'))->where('addressee_id',$user_id)->get();

        if($notice_log == '[]'){
            \DB::table('notice')->insert([
                'num' => null,
                'target_num' => null,
                'addressee_id' => $user_id,
                'sender' => Session::get('id'),
                'notice_kind' => '매칭',
                'notice_content' => $content,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $alert = '매칭 신청이 완료되었습니다.';
        }else{
            $alert = '이미 매칭 신청이 완료된 상대입니다.';
        }


        return redirect()->back()->with('alert', $alert)->with('notice',$notice);
    }
}
