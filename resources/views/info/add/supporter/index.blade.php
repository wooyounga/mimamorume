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

<script>
    $(document).ready(function() {

        $('.license_check').change(function() {
            if($('input[type=radio][name=license_check]:checked').val() == '있음'){
                $('.cer').css('display','');
                $('.certified_btn').css('display','');
            } else {
                $('.cer').css('display','none');
                $('.certified_btn').css('display','none');
            }
        });
    });
</script>

@section('content')
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel-group">
            <a href="{{ url('userinfo') }}" class="btn btn-default" role="button">회원 정보</a>
            <a href="{{ url('addinfo') }}" class="btn btn-default" role="button">추가 정보</a>
            <a href="{{ url('matchinfo') }}" class="btn btn-default" role="button">계약 정보</a>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">보호사 정보</div>

            <div class="panel-body">
              @if($resume == '[]')
                보호사에 대한 정보가 없습니다. <br>
                등록 버튼을 눌러서 보호사 정보 등록 후 사용해 주시기 바랍니다. <br>
                <a href="{{ url('addinfo/create') }}" class="btn btn-primary" role="button">추가</a>
              @else

              <form class="form-horizontal" role="form">
                <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">프로필 사진</label>

                    <div class="col-md-6">
                      <img src="{{URL::to('/')}}/images/profile/{{ $resume[0]->profile_image }}" style="margin-bottom: 20px; width:70px; height: 90px;">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('center') ? ' has-error' : '' }}">
                    <label for="center" class="col-md-4 control-label">소속</label>

                    <div class="col-md-6">
                        {{ $resume[0]->center }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('career') ? ' has-error' : '' }}">
                    <label for="career" class="col-md-4 control-label">경력</label>

                    <div class="col-md-6">
                        {{ $resume[0]->career }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <a href="{{ url('addinfo/modify') }}" class="btn btn-primary" role="button">수정</a>
                    </div>
                </div>
              </form>

              @if(count($license) != 0)
                @foreach ($license as $l)
                  <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group{{ $errors->has('license_kind') ? ' has-error' : '' }}">
                            <label for="license_kind" class="col-md-4 control-label">자격증 이름</label>

                            <div class="col-md-6">
                                {{ $l->license_kind }}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('license_num') ? ' has-error' : '' }}">
                            <label for="license_num" class="col-md-4 control-label">자격증 번호</label>

                            <div class="col-md-6">
                                {{ $l->license_num }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('license_grade') ? ' has-error' : '' }}">
                            <label for="license_grade" class="col-md-4 control-label">자격 등급</label>

                            <div class="col-md-6">
                                {{ $l->license_grade }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('institution') ? ' has-error' : '' }}">
                            <label for="institution" class="col-md-4 control-label">발급 기관</label>

                            <div class="col-md-6">
                                {{ $l->institution }}
                            </div>
                        </div>
                      </form>
                    </div>
                @endforeach
              @endif

              @if($resume[0]->license == 'yes')
              <div class="panel-body">
                <form class="form-horizontal" role="form" action="{{ url('addinfo/license') }}" method="post">
                  {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('license_kind') ? ' has-error' : '' }}">
                        <label for="license_kind" class="col-md-4 control-label">자격증 이름</label>

                        <div class="col-md-6">
                            <input id="license_kind" type="text" class="form-control" name="license_kind" value="{{ old('license_kind') }}" required autofocus>

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('license_num') ? ' has-error' : '' }}">
                        <label for="license_num" class="col-md-4 control-label">자격증 번호</label>

                        <div class="col-md-6">
                            <input id="license_num" type="text" class="form-control" name="license_num" value="{{ old('license_num') }}" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('license_grade') ? ' has-error' : '' }}">
                        <label for="license_grade" class="col-md-4 control-label">자격 등급</label>

                        <div class="col-md-6">
                            <input id="license_grade" type="text" class="form-control" name="license_grade" value="{{ old('license_grade') }}" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('institution') ? ' has-error' : '' }}">
                        <label for="institution" class="col-md-4 control-label">발급 기관</label>

                        <div class="col-md-6">
                            <input id="institution" type="text" class="form-control" name="institution" value="{{ old('institution') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">자격증 추가</button>
                          <a href="{{ url('addinfo/destroy') }}" class="btn btn-primary" role="button">삭제</a>
                        </div>
                    </div>
                  </form>
                </div>
              @endif
              @endif
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
