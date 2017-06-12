<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Session;


class SnapShotController extends Controller
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

            return view('monitor.snapshot')->with('notice',$notice);
        }else{
            $alert = '잘못된 접근입니다.';

            return redirect('/')->with('alert',$alert);
        }
    }

    public function searchImage()
    {
        // 폴더명 지정
        $dir = "C:/xampp/htdocs/mima/public/images/monitor/snapshot";
        // 핸들 획득
        $handle  = opendir($dir);
        $files = array();

        // 디렉터리에 포함된 파일을 저장한다.
        while (false !== ($filename = readdir($handle))) {
            if($filename == "." || $filename == ".."){
                continue;
            }
            // 파일인 경우만 목록에 추가한다.
            if(is_file($dir . "/" . $filename)){
                $files[] = $filename;
            }
        }
        // 파일명을 자름
        foreach ($files as $f) {

        }
    }

}
