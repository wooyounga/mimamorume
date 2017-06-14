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
              <div class="panel panel-default">
                <div class="panel-heading">대상자 정보</div>

                @if ($target == '[]')
                  <p>대상이 없습니다. 대상을 추가하지 않으면 저희 서비스를 사용하실 수 없습니다.</p>
                  <p>추가 버튼을 눌러서 추가를 진행 해주시기 바랍니다.</p>
                  <a href="{{ url('addinfo/create') }}" class="btn btn-primary" role="button">추가</a>
                @else

                <div class="panel-body">
                  <form class="form-horizontal" role="form">
                    @foreach($target as $t)

                    <div class="form-group{{ $errors->has('num') ? ' has-error' : '' }}">
                        <label for="num" class="col-md-4 control-label">대상자 아이디</label>

                        <div class="col-md-6">
                            <p>{{ $t->num }}</p>
                        </div>
                    </div>
{{--
                    <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">대상자 사진</label>

                        <div class="col-md-6">
                            <p>{{ $t->profile_image }}</p>
                        </div>
                    </div> --}}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">이름</label>

                        <div class="col-md-6">
                            <p>{{ $t->name }}</p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                        <label for="age" class="col-md-4 control-label">나이</label>

                        <div class="col-md-6">
                            <p>{{ $t->age }}</p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label for="gender" class="col-md-4 control-label">성별</label>

                        <div class="col-md-6">
                            <p>{{ $t->gender }}</p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                        <label for="telephone" class="col-md-4 control-label">집 전화번호</label>

                        <div class="col-md-6">
                            <p>{{ $t->telephone }}</p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                        <label for="cellphone" class="col-md-4 control-label">휴대 전화번호</label>

                        <div class="col-md-6">
                            <p>{{ $t->cellphone }}</p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                        <label for="zip_code" class="col-md-4 control-label">우편번호</label>

                        <div class="col-md-6">
                            <p>{{ $t->zip_code }}</p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('main_address') ? ' has-error' : '' }}">
                        <label for="main_address" class="col-md-4 control-label">주소</label>

                        <div class="col-md-6">
                            <p>{{ $t->main_address }}</p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('rest_address') ? ' has-error' : '' }}">
                        <label for="rest_address" class="col-md-4 control-label">나머지 주소</label>

                        <div class="col-md-6">
                            <p>{{ $t->rest_address }}</p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('disability_main') ? ' has-error' : '' }}">
                        <label for="disability_main" class="col-md-4 control-label">장애 종류(주)</label>

                        <div class="col-md-6">
                            <p>{{ $t->disability_main }}</p>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('disability_sub') ? ' has-error' : '' }}">
                        <label for="disability_sub" class="col-md-4 control-label">장애 종류(부)</label>

                        <div class="col-md-6">
                          @if ($t->disability_sub == null)
                            <p>없음</p>
                          @else
                            <p>{{ $t->disability_sub }}</p>
                          @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('comment ') ? ' has-error' : '' }}">
                        <label for="comment " class="col-md-4 control-label">특이사항</label>

                        <div class="col-md-6">
                          @if ($t->comment == null)
                            <p>없음</p>
                          @else
                            <p>{{ $t->comment }}</p>
                          @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                          <p></p>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                          <a href="{{ url('addinfo/create') }}" class="btn btn-primary" role="button">추가</a>
                          <a href="{{ url('addinfo/modify') }}" class="btn btn-primary" role="button">수정</a>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
          @endif
        </div>
    </div>
</div>
@endsection
