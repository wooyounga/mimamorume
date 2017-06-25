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
    @if (session('alert'))
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }
        </script>
    @endif
    <div class="body">
        <div>
            <a href="{{URL::to('/home')}}">Home</a> > <a href="{{URL::to('/monitoring')}}">모니터링</a> > <a href="{{URL::to('/snapshot')}}"><b>스냅샷</b></a>
        </div>
        <div class="wrap">
            <ul class="nav nav-tabs">
                @if($target != '[]')
                    @foreach($target as $t)
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
                        <div><h3>최근에 찍힌 스냅샷이 존재하지 않습니다</h3></div>
                    @else
                          @foreach($snapshot as $s)
                            <span style="display:inline-block; width:300px; height:200px;">
                                <img class="thumbnail" src="{{URL::to('/')}}/images/monitor/snapShot/{{$s->upload_name}}">
                                <br>{{$s->snapshot_type}}<br>
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
