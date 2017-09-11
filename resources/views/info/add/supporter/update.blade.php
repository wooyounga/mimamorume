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
              <div class="panel-heading">介護士情報</div>

              <div class="panel-body">
                <form class="form-horizontal" role="form" action="{{ url('addinfo/update') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">プロフィール写真</label>

                        <div class="col-md-6">
                          <img src="{{URL::to('/')}}/images/profile/{{ $resume[0]->profile_image }}" style="margin-bottom: 20px; width:70px; height: 90px;">
                          <input type="file" name="profile_image">
                        </div>
                    </div>

                  <div class="form-group{{ $errors->has('center') ? ' has-error' : '' }}">
                      <label for="center" class="col-md-4 control-label">所属</label>

                      <div class="col-md-6">
                        <input id="center" type="text" class="form-control" name="center" value="{{ $resume[0]->center }}" required autofocus>
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('career') ? ' has-error' : '' }}">
                      <label for="career" class="col-md-4 control-label">経歴</label>

                      <div class="col-md-6">
                        <input id="career" type="text" class="form-control" name="career" value="{{ $resume[0]->career }}" required>
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('license') ? ' has-error' : '' }}">
                      <label for="license" class="col-md-4 control-label">資格有無</label>

                      <div class="col-md-6">
                        @if($resume[0]->license == 'yes')
                          <label for="yes">有</label><input id="yes" type="radio" name="license" value="yes" checked>
                          <label for="yes">無</label><input id="yes" type="radio" name="license" value="no">
                        @else
                          <label for="yes">有</label><input id="yes" type="radio" name="license" value="yes">
                          <label for="yes">無</label><input id="yes" type="radio" name="license" value="no" checked>
                        @endif
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">修正</button>
                        <a href="{{ url('/addinfo') }}" class="btn btn-primary" role="button">取り消し</a>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
