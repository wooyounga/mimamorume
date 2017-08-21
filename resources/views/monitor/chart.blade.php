@extends('layouts.app')
@section('title')
    건강차트
@endsection
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/monitoring_app.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
<style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>
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
        심박수 그래프
      </div>
      <br>
      <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="position:relative; top:-3px; width:20px; height:20px;"></a> > <a href="{{URL::to('/monitoring')}}">모니터링</a> > <a href="{{URL::to('/chart')}}"><b>통계</b></a>
    </div>
    <style>
      #bgimg{
        background-image: url("{{ URL::to('/') }}/images/bgimg/bgimg4.png");
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
    </style>
    <div class="body">
        <div class="wrap">

        </div>
        {{--d3.js Area--}}
        <div style="width:100%;">
            <canvas id="canvas"></canvas>
        </div>

        {{--d3.js graph draw--}}
        <script>
                var dateArray = [];
                var dataArray = [];
                    $.ajax({
                    url:"http:/"+"/133.130.99.167/mimamo/public/chartData",
                    type:"GET",
                    dataType: "jsonp",
                    success: function(data) {
                        data.forEach(function (d) {
                            dateArray.push(d.date);
                            dataArray.push(d.close);
                        });
                    },
                    error: function(data, status, er) {
                        console.log("error:" + status, "er" + er);
                        console.log("code:"+data.status+"\n"+"message:" + data.responseText+"\n"+"error:"+er);
                    }
                });
                var config = {
                    type: 'line',
                    data: {
                        labels: dateArray,
                        datasets: [{
                            label: "pulse data",
                            backgroundColor : 'rgba(255, 99, 132, 0.2)',
                            borderColor : 'rgba(255,99,132,1)',
                            borderWidth: 2,
                            data: dataArray,
                            fill: false,
                        }]
                    }
                };

                window.onload = function() {
                    var ctx = document.getElementById("canvas").getContext("2d");
                    window.myLine = new Chart(ctx, config);
                };

        </script>
    </div>
@endsection
