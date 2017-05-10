<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="{{ URL::to('/') }}/js/jquery.film_roll.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment-with-locales.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ URL::to('/') }}/css/main_app.css" rel="stylesheet" type="text/css">
    <script>
        $(document).ready(function(){
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
        $(document).ready(function()
        {
            var slider_width = $('.main_menu').width();//get width automaticly
            $('#main_btn').click(function() {

                if($(this).css("margin-right") == slider_width+"px" && !$(this).is(':animated')) {
                    $('.main_menu,#main_btn').animate({"margin-right": '-='+slider_width});
                    //$('#main_menu_div').css('visibility','hidden');
                    setTimeout(function(){
                        $('#main_menu_div').css('visibility','hidden');
                    },400);
                } else {
                    if(!$(this).is(':animated')){//perevent double click to double margin
                        $('#main_menu_div').css('visibility','visible');
                        $('.main_menu,#main_btn').animate({"margin-right": '+='+slider_width});

                    }

                }
            });
        });

    </script>
{{--    <script>
        var image_arr = new Array(
            "{{ URL::to('/') }}/images/main/main_image_01.png",
            "{{ URL::to('/') }}/images/main/main_image_02.png"
        );

        var image_num = 0;

        showImage = function(img_btn){
            if(image_arr.length==0){
                return;
            }
            if(img_btn == 'left'){
                image_num=image_num-1;
                if(image_num<0){
                    image_num=image_arr.length-1;
                }
            }else if(img_btn == 'right'){
                image_num=image_num+1;
                if(image_num>(image_arr.length-1)){
                    image_num = 0;
                }
            }else{
                image_num = 0;
            }
            var img_box = document.getElementById('img_box');
            img_box.src = image_arr[image_num];
        }
    </script>--}}
    </head>
    <body>
    <div class="nav">
        <div class="flex-center position-ref full-height">
            <div>
                <a class="logo" href="{{ url('/') }}">
                    <img src="{{ URL::to('/') }}/images/main_logo.png" width="80" height="30">
                </a>
            </div>
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}" class="btn btn-warning" role="button">Home</a>
                    @else
                        <a href="{{ url('/login') }}" class="btn btn-warning" role="button">Login</a>
                        <a href="{{ url('/register') }}" class="btn btn-warning" role="button">Join</a>
                    @endif
                </div>
            @endif
        </div>
    </div>
{{--    <div>
        <a onclick="showImage('left')"><div class="main_img_btn main_img_btn_left"><font color="white"><b><</b></font></div></a>
        <div class="main_image">
            <img src="{{ URL::to('/') }}/images/main/main_image_01.png" id="img_box" style="width:100%;">
        </div>
        <a onclick="showImage('right')"><div class="main_img_btn main_img_btn_right" ><font color="white"><b>></b></font></div></a>
    </div>--}}
    <div style="width: 100%; height: 100%; position: relative;">

        <div id="film_roll" style="width: 100%;  height: 100%; position: absolute">
                <div>
                    <img src="{{ URL::to('/') }}/images/main/main_image_01.png" class="image_size">
                </div>
                <div>
                    <img src="{{ URL::to('/') }}/images/main/main_image_02.png" class="image_size">
                </div>
                <div>
                    <img src="{{ URL::to('/') }}/images/main/main_image_03.png" class="image_size">
                </div>
                <div>
                    <img src="{{ URL::to('/') }}/images/main/main_image_04.png" class="image_size">
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
            <div id="main_service_01"><img src="{{ URL::to('/') }}/images/main/main_service_01.png" class="main_service"></div>
            <div id="main_service_02"><img src="{{ URL::to('/') }}/images/main/main_service_02.png" class="main_service"></div>
            <div id="main_service_03"><img src="{{ URL::to('/') }}/images/main/main_service_03.png" class="main_service"></div>
        </div>
    </body>
</html>
