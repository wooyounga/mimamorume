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

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
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
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();
        $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();
        $snapshot = \DB::table('camera')
        ->join('snapshot', 'camera.num', '=', 'snapshot.camera_num')
        ->where('camera.target_num', 'target.num')->get();

        return view('/poster/create')->with('user', $user)->with('target', $target)->with('snapshot', $snapshot)->with('notice',$notice);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();
        $target = \DB::table('support')->join('target', 'support.target_num', '=', 'target.num')->where('support.family_id', Session::get('id'))->get();

        \DB::table('poster')->insert([
          'target_num' => $request->input('target_num'),
          'snapshot_num' => $request->input('snapshot_num'),
          'clothes' => $request->input('clothes'),
          'other' => $request->input('other'),
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return redirect('/poster/view')->with('user', $user)->with('notice',$notice);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
        $user = \DB::table('user')->where('id', Session::get('id'))->get();

        return view('/poster/view')->with('user', $user)->with('notice',$notice);
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
