@extends('layouts.app')

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="//code.jquery.com/jquery.min.js"></script>

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="panel-body">
                <a href="{{ url('userinfo') }}" class="btn btn-info" role="button">회원 정보</a>
                <a href="{{ url('addinfo') }}" class="btn btn-info" role="button">추가 정보</a>
                <a href="{{ url('matchinfo') }}" class="btn btn-info" role="button">매칭 정보</a>
            </div>
            @foreach($user as $u)
            <div class="panel panel-default">
                <div class="panel-heading">회원 정보</div>

                <div class="panel-body">
                    <form class="fomr-horizontal" role="form" method="post">

                      <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                          <label for="user_type" class="col-md-4 control-label">회원구분</label>

                          <div class="col-md-6">
                              <p>{{ $u->user_type }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">이름</label>

                          <div class="col-md-6">
                              <p>{{ $u->name }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                          <label for="id" class="col-md-4 control-label">아이디</label>

                          <div class="col-md-6">
                              <p>{{ $u->id }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                          <label for="age" class="col-md-4 control-label">나이</label>

                          <div class="col-md-6">
                              <p>{{ $u->age.'세' }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                          <label for="gender" class="col-md-4 control-label">성별</label>

                          <div class="col-md-6">
                              <p>{{ $u->gender }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email" class="col-md-4 control-label">이메일</label>

                          <div class="col-md-6">
                              <p>{{ $u->email }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                          <label for="telephone" class="col-md-4 control-label">집전화번호</label>

                          <div class="col-md-6">
                              <p>{{ $u->telephone }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                          <label for="cellphone" class="col-md-4 control-label">휴대전화번호</label>

                          <div class="col-md-6">
                              <p>{{ $u->cellphone }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                          <label for="zip_code" class="col-md-4 control-label">우편번호</label>

                          <div class="col-md-6">
                              <p>{{ $u->zip_code }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('main_address') ? ' has-error' : '' }}">
                          <label for="main_address" class="col-md-4 control-label">주소</label>

                          <div class="col-md-6">
                              <p>{{ $u->main_address }}</p>
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('rest_address') ? ' has-error' : '' }}">
                          <label for="rest_address" class="col-md-4 control-label">나머지 주소</label>

                          <div class="col-md-6">
                              <p>{{ $u->rest_address }}</p>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <a href="{{ url('/userinfo/update') }}" class="btn btn-primary" role="button">수정</a>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
          @endforeach
          </div>
      </div>
  </div>
@endsection
