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
                <div class="panel-heading">会員情報</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post">

                      <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                          <label for="user_type" class="col-md-4 control-label">会員類型</label>

                          <div class="col-md-6">
                              {{ $user[0]->user_type }}
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">氏名</label>

                          <div class="col-md-6">
                              {{ $user[0]->name }}
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                          <label for="id" class="col-md-4 control-label">アカウント名</label>

                          <div class="col-md-6">
                              {{ $user[0]->id }}
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                          <label for="age" class="col-md-4 control-label">年齢</label>

                          <div class="col-md-6">
                              {{ $user[0]->age.'歳' }}
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
                              {{ $user[0]->email }}
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                          <label for="telephone" class="col-md-4 control-label">電話番号</label>

                          <div class="col-md-6">
                              {{ $user[0]->telephone }}
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                          <label for="cellphone" class="col-md-4 control-label">携帯番号</label>

                          <div class="col-md-6">
                              {{ $user[0]->cellphone }}
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                          <label for="zip_code" class="col-md-4 control-label">郵便番号</label>

                          <div class="col-md-6">
                              {{ $user[0]->zip_code }}
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('main_address') ? ' has-error' : '' }}">
                          <label for="main_address" class="col-md-4 control-label">アドレス</label>

                          <div class="col-md-6">
                              {{ $user[0]->main_address }}
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('rest_address') ? ' has-error' : '' }}">
                          <label for="rest_address" class="col-md-4 control-label">残りのアドレス</label>

                          <div class="col-md-6">
                              {{ $user[0]->rest_address }}
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <a href="{{ url('/userinfo/modify') }}" class="btn btn-primary" role="button">修正</a>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
          </div>
      </div>
  </div>
@endsection
