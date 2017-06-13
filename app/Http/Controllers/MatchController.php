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
                ->get();
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
            ->get();

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

    public function store(Request $request)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->get();


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
            ->get();

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

    public function matching($num, $target, $date)
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

        $notice_log = \DB::table('notice')
            ->where('sender', Session::get('id'))
            ->where('addressee_id', $user_id)
            ->where('notice_kind', '매칭')
            ->get();
        /*   $notice_sender = \DB::table('contract')->where('family_id', $user_id)->where('sitter_id', Session::get('id'))->get();
           $notice_addressee = \DB::table('contract')->where('family_id', Session::get('id'))->where('sitter_id', $user_id)->get();*/

        if ($user[0]->user_type == '보호사') {
            $content = '매칭신청이 왔습니다. 발신자 : ' . Session::get('id') . '/' . $target . '/' . $date;
        } else {
            $target_num = $user[0]->target_num;
            $content = '매칭신청이 왔습니다. 발신자 : ' . Session::get('id') . '/' . $target_num . '/' . $date;
        }
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

    public function matchYes($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->get();

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
    }

    public function matchNo($num)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->get();

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
            ->get();

        return redirect()->back()->with('notice', $notice);
    }

    public function search(Request $request)
    {
        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->get();

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
            ->get();

        \DB::table('matching_post')->where('num', $num)->delete();
        $alert = '게시글이 삭제되었습니다.';

        return redirect('/match')->with('notice', $notice)->with('alert', $alert);
    }
}