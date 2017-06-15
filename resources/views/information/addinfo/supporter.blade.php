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

              @if($resume == '[]')
                <p>보호사에 대한 정보가 없습니다.</p>
                <p>등록 버튼을 눌러서 보호사 정보 등록을 진행 해주시기 바랍니다.</p>
                <a href="{{ url('addinfo/create') }}" class="btn btn-primary" role="button">추가</a>
              @else

              <div class="panel-body">
                <form class="form-horizontal" role="form">
                  @foreach($resume as $r)

                  <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">프로필 사진</label>

                      <div class="col-md-6">
                        <img src="/images/profileImage/{{ $resume[0]->profile_image }}" style="margin-bottom: 20px; width:70px; height: 90px;">
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('center') ? ' has-error' : '' }}">
                      <label for="center" class="col-md-4 control-label">소속</label>

                      <div class="col-md-6">
                          <p>{{ $r->center }}</p>
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('career') ? ' has-error' : '' }}">
                      <label for="career" class="col-md-4 control-label">경력</label>

                      <div class="col-md-6">
                          <p>{{ $r->career }}</p>
                      </div>
                  </div>
                @endforeach

                <form class="form-horizontal" role="form" action="{{ url('license/add') }}" method="post">
                  <table>
                    <tr>
                      <th>자격증 이름</th>
                      <th>자격증 번호</th>
                      <th>자격 등급</th>
                      <th>발급 기관</th>
                    </tr>
                    <tr>
                      <td><input id="license_kind" type="text" class="form-control" name="license_kind" value="" required></td>
                      <td><input id="license_num" type="text" class="form-control" name="license_num" value="" required></td>
                      <td><input id="license_grade" type="text" class="form-control" name="license_grade" value="" required></td>
                      <td><input id="institution" type="text" class="form-control" name="institution" value="" required></td>
                    </tr>
                  </table>
                  <button type="submit" class="btn btn-primary">등록</button>
                  <a href="{{ url('license/modify') }}" class="btn btn-primary" role="button">수정</a>
                  <a href="{{ url('addinfo/destroy') }}" class="btn btn-primary" role="button">삭제</a>
                </form>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <a href="{{ url('addinfo/modify') }}" class="btn btn-primary" role="button">수정</a>
                    </div>
                </div>
                </form>
                @endif
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
