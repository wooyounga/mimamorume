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
        if (Session::get('id')) {
            $match = \DB::table('matching_post')->get();
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();
            $search = '없음';

            return view('match.match')->with('match', $match)->with('notice', $notice)->with('search', $search);
        } else {
            $alert = '잘못된 접근입니다.';

            return redirect('/')->with('alert', $alert);
        }
    }

    public function create()
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();

        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if ($user[0]->user_type == '보호자') {
            $user_target = \DB::table('support')
                ->join('user', 'support.family_id', '=', 'user.id')
                ->join('target', 'support.target_num', '=', 'target.num')
                ->where('user.id', Session::get('id'))
                ->get();
        } else {
            $user_target = \DB::table('user')->where('id', Session::get('id'))->get();
        }


        return view('match.matchForm')->with('user', $user_target)->with('notice', $notice);
    }

    public function matchvideo(Request $request){
        $video_num = $request->get('video_num');
        $notice_num = $request->get('notice_num');

        $notice_addresse_id = \DB::table('notice')
            ->where('num', $notice_num)
            ->get();

        $target = \DB::table('notice')
                ->where('num', $notice_num)
                ->get();

        $title = Session::get('id').'님께서 화상채팅을 신청하셨습니다.';

        \DB::table('notice')->insert([
            'num' => null,
            'target_num' => $target[0]->target_num,
            'addressee_id' => $notice_addresse_id[0]->sender,
            'sender' => Session::get('id'),
            'work_week' => '',
            'work_start' => '',
            'work_end' => '',
            'work_start_time' => '',
            'work_end_time' => '',
            'notice_title' => $title,
            'notice_kind' => '화상채팅',
            'notice_content' => $video_num,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }

    public function store(Request $request)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();


        \DB::table('matching_post')->insert([
            'num' => null,
            'user_id' => Session::get('id'),
            'target_num' => $request->get('target_num'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'roadAddress' => $request->get('roadAddress'),
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

        return redirect('/match')->with('match', $match)->with('notice', $notice);
    }

    public function show($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();

        $match = \DB::table('matching_post')->where('num', $num)->get();

        $view = $match[0]->view;

        \DB::table('matching_post')->where('num', $num)->update([
            'view' => $view + 1
        ]);

        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if ($user[0]->user_type == '보호자') {
            $target = \DB::table('support')
                ->join('target', 'support.target_num', '=', 'target.num')
                ->where('support.family_id', Session::get('id'))->get();
        } else {
            $target = '없음';
        }

        return view('match.matchView')->with('match', $match)->with('target', $target)->with('notice', $notice);
    }

    public function matching(Request $request)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();

        $my_type = \DB::table('user')->where('id', Session::get('id'))->get();
        $user = \DB::table('matching_post')
            ->join('user', 'matching_post.user_id', '=', 'user.id')
            ->where('num', $request->get('num'))->get();
        $user_id = $user[0]->user_id;

        $notice_log = \DB::table('notice')
            ->where('sender', Session::get('id'))
            ->where('addressee_id', $user_id)
            ->where('notice_kind', '매칭')
            ->get();
        /*   $notice_sender = \DB::table('contract')->where('family_id', $user_id)->where('sitter_id', Session::get('id'))->get();
           $notice_addressee = \DB::table('contract')->where('family_id', Session::get('id'))->where('sitter_id', $user_id)->get();*/

        if($request->get('target_num')){
            $target = $request->get('target_num');
        }else{
            $target = $user[0]->target_num;
        }

        $notice_check = 0;

        if($notice != '[]'){
            for($i = 0; $i < count($notice) ; $i++){
                if($notice[$i]->notice_check == true){
                    $notice_check++;
                }
            }
        }

   //     if ($user[0]->user_type == '보호사') {
            $title = '매칭신청이 왔습니다. 발신자 : ' . Session::get('id');
     //   } else {
       //     $title = '매칭신청이 왔습니다. 발신자 : ' . Session::get('id');
        //}
        if ($user[0]->user_type == $my_type[0]->user_type) {
            $alert = '상대와 같은 유형은 매칭신청 할 수 없습니다.';
        } else {
            if ($notice_log == '[]' && $notice_check == 0) {
                \DB::table('notice')->insert([
                    'num' => null,
                    'target_num' => $target,
                    'addressee_id' => $user_id,
                    'sender' => Session::get('id'),
                    'work_week' => $request->get('work_week'),
                    'work_start' => $request->get('work_start'),
                    'work_end' => $request->get('work_end'),
                    'work_start_time' => $request->get('work_start_time'),
                    'work_end_time' => $request->get('work_end_time'),
                    'notice_title' => $title,
                    'notice_kind' => '매칭',
                    'notice_content' => $request->get('content'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                $alert = '매칭 신청이 완료되었습니다.';
            } else {
                $alert = '이미 매칭 신청이 완료된 상대입니다.';
            }
        }
        return redirect()->back()->with('alert', $alert)->with('notice', $notice);
    }
/*
    public function matchYes($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();

        $user = \DB::table('user')->where('id', Session::get('id'))->get();
        $sender = \DB::table('notice')
            ->where('num', $num)
            ->join('user', 'notice.sender', '=', 'user.id')
            ->get();
        $content = '매칭신청을 수락하셨습니다. 발신자 : ' . Session::get('id');

        $notice_target = \DB::table('notice')
            ->where('notice.addressee_id', Session::get('id'))
            ->where('notice.sender', $sender[0]->id)
            ->where('num', $num)
            ->get();

        $tar = explode('/', $notice_target[0]->notice_content);

        if ($user[0]->user_type == '보호사') {
            \DB::table('contract')->insert([
                'family_id' => $sender[0]->id,
                'sitter_id' => Session::get('id'),
                'term' => $tar[2],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $sitter = Session::get('id');
        } else {
            \DB::table('contract')->insert([
                'family_id' => Session::get('id'),
                'sitter_id' => $sender[0]->id,
                'term' => $tar[2],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $sitter = $sender[0]->id;
        }

        \DB::table('care')->insert([
            'sitter_id' => $sitter,
            'target_num' => $tar[1],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

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

        \DB::table('notice')->where('num', $num)->delete();

        return redirect('/home')->with('alert', $alert)->with('notice', $notice);
    }*/

    public function matchNo($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();

        \DB::table('notice')->where('num', $num)->delete();

        $alert = '거절이 완료되었습니다';

        return redirect()->back()->with('alert', $alert)->with('notice', $notice);
    }

    public function noticeDest($num)
    {
        \DB::table('notice')->where('num', $num)->delete();

        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();

        return redirect()->back()->with('notice', $notice);
    }

    public function search(Request $request)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();

        $subject = $request->get('subject');
        $gander = $request->get('gander');
        $age = $request->get('age');
        $disability = $request->get('disability');
        $week = $request->get('week');
        $period = $request->get('period');
        $address = $request->get('roadAddress');
        $search = $request->get('searchInput');

        $address_search = explode(' ', $address);

        if ($address_search == '') {
            $address_log = $address_search[0] . ' ' . $address_search[1] . ' ' . $address_search[2];
        } else {
            $address_log = null;
        }

        $search_log = \DB::table('matching_post')
            ->where('user_type', $subject)
            ->where('content', 'like', '%' . $search . '%')
            ->where('roadAddress', 'like', '%' . $address_log . '%')
            ->where(function ($query) use ($gander) {
                for ($i = 0; $i < count($gander); $i++)
                    $query->orWhere('gender', $gander[$i]);
            })
            ->where(function ($query) use ($disability) {
                for ($i = 0; $i < count($disability); $i++)
                    $query->orWhere('disability', $disability[$i]);
            })
            ->where(function ($query) use ($age) {
                for ($i = 0; $i < count($age); $i++)
                    $query->orWhere('age', $age[$i]);
            })
            ->where(function ($query) use ($week) {
                for ($i = 0; $i < count($week); $i++)
                    $query->orWhere('work_day', $week[$i]);
            })
            ->where(function ($query) use ($period) {
                for ($i = 0; $i < count($period); $i++)
                    $query->orWhere('work_period', $period[$i]);
            })
            ->get();

        $search_btn = '있음';

        return view('match.match')->with('notice', $notice)->with('match', $search_log)->with('search', $search_btn);
    }

    public function destroy($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();

        \DB::table('matching_post')->where('num', $num)->delete();
        $alert = '게시글이 삭제되었습니다.';

        return redirect('/match')->with('notice', $notice)->with('alert', $alert);
    }

    public function appMatching(Request $request){
        $user = \DB::table('user')->where('id',$request->get('id'))->get();

        if($user[0]->user_type == '보호사'){
            $contract  = \DB::table('contract')
                ->join('user','contract.sitter_id','=','user.id')
                ->where('sitter_id',$request->get('id'))
                ->get();
        }else{
            $contract  = \DB::table('contract')
                ->join('user','contract.family_id','=','user.id')
                ->where('family_id',$request->get('id'))
                ->get();
        }

        if($contract == '[]'){
            $contract_list = [];
        }else{
            $contract_list = $contract;
        }

        echo json_encode(array('contract'=>$contract_list));
    }
    public function matchModify(Request $request, $num){
        if($request->get('btn')=='modify'){
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();

            $notice_num = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.num', $num)
                ->get();

            \DB::table('notice')->where('notice.num', $num)->update([
                'notice_check' => 'true',
            ]);

            $title = '조건 변경요청이 들어왔습니다. 발신자 : '.Session::get('id');

            if($request->get('work_week_input'.$num)){
                $week_input = $request->get('work_week_input'.$num);
            }else{
                $week_input = $request->get('work_week_day'.$num);
            }

            if($request->get('week_check_start_input'.$num) == 'yes'){
                $work_start_input = $request->get('start_work'.$num);
            }else{
                $work_start_input = $request->get('work_start_day'.$num);
            }

            if($request->get('week_check_end_input'.$num) == 'yes'){
                $work_end_input = $request->get('end_work'.$num);
            }else{
                $work_end_input = $request->get('work_end_day'.$num);
            }

            if($request->get('work_start_time_input'.$num)){
                $start_time_input = $request->get('work_start_time_input'.$num);
            }else{
                $start_time_input = $request->get('start_time'.$num);
            }

            if($request->get('work_end_time_input'.$num)){
                $end_time_input = $request->get('work_end_time_input'.$num);
            }else{
                $end_time_input = $request->get('end_time'.$num);
            }
            $content = $request->get('content'.$num);

            \DB::table('notice')->insert([
                'num' => null,
                'target_num' => $notice_num[0]->target_num,
                'addressee_id' => $notice_num[0]->sender,
                'sender' => Session::get('id'),
                'work_week' => $week_input,
                'work_start' => $work_start_input,
                'work_end' => $work_end_input,
                'work_start_time' => $start_time_input,
                'work_end_time' => $end_time_input,
                'notice_title' => $title,
                'notice_kind' => '수정',
                'notice_content' => $content,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $alert = '조건 변경 요청이 완료되었습니다.';

            return redirect()->back()->with('alert',$alert)->with('notice', $notice);
        }else{
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();

            if($request->get('work_week_input'.$num)){
                $week_input = false;
            }else{
                $week_input = true;
            }

            if($request->get('week_check_start_input'.$num) == 'yes'){
                $work_start_input = false;
            }else{
                $work_start_input = true;
            }

            if($request->get('week_check_end_input'.$num) == 'yes'){
                $work_end_input = false;
            }else{
                $work_end_input = true;
            }

            if($request->get('work_start_time_input'.$num)){
                $start_time_input = false;
            }else{
                $start_time_input = true;
            }

            if($request->get('work_end_time_input'.$num)){
                $end_time_input = false;
            }else{
                $end_time_input = true;
            }

            if($week_input == true && $work_start_input == true &&
                $work_end_input == true && $start_time_input == true && $end_time_input == true){
                $user = \DB::table('user')->where('id', Session::get('id'))->get();
                $sender = \DB::table('notice')
                    ->where('num', $num)
                    ->join('user', 'notice.sender', '=', 'user.id')
                    ->get();
                $title = '매칭신청을 수락하셨습니다. 발신자 : ' . Session::get('id');

                $notice_num = \DB::table('notice')
                    ->join('user', 'notice.sender', '=', 'user.id')
                    ->where('notice.num', $num)
                    ->get();

                if ($user[0]->user_type == '보호사') {
                    \DB::table('contract')->insert([
                        'family_id' => $sender[0]->id,
                        'sitter_id' => Session::get('id'),
                        'work_week'=>$request->get('work_week_day'.$num),
                        'work_start'=>$request->get('work_start_day'.$num),
                        'work_end'=>$request->get('work_end_day'.$num),
                        'work_start_time'=>$request->get('start_time'.$num),
                        'work_end_time'=>$request->get('end_time'.$num),
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);

                    $sitter = Session::get('id');
                } else {
                    \DB::table('contract')->insert([
                        'family_id' => Session::get('id'),
                        'sitter_id' => $sender[0]->id,
                        'work_week'=>$request->get('work_week_day'.$num),
                        'work_start'=>$request->get('work_start_day'.$num),
                        'work_end'=>$request->get('work_end_day'.$num),
                        'work_start_time'=>$request->get('start_time'.$num),
                        'work_end_time'=>$request->get('end_time'.$num),
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);

                    $sitter = $sender[0]->id;
                }

                \DB::table('care')->insert([
                    'sitter_id' => $sitter,
                    'target_num' => $notice_num[0]->target_num,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                \DB::table('notice')->insert([
                    'num' => null,
                    'target_num' => null,
                    'addressee_id' => $sender[0]->id,
                    'sender' => Session::get('id'),
                    'work_week'=>$request->get('work_week_day'.$num),
                    'work_start'=>$request->get('work_start_day'.$num),
                    'work_end'=>$request->get('work_end_day'.$num),
                    'work_start_time'=>$request->get('start_time'.$num),
                    'work_end_time'=>$request->get('end_time'.$num),
                    'notice_kind' => '수락',
                    'notice_title' => $title,
                    'notice_content' => null,
                    'notice_check' => 'true',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                $alert = '매칭이 성공적으로 이루어졌습니다.';

                \DB::table('notice')->where('num', $num)->delete();

                return redirect('/home')->with('alert', $alert)->with('notice', $notice);
            }else{
                $alert = '조건 수정시 매칭수락이 불가능 합니다.';

                return redirect()->back()->with('alert', $alert)->with('notice', $notice);
            }
        }
    }
}