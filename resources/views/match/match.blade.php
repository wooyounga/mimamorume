@extends('layouts.app')
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/match.css">
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script>
    function address(data){
        $('.wrap ul').css('display','none');
        $('#address_si').css('display','');
        $(data).css('display','');
    }
</script>
@section('content')
<div class="body">
    <div>
        <a href="{{URL::to('/home')}}">Home</a> > <a href="{{URL::to('/match')}}">매칭</a> > <a href="{{URL::to('/match')}}"><b>구인</b></a>
    </div>
    <div class="wrap">
                <form>
                    <div class="navbar" style="border: 2px solid skyblue">
                        <div class="navbar-inner">
                    <ul id="address_si" class=" nav">
                        <li><a href="#" onclick="address('.seoul')">서울</a></li>
                        <li><a href="#" onclick="address('.busan')">부산</a></li>
                        <li><a href="#" onclick="address('.daegu')">대구</a></li>
                        <li><a href="#" onclick="address('.incheon')">인천</a></li>
                        <li><a href="#" onclick="address('.gwangju')">광주</a></li>
                        <li><a href="#" onclick="address('.daejeon')">대전</a></li>
                        <li><a href="#" onclick="address('.ulsan')">울산</a></li>
                        <li><a href="#" onclick="address('.sejong')">세종</a></li>
                        <li><a href="#" onclick="address('.gg')">경기</a></li>
                        <li><a href="#" onclick="address('.gyeongnam')">경남</a></li>
                        <li><a href="#" onclick="address('.gb')">경북</a></li>
                        <li><a href="#" onclick="address('.chungnam')">충남</a></li>
                        <li><a href="#" onclick="address('.chungbuk')">충북</a></li>
                        <li><a href="#" onclick="address('.jeonnam')">전남</a></li>
                        <li><a href="#" onclick="address('.jeonbuk')">전북</a></li>
                        <li><a href="#" onclick="address('.gangwon')">강원</a></li>
                        <li><a href="#" onclick="address('.jeju')">제주</a></li>
                    </ul>
                 </div>
            </div>
            <table class="search table">
                <tr>
                    <td>구분</td>
                    <td>성별</td>
                    <td>나이</td>
                    <td>장애</td>
                    <td>근무기간</td>
                    <td>근무시간</td>
                </tr>
                <tr>
                    <td>
                        <span><label for="care">보호사</label><input type="radio" id="care" name="subject" value="보호사"></span>
                        <span><label for="recipient">대상자</label><input type="radio" id="recipient" name="subject" value="대상자"></span>
                    </td>
                    <td>
                        <span><label for="man">남</label><input type="radio" id="man" name="gander" value="남"></span>
                        <span><label for="woman">여</label><input type="radio" id="woman" name="gander" value="여"></span>
                    </td>
                    <td>
                        <span><label for="10less">10대 미만</label><input type="checkbox" id="10less" name="age" value="10대 미만"></span>
                        <span><label for="10">10대</label><input type="checkbox" id="10" name="age" value="10대"></span>
                        <span><label for="20">20대</label><input type="checkbox" id="20" name="age" value="20대"></span>
                        <span><label for="30">30대</label><input type="checkbox" id="30" name="age" value="30대"></span>
                        <span><label for="40">40대</label><input type="checkbox" id="40" name="age" value="40대"></span>
                        <span><label for="50">50대</label><input type="checkbox" id="50" name="age" value="50대"></span>
                        <span><label for="60">60대</label><input type="checkbox" id="60" name="age" value="60대"></span>
                        <span><label for="60more">60대 이상</label><input type="checkbox" id="60more" name="age" value="60대 이상"></span>
                        <span><label for="age_unrelated">연령무관</label><input type="checkbox" id="age_unrelated" name="age" value="연령무관"></span>
                    </td>
                    <td>
                        <span><label for="no">장애없음</label><input type="checkbox" id="no" name="disability" value="장애없음"></span>
                        <span><label for="physical">지체장애</label><input type="checkbox" id="physical" name="disability" value="지체장애"></span>
                        <span><label for="sense">시각장애</label><input type="checkbox" id="sense" name="disability" value="시각장애"></span>
                        <span><label for="hearing">청각장애</label><input type="checkbox" id="hearing" name="disability" value="청각장애"></span>
                        <span><label for="speech">언어장애</label><input type="checkbox" id="speech" name="disability" value="언어장애"></span>
                        <span><label for="facial">안면장애</label><input type="checkbox" id="facial" name="disability" value="안면장애"></span>
                        <span><label for="brain">뇌병변장애</label><input type="checkbox" id="brain" name="disability" value="뇌병변장애"></span>
                        <span><label for="mental">지적장애</label><input type="checkbox" id="mental" name="disability" value="지적장애"></span>
                        <span><label for="autism">자폐성장애</label><input type="checkbox" id="autism" name="disability" value="자폐성장애"></span>
                        <span><label for="disability_unrelated">장애무관</label><input type="checkbox" id="disability_unrelated" name="disability" value="장애무관"></span>
                    </td>
                    <td>
                        <span><label for="mon">월</label><input type="checkbox" id="mon" name="week" value="월"></span>
                        <span><label for="tues">화</label><input type="checkbox" id="tues" name="week" value="화"></span>
                        <span><label for="wed">수</label><input type="checkbox" id="wed" name="week" value="수"></span>
                        <span><label for="thu">목</label><input type="checkbox" id="thu" name="week" value="목"></span>
                        <span><label for="fri">금</label><input type="checkbox" id="fri" name="week" value="금"></span>
                        <span><label for="sat">토</label><input type="checkbox" id="sat" name="week" value="토"></span>
                        <span><label for="sun">일</label><input type="checkbox" id="sun" name="week" value="일"></span>
                        <span><label for="week_unrelated">추후협의</label><input type="checkbox" id="week_unrelated" name="week" value="추후협의"></span>
                    </td>
                    <td>
                        <span><label for="1less">1개월 미만</label><input type="checkbox" id="1less" name="period" value="1개월미만"></span>
                        <span><label for="3less">3개월 미만</label><input type="checkbox" id="3less" name="period" value="3개월미만"></span>
                        <span><label for="6less">6개월 미만</label><input type="checkbox" id="6less" name="period" value="6개월미만"></span>
                        <span><label for="12less">1년 미만</label><input type="checkbox" id="12less" name="period" value="1년미만"></span>
                        <span><label for="12more">1년 이상</label><input type="checkbox" id="12more" name="period" value="1년이상"></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="form-inline pull-right">
                            <input class="form-control" type="text">
                            <input class="btn btn-default" type="submit" value="검색">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <table class="table table-striped ">
            <tr>
                <td>번호</td>
                <td>제목</td>
                <td>작성자</td>
                <td>날짜</td>
                <td>조회수</td>
            </tr>
            {{--@foreach($projects as $proj)--}}
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            {{--@endforeach--}}
            <tr>
                <td colspan="5"><a class="btn btn-default pull-right" href="{{route('match.create')}}">등록</a></td>
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