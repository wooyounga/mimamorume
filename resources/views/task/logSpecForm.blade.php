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
<script src="{{URL::to('/')}}/js/bootstrap-datepicker.js"></script>
<script src="{{URL::to('/')}}/js/bootstrap-datepicker.kr.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/jquery.simple-dtpicker.js"></script>
<link type="text/css" href="{{URL::to('/')}}/css/jquery.simple-dtpicker.css" rel="stylesheet" />
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
            <a href="{{URL::to('/home')}}">Home</a> > <a onclick="formConfirm('{{URL::to('/task')}}')">근무</a> > <a onclick="formConfirm('{{URL::to('/logSpec')}}')"><b>업무일지</b></a>
        </div>
        <div class="wrap">
            <form class="form-horizeontal" role="form" method="post" action="{{route('logSpec.store')}}">
                {{csrf_field()}}
                <table class="table">
                    <tr>
                        <td>대상자명</td>
                        <td>
                            <select class="form-control" name="target_name">
                                @foreach($target as $t)
                                    <option value="{{$t->num}}">{{$t->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>근무 일자</td>
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
                        <td>업무 유형</td>
                        <td>
                            <select class="form-control" name="content_type">
                                <option>가사</option>
                                <option>돌봄</option>
                                <option>기타</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>약 이름</td>
                        <td>
                            <input type="text" class="form-control" name="medicine_name" required>
                        </td>
                    </tr>
                    <tr>
                        <td>약 복용</td>
                        <td>
                            <div class="form-group form-inline">
                                <label for="start">약복용 시간 및 시작날짜</label>
                                <input type="text" id="start" name="dateStart" value="" class="form-control" style="margin: 0 20px" required>
                                <script type="text/javascript">
                                    $(function(){
                                        $('*[name=dateStart]').appendDtpicker({
                                            "futureOnly": true
                                        });
                                    });
                                </script>
                                <label for="end">약복용 시간 및 완료날짜</label>
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
                        <td>내용</td>
                        <td>
                            <textarea class="form-control" name="content" id="content" rows="10" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-default pull-right" style="margin-top:10px;">작성</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
