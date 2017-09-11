@extends('layouts.app')
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>

<link rel="stylesheet" href="{{URL::to('/')}}/css/match.css">

<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="{{URL::to('/')}}/js/bootstrap-datepicker.js"></script>
<script src="{{URL::to('/')}}/js/bootstrap-datepicker.kr.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/jquery.simple-dtpicker.js"></script>
<link type="text/css" href="{{URL::to('/')}}/css/jquery.simple-dtpicker.css" rel="stylesheet" />
<script>
    function formConfirm(url){
        if(confirm("今ページを移動したら、作成中のすべては削除されます。本当に移動しますか？")){
            location.href=url;
        }
    }
</script>
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
      <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="position:relative; top:-3px; width:20px; height:20px;"></a> > <a onclick="formConfirm('{{URL::to('/task')}}')">勤務</a> > <a onclick="formConfirm('{{URL::to('/logSpec')}}')"><b>業務日誌</b></a>
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
        <div class="wrap">
            <form class="form-horizeontal" role="form" method="post" action="{{route('logSpec.store')}}">
                {{csrf_field()}}
                <table class="table">
                    <tr>
                        <td>対象の氏名</td>
                        <td>
                            <select class="form-control" name="target_name">
                                @foreach($target as $t)
                                    <option value="{{$t->num}}">{{$t->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>勤務日付</td>
                        <td>
                            <input type="text" class="form-control" name="date" value="">
                            <script type="text/javascript">
                                $(function(){
                                    $('*[name=date]').appendDtpicker();
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>業務類型</td>
                        <td>
                            <select class="form-control" name="content_type">
                                <option>家事</option>
                                <option>介護</option>
                                <option>その他</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>薬名</td>
                        <td>
                            <input type="text" class="form-control" name="medicine_name" required>
                        </td>
                    </tr>
                    <tr>
                        <td>服薬</td>
                        <td>
                            <div class="form-group form-inline">
                                <label for="start">服薬時間や開始日付</label>
                                <input type="text" id="start" name="dateStart" value="" class="form-control" style="margin: 0 20px" required>
                                <script type="text/javascript">
                                    $(function(){
                                        $('*[name=dateStart]').appendDtpicker({
                                            "futureOnly": true
                                        });
                                    });
                                </script>
                                <label for="end">服薬時間や完了日付</label>
                                <input type="text" id="end" name="dateEnd" value="" class="form-control" style="margin: 0 20px" required>
                                <script type="text/javascript">
                                    $(function(){
                                        $('*[name=dateEnd]').appendDtpicker({
                                            "futureOnly": true
                                        });
                                    });
                                </script>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>内容</td>
                        <td>
                            <textarea class="form-control" name="content" id="content" rows="10" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-default pull-right" style="margin-top:10px;">作成</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
