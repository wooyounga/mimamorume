<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

//            $notice = \DB::table('notice')
//                ->join('user', 'notice.sender', '=', 'user.id')
//                ->where('notice.addressee_id',Session::get('id'))
//                ->get();

            return view('monitor.chart');
//        ->with('notice',$notice)
//        }else{
//            $alert = '잘못된 접근입니다.';
//            return redirect('/')->with('alert',$alert);
//        }
    }

    public function getBluetoothValue(Request $request) {
//        $data = $request->input('pulse');
//        DB::table('vital_data')->insert(
//            [
//                'num' => null,
//                'data_type' => 'pulse',
//                'target_num' => 1,
//                'value' => $data
//            ]
//        );
//        return $data;
        echo "as";
    }


    private function jsonTransmit() {
        $pulseData = \DB::table('vital_data')
            ->get();

        $dataArray = array();

        foreach ($pulseData as $data) {
            $dataArray['date'] = $data->updated_at;
            $dataArray['pulse'] = $data->value;
        }

        return json_encode($dataArray);

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

    }



}
