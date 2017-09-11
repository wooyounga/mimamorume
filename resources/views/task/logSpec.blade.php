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
        <div style="margin-top: 30px;">
            <input onclick="home()" type="button" value="全体" class="btn btn-default">
            <input onclick="filter(7)" type="button" value="１週間" class="btn btn-default">
            <input onclick="filter(1)" type="button" value="1ヶ月" class="btn btn-default">
            <input onclick="filter(3)" type="button" value="3ヶ月" class="btn btn-default">
            <input onclick="filter(6)" type="button" value="6ヶ月" class="btn btn-default">
            <input onclick="filter(12)" type="button" value="1年" class="btn btn-default">
        </div>
        <div class="wrap">
            <ul class="nav nav-tabs">
                @if($target !== 'なし')
                    @foreach($target as $t)
                        <script>
                            function filter(filter){
                                var url = '{{URL::to('/logSpecFilter')}}';
                                var target = '{{$t->num}}';
                                location.href=url+'/'+filter+'/'+target;
                            }
                            function home(){
                                var url = '{{URL::to('/logSpecTarget')}}';
                                var target = '{{$t->num}}';
                                location.href=url+'/'+target;
                            }
                        </script>
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
            <table class="table table-striped">
              <style>
                #table_head{
                  background-color: #333333;
                  color: white;
                  font-size: 17px;
                  font-weight: bold;
                }
                .table_body{
                  font-size: 17px;
                  font-weight: bold;
                }
              </style>
                <tr id="table_head">
                    <td>番号</td>
                    <td>内容</td>
                    <td>作成者</td>
                    <td>勤務日付</td>
                </tr>
                @if($log == '[]')
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 50px;">登録された業務日誌がありません。</td>
                    </tr>
                @else
                    @foreach($log as $l)
                        <tr class="table_body">
                            <td class="post_numm"><a href="{{route('logSpec.show',[$l->num])}}">{{$l->num}}</a></td>
                            <td class="post_conn"><a href="{{route('logSpec.show',[$l->num])}}"><p class="logSpec_content">{{$l->content}}</p></a></td>
                            <style>
                              .post_numm > a, .post_conn > a{
                                color: black;
                              }
                              .post_numm > a:hover, .post_conn > a:hover{
                                text-decoration: none;
                              }
                            </style>
                            <td>{{$l->sitter_id}}</td>
                            <td>{{$l->work_date}}</td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    @if($user[0]->user_type == '介護職員' && $target != 'なし')
                        <td colspan="5"><a class="btn btn-default pull-right" href="{{route('task.create')}}">登録</a></td>
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
