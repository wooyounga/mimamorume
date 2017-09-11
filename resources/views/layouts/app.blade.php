<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
    <script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>
    <!-- 부트스트랩 -->
    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script type='text/javascript' src='{{URL::to('/')}}/js/playrtc.js'></script>
    <!-- DatePicker -->
    <script type="text/javascript" src="{{ asset('js/jquery.simple-dtpicker.js') }}"></script>
    <link type="text/css" href="{{ asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','MIMAMORUME')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav_app.css') }}" rel="stylesheet">
    <style>
        .local-video {
            width: 140px;
            height: 120px;
            z-index: 10;
            position: relative;
            top: -100px;
            right: 30px;
        }
        .remote-video {
            margin-top: 20px;
            margin-bottom: 20px;
            width: 320px;
            height: 240px;
        }
        .btn-info{
          width: 100px;
        }
        .notibar{
          font-size: 17px;
          font-weight: bold;
        }
        .notibar2{
          font-size: 17px;
        }
    </style>
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
            $('#video_connect').click(function(){
                if(confirm("画像チャット連結すると、今変更した条件は繁栄されません。")){
                    $('#video_form').css('display','none');
                    $('#video_div').css('display','');
                    $('#video_btn').css('display','none');
                    $('#video_btn2').css('display','');
                }
            });
        });
        function showModal(num){
            $('#'+num).modal('show');
        };
        function matchYesConfirm(url){
            if(confirm("本当に承諾しますか？")){
                //var log = $(num).val();
                location.href=url;
            }
        }
        function video(){
            $('#video_form').css('display','none');
            $('#video_div2').css('display','');
            $('#video_btn').css('display','none');
            $('#video_btn2').css('display','none');
        }
        function dest(url){
            location.href=url;
        }
        function matchNoConfirm(url){
            if(confirm("拒絶するとお知らせがなくなります。本当に拒絶しますか？")){
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
    <nav class="navcolor">
      <style>
      .navcolor{
        background-color: #5059a8
      }
      </style>
        <div class="nav">
            @if(Session::get('user_type') == '管理者')
            <a class="logo pull-left" href="{{ url('/dashboard') }}">
            @else
            <a class="logo pull-left" href="{{ url('/task') }}">
            @endif
                <img src="{{ URL::to('/') }}/images/logo.png" width="140" height="30">
            </a>
            @if (Session::get('id'))
                @if(Session::get('user_type') != '管理者')
                <div class="zeta-wrap">
                    <ul class="zeta-menu center-block">
                        <li>
                            <a href="{{ url('/match') }}"><b>CONTRACT</b></a>
                        </li>
                        <li>
                            <a href="{{ url('/snapshot') }}"><b>MIMAMORI</b></a>
                            <ul>
                                <li><a href="{{ url('/snapshot') }}">Snapshot</a></li>
                                <li><a href="{{ url('/chart') }}">Heart-Rate</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/task') }}"><b>WORKING</b></a>
                            <ul>
                                <li><a href="{{ url('/task') }}">Schedule</a></li>
                                <li><a href="{{ url('/logSpec') }}">Daily-Log</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @endif
                @if(Session::get('user_type') != '管理者')
                <div class="notice pull-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notibar">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Session::get('name') }} <span class="caret"></span>
                            </a>
                            <style>
                              .dropdown-toggle{
                                color: white;
                              }
                              .dropdown-toggle:hover{
                                background-color: white;
                                color: #5059a8;
                              }
                            </style>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a class="notibar2" href="{{ url('userinfo') }}">MYPAGE</a>
                                    <a class="notibar2" href="{{ route('login.destroy') }}">LOGOUT</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <div style="width: 50px; height: 20px;">
                                    <img src="{{ URL::to('/') }}/images/notice.png" width="20" height="20" style="position: absolute">
                                    @if($count != 0)
                                        <span style="background-color: red; color: yellow; position: relative; margin:20px; border-radius: 100px;">{{$count}}</span>
                                    @endif
                                </div>
                            </a>
                            <ul class="dropdown-menu" role="menu" style="width: 400px; text-align: center;">
                                <hr>
                                @if($notice == '[]')
                                    <p class="notibar2">新しいお知らせがありません。</p>
                                    <hr>
                                @else
                                    <?php $i = 1; ?>
                                    @foreach($notice as $n)
                                        @if($n->notice_kind == 'マッチング')
                                            <a onclick=showModal('modal{{$n->num}}') class="notice"><?php echo $i; ?> : {{$n->notice_title}}</a>
                                            <a href="{{URL::to('/noticeDest',[$n->num])}}" class="close" style="margin: 0 5px;">X</a>
                                            <hr>
                                        @elseif($n->notice_kind == '修正')
                                            <a onclick=showModal('modal{{$n->num}}') class="notice"><?php echo $i; ?> : {{$n->notice_title}}</a>
                                            <a href="{{URL::to('/noticeDest',[$n->num])}}" class="close" style="margin: 0 5px;">X</a>
                                            <hr>
                                        @elseif($n->notice_kind == '画像チャット')
                                            <a onclick=video(),showModal('modal{{$n->num}}') class="notice"><?php echo $i; ?> : {{$n->notice_title}}</a>
                                            <a href="{{URL::to('/noticeDest',[$n->num])}}" class="close" style="margin: 0 5px;">X</a>
                                            <hr>
                                        @elseif($n->notice_kind == '承諾')
                                            <?php echo $i; ?> : {{$n->notice_title}}
                                            <a href="{{URL::to('/noticeDest',[$n->num])}}" class="close" style="margin: 0 5px;">X</a>
                                            <hr>
                                        @else
                                            <?php echo $i; ?> : {{$n->notice_title}}
                                            <a href="{{URL::to('/noticeDest',[$n->num])}}" class="close" style="margin: 0 5px;">x</a>
                                            <hr>
                                        @endif
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
                @endif
                @if(Session::get('user_type') == '管理者')
                <div class="pull-right links adminm" style="margin: 9px 50px 0 0;">
                    <a href="{{ url('userinfo') }}" class="buttonss" role="button">MYPAGE</a>&nbsp;&nbsp;
                    <a href="{{ route('login.destroy') }}" class="buttonss" role="button">LOGOUT</a>
                </div>
                <style>
                  .buttonss{
                    text-decoration: none;
                    font-size: 20px;
                    font-weight: bold;
                    color: white;
                    padding-left: 10px;
                  }
                  .buttonss:hover{
                    color: white;
                  }
                </style>
                @endif
            @else
                <div class="pull-right links" style="margin: 9px 50px 0 0;">
                    <a href="{{URL::to('/')}}" class="buttonss" role="button">LOGIN</a>&nbsp;&nbsp;
                    <a href="{{ route('join.create') }}" class="buttonss" role="button">JOIN</a>
                </div>
                <style>
                  .buttonss{
                    text-decoration: none;
                    font-size: 20px;
                    font-weight: bold;
                    color: white;
                    padding-left: 10px;
                  }
                  .buttonss:hover{
                    color: white;
                  }
                </style>
            @endif
        </div>
    </nav>
    <div class="container">
    </div>
    @if(Session::get('id'))
        @if($notice != '[]')
            @foreach($notice as $n)
                <script>
                    $(function(){
                        $(':radio[name=week_check{{$n->num}}]').on('change',function(){
                            var weekInput = '<select class="form-control" id="work_week_input{{$n->num}}" name="work_week_input{{$n->num}}" style="margin-top:10px;">';
                            weekInput+='<option value="週1回">週1回</option>';
                            weekInput+='<option value="週2回">週2回</option>';
                            weekInput+='<option value="週3回">週3回</option>';
                            weekInput+='<option value="週4回">週4回</option>';
                            weekInput+='<option value="週5回">週5回</option>';
                            weekInput+='<option value="週6回">週6回</option>';
                            weekInput+='<option value="週7回">週7回</option>';
                            weekInput+='</select>';
                            if($("input:radio[name='week_check{{$n->num}}']:checked").val() == 'yes'){
                                $('.week{{$n->num}}').append(weekInput);
                            }else{
                                $('#work_week_input{{$n->num}}').remove();
                            }
                        });
                        $(':radio[name=work_start{{$n->num}}]').on('change',function(){
                            if($("input:radio[name='work_start{{$n->num}}']:checked").val() == 'yes'){
                                var weekInput = '<input type="hidden" value="yes" id="week_check_start_input{{$n->num}}" name="week_check_start_input{{$n->num}}">';
                                $('#start{{$n->num}}').append(weekInput);
                                $('#start{{$n->num}}').css('display','');
                            }else{
                                $('#start{{$n->num}}').css('display','none');
                                $('#start{{$n->num}}').remove($('#week_check_start_input{{$n->num}}'));
                            }
                        });
                        $(':radio[name=work_end{{$n->num}}]').on('change',function(){
                            if($("input:radio[name='work_end{{$n->num}}']:checked").val() == 'yes'){
                                var weekInput = '<input type="hidden" value="yes" id="week_check_end_input{{$n->num}}" name="week_check_end_input{{$n->num}}">';
                                $('#start{{$n->num}}').append(weekInput);
                                $('#end{{$n->num}}').css('display','');
                            }else{
                                $('#end{{$n->num}}').css('display','none');
                                $('#end{{$n->num}}').remove($('#week_check_end_input{{$n->num}}'));
                            }
                        });
                        $(':radio[name=work_start_time{{$n->num}}]').on('change',function(){
                            var weekInput = '<select class="form-control" id="work_start_time_input{{$n->num}}" name="work_start_time_input{{$n->num}}"  style="margin-top:10px;">';
                            for(var i = 0; i <= 24; i++){
                                weekInput+="<option value='"+i+":00'>"+i+":00</option>";
                            }
                            if($("input:radio[name='work_start_time{{$n->num}}']:checked").val() == 'yes'){
                                $('.start_time{{$n->num}}').append(weekInput);
                            }else{
                                $('#work_start_time_input{{$n->num}}').remove();
                            }
                        });
                        $(':radio[name=work_end_time{{$n->num}}]').on('change',function(){
                            var weekInput = '<select class="form-control" id="work_end_time_input{{$n->num}}" name="work_end_time_input{{$n->num}}"  style="margin-top:10px;">';
                            for(var i = 0; i <= 24; i++){
                                weekInput+="<option value='"+i+":00'>"+i+":00</option>";
                            }
                            weekInput+='</select>';
                            if($("input:radio[name='work_end_time{{$n->num}}']:checked").val() == 'yes'){
                                $('.end_time{{$n->num}}').append(weekInput);
                            }else{
                                $('#work_end_time_input{{$n->num}}').remove();
                            }
                        });
                    });
                </script>
                <form class="form-horizontal" name="form-horizontal" role="form" method="get" action="{{URL::to('/matchmodify',[$n->num])}}">
                  <style>
                  .form-horizontal{
                    margin: 0;
                    padding: 0;
                  }
                  </style>
                    <div>
                        <div id="modal{{$n->num}}" class="modal fade" role="dialog">
                            <input type="hidden" id="notice_num" value="{{$n->num}}">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content" style="width: 750px;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">マッチング承諾</h4>
                                    </div>
                                    <div style="background-color: black;">
                                        <div class="col-md-6" id="video_div" style="display: none; width: 100%; height: 80%;">
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <label class="sr-only" for="createChannelId">画像チャット番号</label>
                                                    <input class="form-control" type="text" id="createChannelId" placeholder="Create and connect the channel." value="" readonly>
                                                </div>
                                                <button class="btn btn-default" id="createChannel">
                                                    <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> 画像チャット連結
                                                </button>
                                            </form>

                                            <video class="remote-video center-block" id="callerRemoteVideo"></video>
                                            <video class="local-video pull-right" id="callerLocalVideo"></video>
                                            <script>
                                                'use strict';
                                                var createChannelButton = document.querySelector('#createChannel');
                                                var createChannelId = document.querySelector('#createChannelId');
                                                var appCaller;
                                                appCaller = new PlayRTC({
                                                    projectKey: "60ba608a-e228-4530-8711-fa38004719c1",
                                                    localMediaTarget: "callerLocalVideo",
                                                    remoteMediaTarget: "callerRemoteVideo"
                                                });
                                                appCaller.on('connectChannel', function(channelId) {
                                                    createChannelId.value = channelId;
                                                    $.ajax({
                                                        url:"{{URL::to('/matchvideo')}}",
                                                        type:"GET",
                                                        data:{"video_num":channelId, "notice_num":$("#notice_num").val()},
                                                        success:function(data){

                                                        }
                                                    });
                                                });
                                                createChannelButton.addEventListener('click', function(e) {
                                                    e.preventDefault();
                                                    appCaller.createChannel();
                                                }, false);
                                            </script>
                                        </div>

                                        <div style="background-color: black">
                                            <div class="col-md-6" id="video_div2" style="display: none; width: 100%; height: 80%;">
                                                <form class="form-inline">
                                                    <div class="form-group">
                                                        <label class="sr-only" for="connectChannelId">画像チャット番号</label>
                                                        <input class="form-control" type="text" id="connectChannelId" placeholder="Enter the channel id." value="{{$n->notice_content}}" readonly>
                                                    </div>
                                                    <button class="btn btn-default" id="connectChannel">
                                                        <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> 画像チャット連結
                                                    </button>
                                                </form>

                                                <video class="remote-video center-block" id="calleeRemoteVideo"></video>
                                                <video class="local-video pull-right" id="calleeLocalVideo"></video>
                                                <script>
                                                    'use strict';
                                                    var connectChannelId = document.querySelector('#connectChannelId');
                                                    var connectChannelButton = document.querySelector('#connectChannel');
                                                    var appCallee;
                                                    appCallee = new PlayRTC({
                                                        projectKey: "60ba608a-e228-4530-8711-fa38004719c1",
                                                        localMediaTarget: "calleeLocalVideo",
                                                        remoteMediaTarget: "calleeRemoteVideo"
                                                    });
                                                    connectChannelButton.addEventListener('click', function(e) {
                                                        e.preventDefault();
                                                        var channelId = connectChannelId.value;
                                                        if (!channelId) { return };
                                                        appCallee.connectChannel(channelId);
                                                    }, false);
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body" id="video_form">
                                        <b>※ マッチング申し込みをした相手の情報です。</b><br>
                                        <br><label>名前</label> {{$n->name}}
                                        <br><label>区分</label> {{$n->user_type}}
                                        <br><label>年齢</label> {{$n->age}}
                                        <br><label>性別</label> {{$n->gender}}
                                        <br><label>連絡先</label> {{$n->cellphone}}
                                        <br><label>連絡先2</label> {{$n->telephone}}
                                        <br><br>
                                        <b>※相手が欲しがっている条件です。</b><br>
                                        <br><div style="width: 65%; float: left; margin-left: 10px;"><label>勤務日</label>
                                            <input readonly class="form-control" name="work_week_day{{$n->num}}" value="{{$n->work_week}}">
                                        </div><br>
                                        <div class="week{{$n->num}}" style="margin-top: 10px;">
                                            <label for="week_check_yes" style="margin-left: 10px;">変更</label><input type="radio" name="week_check{{$n->num}}" id="week_check_yes{{$n->num}}" value="yes">
                                            <label for="week_check_no">このまま</label><input type="radio" name="week_check{{$n->num}}" id="week_check_no{{$n->num}}" value="no" checked>
                                        </div>
                                        <br><div style="width: 65%; float: left; margin-left: 10px;"><label>勤務の初めの日</label>
                                            <input readonly class="form-control" name="work_start_day{{$n->num}}" value="{{$n->work_start}}">
                                        </div><br>
                                        <div style="margin-top: 10px;">
                                            <label for="work_start_yes{{$n->num}}" style="margin-left: 10px;">変更</label><input type="radio" name="work_start{{$n->num}}" id="work_start_yes{{$n->num}}" value="yes">
                                            <label for="work_start_no{{$n->num}}">このまま</label><input type="radio" name="work_start{{$n->num}}" id="work_start_no{{$n->num}}" value="no" checked>
                                        </div>
                                        <div id="start{{$n->num}}" style="display: none; margin-top: 10px">
                                            <input class="form-control" type="text" name="start_work{{$n->num}}" value="">
                                            <script type="text/javascript">
                                                $(function(){
                                                    $('*[name=start_work{{$n->num}}]').appendDtpicker({
                                                        "futureOnly": true
                                                    });
                                                });
                                            </script>
                                        </div>
                                        <br><div style="width: 65%; float: left; margin-left: 10px;"><label>勤務の終りの日</label>
                                            <input readonly class="form-control" name="work_end_day{{$n->num}}" value="{{$n->work_end}}">
                                        </div><br>
                                        <div style="margin-top: 10px;">
                                            <label for="work_end_yes{{$n->num}}" style="margin-left: 10px;">変更</label><input type="radio" name="work_end{{$n->num}}" id="work_end_yes{{$n->num}}" value="yes">
                                            <label for="work_end_no{{$n->num}}">このまま</label><input type="radio" name="work_end{{$n->num}}" id="work_end_no{{$n->num}}" value="no" checked>
                                        </div>
                                        <div id="end{{$n->num}}" style="display: none; margin-top: 10px">
                                            <input class="form-control" type="text" name="end_work{{$n->num}}" value="">
                                            <script type="text/javascript">
                                                $(function(){
                                                    $('*[name=end_work{{$n->num}}]').appendDtpicker({
                                                        "futureOnly": true
                                                    });
                                                });
                                            </script>
                                        </div>
                                        <br><div style="width: 65%; float: left; margin-left: 10px;"><label>勤務の初めの時間</label>
                                            <input readonly class="form-control" name="start_time{{$n->num}}" value="{{$n->work_start_time}}">
                                        </div><br>
                                        <div class="start_time{{$n->num}}" style="margin-top: 10px;">
                                            <label for="work_start_time_yes{{$n->num}}" style="margin-left: 10px;">変更</label><input type="radio" name="work_start_time{{$n->num}}" id="work_start_time_yes{{$n->num}}" value="yes">
                                            <label for="work_start_time_no{{$n->num}}">このまま</label><input type="radio" name="work_start_time{{$n->num}}" id="work_start_time_no{{$n->num}}" value="no" checked>
                                        </div>
                                        <br><div style="width: 65%; float: left; margin-left: 10px;"><label>勤務の終わりの時間</label>
                                            <input readonly class="form-control" name="end_time{{$n->num}}" value="{{$n->work_end_time}}">
                                        </div><br>
                                        <div class="end_time{{$n->num}}" style="margin-top: 10px;">
                                            <label for="work_end_time_yes{{$n->num}}" style="margin-left: 10px;">変更</label><input type="radio" name="work_end_time{{$n->num}}" id="work_end_time_yes{{$n->num}}" value="yes">
                                            <label for="work_end_time_no{{$n->num}}">このまま</label><input type="radio" name="work_end_time{{$n->num}}" id="work_end_time_no{{$n->num}}" value="no" checked>
                                        </div><br>
                                        <div style="margin-left: 25px;">
                                            <label>相手が残した話</label>
                                            <p>{{$n->notice_content}}</p>
                                        </div><br>
                                        <label for="content{{$n->num}}"style="margin-left: 25px;">相手に伝えたい話</label>
                                        <textarea class="form-control" id="content{{$n->num}}" name="content{{$n->num}}" rows="5" style="width: 90%; margin-left: 30px;"></textarea>
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        @if($n->notice_check != 'true')
                                            <div id="video_btn">
                                                <button type="submit" class="btn btn-primary" name="btn" value="modify">条件変更の要請</button>
                                                <span class="btn btn-primary" id="video_connect">画像チャット連結</span>
                                                <button type="submit" class="btn btn-primary" name="btn" value="yes">承諾</button>
                                                <a onclick="matchNoConfirm('{{URL::to('/matchNo',[$n->num])}}')" class="btn btn-danger">拒絶</a>
                                            </div>
                                            <div id="video_btn2" style="display: none;">
                                                <button type="submit" class="btn btn-primary" name="btn" value="yes">承諾</button>
                                                <a onclick="matchNoConfirm('{{URL::to('/matchNo',[$n->num])}}')" class="btn btn-danger">拒絶</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
