@extends('layouts.app')
@section('title')
    스냅샷 열람
@endsection

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/monitoring_app.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        var modal = document.getElementById('myModal');

        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");

        $('.thumbnail').click(function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        });

        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }
    });
</script>
@section('content')
    <div class="body">
        <div>
            <a href="{{URL::to('/home')}}">Home</a> > <a href="{{URL::to('/monitoring')}}">모니터링</a> > <a href="{{URL::to('/snapshot')}}"><b>스냅샷</b></a>
        </div>
        <div class="wrap">
            <div class="btn-group" style="margin-bottom: 20px;">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    전체 보기
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                    <li><a tabindex="-1" href="#">외출 센서 촬영</a></li>
                    <li><a tabindex="-1" href="#">일정 주기 촬영</a></li>
                    <li><a tabindex="-1" href="#">수동 촬영</a></li>
                    <li class="divider"></li>
                </ul>
            </div>
            <div class="thumbnail_list">
                <img class="thumbnail" src="{{URL::to('/')}}/images/main_logo.png">
                <img class="thumbnail" src="{{URL::to('/')}}/images/main/main_image_01.png">
            </div>
            <div id="myModal" class="modal modal-cont">
                <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption"></div>
            </div>
        </div>
    </div>
@endsection