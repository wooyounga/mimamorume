@extends('layouts.app')
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/task_app.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
@section('content')
    <div class="body">
        <div>
            <a href="{{URL::to('/home')}}">Home</a> > <a href="{{URL::to('/task')}}">근무</a> > <a href="{{URL::to('/logSpec')}}"><b>업무일지</b></a>
        </div>
        <div class="wrap">
            <table class="table table-striped" style="text-align: left;">
                <tr>
                    <td>대상자명</td>
                    <td>{{$target[0]->name}}</td>
                </tr>
                <tr>
                    <td>근무일자</td>
                    <td>{{$log[0]->workDate}}</td>
                </tr>
                <tr>
                    <td>작성시간</td>
                    <td>{{$log[0]->workDate}}</td>
                </tr>
                <tr>
                    <td>업무유형</td>
                    <td>{{$content[0]->contentType}}</td>
                </tr>
                <tr>
                    <td>약 복용 일정</td>
                    <td>{{$log[0]->medicineSchedule}}</td>
                </tr>
                <tr>
                    <td>내용</td>
                    <td>{{$content[0]->content}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection