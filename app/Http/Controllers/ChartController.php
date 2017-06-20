<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
                ->where('notice.addressee_id',Session::get('id'))
                ->get();

            return view('monitor.chart')->with('notice',$notice);
//        }else{
//            $alert = '잘못된 접근입니다.';
//            return redirect('/')->with('alert',$alert);
//        }
    }

    public function getBluetoothValue(Request $request) {
        $data = $request->input('pulse');
        $targetNum = $request->input('targetNum');
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


    public function jsonTransmit(Request $request)
    {
        $callback = $request->input('callback');
        $pulseData = \DB::table('vital_data')
            ->get();
        $dataArray = array();

        $i = 0;
//        $before = 0;
//        $valueSum = 0;
//        $count = 1;
        foreach ($pulseData as $data) {
            //평균 알고리즘
//            if($i == 0 and $before != (int)date("s", strtotime($data->created_at))) {
//                $valueSum += $data->value;
//            } else if($before != (int)date("s", strtotime($data->created_at)) || $i == count($pulseData) - 1) {
//                if($i == count($pulseData) - 1) {
//                    $count++;
//                    $valueSum += $data->value;
//                }
//                $dataArray[$i]['date'] = date("d-i:s", strtotime($data->created_at));
//                $dataArray[$i]['close'] = (int)($valueSum / $count);
//                $valueSum = $data->value;
//                $count = 1;
//            } else {
//                $valueSum += $data->value;
//                $count++;
//            }
//            $before = (int)date("s", strtotime($data->created_at));
            $dataArray[$i]['date'] = date("d-i:s", strtotime($data->created_at));
            $dataArray[$i]['close'] = $data->value;
            $i++;
        }
        return $callback . "(" . json_encode($dataArray) . " ) ";
    }


//    public function index(Request $request) {
//        if(Session::get('id')){
//            $notice = \DB::table('notice')
//                ->join('user', 'notice.sender', '=', 'user.id')
//                ->where('notice.addressee_id',Session::get('id'))
//                ->get();
//
//
//            $pulseData = $request->input('sensorVal');
//
//            return view('monitor.chart')->with('pulseData', $pulseData)->with('notice',$notice);
//        }else{
//            $alert = '잘못된 접근입니다.';
//
//            return redirect('/')->with('alert',$alert);
//        }
//    }


}
