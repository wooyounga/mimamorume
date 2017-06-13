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
                    <a class="btn btn-default pull-right" href="/match">목록</a>
                    @if($match[0]->user_id == Session::get('id'))
                        <a class="btn btn-default pull-right" style="margin: 0 10px;" onclick="destConfirm('{{URL::to('/destroy',[$match[0]->num])}}')">삭제</a>
                    @endif

                </td>
            </tr>
        </table>
    </div>
    <div id="matchModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">매칭 신청</h4>
                </div>
                <div class="modal-body">
                    @if($target != '없음')
                        <select class="form-control" id="target_num" name="target_num">
                            @foreach($target as $t)
                                <option value="{{$t->num}}">{{$t->name}}</option>
                            @endforeach
                        </select>
                    @endif
                        <div style="margin-left: 15px;">
                            <b>※계약 마지막 날을 선택해주세요</b><br><br>
                            <div>
                                <input type="text" name="end" value="">
                                <script type="text/javascript">
                                    $(function(){
                                        $('*[name=end]').appendDtpicker({
                                            "futureOnly": true
                                        });
                                    });
                                </script>
                            </div>
                        </div><br>
                </div><br>
                <div class="modal-footer">
                    <a onclick="matchConfirm('{{URL::to('/matching',[$match[0]->num])}}')" class="btn btn-primary">매칭신청</a>
                </div>
            </div>
        </div>
    </div>
@endsection
