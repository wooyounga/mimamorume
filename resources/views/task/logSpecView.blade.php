@extends('layouts.app')
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/task_app.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
@section('content')
    @if (session('alert'))
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }
        </script>
    @endif
    <div id="bgimg">
      <div class="page_title">
        業務日誌
      </div>
      <br>
      <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="position:relative; top:-3px; width:20px; height:20px;"></a> > <a href="{{URL::to('/task')}}">勤務</a> > <a href="{{URL::to('/logSpec')}}"><b>業務日誌</b></a>
    </div>
    <style>
      #bgimg{
        background-image: url("{{ URL::to('/') }}/images/bgimg/bgimg1.png");
        background-size: cover;
        height: 300px;
        padding-left: 75px;
        padding-top: 70px;
        color: white;
        font-size: 17px;
        font-weight: bold;
      }
      #bgimg > a{
        color: white;
        text-decoration: none;
        font-size: 17px;
        font-weight: bold;
      }
      .page_title{
        color: white;
        font-size: 40px;
        margin-bottom: 100px;
      }
      .body{
        margin-top: -5%;
      }
    </style>
    <div class="body">
        <div class="wrap">
            <table class="table table-striped" style="text-align: left;">
                <tr>
                    <td>対象の氏名</td>
                    <td>{{$target[0]->name}}</td>
                </tr>
                <tr>
                    <td>勤務日付</td>
                    <td>{{$log[0]->work_date}}</td>
                </tr>
                <tr>
                    <td>作成時間</td>
                    <td>{{$log[0]->created_at}}</td>
                </tr>
                <tr>
                    <td>業務類型</td>
                    <td>{{$log[0]->content_type}}</td>
                </tr>
                <tr>
                    <td>薬名</td>
                    <td>{{$log[0]->medicine_name}}</td>
                </tr>
                <tr>
                    <td>服薬日程</td>
                    <td>{{$log[0]->start_date}}から {{$log[0]->end_date}}まで毎日{{$log[0]->time}}</td>
                </tr>
                <tr>
                    <td>内容</td>
                    <td>{{$log[0]->content}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
