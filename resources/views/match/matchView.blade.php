@extends('layouts.app')
@section('title')
    구인구직
@endsection
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/match.css">
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="{{URL::to('/')}}/js/match.js"></script>
@section('content')
    <script>
        function matchConfirm(url){
            if(confirm("정말로 매칭신청하겠습니까?")){
                location.href=url;
            }
        }
    </script>
    <div class="body">
        @if (session('alert'))
            <script>
                var msg = '{{Session::get('alert')}}';
                var exist = '{{Session::has('alert')}}';
                if(exist){
                    alert(msg);
                }
            </script>
        @endif
        <div>
            <a href="{{URL::to('/home')}}">Home</a> > <a href="{{URL::to('/match')}}">매칭</a> > <a href="{{URL::to('/match')}}"><b>구인</b></a>
        </div>
        <br>
            <h4 style="color: #428bca;">※글쓴이가 원하는 조건 입니다.</h4>
            <table class="table">
                <tr>
                    <td>구분</td>
                    <td>성별</td>
                    <td>나이</td>
                    <td>대상장애</td>
                    <td>근무일</td>
                    <td>근무기간</td>
                </tr>
                <tr>
                    <td>{{$match[0]->user_type}}</td>
                    <td>{{$match[0]->gender}}</td>
                    <td>{{$match[0]->age}}</td>
                    <td>{{$match[0]->disability}}</td>
                    <td>{{$match[0]->work_day}}</td>
                    <td>{{$match[0]->work_period}}</td>
                </tr>
            </table>
        <table class="table" style="margin-top: 50px;">
            <tr>
                <th>제목</th>
                <td>{{$match[0]->title}}</td>
                <td><a class="btn btn-default pull-right" onclick="matchConfirm('{{URL::to('/matching',[$match[0]->num])}}')">매칭신청</a></td>
            </tr>
            <tr>
                <th>내용</th>
                <td colspan="2">{{$match[0]->content}}</td>
            </tr>
        </table>
    </div>
@endsection
