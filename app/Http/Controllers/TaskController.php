<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
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
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();

        return view('task.task')->with('notice',$notice);
    }

    public function create(){
        $notice = \DB::table('notice')->where('addressee_id',Session::get('id'))->get();
        return view('task.logSpecForm')->with('notice',$notice);
    }
}
