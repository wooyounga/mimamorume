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
<link rel="stylesheet" href="{{URL::to('/')}}/css/datepicker3.css">
<script>
    function formConfirm(url){
        if(confirm("지금 나가시면 작성 중인 내용은 전부 삭제 됩니다. 정말로 나가시겠습니까?")){
            location.href=url;
        }
    }
</script>
@section('content')
    <div class="body">
        <div>
            <a href="{{URL::to('/home')}}">Home</a> > <a onclick="formConfirm('{{URL::to('/task')}}')">근무</a> > <a onclick="formConfirm('{{URL::to('/logSpec')}}')"><b>업무일지</b></a>
        </div>
        <div class="wrap">
            <form>
               <select class="form-control pull-left" style="width: 20%; margin-bottom: 30px;">
                   <option>집안일</option>
                   <option>산책</option>
                   <option>기타</option>
               </select>
               <br>
               <textarea class="form-control" id="content" rows="20"></textarea>
               <button type="submit" class="btn btn-default pull-right" style="margin-top:10px;">작성</button>
            </form>
        </div>
    </div>
@endsection
