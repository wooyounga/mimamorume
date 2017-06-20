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
<!--d3js-->
<script src="https://d3js.org/d3.v4.min.js"></script>
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
            <a href="{{URL::to('/home')}}">Home</a> > <a href="{{URL::to('/monitoring')}}">모니터링</a> > <a href="{{URL::to('/chart')}}"><b>통계</b></a>
        </div>
        <div class="wrap">

        </div>
        {{--d3.js Area--}}
        <svg width="960" height="500"></svg>

        {{--d3.js graph draw--}}
        <script>
            var svg = d3.select("svg"),
                margin = {top: 20, right: 20, bottom: 30, left: 50},
                width = +svg.attr("width") - margin.left - margin.right,
                height = +svg.attr("height") - margin.top - margin.bottom,
                g = svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

            var parseTime = d3.timeParse("%d-%I:%S");

            var x = d3.scaleTime()
                .rangeRound([0, width]);

            var y = d3.scaleLinear()
                .rangeRound([height, 0]);

            var line = d3.line()
                .x(function(d) { return x(d.date); })
                .y(function(d) { return y(d.close); });

            $.ajax({
                url:"http://133.130.99.167/mimamo/public/chartData",
                type:"GET",
                dataType: "jsonp",
                success: function(data) {
                    data.forEach(function (d) {
                        d.date = parseTime(d.date);
                        d.close = +d.close;
                        return d;
                    });

                    x.domain(d3.extent(data, function(d) { return d.date; }));
                    y.domain(d3.extent(data, function(d) { return d.close; }));

                    g.append("g")
                        .attr("transform", "translate(0," + height + ")")
                        .call(d3.axisBottom(x))
                        .select(".domain")
                        .remove();

                    g.append("g")
                        .call(d3.axisLeft(y))
                        .append("text")
                        .attr("fill", "#000")
                        .attr("transform", "rotate(-90)")
                        .attr("y", 6)
                        .attr("dy", "0.71em")
                        .attr("text-anchor", "end")
                        .text("심박수");

                    g.append("path")
                        .datum(data)
                        .attr("fill", "none")
                        .attr("stroke", "steelblue")
                        .attr("stroke-linejoin", "round")
                        .attr("stroke-linecap", "round")
                        .attr("stroke-width", 1.5)
                        .attr("d", line);
                },
                error: function(data, status, er) {
                    console.log("error:" + status, "er" + er);
                    console.log("code:"+data.status+"\n"+"message:" + data.responseText+"\n"+"error:"+er);
                }
            });
        </script>
    </div>
@endsection