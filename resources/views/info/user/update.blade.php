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

<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-2.2.4.min.js'></script>

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
              <div class="panel-heading">会員情報</div>

              <div class="panel-body">
                <form class="form-horizontal" role="form" action="{{ url('userinfo/update') }}" method="post">
                  {{ csrf_field() }}

                  <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                      <label for="user_type" class="col-md-4 control-label">会員類型</label>

                      <div class="col-md-6">
                          {{ $user[0]->user_type }}
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="name" class="col-md-4 control-label">氏名</label>

                      <div class="col-md-6">
                          <input id="name" type="text" class="form-control" name="name" value="{{ $user[0]->name }}" required autofocus>
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                      <label for="id" class="col-md-4 control-label">アカウント名</label>

                      <div class="col-md-6">
                          {{ $user[0]->id }}
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('pw') ? ' has-error' : '' }}">
                      <label for="pw" class="col-md-4 control-label">パスワード</label>

                      <div class="col-md-6">
                          <input id="pw" type="password" class="form-control" name="pw" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="pw-confirm" class="col-md-4 control-label">パスワード確認</label>

                      <div class="col-md-6">
                          <input id="pw-confirm" type="password" class="form-control" name="pw_confirmation" required>
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                      <label for="age" class="col-md-4 control-label">年齢</label>

                      <div class="col-md-6">
                          {{ $user[0]->age.'才' }}
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                      <label for="gender" class="col-md-4 control-label">性別</label>

                      <div class="col-md-6">
                          {{ $user[0]->gender }}
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="col-md-4 control-label">イメール</label>

                      <div class="col-md-6">
                          <input id="email" type="email" class="form-control" name="email" value="{{ $user[0]->email }}" required>
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                      <label for="telephone" class="col-md-4 control-label">電話番号</label>

                      <div class="col-md-6">
                          <input id="telephone" type="text" class="form-control" name="telephone" value="{{ $user[0]->telephone }}">
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                      <label for="cellphone" class="col-md-4 control-label">携帯番号</label>

                      <div class="col-md-6">
                          <input id="cellphone" type="text" class="form-control" name="cellphone" value="{{ $user[0]->cellphone }}" required>
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                      <label for="zip_code" class="col-md-4 control-label">郵便番号</label>

                      <div class="col-md-6">
                          <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ $user[0]->zip_code }}" style="width: 130px; float: left;" readonly>
                          &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-default" value="郵便番号検索" onClick="execDaumPostCode()">
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('main_address') ? ' has-error' : '' }}">
                      <label for="main_address" class="col-md-4 control-label">アドレス</label>

                      <div class="col-md-6">
                          <input id="main_address" type="text" class="form-control" name="main_address" value="{{ $user[0]->main_address }}" readonly>
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('rest_address') ? ' has-error' : '' }}">
                      <label for="rest_address" class="col-md-4 control-label">残りのアドレス</label>

                      <div class="col-md-6">
                          <input id="rest_address" type="text" class="form-control" name="rest_address" value="{{ $user[0]->rest_address }}">
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">修正</button>
                          <a href="{{ url('/userinfo') }}" class="btn btn-primary" role="button">取り消し</a>
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
