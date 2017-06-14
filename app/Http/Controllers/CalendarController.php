<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CalendarController extends Controller
{
    public function index(){
      $rows = DB::table('calendar')->get();

      if(count($rows) == 0){
        echo json_encode("DB가 비었습니다.");
      }
      else{
        echo json_encode($rows);
      }
    }

    public function store(Request $request){
      $title = $request->get('title');

      $e_start = explode("-", $request->get('start'));
      $start_year = $e_start[0];
      $start_month = $e_start[1];
      $e_start_daytime = explode(" ", $e_start[2]);
      $start_day = $e_start_daytime[0];
      $start_time = $e_start_daytime[1];
      $e_start_time = explode(":", $start_time);
      $start_hour = $e_start_time[0];
      $start_minute = $e_start_time[1];

      $e_end = explode("-", $request->get('end'));
      $end_year = $e_end[0];
      $end_month = $e_end[1];
      $e_end_daytime = explode(" ", $e_end[2]);
      $end_day = $e_end_daytime[0];
      $end_time = $e_end_daytime[1];
      $e_end_time = explode(":", $end_time);
      $end_hour = $e_end_time[0];
      $end_minute = $e_end_time[1];

      DB::table('calendar')->insert([
        'num' => null,
        'title' => $title,
        'start_year' => $start_year,
        'start_month' => $start_month,
        'start_day' => $start_day,
        'start_hour' => $start_hour,
        'start_minute' => $start_minute,
        'end_year' => $end_year,
        'end_month' => $end_month,
        'end_day' => $end_day,
        'end_hour' => $end_hour,
        'end_minute' => $end_minute,
      ]);
    }

    public function show($num){
      $rows = DB::table('calendar')->where('num', $num)->get();

      echo json_encode($rows[0]);
    }

    public function delCal(){
      DB::table('calendar')->where('num', $_GET['num'])->delete();
    }

    public function calMonth(){
      $title = $_POST['title'];
      $year = $_POST['year'];
      $month = $_POST['month'] + 1;
      $date = $_POST['date'];

      DB::table('calendar')->insert([
        'num' => null,
        'title' => $title,
        'start_year' => $year,
        'start_month' => $month,
        'start_day' => $date,
        'start_hour' => 0,
        'start_minute' => 0,
        'end_year' => $year,
        'end_month' => $month,
        'end_day' => $date,
        'end_hour' => 0,
        'end_minute' => 0,
      ]);
    }
}
