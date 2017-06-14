<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!-- 부트스트랩 -->
    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- DatePicker -->
    <script type="text/javascript" src="{{ asset('js/jquery.simple-dtpicker.js') }}"></script>
    <link type="text/css" href="{{ asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','MIMAMORUME')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav_app.css') }}" rel="stylesheet">

    <script>
        $(function(){
            $('*[name=date]').change(function(){
                $('#dateLog').val($('*[name=date]').val());
            });


            $(".zeta-menu li").hover(function(){
                $('ul:first',this).show();
            }, function(){
                $('ul:first',this).hide();
            });
        });
        function showModal(num){
            $('#'+num).modal('show');
        };

        function matchYesConfirm(url){
            if(confirm("정말로 수락하겠습니까?")){
               //var log = $(num).val();
                location.href=url;
            }
        }

        function dest(url){
            location.href=url;
        }

        function matchNoConfirm(url){
            if(confirm("거절하시면 알림이 사라집니다. 정말로 거절하겠습니까?")){
                location.href=url;
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body>



<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="nav">
                <a class="logo pull-left" href="{{ url('/') }}">
                    <img src="{{ URL::to('/') }}/images/main_logo.png" width="80" height="30">
                </a>
                    @if (Session::get('id'))
                        <div class="zeta-wrap">
                            <ul class="zeta-menu center-block">
                                <li>
                                    <a href="{{ url('/match') }}"><b>Contract</b></a>
                                </li>
                                <li>
                                    <a href="{{ url('/monitoring') }}"><b>Monitoring</b></a>
                                    <ul>
                                        <li><a href="{{ url('/snapshot') }}">Snapshot</a></li>
                                        <li><a href="{{ url('/chart') }}">Chart</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/task"><b>Task</b></a>
                                    <ul>
                                        <li><a href="{{ url('/task') }}">Shift</a></li>
                                        <li><a href="{{ url('/logSpec') }}">LogSpec</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="notice pull-right">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Session::get('id') }} <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ url('/userinfo') }}">내 정보</a>
                                            <a href="{{ route('login.destroy') }}">로그아웃</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav">
                                <li class="dropdown pull-right">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <img src="{{ URL::to('/') }}/images/notice_list.png" width="15" height="20">
                                    </a>
                                    <ul class="dropdown-menu" role="menu" style="width: 300px; text-align: center;">
                                            <hr>
                                        @if($notice == '[]')
                                            <p>새로운 알림이 없습니다</p>
                                            <hr>
                                        @else
                                            @foreach($notice as $n)
                                                @if($n->notice_kind == '매칭')
                                                    <a onclick=showModal('modal{{$n->num}}') class="notice">{{explode('/',$n->notice_content)[0]}}</a>
                                                    <a href="{{URL::to('/noticeDest',[$n->num])}}" class="close" style="margin: 0 5px;">X</a>
                                                    <hr>
                                                @elseif($n->notice_kind == '수락')
                                                    {{$n->notice_content}}
                                                    <a href="{{URL::to('/noticeDest',[$n->num])}}" class="close" style="margin: 0 5px;">X</a>
                                                    <hr>
                                                @else
                                                    {{$n->notice_content}}
                                                    <a href="{{URL::to('/noticeDest',[$n->num])}}" class="close" style="margin: 0 5px;">x</a>
                                                    <hr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="pull-right links" style="margin: 8px 50px 0 0;">
                            <a href="{{ route('login.create') }}" class="btn btn-warning" role="button">Login</a>
                            <a href="{{ route('join.create') }}" class="btn btn-warning" role="button">Join</a>
                        </div>
                    @endif
            </div>
    </nav>
    <div class="container">
    </div>
    @if(Session::get('id'))
        @if($notice != '[]')
            @foreach($notice as $n)
                <div id="modal{{$n->num}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">매칭 수락</h4>
                            </div>
                            <div class="modal-body">
                                <b>※ 매칭신청을 요청한 사용자의 정보입니다.</b><br>
                                <br><label>이름</label> {{$n->name}}
                                <br><label>유형</label> {{$n->user_type}}
                                <br><label>나이</label> {{$n->age}}
                                <br><label>성별</label> {{$n->gender}}
                                <br><label>연락처</label> {{$n->cellphone}}
                                <br><label>연락처2</label> {{$n->telephone}}
                              {{--  <br><label>마지막 계약일</label> {{explode('/',$n->notice_content)[2]}}--}}
                            </div><br>
                            <div class="modal-footer">
                                <a onclick="matchYesConfirm('{{URL::to('/matchYes',[$n->num])}}')" class="btn btn-primary">수락</a>
                                <a onclick="matchNoConfirm('{{URL::to('/matchNo',[$n->num])}}')" class="btn btn-danger">거절</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endif
    @yield('content')
</div>
{{--
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>--}}
</body>
</html>
