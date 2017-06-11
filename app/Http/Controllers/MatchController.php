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
        if(Session::get('id')){
            $match = \DB::table('matching_post')->get();
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id',Session::get('id'))
                ->get();


            return view('match.match')->with('match',$match)->with('notice',$notice);
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

    public function matching($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->get();

        $my_type = \DB::table('user')->where('id', Session::get('id'))->get();
        $user = \DB::table('matching_post')
            ->join('user', 'matching_post.user_id', '=', 'user.id')
            ->where('num', $num)->get();
        $user_id = $user[0]->user_id;
        $content = '매칭신청이 왔습니다. 발신자 : ' . Session::get('id');

        $notice_log = \DB::table('notice')->where('sender', Session::get('id'))->where('addressee_id', $user_id)->get();

        if ($user[0]->user_type == $my_type[0]->user_type) {
            $alert = '상대와 같은 유형은 매칭신청 할 수 없습니다.';
        } else {
            if ($notice_log == '[]') {
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
            } else {
                $alert = '이미 매칭 신청이 완료된 상대입니다.';
            }
        }
        return redirect()->back()->with('alert', $alert)->with('notice', $notice);
    }
    public function matchYes($num, $date)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();

        $user = \DB::table('user')->where('id',Session::get('id'))->get();
        $sender = \DB::table('notice')
            ->where('num',$num)
            ->join('user','notice.sender','=','user.id')
            ->get();
        $content = '매칭신청을 수락하셨습니다. 발신자 : '.Session::get('id');

        if($user[0]->user_type == '보호사'){
            \DB::table('contract')->insert([
                'family_id' => $sender[0]->id,
                'sitter_id' => Session::get('id'),
                'term' => $date,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            \DB::table('notice')->where('num',$num)->delete();
        }else{
            \DB::table('contract')->insert([
                'family_id' => Session::get('id'),
                'sitter_id' => $sender[0]->id,
                'term' => $date,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            \DB::table('notice')->where('num',$num)->delete();
        }
        \DB::table('notice')->insert([
            'num' => null,
            'target_num' => null,
            'addressee_id' => $sender[0]->id,
            'sender' => Session::get('id'),
            'notice_kind' => '수락',
            'notice_content' => $content,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $alert = '매칭이 성공적으로 이루어졌습니다.';

        return redirect('/home')->with('alert', $alert)->with('notice',$notice);
    }

    public function matchNo($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();

        \DB::table('notice')->where('num',$num)->delete();

        $alert = '거절이 완료되었습니다';

        return redirect()->back()->with('alert', $alert)->with('notice',$notice);
    }

    public function noticeDest($num){
        \DB::table('notice')->where('num',$num)->delete();

        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();

        return redirect()->back()->with('notice',$notice);
    }

    public function search(Request $request){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id',Session::get('id'))
            ->get();
        $search_list = array();
        $subject = $request->get('subject');
        $gander = $request->get('gander');
        $age = $request->get('age');
        $disability = $request->get('disability');
        $week = $request->get('week');
        $period = $request->get('period');
        $address = $request->get('roadAddress');
        $search = $request->get('searchInput');

        /*for($i = 0 ; $i < count($age) ; $i++){
            $age_log = \DB::table('matching_post')->where('age',$age[$i])->get();
            $search_list[$i] = $age_log[0];
        }

        for($i = 0 ; $i < count($disability) ; $i++){
            $search_count =  count($search_list);
            $disability_log = \DB::table('matching_post')->where('disability',$disability[$i])->get();
            $search_list[$search_count] = $disability_log[0];
            $search_count++;
        }

        for($i = 0 ; $i < count($week) ; $i++){
            $search_count =  count($search_list);
            $week_log = \DB::table('matching_post')->where('work_day',$week[$i])->get();
            $search_list[$search_count] = $week_log[0];
            $search_count++;
        }

        for($i = 0 ; $i < count($period) ; $i++){
            $search_count =  count($search_list);
            $period_log = \DB::table('matching_post')->where('work_period',$period[$i])->get();
            $search_list[$search_count] = $period_log[0];
            $search_count++;
        }

            $search_count =  count($search_list);
            $search_log = \DB::table('matching_post')
                ->orWhere('gender',$gander)
                ->orWhere('user_type',$subject)
                ->orWhere('content', 'like', '%' . $search . '%')
                ->get();
            $search_list[$search_count] = $search_log[0];*/

       // $result = array_unique($input);
        
//        view('match.match')->with('notice',$notice)
    }
}
