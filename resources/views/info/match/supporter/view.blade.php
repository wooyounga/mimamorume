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
          <div class="panel-group">
            <a href="{{ url('userinfo') }}" class="btn btn-info" role="button">회원 정보</a>
            <a href="{{ url('addinfo') }}" class="btn btn-info" role="button">추가 정보</a>
            <a href="{{ url('matchinfo') }}" class="btn btn-info" role="button">계약 정보</a>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">대상자 정보</div>

            <div class="panel-body">
              <form class="form-horizontal" role="form">
                <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">대상자 사진</label>

                    <div class="col-md-6">
                      <img src="{{URL::to('/')}}/images/profile/{{ $match[0]->profile_image }}" style="margin-bottom: 20px; width:70px; height: 90px;">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">이름</label>

                    <div class="col-md-6">
                        {{ $match[0]->name }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                    <label for="age" class="col-md-4 control-label">나이</label>

                    <div class="col-md-6">
                        {{ $match[0]->age }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">성별</label>

                    <div class="col-md-6">
                        {{ $match[0]->gender }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                    <label for="telephone" class="col-md-4 control-label">집 전화번호</label>

                    <div class="col-md-6">
                        {{ $match[0]->telephone }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                    <label for="cellphone" class="col-md-4 control-label">휴대 전화번호</label>

                    <div class="col-md-6">
                        {{ $match[0]->cellphone }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                    <label for="zip_code" class="col-md-4 control-label">우편번호</label>

                    <div class="col-md-6">
                        {{ $match[0]->zip_code }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('main_address') ? ' has-error' : '' }}">
                    <label for="main_address" class="col-md-4 control-label">주소</label>

                    <div class="col-md-6">
                        {{ $match[0]->main_address }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('rest_address') ? ' has-error' : '' }}">
                    <label for="rest_address" class="col-md-4 control-label">나머지 주소</label>

                    <div class="col-md-6">
                        {{ $match[0]->rest_address }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('disability_main') ? ' has-error' : '' }}">
                    <label for="disability_main" class="col-md-4 control-label">장애 종류(주)</label>

                    <div class="col-md-6">
                        {{ $match[0]->disability_main }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('disability_sub') ? ' has-error' : '' }}">
                    <label for="disability_sub" class="col-md-4 control-label">장애 종류(부)</label>

                    <div class="col-md-6">
                      @if ($match[0]->disability_sub == null)
                        없음
                      @else
                        {{ $match[0]->disability_sub }}
                      @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <label for="comment" class="col-md-4 control-label">특이사항</label>

                    <div class="col-md-6">
                      @if ($match[0]->comment == null)
                        없음
                      @else
                        {{ $match[0]->comment }}
                      @endif
                    </div>
                </div>

                <div id="map">

                </div>
              </form>
            </div>

            <div class="panel-body">
              <form class="form-horizontal" role="form">
                <div class="form-group{{ $errors->has('work_week') ? ' has-error' : '' }}">
                    <label for="work_week" class="col-md-4 control-label">근무 요일</label>

                    <div class="col-md-6">
                        {{ $contract[0]->work_week }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('work_start') ? ' has-error' : '' }}">
                    <label for="work_start" class="col-md-4 control-label">근무 시작일</label>

                    <div class="col-md-6">
                        {{ $contract[0]->work_start }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('work_end') ? ' has-error' : '' }}">
                    <label for="work_end" class="col-md-4 control-label">근무 종료일</label>

                    <div class="col-md-6">
                        {{ $contract[0]->work_end }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('work_start_time') ? ' has-error' : '' }}">
                    <label for="work_start_time" class="col-md-4 control-label">근무 시작시간</label>

                    <div class="col-md-6">
                        {{ $contract[0]->work_start_time }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('work_end_time') ? ' has-error' : '' }}">
                    <label for="work_end_time" class="col-md-4 control-label">근무 종료시간</label>

                    <div class="col-md-6">
                        {{ $contract[0]->work_end_time }}
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
