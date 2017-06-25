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

<script src="/js/html2canvas.js"></script>

<link rel="stylesheet" href="{{URL::to('/')}}/css/poster.css">

<script type="text/javascript">
  $(document).ready(function(){
    $("#poster_image").hide();
    $('#print_poster').hide();
    $('#save_poster').on('click', function(){
      html2canvas($("#poster_body").get(0), {
          "logging": true,
          "proxy": "/html2canvasproxy.php",
          "onrendered": function(canvas) {
              // alert(canvas);
              var url = canvas.toDataURL("image/png");
              // window.open(url, "_blank");

              $("#poster_body").hide();
              $("#save_poster").hide();
              $("#poster_image").attr("src", url);
              $("#poster_image").show();
              $("#print_poster").show();
          }
      });
    });

    $('#print_poster').on('click', function(){
      window.print();
    });
  });
</script>

@section('content')
<div class="container">
  <div class="row" style="margin:auto 0; width:1050px;">
    <div class="panel panel-default">
      <div class="panel-body">

<div id="poster_body" style="background-color:white;">
  <table id="table">
    <tr>
      <td class="title" colspan="2">실종자를 찾습니다</td>
    </tr>
    <tr>
      <td class="sub_title">실종 인물 사진</td>
      <td class="sub_title">실종 전 사진</td>
    </tr>
    <tr>
      <td class="photo"><img src="{{URL::to('/')}}/images/profile/default.jpg" style="width:300px;"></td>
      <td class="photo"><img src="{{URL::to('/')}}/images/profile/default.jpg" style="width:300px;"></td>
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
        {{-- $poster[0]->other --}}
      </td>
    </tr>
    <tr>
      <td class="foot" colspan="2">위 사람을 찾으신 분은 <span style="color:yellow;">{{ $user[0]->cellphone }}</span> 혹은 경찰서 <span style="color:yellow;">112</span>로 연락주시기 바랍니다.</td>
    </tr>
  </table>
</div>

<img id="poster_image" />

<div class="panel-body">
  <button class="btn btn-primary btn-lg" type="button" id="save_poster">저장</button>
  <button class="btn btn-primary btn-lg" type="button" id="print_poster">인쇄</button>
</div>

      </div>
    </div>
  </div>
</div>

<!--
<div class="SNS_Share_Top hidden-xs">
  <button id="pdn" type="button" name="button">인쇄</button>

  <a href="#" onclick="javascript:window.open('https://twitter.com/intent/tweet?text='
 +encodeURIComponent(document.URL)+'%20-%20'+encodeURIComponent(document.title), 'twittersharedialog',
  'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" alt="Share on Twitter">
    <img src="/images/Twitter.png" style="width:32px; height:32px;"></a>

 <a href="#" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u='
 +encodeURIComponent(document.URL)+'&amp;t='+encodeURIComponent(document.title), 'facebooksharedialog',
  'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" alt="Share on Facebook">
  <img src="/images/Facebook.png" style="width:32px; height:32px;"></a>

 <a href="#" onclick="javascript:window.open('https://plus.google.com/share?url='+encodeURIComponent(document.URL), 'googleplussharedialog',
 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=600');return false;" target="_blank" alt="Share on Google+">
  <img src="/images/Google_Plus.png" style="width:32px; height:32px;"></a>
</div>
-->

@endsection