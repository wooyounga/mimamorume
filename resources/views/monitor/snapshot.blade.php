@extends('layouts.app')
@section('title')
    スナップショット撮影記録
@endsection

<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/monitoring_app.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<style>
  .shot_info{
    margin: 0;
    padding: 0;
    color: yellow;
    font-size: 19px;
    font-weight: bold;
	  text-shadow: 0 0 5px #000;
  }
  #caption{
    font-size: 40px;
  }
</style>
<script>
    $(document).ready(function(){
        $('.shot_info').hide();
        var modal = document.getElementById('myModal');

        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");

        $('.thumbnail').click(function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            var text = $(this).siblings('.shot_info').html();
            captionText.innerHTML = text;
        });

        $('.thumbnail').hover(
          function(){
            $(this).siblings('.shot_off').hide();
            $(this).siblings('.shot_info').show();
          },
          function(){
            $(this).siblings('.shot_info').hide();
            $(this).siblings('.shot_off').show();
          }
        );

        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }
    });
</script>
@section('content')
    @if (session('alert'))
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }
        </script>
    @endif
    <div id="bgimg">
      <div class="page_title">
        スナップショット撮影記録
      </div>
      <br>
      <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="position:relative; top:-3px; width:20px; height:20px;"></a> > <a href="{{URL::to('/monitoring')}}">モニタリング</a> > <a href="{{URL::to('/snapshot')}}"><b>スナップショット</b></a>
    </div>
    <style>
      #bgimg{
        background-image: url("{{ URL::to('/') }}/images/bgimg/bgimg3.png");
        background-size: cover;
        height: 300px;
        padding-left: 75px;
        padding-top: 70px;
        color: white;
        font-size: 17px;
        font-weight: bold;
      }
      #bgimg > a{
        color: white;
        text-decoration: none;
        font-size: 17px;
        font-weight: bold;
      }
      .page_title{
        color: white;
        font-size: 40px;
        margin-bottom: 100px;
      }
      .body{
        margin-top: -5%;
      }
    </style>
    <div class="body">
        <div style="margin-top: 30px;">
            <input onclick="home()" type="button" value="全体" class="btn btn-default">
            <input onclick="filter('time')" type="button" value="時間" class="btn btn-default">
            <input onclick="filter('sensing')" type="button" value="センサー" class="btn btn-default">
            <input onclick="filter('remote')" type="button" value="遠隔撮影" class="btn btn-default">
        </div>
        <div class="wrap">
            <ul class="nav nav-tabs">
                @if($target != '[]')
                    @foreach($target as $t)
                    <script>
                        function filter(filter){
                            var url = '{{URL::to('/snapShotFilter')}}';
                            var target = '{{$t->num}}';
                            location.href=url+'/'+filter+'/'+target;
                        }
                        function home(){
                            var url = '{{URL::to('/snapshot')}}';
                            location.href=url;
                        }
                    </script>
                        @if($t->num == $num)
                            <li role="presentation" class="active"><a href="#">{{$t->name}}</a></li>
                        @else
                            <li role="presentation"><a href="{{URL::to('/snapShotTarget',[$t->num])}}">{{$t->name}}</a>
                        @endif
                    @endforeach
                @else
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                @endif
            </ul>
            <div class="modal_cont">
                <div class="thumbnail_list">
                    @if($snapshot == '[]')
                        <div><h3>スナップショットがありません</h3></div>
                    @else
                          @foreach($snapshot as $s)
                            <span style="display:inline-block; width:280px; height:200px; text-align:center">
                                <img class="thumbnail" src="{{URL::to('/')}}/images/monitor/snapShot/{{$s->upload_name}}" style="position: relative; width:280px; height:200px;">
                                <span class="shot_off" style="position: relative; top: -130px;">
                                  <!-- {{$s->snapshot_type}}&nbsp;&nbsp;{{$s->created_at}} -->
                                  <br>&nbsp;
                                </span>
                                <span class="shot_info" style="position: relative; top: -130px;">
                                  {{$s->snapshot_type}}&nbsp;&nbsp;{{$s->created_at}}
                                </span>
                              </span>
                          @endforeach
                    @endif
                   {{-- <img class="thumbnail" src="{{URL::to('/')}}/images/main_logo.png">
                    <img class="thumbnail" src="{{URL::to('/')}}/images/main/main_image_01.png">--}}
                </div>
                <div id="myModal" class="modal">
                    <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
