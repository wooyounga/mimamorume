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
<script async defer
        src="http://maps.googleapis.com/maps/api/js?callback=initMap"></script>
<script>

    function initMap() {
        var address = {lat: 35.896274, lng: 128.621965};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: address
        });
        var marker = new google.maps.Marker({
            position: address,
            map: map
        });
    }
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
                    <div class="panel-heading">対象者情報</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group{{ $errors->has('num') ? ' has-error' : '' }}">
                                <label for="num" class="col-md-4 control-label">対象者アカウント</label>

                                <div class="col-md-6">
                                    {{ $target[0]->num }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">対象者の写真</label>

                                <div class="col-md-6">
                                    <img src="{{URL::to('/')}}/images/profile/{{ $target[0]->profile_image }}" style="margin-bottom: 20px; width:70px; height: 90px;">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">氏名</label>

                                <div class="col-md-6">
                                    {{ $target[0]->name }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age" class="col-md-4 control-label">年齢</label>

                                <div class="col-md-6">
                                    {{ $target[0]->age }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">性別</label>

                                <div class="col-md-6">
                                    {{ $target[0]->gender }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                <label for="telephone" class="col-md-4 control-label">電話番号</label>

                                <div class="col-md-6">
                                    {{ $target[0]->telephone }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                                <label for="cellphone" class="col-md-4 control-label">携帯番号</label>

                                <div class="col-md-6">
                                    {{ $target[0]->cellphone }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                <label for="zip_code" class="col-md-4 control-label">郵便番号</label>

                                <div class="col-md-6">
                                    {{ $target[0]->zip_code }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('main_address') ? ' has-error' : '' }}">
                                <label for="main_address" class="col-md-4 control-label">アドレス</label>

                                <div class="col-md-6">
                                    {{ $target[0]->main_address }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('rest_address') ? ' has-error' : '' }}">
                                <label for="rest_address" class="col-md-4 control-label">残りのアドレス</label>

                                <div class="col-md-6">
                                    {{ $target[0]->rest_address }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('disability_main') ? ' has-error' : '' }}">
                                <label for="disability_main" class="col-md-4 control-label">障害種類(主)</label>

                                <div class="col-md-6">
                                    {{ $target[0]->disability_main }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('disability_sub') ? ' has-error' : '' }}">
                                <label for="disability_sub" class="col-md-4 control-label">障害種類(副)</label>

                                <div class="col-md-6">
                                    @if ($target[0]->disability_sub == null)
                                        無
                                    @else
                                        {{ $target[0]->disability_sub }}
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <label for="comment" class="col-md-4 control-label">特異事項</label>

                                <div class="col-md-6">
                                    @if ($target[0]->comment == null)
                                        無
                                    @else
                                        {{ $target[0]->comment }}
                                    @endif
                                </div>
                            </div>

                            <div id="map">

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{ url('addinfo/modify') }}" class="btn btn-primary" role="button">修正</a>
                                    <a href="{{ url('addinfo/destroy') }}" class="btn btn-primary" role="button">削除</a>
                                    <a href="{{ url('poster/create') }}" class="btn btn-primary" role="button">行方不明ポスター作製</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
