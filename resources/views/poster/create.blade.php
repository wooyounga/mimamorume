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

<link rel="stylesheet" href="{{URL::to('/')}}/css/poster.css">

@section('content')
<div class="container">
    <div class="row" style="margin:auto 0; width:1050px;">
        <div class="panel panel-default">
            <div class="panel-body">
              <form class="form-horizontal" role="form" action="{{ route('poster.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <table id="table">
                  <tr>
                    <td class="title" colspan="2">실종자를 찾습니다</td>
                  </tr>
                  <tr>
                    <td class="sub_title">실종 인물 사진</td>
                    <td class="sub_title">실종 전 사진</td>
                  </tr>
                  <tr>
                    <td class="photo"><img src="{{URL::to('/')}}/images/profile/{{ $target[0]->profile_image }}" style="width:300px;"></td>
                    <td class="photo"><img src="{{URL::to('/')}}/images/monitor/snapShot/{{-- $snapshot[count(snapshot) - 1]->num --}}" style="width:300px;"></td>
                    <input id="target_num" type="hidden" name="target_num" value="{{ $target[0]->num }}">
                    <input id="snapshot_num" type="hidden" name="snapshot_num" value="{{-- $snapshot[count(snapshot) - 1]->num --}}">
                  </tr>
                  <tr>
                    <td class="content" colspan="2">이름 : {{ $target[0]->name }}</td>
                  </tr>
                  <tr>
                    <td class="content" colspan="2">나이 : {{ $target[0]->age }}세</td>
                  </tr>
                  <tr>
                    <td class="content" colspan="2">성별 : {{ $target[0]->gender }}</td>
                  </tr>
                  <tr>
                    <td class="content" colspan="2">
                      특이사항 : {{ $target[0]->disability_main }}{{ ',' . $target[0]->disability_sub }}{{ ',' . $target[0]->comment }}
                    </td>
                  </tr>
                  <tr>
                    <td class="content" colspan="2">인상착의 : <input id="clothes" type="text" name="clothes" value="{{ old('clothes') }}" size="50" placeholder="키, 복장 상세, 신체적 특징 등을 기입해주세요." required></td>
                  </tr>
                  <tr>
                    <td class="content" colspan="2">
                      <textarea id="other" name="other" rows="10" cols="100" value="{{ old('other') }}" placeholder="실종 당시 상황 및 전달 하실 말씀을 적어주세요." required></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td class="foot" colspan="2">위 사람을 찾으신 분은 <p style="color:yellow;">{{ $user[0]->cellphone }}</p> 혹은 경찰서 <p style="color:yellow;">112</p>로 연락주시기 바랍니다.</td>
                  </tr>
                </table>

                <div class="panel-body">
                  <button type="submit" class="btn btn-primary">등록</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection
