<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','MIMAMORUME')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav_app.css') }}" rel="stylesheet">

    <script>
        $(function(){
            $(".zeta-menu li").hover(function(){
                $('ul:first',this).show();
            }, function(){
                $('ul:first',this).hide();
            });


        });
        function showModal(num){
            $('#'+num).modal('show');
        };
    </script>

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
                                    <a href="/monitoring"><b>Monitoring</b></a>
                                    <ul>
                                        <li><a href="/snapshot">Snapshot</a></li>
                                        <li><a href="/chart">Chart</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/task"><b>Task</b></a>
                                    <ul>
                                        <li><a href="/task">Shift</a></li>
                                        <li><a href="/logSpec">LogSpec</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="pull-right">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Session::get('id') }} <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ url('/individual') }}">
                                                내 정보
                                            </a>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                로그아웃
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
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
                                                <a onclick=showModal({{$n->num}}) class="notice">{{$n->notice_content}}</a>
                                                <hr>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="pull-right links" style="margin-top: 8px;">
                            <a href="{{ url('/login') }}" class="btn btn-warning" role="button">Login</a>
                            <a href="{{ url('/register') }}" class="btn btn-warning" role="button">Join</a>
                        </div>
                    @endif
            </div>
    </nav>
   @if(Session::get('id'))
        @foreach($notice as $n)
            <div id="{{$n->num}}" class="modal fade" role="dialog">
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
                            {{--@if($n->user_type == '보호사')
                                @if($notice_etc[0]->lisence == 'yes')
                                    @foreach($notice_etc as $ne)
                                        <br><label>자격증명</label> {{$ne->license_kind}}{{$ne->license_grade}}
                                        <br><label>발급처</label> {{$ne->institution}}
                                    @endforeach
                                @endif
                            @else
                                @if($notice_care != '[]')
                                    @foreach($notice_care as $n)
                                        <br><label>대상자넘버</label> {{$n->num}}
                                        <br><label>대상자나이</label> {{$n->age}}
                                        <br><label>대상자성별</label> {{$n->gender}}
                                        <br><label>대상자장애</label> {{$n->disability_main}}
                                        <br><label>대상자장애2</label> {{$n->disability_sub}}
                                    @endforeach
                                @endif
                            @endif--}}
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-primary">수락</a>
                            <a class="btn btn-danger">거절</a>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    @endif
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
