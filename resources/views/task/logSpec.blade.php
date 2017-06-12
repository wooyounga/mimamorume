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
    @if (session('alert'))
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }
        </script>
    @endif
    <div class="body">
        <div>
            <a href="{{URL::to('/home')}}">Home</a> > <a href="{{URL::to('/task')}}">근무</a> > <a href="{{URL::to('/logSpec')}}"><b>업무일지</b></a>
        </div>
        <div class="wrap">
            <ul class="nav nav-tabs">
                @if($target !== '없음')
                    @foreach($target as $t)
                        @if($t->num == $num)
                            <li role="presentation" class="active"><a href="#">{{$t->name}}</a></li>
                        @else
                            <li role="presentation"><a href="{{URL::to('/logSpecTarget',[$t->num])}}">{{$t->name}}</a>
                        @endif
                    @endforeach
                @else
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                @endif
            </ul>
            <table class="table table-striped ">
                <tr>
                    <td>번호</td>
                    <td>내용</td>
                    <td>작성자</td>
                    <td>근무날짜</td>
                </tr>
                @if($log == '[]')
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 50px;">등록된 업무일지가 없습니다.</td>
                    </tr>
                @else
                    @foreach($log as $l)
                        <tr>
                            <td><a href="{{route('logSpec.show',[$l->num])}}">{{$l->num}}</a></td>
                            <td><a href="{{route('logSpec.show',[$l->num])}}"><p class="logSpec_content">{{$l->content}}</p></a></td>
                            <td>{{$l->sitter_id}}</td>
                            <td>{{$l->work_date}}</td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    @if($user[0]->user_type == '보호사' && $target != '없음')
                        <td colspan="5"><a class="btn btn-default pull-right" href="{{route('task.create')}}">등록</a></td>
                    @endif
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