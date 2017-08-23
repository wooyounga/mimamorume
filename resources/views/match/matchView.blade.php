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
        function matchModal(){
            $('#matchModal').modal('show');
        }

        function matchConfirm(url){
            if(confirm("정말로 매칭신청하겠습니까?")){
                var target = $('#target_num').val();
                if(target == null){
                    target = '없음';
                }
                var log = $('*[name=end]').val();
                location.href=url+'/'+target+'/'+log;
            }
        }
        function destConfirm(url){
            if(confirm("정말로 삭제하겠습니까?")){
                location.href=url;
            }
        }
    </script>
    <div id="bgimg">
      <div class="page_title">
        구인구직
      </div>
      <br>
      <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="position:relative; top:-3px; width:20px; height:20px;"></a> > <a href="{{URL::to('/match')}}">매칭</a> > <a href="{{URL::to('/match')}}"><b>구인</b></a>
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
            <h4 style="color: #428bca;">※글쓴이가 원하는 조건 입니다.</h4>
            <table class="table">
                <tr>
                    <td>성별</td>
                    <td>나이</td>
                    <td>대상장애</td>
                    <td>근무일</td>
                    <td>근무기간</td>
                </tr>
                <tr>
                    <td>{{$match[0]->gender}}</td>
                    <td>{{$match[0]->age}}</td>
                    <td>{{$match[0]->disability}}</td>
                    <td>{{$match[0]->work_day}}</td>
                    <td>{{$match[0]->work_period}}</td>
                </tr>
                <tr>
                    <td colspan="1">주소</td>
                    <td colspan="5">{{$match[0]->roadAddress}}</td>
                </tr>
            </table>
        <table class="table" style="margin-top: 50px;">
            <tr>
                <th>제목</th>
                <td>{{$match[0]->title}}</td>
                <td><a class="btn btn-default pull-right" onclick="matchModal()">매칭신청</a></td>
            </tr>
            <tr>
                <th>내용</th>
                <td colspan="2">
                    {{$match[0]->content}}<br>
                    <a class="btn btn-default pull-right" href="{{URL::to('/match')}}">목록</a>
                    @if($match[0]->user_id == Session::get('id'))
                        <a class="btn btn-default pull-right" style="margin: 0 10px;" onclick="destConfirm('{{URL::to('/destroy',[$match[0]->num])}}')">삭제</a>
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
                        <h4 class="modal-title">매칭 신청</h4>
                    </div>
                    <div class="modal-body">
                        @if($target != '없음')
                            <label for="target_num" style=" margin-left: 13px;">대상자명</label>
                            <select class="form-control" id="target_num" name="target_num" style="width: 98%; margin-left: 13px;">
                                @foreach($target as $t)
                                    <option value="{{$t->num}}">{{$t->name}}</option>
                                @endforeach
                            </select>
                        @endif
                        <br>
                        <div style="margin-left: 15px;">
                            <b>※계약 시작 날을 선택해주세요</b><br>
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
                            <b>※계약 마지막 날을 선택해주세요</b><br>
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
                        <label for="work_week"style="margin-left: 15px;">근무일</label>
                        <select class="form-control" id="work_week" name="work_week" style="width: 97%; margin-left: 15px;">
                            <option value="주1회">주 1회</option>
                            <option value="주2회">주 2회</option>
                            <option value="주3회">주 3회</option>
                            <option value="주4회">주 4회</option>
                            <option value="주5회">주 5회</option>
                            <option value="주6회">주 6회</option>
                            <option value="주7회">주 7회</option>
                        </select><br>
                        <label for="work_start_time"style="margin-left: 15px;">근무시작 시간</label>
                        <select class="form-control" id="work_start_time" name="work_start_time" style="width: 97%; margin-left: 15px;">
                            <script>
                                for(var i = 0; i <= 24; i++){
                                    document.write("<option value='"+i+":00'>"+i+":00</option>");
                                }
                            </script>
                        </select>
                        <br>
                        <label for="work_end_time"style="margin-left: 15px;">근무끝나는 시간</label>
                        <select class="form-control" id="work_end_time" name="work_end_time" style="width: 97%; margin-left: 15px;">
                            <script>
                                for(var i = 0; i <= 24; i++){
                                    document.write("<option value='"+i+":00'>"+i+":00</option>");
                                }
                            </script>
                        </select><br>
                        <label for="content"style="margin-left: 15px;">전하고 싶은 말</label>
                        <textarea class="form-control" id="content" name="content" rows="4" style="width: 97%; margin-left: 15px;"></textarea>
                    </div><br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">매칭신청</button>
                        {{--onclick="matchConfirm('{{URL::to('/matching',[$match[0]->num])}}')"--}}
                    </div>
                </div>
                <input type="hidden" name="num" value="{{$match[0]->num}}">
            </form>
        </div>
    </div>
@endsection
