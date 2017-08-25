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
            if($(':radio[name="subject"]:checked').val()=='보호사'){
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
                    <td>구분</td>
                    <td>성별</td>
                    <td>나이</td>
                    <td><span class="recipient" style="display: none;">장애</span></td>
                    <td>근무일</td>
                    <td>근무기간</td>
               </tr>
               <tr>
                    <td>
                        <span><input type="radio" id="care" name="subject" value="보호사" checked="checked"><label for="care">보호사</label></span>
                        <span><input type="radio" id="recipient" name="subject" value="대상자"><label for="recipient">대상자</label></span>
                    </td>
                    <td>
                        <span><input type="checkbox" id="man" name="gander[]" value="남"><label for="man">남</label></span>
                        <span><input type="checkbox" id="woman" name="gander[]" value="여"><label for="woman">여</label></span>
                    </td>
                    <td>
                        <span><input type="checkbox" id="10less" name="age[]" value="10대미만"><label for="10less">10대 미만</label></span>
                        <span><input type="checkbox" id="10" name="age[]" value="10대"><label for="10">10대</label></span>
                        <span><input type="checkbox" id="20" name="age[]" value="20대"><label for="20">20대</label></span>
                        <span><input type="checkbox" id="30" name="age[]" value="30대"><label for="30">30대</label></span>
                        <span><input type="checkbox" id="40" name="age[]" value="40대"><label for="40">40대</label></span>
                        <span><input type="checkbox" id="50" name="age[]" value="50대"><label for="50">50대</label></span>
                        <span><input type="checkbox" id="60" name="age[]" value="60대"><label for="60">60대</label></span>
                        <span><input type="checkbox" id="60more" name="age[]" value="60대이상"><label for="60more">60대 이상</label></span>
                        <span><input type="checkbox" id="age_unrelated" name="age[]" value="연령무관"><label for="age_unrelated">연령무관</label></span>
                    </td>
                    <td>
                        <div class="recipient" style="display: none;">
                            <span><input type="checkbox" id="no" name="disability[]" value="장애없음"><label for="no">장애없음</label></span>
                            <span><input type="checkbox" id="physical" name="disability[]" value="지체장애"><label for="physical">지체장애</label></span>
                            <span><input type="checkbox" id="sense" name="disability[]" value="시각장애"><label for="sense">시각장애</label></span>
                            <span><input type="checkbox" id="hearing" name="disability[]" value="청각장애"><label for="hearing">청각장애</label></span>
                            <span><input type="checkbox" id="speech" name="disability[]" value="언어장애"><label for="speech">언어장애</label></span>
                            <span><input type="checkbox" id="facial" name="disability[]" value="안면장애"><label for="facial">안면장애</label></span>
                            <span><input type="checkbox" id="brain" name="disability[]" value="뇌병변장애"><label for="brain">뇌병변장애</label></span>
                            <span><input type="checkbox" id="mental" name="disability[]" value="지적장애"><label for="mental">지적장애</label></span>
                            <span><input type="checkbox" id="autism" name="disability[]" value="자폐성장애"><label for="autism">자폐성장애</label></span>
                            <span><input type="checkbox" id="disability_unrelated" name="disability[]" value="장애무관"><label for="disability_unrelated">장애무관</label></span>
                        </div>

                    </td>
                    <td>
                        <span><input type="checkbox" id="mon" name="week[]" value="주1회"><label for="mon">주 1회</label></span>
                        <span><input type="checkbox" id="tues" name="week[]" value="주2회"><label for="tues">주 2회</label></span>
                        <span><input type="checkbox" id="wed" name="week[]" value="주3회"><label for="wed">주 3회</label></span>
                        <span><input type="checkbox" id="thu" name="week[]" value="주4회"><label for="thu">주 4회</label></span>
                        <span><input type="checkbox" id="fri" name="week[]" value="주5회"><label for="fri">주 5회</label></span>
                        <span><input type="checkbox" id="sat" name="week[]" value="주6회"><label for="sat">주 6회</label></span>
                        <span><input type="checkbox" id="sun" name="week[]" value="주7회"><label for="sun">주 7회</label></span>
                        <span><input type="checkbox" id="week_unrelated" name="week[]" value="추후협의"><label for="week_unrelated">추후협의</label></span>
                    </td>
                    <td>
                        <span><input type="checkbox" id="1less" name="period[]" value="1개월미만"><label for="1less">1개월 미만</label></span>
                        <span><input type="checkbox" id="3less" name="period[]" value="3개월미만"><label for="3less">3개월 미만</label></span>
                        <span><input type="checkbox" id="6less" name="period[]" value="6개월미만"><label for="6less">6개월 미만</label></span>
                        <span><input type="checkbox" id="12less" name="period[]" value="1년미만"><label for="12less">1년 미만</label></span>
                        <span><input type="checkbox" id="12more" name="period[]" value="1년이상"><label for="12more">1년 이상</label></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-inline pull-right">
                            <input type="text" id="roadAddress" class="form-control" name="roadAddress" value="" readonly>
                            <input type="button" class="btn btn-default" value="동 검색" onClick="execDaumPostCode()"><br/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-inline pull-right">
                            <input class="form-control" name="searchInput" type="text">
                            <button class="btn btn-default" type="submit">검색</button>
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
                <td>번호</td>
                <td>제목</td>
                <td>작성자</td>
                <td>날짜</td>
                <td>조회수</td>
            </tr>
            @if($match == '[]')
                <tr>
                    <td colspan="5" style="text-align: center; margin: 50px;">등록 된 구인 글이 없습니다.</td>
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
                @if($search == '있음')
                    <td colspan="5"><a class="btn btn-default pull-right" href="{{URL::to('/match')}}">전체보기</a></td>
                @else
                  <td colspan="5"><a class="btn btn-default pull-right" href="{{route('match.create')}}">등록</a></td>
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
