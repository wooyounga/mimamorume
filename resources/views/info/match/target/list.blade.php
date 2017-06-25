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
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel-group">
            <a href="{{ url('userinfo') }}" class="btn btn-info" role="button">회원 정보</a>
            <a href="{{ url('addinfo') }}" class="btn btn-info" role="button">추가 정보</a>
            <a href="{{ url('matchinfo') }}" class="btn btn-info" role="button">계약 정보</a>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">계약 정보</div>

            <div class="panel-body">
              @if ($match == '[]')
                담당하고 있는 대상자가 없습니다.
              @else

                @foreach($match as $m)
                  <div class="list">
                    <a class="list_link" href="{{ url('/matchinfo/view', [$m->num]) }}">
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
