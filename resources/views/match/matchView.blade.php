@extends('layouts.app')
@section('title')
    求人
@endsection
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>
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
        function matchModal(){
            $('#matchModal').modal('show');
        }

        function matchConfirm(url){
            if(confirm("本当に申請しますか？")){
                var target = $('#target_num').val();
                if(target == null){
                    target = '없음';
                }
                var log = $('*[name=end]').val();
                location.href=url+'/'+target+'/'+log;
            }
        }
        function destConfirm(url){
            if(confirm("本当に消しますか？?")){
                location.href=url;
            }
        }
    </script>
    <div id="bgimg">
      <div class="page_title">
        求人
      </div>
      <br>
      <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="position:relative; top:-3px; width:20px; height:20px;"></a> > <a href="{{URL::to('/match')}}">マッチング</a> > <a href="{{URL::to('/match')}}"><b>求人</b></a>
    </div>
    <style>
      #bgimg{
        background-image: url("{{ URL::to('/') }}/images/bgimg/bgimg2.png");
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
    </style>
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
        <br>
            <h4 style="color: #428bca;">※相手が欲しがっている条件です。</h4>
            <table class="table">
                <tr>
                    <td>性別</td>
                    <td>年齢</td>
                    <td>対象障害</td>
                    <td>勤務日</td>
                    <td>勤務期間</td>
                </tr>
                <tr>
                    <td>{{$match[0]->gender}}</td>
                    <td>{{$match[0]->age}}</td>
                    <td>{{$match[0]->disability}}</td>
                    <td>{{$match[0]->work_day}}</td>
                    <td>{{$match[0]->work_period}}</td>
                </tr>
                <tr>
                    <td colspan="1">住所</td>
                    <td colspan="5">{{$match[0]->roadAddress}}</td>
                </tr>
            </table>
        <table class="table" style="margin-top: 50px;">
            <tr>
                <th>タイトル</th>
                <td>{{$match[0]->title}}</td>
                <td><a class="btn btn-default pull-right" onclick="matchModal()">マッチング申し込み</a></td>
            </tr>
            <tr>
                <th>内容</th>
                <td colspan="2">
                    {{$match[0]->content}}<br>
                    <a class="btn btn-default pull-right" href="{{URL::to('/match')}}">リスト</a>
                    @if($match[0]->user_id == Session::get('id'))
                        <a class="btn btn-default pull-right" style="margin: 0 10px;" onclick="destConfirm('{{URL::to('/destroy',[$match[0]->num])}}')">削除</a>
                    @endif

                </td>
            </tr>
        </table>
    </div>
    <div id="matchModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" name="form-horizontal" role="form" method="get" action="{{URL::to('/matching')}}">
            {{csrf_field()}}
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">マッチング申し込み</h4>
                    </div>
                    <div class="modal-body">
                        @if($target != 'なし')
                            <label for="target_num" style=" margin-left: 13px;">対象の名前</label>
                            <select class="form-control" id="target_num" name="target_num" style="width: 98%; margin-left: 13px;">
                                @foreach($target as $t)
                                    <option value="{{$t->num}}">{{$t->name}}</option>
                                @endforeach
                            </select>
                        @endif
                        <br>
                        <div style="margin-left: 15px;">
                            <b>※欲しがっている契約の始めの日を選んでください。</b><br>
                            <div>
                                <input class="form-control" type="text" name="work_start" value="">
                                <script type="text/javascript">
                                    $(function(){
                                        $('*[name=work_start]').appendDtpicker({
                                            "futureOnly": true
                                        });
                                    });
                                </script>
                            </div>
                        </div><br>
                        <div style="margin-left: 15px;">
                            <b>※欲しがっている契約の終りの日を選んでください。</b><br>
                            <div>
                                <input class="form-control" type="text" name="work_end" value="">
                                <script type="text/javascript">
                                    $(function(){
                                        $('*[name=work_end]').appendDtpicker({
                                            "futureOnly": true
                                        });
                                    });
                                </script>
                            </div>
                        </div><br>
                        <label for="work_week"style="margin-left: 15px;">勤務日</label>
                        <select class="form-control" id="work_week" name="work_week" style="width: 97%; margin-left: 15px;">
                            <option value="週1回">週1回</option>
                            <option value="週2回">週2回</option>
                            <option value="週3回">週3回</option>
                            <option value="週4回">週4回</option>
                            <option value="週5回">週5回</option>
                            <option value="週6回">週6回</option>
                            <option value="週7回">週7回</option>
                        </select><br>
                        <label for="work_start_time"style="margin-left: 15px;">勤務が始まる時間</label>
                        <select class="form-control" id="work_start_time" name="work_start_time" style="width: 97%; margin-left: 15px;">
                            <script>
                                for(var i = 0; i <= 24; i++){
                                    document.write("<option value='"+i+":00'>"+i+":00</option>");
                                }
                            </script>
                        </select>
                        <br>
                        <label for="work_end_time"style="margin-left: 15px;">勤務が終わる時間</label>
                        <select class="form-control" id="work_end_time" name="work_end_time" style="width: 97%; margin-left: 15px;">
                            <script>
                                for(var i = 0; i <= 24; i++){
                                    document.write("<option value='"+i+":00'>"+i+":00</option>");
                                }
                            </script>
                        </select><br>
                        <label for="content"style="margin-left: 15px;">相手に伝えたい子話</label>
                        <textarea class="form-control" id="content" name="content" rows="4" style="width: 97%; margin-left: 15px;"></textarea>
                    </div><br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">マッチング申し込み</button>
                        {{--onclick="matchConfirm('{{URL::to('/matching',[$match[0]->num])}}')"--}}
                    </div>
                </div>
                <input type="hidden" name="num" value="{{$match[0]->num}}">
            </form>
        </div>
    </div>
@endsection
