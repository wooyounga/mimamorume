<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
            $count = \DB::table('notice')
                ->where('addressee_id', Session::get('id'))
                ->whereNull('notice_check')->count();

            $search = 'なし';

            return view('match.match')->with('match', $match)->with('notice', $notice)->with('search', $search)->with('count',$count);
        } else {
            $alert = '誤った処理です';

            return redirect('/')->with('alert', $alert);
        }
    }

    public function create()
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if ($user[0]->user_type == '保護者') {
            $user_target = \DB::table('support')
                ->join('user', 'support.family_id', '=', 'user.id')
                ->join('target', 'support.target_num', '=', 'target.num')
                ->where('user.id', Session::get('id'))
                ->get();
        } else {
            $user_target = \DB::table('user')->where('id', Session::get('id'))->get();
        }


        return view('match.matchForm')->with('user', $user_target)->with('notice', $notice)->with('count',$count);
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

        $title = Session::get('id').'様から画像チャットの申し込みが届きました。';

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
            'notice_kind' => '画像チャット',
            'notice_content' => $video_num,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }

    public function notice(){
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

        $count = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->where('notice.notice_check',false);

        return redirect()->back()->with('notice',$notice)->with('count',$count);
    }

    public function store(Request $request)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();


        \DB::table('matching_post')->insert([
            'num' => null,
            'user_id' => Session::get('id'),
            'target_num' => $request->get('target_num'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'roadAddress' => $request->get('roadAddress'),
            'gender' => $request->get('gender'),
            'age' => $request->get('age'),
            'disability' => $request->get('disability'),
            'work_day' => $request->get('week'),
            'work_period' => $request->get('period'),
            'view' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $match = \DB::table('matching_post')->get();

        return redirect('/match')->with('match', $match)->with('notice', $notice)->with('count',$count);
    }

    public function show($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

        $match = \DB::table('matching_post')->where('num', $num)->get();

        $view = $match[0]->view;

        \DB::table('matching_post')->where('num', $num)->update([
            'view' => $view + 1
        ]);

        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        if ($user[0]->user_type == '保護者') {
            $target = \DB::table('support')
                ->join('target', 'support.target_num', '=', 'target.num')
                ->where('support.family_id', Session::get('id'))->get();
        } else {
            $target = 'なし';
        }

        return view('match.matchView')->with('match', $match)->with('target', $target)->with('notice', $notice)->with('count',$count);
    }

    public function matching(Request $request)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

        $my_type = \DB::table('user')->where('id', Session::get('id'))->get();
        $user = \DB::table('matching_post')
            ->join('user', 'matching_post.user_id', '=', 'user.id')
            ->where('num', $request->get('num'))->get();
        $user_id = $user[0]->user_id;

        $notice_log = \DB::table('notice')
            ->where('sender', Session::get('id'))
            ->where('addressee_id', $user_id)
            ->where('notice_kind', 'マッチング')
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
            $title = 'マッチング申し込みが届きました。発信者 : ' . Session::get('id');
     //   } else {
       //     $title = '매칭신청이 왔습니다. 발신자 : ' . Session::get('id');
        //}
        if ($user[0]->user_type == $my_type[0]->user_type) {
            $alert = 'マッチングする対象ではありません。';
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
                    'notice_kind' => 'マッチング',
                    'notice_content' => $request->get('content'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                $alert = 'マッチング申し込みが完了されました。';

		//matching push
                $message = 'マッチング申し込みが届きました。';
		system('node ./js/fcm.js '.$message);

                //$this->pushCurl("매칭신청이 왔습니다. 컴퓨터에서 확인해주세요");
            } else {
                $alert = 'もうマッチング申し込みが完了された対象です。';
            }
        }
        return redirect()->back()->with('alert', $alert)->with('notice', $notice)->with('count',$count);
    }

    public function matchNo($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

        \DB::table('notice')->where('num', $num)->delete();

        $alert = '拒絶が完了されました。';

        return redirect()->back()->with('alert', $alert)->with('notice', $notice)->with('count',$count);
    }

    public function noticeDest($num)
    {
        \DB::table('notice')->where('num', $num)->delete();

        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

        return redirect()->back()->with('notice', $notice)->with('count',$count);
    }

    public function search(Request $request)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

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
            $address_log = $address_search[0].' '.$address_search[1].' '.$address_search[2];
        } else {
            $address_log = null;
        }

        if($subject == '対象者'){
            $search_log = \DB::table('matching_post')
                ->join('user', 'matching_post.user_id', '=', 'user.id')
                ->where('user.user_type','保護者')
                ->where('matching_post.content', 'like', '%'.$search.'%')
                ->where('matching_post.roadAddress', 'like', '%'.$address_log.'%')
                ->where(function ($query) use ($gander) {
                    for ($i = 0; $i < count($gander); $i++)
                        $query->orWhere('matching_post.gender', $gander[$i]);
                })
                ->where(function ($query) use ($disability) {
                    for ($i = 0; $i < count($disability); $i++)
                        $query->orWhere('matching_post.disability', $disability[$i]);
                })
                ->where(function ($query) use ($age) {
                    for ($i = 0; $i < count($age); $i++)
                        $query->orWhere('matching_post.age', $age[$i]);
                })
                ->where(function ($query) use ($week) {
                    for ($i = 0; $i < count($week); $i++)
                        $query->orWhere('matching_post.work_day', $week[$i]);
                })
                ->where(function ($query) use ($period) {
                    for ($i = 0; $i < count($period); $i++)
                        $query->orWhere('matching_post.work_period', $period[$i]);
                })
                ->get();
        }else{
            $search_log = \DB::table('matching_post')
                ->join('user', 'matching_post.user_id', '=', 'user.id')
                ->where('user.user_type','介護職員')
                ->where('matching_post.content', 'like', '%'.$search.'%')
                ->where('matching_post.roadAddress', 'like', '%' . $address_log . '%')
                ->where(function ($query) use ($gander) {
                    for ($i = 0; $i < count($gander); $i++)
                        $query->orWhere('user.gender', $gander[$i]);
                })
                ->where(function ($query) use ($age) {
                      if($age == '70代以上'){
                        for ($i = 0; $i < count($age); $i++){
                            $age = explode('代',$age[$i])[0];
                            $query->orWhereBetween('user.age', [$age,999]);
                        }
                      }
                      else{
                        for ($i = 0; $i < count($age); $i++){
                            $age = explode('代',$age[$i])[0];
                            $query->orWhereBetween('user.age', [$age,$age+9]);
                        }
                      }
                })
                ->where(function ($query) use ($week) {
                    for ($i = 0; $i < count($week); $i++)
                        $query->orWhere('matching_post.work_day', $week[$i]);
                })
                ->where(function ($query) use ($period) {
                    for ($i = 0; $i < count($period); $i++)
                        $query->orWhere('matching_post.work_period', $period[$i]);
                })
                ->get();
        }

        $search_btn = 'ある';

        return view('match.match')->with('notice', $notice)->with('match', $search_log)->with('search', $search_btn)->with('count',$count);
    }

    public function destroy($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

        \DB::table('matching_post')->where('num', $num)->delete();
        $alert = '削除されました。';

        return redirect('/match')->with('notice', $notice)->with('alert', $alert)->with('count',$count);
    }

    public function appMatching(Request $request){
        $user = \DB::table('user')->where('id',$request->get('id'))->get();

        if($user[0]->user_type == '介護職員'){
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
            $count = \DB::table('notice')
                ->where('addressee_id', Session::get('id'))
                ->whereNull('notice_check')->count();

            $notice_num = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.num', $num)
                ->get();

            \DB::table('notice')->where('notice.num', $num)->update([
                'notice_check' => 'true',
            ]);

            $title = '条件変更要請が届きました。発信者 : '.Session::get('id');

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
                'notice_kind' => '修正',
                'notice_content' => $content,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $alert = '条件変更の要請が完了されました。';

	    //matcing succeed push
	    $message = '契約が完了されました。';
	    system('node ./js/fcm.js'.$message);

            return redirect()->back()->with('alert',$alert)->with('notice', $notice)->with('count',$count);
        }else{
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();
            $count = \DB::table('notice')
                ->where('addressee_id', Session::get('id'))
                ->whereNull('notice_check')->count();

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
                $title = '契約できました。発信者 : ' . Session::get('id');

                $notice_num = \DB::table('notice')
                    ->join('user', 'notice.sender', '=', 'user.id')
                    ->where('notice.num', $num)
                    ->get();

                if ($user[0]->user_type == '介護職員') {
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
                    'notice_kind' => '承諾',
                    'notice_title' => $title,
                    'notice_content' => null,
                    'notice_check' => 'true',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                $alert = '契約が完了されました。';

                \DB::table('notice')->where('num', $num)->delete();

                return redirect('/home')->with('alert', $alert)->with('notice', $notice)->with('count',$count);
            }else{
                $alert = '条件変更したら承諾できません。';

                return redirect()->back()->with('alert', $alert)->with('notice', $notice)->with('count',$count);
            }
        }
    }

    public function pushCurl($message)
    {
        $u = "http://133.130.99.167/mimamo/public/fcm";
        $array = ['message'=>$message];
        $url = $u.'?'.http_build_query($array);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}
