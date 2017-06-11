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
<script src="{{URL::to('/')}}/js/matchForm.js"></script>
<script>
    function formConfirm(url){
        if(confirm("지금 나가시면 작성 중인 내용은 전부 삭제 됩니다. 정말로 나가시겠습니까?")){
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
    <div class="body">
        <div>
            <a href="{{URL::to('/home')}}">Home</a> > <a onclick="formConfirm('{{URL::to('/match')}}')">매칭</a> > <a onclick="formConfirm('{{URL::to('/match')}}')"><b>구인</b></a>
        </div>
        <div class="wrap">
            <form class="form-horizeontal" role="form" method="post" action="{{route('match.store')}}">
                {{csrf_field()}}
                <h4 style="color: #428bca;">※본인이 찾는 상대의 조건을 선택하는 곳입니다.</h4>
                <table class="search table">
                    <tr>
                        <td>구분</td>
                        <td>성별</td>
                        <td>나이</td>
                        <td>장애</td>
                        <td>근무일</td>
                        <td>근무기간</td>
                    </tr>
                    <tr>
                        <td>
                            <span><label for="care">보호사</label><input type="radio" id="care" name="subject" value="보호사"></span>
                            <span><label for="recipient">대상자</label><input type="radio" id="recipient" name="subject" value="대상자"></span>
                        </td>
                        <td>
                            <span><label for="man">남</label><input type="radio" id="man" name="gender" value="남"></span>
                            <span><label for="woman">여</label><input type="radio" id="woman" name="gender" value="여"></span>
                        </td>
                        <td>
                            <span><label for="10less">10대 미만</label><input type="radio" id="10less" name="age" value="10대 미만"></span>
                            <span><label for="10">10대</label><input type="radio" id="10" name="age" value="10대"></span>
                            <span><label for="20">20대</label><input type="radio" id="20" name="age" value="20대"></span>
                            <span><label for="30">30대</label><input type="radio" id="30" name="age" value="30대"></span>
                            <span><label for="40">40대</label><input type="radio" id="40" name="age" value="40대"></span>
                            <span><label for="50">50대</label><input type="radio" id="50" name="age" value="50대"></span>
                            <span><label for="60">60대</label><input type="radio" id="60" name="age" value="60대"></span>
                            <span><label for="60more">60대 이상</label><input type="radio" id="60more" name="age" value="60대 이상"></span>
                            <span><label for="age_unrelated">연령무관</label><input type="radio" id="age_unrelated" name="age" value="연령무관"></span>
                        </td>
                        <td>
                            <span><label for="no">장애없음</label><input type="radio" id="no" name="disability" value="장애없음"></span>
                            <span><label for="physical">지체장애</label><input type="radio" id="physical" name="disability" value="지체장애"></span>
                            <span><label for="sense">시각장애</label><input type="radio" id="sense" name="disability" value="시각장애"></span>
                            <span><label for="hearing">청각장애</label><input type="radio" id="hearing" name="disability" value="청각장애"></span>
                            <span><label for="speech">언어장애</label><input type="radio" id="speech" name="disability" value="언어장애"></span>
                            <span><label for="facial">안면장애</label><input type="radio" id="facial" name="disability" value="안면장애"></span>
                            <span><label for="brain">뇌병변장애</label><input type="radio" id="brain" name="disability" value="뇌병변장애"></span>
                            <span><label for="mental">지적장애</label><input type="radio" id="mental" name="disability" value="지적장애"></span>
                            <span><label for="autism">자폐성장애</label><input type="radio" id="autism" name="disability" value="자폐성장애"></span>
                            <span><label for="disability_unrelated">장애무관</label><input type="radio" id="disability_unrelated" name="disability" value="장애무관"></span>
                        </td>
                        <td>
                            <span><label for="mon">주 1회</label><input type="radio" id="mon" name="week" value="주 1회"></span>
                            <span><label for="tues">주 2회</label><input type="radio" id="tues" name="week" value="주 2회"></span>
                            <span><label for="wed">주 3회</label><input type="radio" id="wed" name="week" value="주 3회"></span>
                            <span><label for="thu">주 4회</label><input type="radio" id="thu" name="week" value="주 4회"></span>
                            <span><label for="fri">주 5회</label><input type="radio" id="fri" name="week" value="주 5회"></span>
                            <span><label for="sat">주 6회</label><input type="radio" id="sat" name="week" value="주 6회"></span>
                            <span><label for="sun">주 7회</label><input type="radio" id="sun" name="week" value="주 7회"></span>
                            <span><label for="week_unrelated">추후협의</label><input type="radio" id="week_unrelated" name="week" value="추후협의"></span>
                        </td>
                        <td>
                            <span><label for="1less">1개월 미만</label><input type="radio" id="1less" name="period" value="1개월미만"></span>
                            <span><label for="3less">3개월 미만</label><input type="radio" id="3less" name="period" value="3개월미만"></span>
                            <span><label for="6less">6개월 미만</label><input type="radio" id="6less" name="period" value="6개월미만"></span>
                            <span><label for="12less">1년 미만</label><input type="radio" id="12less" name="period" value="1년미만"></span>
                            <span><label for="12more">1년 이상</label><input type="radio" id="12more" name="period" value="1년이상"></span>
                        </td>
                    </tr>
                </table>
                <div class="matchForm">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">제목</label>
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    <div  class="form-group">
                        <label for="content" class="col-sm-2 control-label">내용</label>
                        <textarea class="form-control" id="content" name="content" rows="20"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default pull-right" style="margin-top:10px;">작성</button>
                </div>
            </form>
        </div>
    </div>
@endsection
