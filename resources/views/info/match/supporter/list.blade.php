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

<style>
  .list {
    display: inline-block;
    width: 200px;
    height: 70px;
    border-radius: 10px;
    border: 2px solid lightgray;
  }

  .list_link {
    float: left;
    margin-top: 10px;
    margin-left: 10px;
  }

  .thumbnale {
    float: left;
    width: 50px;
    height: 50px;
    border-radius: 50%;
  }

  p {
    padding: 5px;
    display: inline-block;
    color: gray;
  }
</style>

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
            <div class="panel-heading">求人情報</div>

            <div class="panel-body">
              @if ($match == '[]')
                対象者を介護している介護士がいないです。
              @else

                @foreach($match as $m)
                  <div class="list">
                    <a class="list_link" href="{{ url('/matchinfo/view', [$m->target_num]) }}">
                      <img class="thumbnale" src="{{URL::to('/')}}/images/profile/{{ $m->profile_image }}">
                      <p>{{ $m->name }} <br> {{ $m->cellphone }}</p>
                    </a>
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
