@extends('layouts.app')
@section('title')
    MIMAMORUME
@endsection
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/monitoring_app.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script>

    function hover(element, url) {
        /*var id = document.getElementById()*/
        element.setAttribute('src','{{ URL::to('/') }}/images/monitor'+url+'_mouseover.png');//이미지 주소 변경
    }
    function unhover(element, url) {
        element.setAttribute('src', '{{ URL::to('/') }}/images/monitor'+url+'.png'); //이미지 주소 변경
    }
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
            <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="width:20px; height:20px;"></a> > <a href="{{URL::to('/monitoring')}}"><b>모니터링</b></a>
        </div>
        <div class="wrap">
            <div class="monitor_image">
                <div>
                    <a href="{{ URL::to('/snapshot') }}">
                        <img id="img01" src="{{ URL::to('/') }}/images/monitor/snapshot_button.png"
                         onmouseover="hover(this,'/snapshot_button');" onmouseout="unhover(this, '/snapshot_button')">
                    </a>
                </div>
                <div>
                    <a href="{{ URL::to('/chart') }}">
                        <img src="{{ URL::to('/') }}/images/monitor/stats_button.png"
                         onmouseover="hover(this,'/stats_button');" onmouseout="unhover(this, '/stats_button')">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
