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

<link rel="stylesheet" href="/css/poster.css">

@section('content')
<div class="container">
    <div class="row" style="margin:auto 0; width:1050px;">
        <div class="panel panel-default">
            <div class="panel-body">
              <div id="save_image" class="panel-content">
                <table id="table">
                  <tr>
                    <td class="title" colspan="2"><p>실종자를 찾습니다</p></td>
                  </tr>
                  <tr>
                    <td class="sub_title"><p>실종 인물 사진</p></td>
                    <td class="sub_title"><p>실종 전 사진</p></td>
                  </tr>
                  <tr>
                    <td class="photo"><img src="{{URL::to('/')}}/images/profile/{{-- $poster[0]->target_num --}}" style="width:300px;"></td>
                    <td class="photo"><img src="{{URL::to('/')}}/images/profile/{{-- $poster[0]->snapshot_num --}}" style="width:300px;"></td>
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
                    <td class="content" colspan="2">인상착의 : {{-- $poster[0]->clothes --}}</td>
                  </tr>
                  <tr>
                    <td class="content" colspan="2">
                      <p>{{-- $poster[0]->other --}}</p>
                    </td>
                  </tr>
                  <tr>
                    <td class="foot" colspan="2">위 사람을 찾으신 분은 <p style="color:yellow;">{{ $user[0]->cellphone }}</p> 혹은 경찰서 <p style="color:yellow;">112</p>로 연락주시기 바랍니다.</td>
                  </tr>
                </table>
              </div>

              <div class="SNS_Share_Top hidden-xs">
                <input type="button" value="인쇄" onclick="window.print();">

               <a href="#" onclick="javascript:window.open('https://twitter.com/intent/tweet?text='
               +encodeURIComponent(document.URL)+'%20-%20'+encodeURIComponent(document.title), 'twittersharedialog',
                'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" alt="Share on Twitter">
                  <img src="{{URL::to('/')}}/images/Twitter.png" style="width:32px; height:32px;"></a>

               <a href="#" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u='
               +encodeURIComponent(document.URL)+'&amp;t='+encodeURIComponent(document.title), 'facebooksharedialog',
                'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" alt="Share on Facebook">
                <img src="{{URL::to('/')}}/images/Facebook.png" style="width:32px; height:32px;"></a>

               <a href="#" onclick="javascript:window.open('https://plus.google.com/share?url='+encodeURIComponent(document.URL), 'googleplussharedialog',
               'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=600');return false;" target="_blank" alt="Share on Google+">
                <img src="{{URL::to('/')}}/images/Google_Plus.png" style="width:32px; height:32px;"></a>
             </div>

            </div>
        </div>
    </div>
</div>
@endsection
