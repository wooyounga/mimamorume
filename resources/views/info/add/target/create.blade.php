@extends('layouts.app')

<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<!-- 우편번호 찾기 -->
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

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

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('zip_code').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('main_address').value = fullAddr;

                // 커서를 상세주소 필드로 이동한다.
                document.getElementById('rest_address').focus();
            }
        }).open();

    }

</script>

@section('content')
<br><br><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel-group">
            <a href="{{ url('userinfo') }}" class="btn btn-default" role="button">会員情報</a>
            <a href="{{ url('addinfo') }}" class="btn btn-default" role="button">追加情報</a>
            <a href="{{ url('matchinfo') }}" class="btn btn-default" role="button">契約情報</a>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">対象者情報</div>

            <div class="panel-body">
              <form class="form-horizontal" role="form" action="{{ url('addinfo/store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('num') ? ' has-error' : '' }}">
                    <label for="num" class="col-md-4 control-label">対象者アカウント</label>

                    @if (count($target) == 0)
                      <div class="col-md-6">
                        <input id="num" type="text" class="form-control" name="num" value="1" required readonly>
                      </div>
                    @else
                      <div class="col-md-6">
                        <input id="num" type="text" class="form-control" name="num" value="{{ $target[count($target) - 1]->num + 1 }}" required readonly>
                      </div>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">対象者写真</label>

                    <div class="col-md-6">
                      <input id="profile_image" type="file" name="profile_image">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">氏名</label>

                    <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                    <label for="age" class="col-md-4 control-label">年齢</label>

                    <div class="col-md-6">
                      <input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}" required>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">性別</label>

                    <div class="col-md-6">
                      <label for="man">男</label><input id="man" type="radio" name="gender" value="남성">
                      <label for="woman">女</label><input id="woman" type="radio" name="gender" value="여성">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                    <label for="telephone" class="col-md-4 control-label">電話番号</label>

                    <div class="col-md-6">
                      <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                    <label for="cellphone" class="col-md-4 control-label">携帯番号</label>

                    <div class="col-md-6">
                      <input id="cellphone" type="text" class="form-control" name="cellphone" value="{{ old('cellphone') }}" required>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                    <label for="zip_code" class="col-md-4 control-label">郵便番号</label>

                    <div class="col-md-6">
                        <input id="zip_code" type="text" class="form-control" name="zip_code" style="width: 130px; float: left;" readonly>
                        &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-default" value="郵便番号検索" onClick="execDaumPostCode()">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('main_address') ? ' has-error' : '' }}">
                    <label for="main_address" class="col-md-4 control-label">アドレス</label>

                    <div class="col-md-6">
                        <input id="main_address" type="text" class="form-control" name="main_address" readonly>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('rest_address') ? ' has-error' : '' }}">
                    <label for="rest_address" class="col-md-4 control-label">残りのアドレス</label>

                    <div class="col-md-6">
                        <input id="rest_address" type="text" class="form-control" name="rest_address" value="{{ old('rest_address') }}">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('disability_main') ? ' has-error' : '' }}">
                    <label for="disability_main" class="col-md-4 control-label">障害種類(主)</label>

                    <div class="col-md-6">
                      <select id="disability_main" class="form-control" name="disability_main">
                          <option value="장애없음">無</option>
                          <option value="지체장애">肢体障害</option>
                          <option value="시각장애">視覚障害</option>
                          <option value="청각장애">聴覚障害</option>
                          <option value="언어장애">言語障害</option>
                          <option value="안면장애">顔面障害</option>
                          <option value="뇌병변장애">脳血管障害</option>
                          <option value="지적장애">知的障害</option>
                          <option value="자폐성장애">自閉症障害</option>
                      </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('disability_sub') ? ' has-error' : '' }}">
                    <label for="disability_sub" class="col-md-4 control-label">障害種類(副)</label>

                    <div class="col-md-6">
                      <input id="disability_sub" type="text" class="form-control" name="disability_sub" value="{{ old('disability_sub') }}">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <label for="comment" class="col-md-4 control-label">特異事項</label>

                    <div class="col-md-6">
                        <input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}">
                    </div>
                </div>

                <div id="map">

                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">登録</button>
                        <button type="reset" class="btn btn-primary">取り消し</button>
                        <a href="{{ url('/addinfo') }}" class="btn btn-primary" role="button">リスト</a>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
