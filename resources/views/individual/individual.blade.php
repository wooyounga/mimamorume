@extends('layouts.app')
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

@section('content')
    <div class="body">
        <div class="pro">

        </div>
        <div class="individual_01">

        </div>
        <br>
        <div class="individual_02">

        </div>
        <div class="individual_03">

        </div>
        <div class="individual_04">

        </div>
        <a href="{{route('individual.create')}}">
            <button class="btn btn-default">
                수정
            </button>
        </a>
    </div>
@endsection