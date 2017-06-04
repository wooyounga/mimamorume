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
            <table class="table table-striped ">
                <tr>
                    <td>번호</td>
                    <td>내용</td>
                    <td>작성자</td>
                    <td>근무날짜</td>
                </tr>
                {{--@foreach($projects as $proj)--}}
                @foreach($log as $l)
                    <tr>
                        <td><a href="{{route('logSpec.show',[$l->num])}}">{{$l->num}}</a></td>
                        <td><a href="{{route('logSpec.show',[$l->num])}}">{{$l->content}}</a></td>
                        <td>{{$l->sitterId}}</td>
                        <td>{{$l->workDate}}</td>
                    </tr>
                @endforeach
                {{--@endforeach--}}
                <tr>
                    <td colspan="5"><a class="btn btn-default pull-right" href="{{route('task.create')}}">등록</a></td>
                </tr>
                <tr class="text-center">
                    <td colspan="5">
                        <ul class="pagination">
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection