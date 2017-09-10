<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ChartController extends Controller
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

    public function index() {
        //if(Session::get('id')){

        $notice = \DB::table('notice')
            ->join('user', 'notice.sender', '=', 'user.id')
            ->where('notice.addressee_id', Session::get('id'))
            ->orderBy('num', 'desc')->get();
        $count = \DB::table('notice')
            ->where('addressee_id', Session::get('id'))
            ->whereNull('notice_check')->count();

            return view('monitor.chart')->with('notice',$notice)->with('count', $count);
//        }else{
//            $alert = '잘못된 접근입니다.';
//            return redirect('/')->with('alert',$alert);
//        }
    }

    public function getBluetoothValue(Request $request) {
        $data = $request->input('pulse');
        $targetNum = $request->input('targetNum');

	if($data < 170) {
	    \DB::table('vital_data')->insert(
                [
                    'num' => null,
                    'data_type' => 'pulse',
                    'target_num' => $targetNum,
                    'value' => $data,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
	}

        if($data >= 150) {
            //run node js push
            $message = "心拍数異常";
//	    $origin = 'UTF-8';
//	    $newbee = 'EUC-KR';

//	    $converted_value = mb_convert_encoding($message, $newbee, $origin);

 //          system('node ./js/fcm.js '.$message);
        }




    }


    public function jsonTransmit(Request $request)
    {
        $callback = $request->input('callback');
        $pulseData = \DB::table('vital_data')
	    ->where('vital_data.target_num', 1)
            ->get();
        $dataArray = array();

        $i = 0;
	$valueSum = 0;
        foreach ($pulseData as $data) {
            //avg
	    $valueSum += $data->value;
            $dataArray[$i]['date'] = date("d-i:s", strtotime($data->created_at));
            $dataArray[$i]['vital'] = $data->value;
            $i++;
        }
        $avg = $valueSum / $i;

        return $callback . "(" . json_encode($dataArray) . " ) ";
    }

}
