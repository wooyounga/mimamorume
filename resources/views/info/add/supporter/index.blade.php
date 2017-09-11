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
              @if($resume == '[]')
                介護士に対する情報がありません。 <br>
                登録ボタンをクリックして、介護士の情報を登録してから、ご利用いただけます。 <br>
                <a href="{{ url('addinfo/create') }}" class="btn btn-primary" role="button">追加</a>
              @else

              <form class="form-horizontal" role="form">
                <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">プロフィール写真</label>

                    <div class="col-md-6">
                      <img src="{{URL::to('/')}}/images/profile/{{ $resume[0]->profile_image }}" style="margin-bottom: 20px; width:70px; height: 90px;">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('center') ? ' has-error' : '' }}">
                    <label for="center" class="col-md-4 control-label">所属</label>

                    <div class="col-md-6">
                        {{ $resume[0]->center }}
                    </div>
                </div>

                <div class="form-group{{ $errors->has('career') ? ' has-error' : '' }}">
                    <label for="career" class="col-md-4 control-label">経歴</label>

                    <div class="col-md-6">
                        {{ $resume[0]->career }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <a href="{{ url('addinfo/modify') }}" class="btn btn-primary" role="button">修正</a>
                    </div>
                </div>
              </form>

              @if(count($license) != 0)
                @foreach ($license as $l)
                  <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group{{ $errors->has('license_kind') ? ' has-error' : '' }}">
                            <label for="license_kind" class="col-md-4 control-label">資格名</label>

                            <div class="col-md-6">
                                {{ $l->license_kind }}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('license_num') ? ' has-error' : '' }}">
                            <label for="license_num" class="col-md-4 control-label">資格番号</label>

                            <div class="col-md-6">
                                {{ $l->license_num }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('license_grade') ? ' has-error' : '' }}">
                            <label for="license_grade" class="col-md-4 control-label">資格級</label>

                            <div class="col-md-6">
                                {{ $l->license_grade }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('institution') ? ' has-error' : '' }}">
                            <label for="institution" class="col-md-4 control-label">発給機関</label>

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
                        <label for="license_kind" class="col-md-4 control-label">資格名</label>

                        <div class="col-md-6">
                            <input id="license_kind" type="text" class="form-control" name="license_kind" value="{{ old('license_kind') }}" required autofocus>

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('license_num') ? ' has-error' : '' }}">
                        <label for="license_num" class="col-md-4 control-label">資格番号</label>

                        <div class="col-md-6">
                            <input id="license_num" type="text" class="form-control" name="license_num" value="{{ old('license_num') }}" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('license_grade') ? ' has-error' : '' }}">
                        <label for="license_grade" class="col-md-4 control-label">資格級</label>

                        <div class="col-md-6">
                            <input id="license_grade" type="text" class="form-control" name="license_grade" value="{{ old('license_grade') }}" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('institution') ? ' has-error' : '' }}">
                        <label for="institution" class="col-md-4 control-label">発給機関</label>

                        <div class="col-md-6">
                            <input id="institution" type="text" class="form-control" name="institution" value="{{ old('institution') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">資格追加</button>
                          <a href="{{ url('addinfo/destroy') }}" class="btn btn-primary" role="button">削除</a>
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
