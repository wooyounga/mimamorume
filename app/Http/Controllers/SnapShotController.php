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

            $user_type = \DB::table('user')->where('id',Session::get('id'))->get();

            if($user_type[0]->user_type == '보호사'){
                $target_list = \DB::table('care')
                    ->join('target','care.target_num','=','target.num')
                    ->where('sitter_id',Session::get('id'))
                    ->get();
                if($target_list == '[]'){
                    $activi = '없음';
                }else{
                    $activi = $target_list[0]->num;
                }
              /*  $snapshot = \DB::table('camera')
                    ->join('target','camera.target_num','=','target.num')
                    ->join('snapshot','camera.num')*/
            }else{
                $target_list = \DB::table('support')
                    ->join('target','support.target_num','=','target.num')
                    ->where('family_id',Session::get('id'))
                    ->get();

                $activi = $target_list[0]->num;
            }

            return view('monitor.snapshot')->with('target',$target_list)->with('num',$activi)->with('notice',$notice);
        }else{
            $alert = '잘못된 접근입니다.';

            return redirect('/')->with('alert',$alert);
        }
    }
<<<<<<< HEAD
=======

>>>>>>> 073e03ca39387f0953a52c5507046bd7ce66a241
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
<<<<<<< HEAD

=======
>>>>>>> 073e03ca39387f0953a52c5507046bd7ce66a241
            // 파일인 경우만 목록에 추가한다.
            if(is_file($dir . "/" . $filename)){
                $files[] = $filename;
            }
        }
<<<<<<< HEAD
        $fileArray = array();
        // 파일명을 자름
        foreach ($files as $f) {
            $cameraNum = substr($f, 0, 1);
            $snpshotTypeValue = (int)substr($f, 2, 1);
            $snapshotType = "";
            switch ($snpshotTypeValue) {
                case 1:
                    $snapshotType = "time";
                    break;
                case 2:
                    $snapshotType = "remote";
                    break;
                case 3:
                    $snapshotType = "sensing";
                    break;
            }
            $snapshotName = $f;
            try {
                \DB::table('snapshot')->insert([
                    'snapshot_type' => $snapshotType,
                    'snapshot_name' => $snapshotName,
                    'upload_name' => $snapshotName,
                    'camera_num' => $cameraNum,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            } catch (QueryException $e) {
                continue;
            }
        }
    }
=======
        // 파일명을 자름
        foreach ($files as $f) {

        }
    }

>>>>>>> 073e03ca39387f0953a52c5507046bd7ce66a241
}
