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

<link rel="stylesheet" href="{{URL::to('/')}}/css/poster.css">

@section('content')
<div class="container">
  <div class="row" style="margin:auto 0; width:1050px;">
    <div class="panel panel-default">
      <div class="panel-body">
        <form class="form-horizontal" role="form" action="{{ url('poster/store') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

<div id="poster_body">
  <table id="table">
  <tr>
    <td class="title" colspan="2">探しています</td>
  </tr>
  <tr>
    <td class="sub_title">行方不明の人の写真</td>
    <td class="sub_title">行方不明の直前の写真</td>
  </tr>
  <tr>
    <td class="photo"><img src="{{URL::to('/')}}/images/profile/{{ $target[0]->profile_image }}" style="width:300px;"></td>
@if(isset($snapshot))
    <td class="photo"><img src="{{URL::to('/')}}/images/monitor/snapShot/{{ $snapshot[0]->snapshot_name }}" style="width:300px;"></td>
@else
    <td class="photo"><img src="{{URL::to('/')}}/images/profile/default.jpg" style="width:300px;"></td>
@endif
    <input id="target_num" type="hidden" name="target_num" value="{{ $target[0]->num }}">
@if(isset($snapshot))
    <input id="snapshot_name" type="hidden" name="snapshot_name" value="{{ $snapshot[0]->snapshot_name }}">
@else
    <input id="snapshot_name" type="hidden" name="snapshot_name" value="default.jpg">
@endif
  </tr>
  <tr>
    <td class="content" colspan="2">氏名 : {{ $target[0]->name }}</td>
  </tr>
  <tr>
    <td class="content" colspan="2">年齢 : {{ $target[0]->age }}세</td>
  </tr>
  <tr>
    <td class="content" colspan="2">性別 : {{ $target[0]->gender }}</td>
  </tr>
  <tr>
    <td class="content" colspan="2">
      特異事項 : {{ $target[0]->disability_main }}{{ ',' . $target[0]->disability_sub }}{{ ',' . $target[0]->comment }}
    </td>
  </tr>
  <tr>
    <!-- <td class="content" colspan="2">印象着衣 : <input id="clothes" type="text" name="clothes" value="{{ old('clothes') }}" size="50" placeholder="키, 복장 상세, 신체적 특징 등을 기입해주세요." required></td> -->
    <td class="content" colspan="2">印象着衣 : <input id="clothes" type="text" name="clothes" value="身長: 185cm / 服装: 青い系列のティーシャツ, 黒い半ズボン / 身体的な特徴: 腹が出ている" size="50" required></td>
  </tr>
  <tr>
    <td class="content" colspan="2">
      <!-- <textarea id="other" name="other" rows="10" cols="100" value="{{ old('other') }}" placeholder="行方不明の状況や伝えたいことをお書きしてください." required></textarea> -->
      <textarea id="other" name="other" rows="10" cols="100" value="発表練習のために、情報館への移動中行方不明になる" required></textarea>
    </td>
  </tr>
  <tr>
    <td class="foot" colspan="2">上の人を見つけた方や見た覚えがある方は<span style="color:yellow;">{{ $user[0]->cellphone }}</span>や警察<span style="color:yellow;">110</span>にご連絡ください。</td>
  </tr>
  </table>
</div>

<div class="panel-body">
  <button type="submit" class="btn btn-primary btn-lg">登録</button>
</div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
