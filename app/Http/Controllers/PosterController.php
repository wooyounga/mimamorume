<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PosterController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

foreach($target as $val){
$targetNum = $val->num;
}

        $snapshot = \DB::table('camera')
        ->join('snapshot', 'camera.num', '=', 'snapshot.camera_num')
        ->where('snapshot.snapshot_type', 'sensing')
        ->where('camera.target_num', $targetNum)->orderBy('snapshot.num', 'desc')->get();

if(count($snapshot) == 0){
	return view('/poster/create')->with('user', $user)->with('target', $target)->with('notice',$notice)->with('count',$count);
}
else{
        return view('/poster/create')->with('user', $user)->with('target', $target)->with('snapshot', $snapshot)->with('notice',$notice)->with('count',$count);
}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $notice = \DB::table('notice')
        ->join('user', 'notice.sender', '=', 'user.id')
        ->where('notice.addressee_id', Session::get('id'))
        ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();
        $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

        \DB::table('poster')->insert([
          'target_num' => $request->input('target_num'),
          'snapshot_name' => $request->input('snapshot_name'),
          'clothes' => $request->input('clothes'),
          'other' => $request->input('other'),
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $finalAdd = \DB::table('poster')->max('num');
        $poster = \DB::table('poster')->where('num', $finalAdd)->get();

        return view('/poster/view')->with('user', $user)->with('notice',$notice)->with('target',$target)->with('poster',$poster)->with('count',$count);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $user
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($user)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $user
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $user)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $user
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($user)
    // {
    //     //
    // }
}
