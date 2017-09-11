<script src="{{ URL::to('/') }}/js/jquery.film_roll.js"></script>
<link href="{{ URL::to('/') }}/css/main_app.css" rel="stylesheet" type="text/css">
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="pn">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login.store') }}">
                    {{ csrf_field() }}
                    <br>
                    <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                        <span class="st">ID</span>
                        <br>
                        <input id="id" type="id" class="form-control" name="id" value="{{ old('id') }}" required autofocus>
                    </div>
                    <div class="form-group{{ $errors->has('pw') ? ' has-error' : '' }}">
                        <span class="st">PW</span>
                        <br>
                        <input id="pw" type="password" class="form-control" name="pw" required>
                    </div>
                    @if (session('alert'))
                        <script>
                            var msg = '{{Session::get('alert')}}';
                            var exist = '{{Session::has('alert')}}';
                            if(exist){
                                alert(msg);
                            }
                        </script>
                    @endif
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn logbtn stt">
                            LOGIN
                        </button>
                        <style>
                          .stt{
                            font-weight: bold;
                          }
                        </style>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function()
        {
            var slider_width = $('.main_menu').width();//get width automaticly
            var flag = 1;

            $('#main_btn').click(function() {
                if(flag % 2 == 0) {
                    $('.main_menu').animate({"margin-right": '-='+slider_width});
                    // $('#main_menu_div').css('visibility','hidden');
                    setTimeout(function(){
                        $('#main_menu_div').css('visibility','hidden');
                    },400);
                } else {
                    if(!$(this).is(':animated')){//perevent double click to double margin
                        $('#main_menu_div').css('visibility','visible');
                        $('.main_menu').animate({"margin-right": '+='+slider_width});
                    }
                }
                flag++;
            });
            $(function() {
                fr = new FilmRoll({
                    container: '#film_roll',
                    height: 800
                });
            });
            $(window).load(function(){
                $('.film_roll_pager').addClass('container');

            })

            $(".top").hide();

            // fade in #back-top
            $(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $('.top').fadeIn();
                    } else {
                        $('.top').fadeOut();
                    }
                });
                // scroll body to 0px on click
                $('#back-top a').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            })
        });

    </script>

    <div style="width: 100%; height: 100%; position: relative;">

        <div id="film_roll" style="width: 100%;  height: 100%; position: absolute">
            <div>
                <img src="{{ URL::to('/') }}/images/main/main_image_01.jpg" class="image_size">
            </div>
            <div>
                <img src="{{ URL::to('/') }}/images/main/main_image_02.jpg" class="image_size">
            </div>
            <div>
                <img src="{{ URL::to('/') }}/images/main/main_image_03.jpg" class="image_size">
            </div>
            <div>
                <img src="{{ URL::to('/') }}/images/main/main_image_04.jpg" class="image_size">
            </div>
        </div>

        <img id="main_btn" src="{{ URL::to('/') }}/images/main/main_image_button.png" >
        <div id="main_menu_div">
            <a href="#main_service_01"><img class="main_menu" src="{{ URL::to('/') }}/images/main/main_service_image_01.png"></a>
            <a href="#main_service_02"><img class="main_menu" src="{{ URL::to('/') }}/images/main/main_service_image_02.png"></a>
            <a href="#main_service_03"><img class="main_menu" src="{{ URL::to('/') }}/images/main/main_service_image_03.png"></a>
        </div>
    </div>
    <div class="main_service" id="service_01">
        <div class="top"><a href="#film_roll"><img src="{{ URL::to('/') }}/images/main/main_top_image.png" class="main_top"></a></div>
        <div id="main_service_01"><img src="{{ URL::to('/') }}/images/main/main_service_01.jpg" class="main_service_image"></div>
        <div id="main_service_02"><img src="{{ URL::to('/') }}/images/main/main_service_02.jpg" class="main_service_image"></div>
        <div id="main_service_03"><img src="{{ URL::to('/') }}/images/main/main_service_03.jpg" class="main_service_image"></div>
    </div>
@endsection
