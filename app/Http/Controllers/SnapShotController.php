<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

use Illuminate\Database\QueryException;

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
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();
            $count = \DB::table('notice')
                ->where('addressee_id', Session::get('id'))
                ->whereNull('notice_check')->count();

            $user_type = \DB::table('user')->where('id',Session::get('id'))->get();

            if($user_type[0]->user_type == '介護職員'){
                $target_list = \DB::table('care')
                    ->join('target','care.target_num','=','target.num')
                    ->where('sitter_id',Session::get('id'))
                    ->get();
                if($target_list == '[]'){
                    $activi = 'なし';
                }else{
                    $activi = $target_list[0]->num;
                }
            }else{
                $target_list = \DB::table('support')
                    ->join('target','support.target_num','=','target.num')
                    ->where('family_id',Session::get('id'))
                    ->get();

                $activi = $target_list[0]->num;
            }
            $snapshot = \DB::table('camera')
                ->join('target','camera.target_num','=','target.num')
                ->join('snapshot','camera.num','=','snapshot.camera_num')
                ->where('target.num',$activi)
                ->orderBy('snapshot.created_at', 'desc')
                ->get();

            return view('monitor.snapshot')->with('target',$target_list)->with('snapshot',$snapshot)->with('num',$activi)->with('notice',$notice)->with('count',$count);
        }else{
            $alert = '誤った処理です';

            return redirect('/')->with('alert',$alert);
        }
    }

    public function snapShotFilter($filter, $num){
        if(Session::get('id')){
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();
            $count = \DB::table('notice')
                ->where('addressee_id', Session::get('id'))
                ->whereNull('notice_check')->count();

            $user_type = \DB::table('user')->where('id',Session::get('id'))->get();

            if($user_type[0]->user_type == '介護職員'){
                $target_list = \DB::table('care')
                    ->join('target','care.target_num','=','target.num')
                    ->where('sitter_id',Session::get('id'))
                    ->get();
            }else{
                $target_list = \DB::table('support')
                    ->join('target','support.target_num','=','target.num')
                    ->where('family_id',Session::get('id'))
                    ->get();
            }
            $snapshot = \DB::table('camera')
                ->join('target','camera.target_num','=','target.num')
                ->join('snapshot','camera.num','=','snapshot.camera_num')
                ->where('target.num',$num)
                ->where('snapshot.snapshot_type',$filter)
                ->orderBy('snapshot.created_at', 'desc')
                ->get();

            $activi = $num;

            return view('monitor.snapshot')->with('target',$target_list)->with('snapshot',$snapshot)->with('num',$activi)->with('notice',$notice)->with('count',$count);
        }else{
            $alert = '誤った処理です';

            return redirect('/')->with('alert',$alert);
        }
    }

    public function snapShotTarget($num){
        if(Session::get('id')){
            $notice = \DB::table('notice')
                ->join('user', 'notice.sender', '=', 'user.id')
                ->where('notice.addressee_id', Session::get('id'))
                ->orderBy('num', 'desc')->get();
            $count = \DB::table('notice')
                ->where('addressee_id', Session::get('id'))
                ->whereNull('notice_check')->count();

            $user_type = \DB::table('user')->where('id',Session::get('id'))->get();

            if($user_type[0]->user_type == '介護職員'){
                $target_list = \DB::table('care')
                    ->join('target','care.target_num','=','target.num')
                    ->where('sitter_id',Session::get('id'))
                    ->get();
            }else{
                $target_list = \DB::table('support')
                    ->join('target','support.target_num','=','target.num')
                    ->where('family_id',Session::get('id'))
                    ->get();
            }
            $snapshot = \DB::table('camera')
                ->join('target','camera.target_num','=','target.num')
                ->join('snapshot','camera.num','=','snapshot.camera_num')
                ->where('target.num',$num)
                ->orderBy('snapshot.created_at', 'desc')
                ->get();

            $activi = $num;

            return view('monitor.snapshot')->with('target',$target_list)->with('snapshot',$snapshot)->with('num',$activi)->with('notice',$notice)->with('count',$count);
        }else{
            $alert = '誤った処理です';

            return redirect('/')->with('alert',$alert);
        }
    }

    public function searchImage()
    {
        // 폴더명 지정
        $dir = "images/monitor/snapShot";
        // 핸들 획득
        $handle = opendir($dir);
        $files = array();

        // 디렉터리에 포함된 파일을 저장한다.
        while (false !== ($filename = readdir($handle))) {
            if ($filename == "." || $filename == "..") {
                continue;
            }

            // 파일인 경우만 목록에 추가한다.
            if (is_file($dir . "/" . $filename)) {
                $files[] = $filename;
            }
        }

        foreach ($files as $f) {
            $cameraNum = substr($f, 0, 1);
            $snapshotTypeValue = (int)substr($f, 2, 1);
            $snapshotType = "";
            switch ($snapshotTypeValue) {
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
		return "url connect";
            } catch (QueryException $e) {
                continue;
            }
        }
    }

    public function imageSend() {
        $result = \DB::table('snapshot')->orderBy('num', 'desc')->get();

        $array = array();
        foreach($result as $value) {
            $json = [
                "image_url" => $value->upload_name,
		"user_name" => "イ・ヒョンピル",
		"snapshot_type" => $value->snapshot_type,
		"date" => $value->created_at
            ];
            array_push($array, $json);
        }

        echo json_encode($array);
    }
}
