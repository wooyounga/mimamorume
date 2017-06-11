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
              <div class="panel-heading">보호사 정보</div>

              <div class="panel-body">
                <form class="fomr-horizontal" role="form">

                  <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">프로필 사진</label>

                      <div class="col-md-6">
                        <img src="" style="margin-bottom: 20px; width:100px; height: 130px;" class="img-thumbnail" onerror="javascript:this.src=''">
                        <input type="file" value="사진 업로드">
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('center') ? ' has-error' : '' }}">
                      <label for="center" class="col-md-4 control-label">소속</label>

                      <div class="col-md-6">
                          <input id="center" type="text" class="form-control" name="center" value="{{ old('center') }}" required>
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('career') ? ' has-error' : '' }}">
                      <label for="career" class="col-md-4 control-label">경력</label>

                      <div class="col-md-6">
                          <input id="career" type="text" class="form-control" name="career" value="{{ old('career') }}" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="license_kind" class="col-md-4 control-label">자격증 이름</label>

                      <div class="col-md-6">
                          <input id="license_kind" type="text" class="form-control" name="license_kind" value="" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="license_num" class="col-md-4 control-label">자격증 번호</label>

                      <div class="col-md-6">
                          <input id="license_num" type="text" class="form-control" name="license_num" value="" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="license_grade" class="col-md-4 control-label">자격 등급</label>

                      <div class="col-md-6">
                          <input id="license_grade" type="text" class="form-control" name="license_grade" value="" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="institution" class="col-md-4 control-label">자격증 발급 기관</label>

                      <div class="col-md-6">
                          <input id="institution" type="text" class="form-control" name="institution" value="" required>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
