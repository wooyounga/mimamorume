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
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
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
<script>
    $(document).ready(function(){
        $("input[name=subject]").change(function(){
            if($(':radio[name="subject"]:checked').val()=='介護職員'){
                $('.recipient').css('display','none');
                $('.care').css('display','');
            }else{
                $('.recipient').css('display','');
                $('.care').css('display','none');
            }
        });
    });
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
  .body{
    margin-top: -5%;
  }
</style>
<div class="body">
    <div class="test1">
    </div>
    <div class="wrap">
    <form  class="form-horizeontal" role="form" method="post" action="{{URL::to('/search')}}">
        {{csrf_field()}}
        {{--<div class="navbar" style="border: 2px solid skyblue">
            <div class="navbar-inner">
                <ul id="address_si" class=" nav">
                    <!-- 매칭 지역명을 Append 시킬 공간-->
                </ul>
            </div>
        </div>--}}
        <table class="search table">
               <tr>
                    <td>区分</td>
                    <td>性別</td>
                    <td>年齢</td>
                    <td><span class="recipient" style="display: none;">障害</span></td>
                    <td>勤務日</td>
                    <td>勤務期間</td>
               </tr>
               <tr>
                    <td>
                        <span><input type="radio" id="care" name="subject" value="介護職員" checked="checked"><label for="care">介護職員</label></span>
                        <span><input type="radio" id="recipient" name="subject" value="対象者"><label for="recipient">対象者</label></span>
                    </td>
                    <td>
                        <span><input type="checkbox" id="man" name="gander[]" value="男"><label for="man">男</label></span>
                        <span><input type="checkbox" id="woman" name="gander[]" value="女"><label for="woman">女</label></span>
                    </td>
                    <td>
                        <span><input type="checkbox" id="10" name="age[]" value="10代"><label for="10">10代</label></span>
                        <span><input type="checkbox" id="20" name="age[]" value="20代"><label for="20">20代</label></span>
                        <span><input type="checkbox" id="30" name="age[]" value="30代"><label for="30">30代</label></span>
                        <span><input type="checkbox" id="40" name="age[]" value="40代"><label for="40">40代</label></span>
                        <span><input type="checkbox" id="50" name="age[]" value="50代"><label for="50">50代</label></span>
                        <span><input type="checkbox" id="60" name="age[]" value="60代"><label for="60">60代</label></span>
                        <span><input type="checkbox" id="70more" name="age[]" value="70代以上"><label for="70more">70代以上</label></span>
                    </td>
                    <td>
                        <div class="recipient" style="display: none;">
                            <span><input type="checkbox" id="no" name="disability[]" value="障害なし"><label for="no">障害なし</label></span>
                            <span><input type="checkbox" id="physical" name="disability[]" value="肢体障害"><label for="physical">肢体障害</label></span>
                            <span><input type="checkbox" id="sense" name="disability[]" value="視覚障害"><label for="sense">視覚障害</label></span>
                            <span><input type="checkbox" id="hearing" name="disability[]" value="聴覚障害"><label for="hearing">聴覚障害</label></span>
                            <span><input type="checkbox" id="speech" name="disability[]" value="言語障害"><label for="speech">言語障害</label></span>
                            <span><input type="checkbox" id="facial" name="disability[]" value="顔面障害"><label for="facial">顔面障害</label></span>
                            <span><input type="checkbox" id="brain" name="disability[]" value="脳血管障害"><label for="brain">脳血管障害</label></span>
                            <span><input type="checkbox" id="mental" name="disability[]" value="知的障害"><label for="mental">知的障害</label></span>
                            <span><input type="checkbox" id="autism" name="disability[]" value="自閉性障害"><label for="autism">自閉性障害</label></span>
                        </div>

                    </td>
                    <td>
                        <span><input type="checkbox" id="mon" name="week[]" value="週1回"><label for="mon">週1回</label></span>
                        <span><input type="checkbox" id="tues" name="week[]" value="週2回"><label for="tues">週2回</label></span>
                        <span><input type="checkbox" id="wed" name="week[]" value="週3回"><label for="wed">週3回</label></span>
                        <span><input type="checkbox" id="thu" name="week[]" value="週4回"><label for="thu">週4回</label></span>
                        <span><input type="checkbox" id="fri" name="week[]" value="週5回"><label for="fri">週5回</label></span>
                        <span><input type="checkbox" id="sat" name="week[]" value="週6回"><label for="sat">週6回</label></span>
                        <span><input type="checkbox" id="sun" name="week[]" value="週7回"><label for="sun">週7回</label></span>
                    </td>
                    <td>
                        <span><input type="checkbox" id="1less" name="period[]" value="1ヵ月未満"><label for="1less">1ヵ月未満</label></span>
                        <span><input type="checkbox" id="3less" name="period[]" value="3ヵ月未満"><label for="3less">3ヵ月未満</label></span>
                        <span><input type="checkbox" id="6less" name="period[]" value="6ヵ月未満"><label for="6less">6ヵ月未満</label></span>
                        <span><input type="checkbox" id="12less" name="period[]" value="1年未満"><label for="12less">1年未満</label></span>
                        <span><input type="checkbox" id="12more" name="period[]" value="1年以上"><label for="12more">1年以上</label></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-inline pull-right">
                            <input type="text" id="roadAddress" class="form-control" name="roadAddress" value="" readonly>
                            <input type="button" class="btn btn-default" value="住所検索" onClick="execDaumPostCode()"><br/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-inline pull-right">
                            <input class="form-control" name="searchInput" type="text">
                            <button class="btn btn-default" type="submit">検索</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <table class="table table-striped ">
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
                <td>タイトル</td>
                <td>作成者</td>
                <td>作成日</td>
                <td>クリック数</td>
            </tr>
            @if($match == '[]')
                <tr>
                    <td colspan="5" style="text-align: center; margin: 50px;">登録できたことがありません。</td>
                </tr>
            @else
                @foreach($match as $m)
                    <tr class="table_body">
                        <td><a href="{{route('match.show',[$m->num])}}">{{$m->num}}</a></td>
                        <td><a href="{{route('match.show',[$m->num])}}">{{$m->title}}</a></td>
                        <td>{{$m->user_id}}</td>
                        <td>{{$m->created_at}}</td>
                        <td>{{$m->view}}</td>
                    </tr>
                @endforeach
            @endif
            <tr>
                @if($search == 'ある')
                    <td colspan="5"><a class="btn btn-default pull-right" href="{{URL::to('/match')}}">全部見る</a></td>
                @else
                  <td colspan="5"><a class="btn btn-default pull-right" href="{{route('match.create')}}">登録</a></td>
                @endif
            </tr>
            <tr class="text-center">
                <td colspan="5">
                    <ul class="pagination">
                    </ul>
                </td>
            </tr>
        </table>
        {{--https://laravel.com/docs/5.4/pagination--}}
    </div>
</div>
@endsection
