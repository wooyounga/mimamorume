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
<script src="{{URL::to('/')}}/js/matchForm.js"></script>
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script>
    function formConfirm(url){
        if(confirm("今、出と作成中の内容がなくなります。本当に出ますか。")){
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
    <script>
        function execDaumPostCode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var fullAddr = ''; // 최종 주소 변수
                    var extraAddr = ''; // 조합형 주소 변수

                    // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        fullAddr = data.roadAddress;

                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        fullAddr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                    if(data.userSelectedType === 'R'){
                        //법정동명이 있을 경우 추가한다.
                        if(data.bname !== ''){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있을 경우 추가한다.
                        if(data.buildingName !== ''){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                        fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                    }
                    document.getElementById('roadAddress').value = fullAddr;
                }
            }).open();
        }
    </script>
    <div id="bgimg">
      <div class="page_title">
        求人
      </div>
      <br>
      <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="position:relative; top:-3px; width:20px; height:20px;"></a> > <a onclick="formConfirm('{{URL::to('/match')}}')">マッチング</a> > <a onclick="formConfirm('{{URL::to('/match')}}')"><b>求人</b></a>
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
      .body{
        margin-top: -5%;
      }
    </style>
    <div class="body">
        <div class="wrap">
            <form class="form-horizeontal" role="form" method="post" action="{{route('match.store')}}">
                {{csrf_field()}}
                <h4 style="color: #428bca;">※自分が探す相手の条件を選ぶところです。</h4>
                <table class="search table">
                    @if($user[0]->user_type == '保護者')
                        <tr>
                            <td colspan="2">対象の名前</td>
                            <td colspan="4">
                                <select class="form-control" id="target_num" name="target_num">
                                    @foreach($user as $t)
                                        <option value="{{$t->num}}">{{$t->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>性別</td>
                            <td>年齢</td>
                            <td>障害</td>
                            <td>勤務日</td>
                            <td>勤務期間</td>
                        </tr>
                    @endif
                    <tr>
                        <td>
                            <span><label for="man">男</label><input type="radio" id="man" name="gender" value="男" required></span>
                            <span><label for="woman">女</label><input type="radio" id="woman" name="gender" value="女" required></span>
                        </td>
                        <td>
                            <span><label for="10">10代</label><input type="radio" id="10" name="age" value="10代" required></span>
                            <span><label for="20">20代</label><input type="radio" id="20" name="age" value="20代" required></span>
                            <span><label for="30">30代</label><input type="radio" id="30" name="age" value="30代" required></span>
                            <span><label for="40">40代</label><input type="radio" id="40" name="age" value="40代" required></span>
                            <span><label for="50">50代</label><input type="radio" id="50" name="age" value="50代" required></span>
                            <span><label for="60">60代</label><input type="radio" id="60" name="age" value="60代" required></span>
                            <span><label for="60more">70代以上</label><input type="radio" id="70more" name="age" value="70代以上" required></span>
                        </td>
                        <td>
                            <span><label for="no">障害なし</label><input type="radio" id="no" name="disability" value="障害なし" required></span>
                            <span><label for="physical">肢体障害</label><input type="radio" id="physical" name="disability" value="肢体障害" required></span>
                            <span><label for="sense">視覚障害</label><input type="radio" id="sense" name="disability" value="視覚障害" required></span>
                            <span><label for="hearing">聴覚障害</label><input type="radio" id="hearing" name="disability" value="聴覚障害" required></span>
                            <span><label for="speech">言語障害</label><input type="radio" id="speech" name="disability" value="言語障害" required></span>
                            <span><label for="facial">顔面障害</label><input type="radio" id="facial" name="disability" value="顔面障害" required></span>
                            <span><label for="brain">脳血管障害</label><input type="radio" id="brain" name="disability" value="脳血管障害" required></span>
                            <span><label for="mental">知的障害</label><input type="radio" id="mental" name="disability" value="知的障害" required></span>
                            <span><label for="autism">自閉性障害</label><input type="radio" id="autism" name="disability" value="自閉性障害" required></span>
                        </td>
                        <td>
                            <span><label for="mon">週1回</label><input type="radio" id="mon" name="week" value="週1回" required></span>
                            <span><label for="tues">週2回</label><input type="radio" id="tues" name="week" value="週2回" required></span>
                            <span><label for="wed">週3回</label><input type="radio" id="wed" name="week" value="週3回" required></span>
                            <span><label for="thu">週4回</label><input type="radio" id="thu" name="week" value="週4回" required></span>
                            <span><label for="fri">週5回</label><input type="radio" id="fri" name="week" value="週5回" required></span>
                            <span><label for="sat">週6回</label><input type="radio" id="sat" name="week" value="週6回" required></span>
                            <span><label for="sun">週7回</label><input type="radio" id="sun" name="week" value="週7回" required></span>
                        </td>
                        <td>
                            <span><label for="1less">1ヵ月未満</label><input type="radio" id="1less" name="period" value="1ヵ月未満" required></span>
                            <span><label for="3less">3ヵ月未満</label><input type="radio" id="3less" name="period" value="3ヵ月未満" required></span>
                            <span><label for="6less">6ヵ月未満</label><input type="radio" id="6less" name="period" value="6ヵ月未満" required></span>
                            <span><label for="12less">1年未満</label><input type="radio" id="12less" name="period" value="1年未満" required></span>
                            <span><label for="12more">1年以上</label><input type="radio" id="12more" name="period" value="1年以上" required></span>
                        </td>
                    </tr>
                    <tr>
                        <td>住所</td>
                        <td colspan="5">
                            <div class="form-inline pull-right">
                                <input type="text" id="roadAddress" class="form-control" name="roadAddress" value="" readonly>
                                <input type="button" class="btn btn-default" value="住所検索" onClick="execDaumPostCode()"><br/>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="matchForm">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">タイトル</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div  class="form-group">
                        <label for="content" class="col-sm-2 control-label">内容</label>
                        <textarea class="form-control" id="content" name="content" rows="15" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-default pull-right" style="margin-top:10px;">作成</button>
                </div>
            </form>
        </div>
    </div>
    <br><br>
@endsection
