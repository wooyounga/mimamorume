@extends('layouts.app')
@section('title')
    개인정보
@endsection
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/individual_app.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

@section('content')
    <div class="body">
        <div class="pro">
            <img src="{{ URL::to('/') }}/{{$etc[0]->profileImage}}">
            <h3>{{$user[0]->name}}({{$user[0]->userType}})</h3>
            <a href="{{route('individual.create',$user[0]->id)}}">
                <button class="btn btn-default">
                    수정
                </button>
            </a>
        </div>
        <div class="resume">
            <div class="individual">
                <h3>주소</h3>
                {{$user[0]->adressCity}}
                {{$user[0]->adressGu}}
                {{$user[0]->adressDong}}
                <br>
                {{$user[0]->adressRest}}
            </div>
            <br>
            <div class="individual">
                <h3>연락처</h3>
                {{$user[0]->telephone}}
                <br>
                {{$user[0]->cellphone}}
            </div>
            <br>
            @if($user[0]->userType == '보호사')
                <div class="individual">
                    <h3>자격증</h3>
                    @foreach($etc as $e)
                        {{$e->licenseKind}}
                        {{$e->licenseGrade}}
                        <br>
                    @endforeach
                    <br>
                    <h3>발급처</h3>
                    @foreach($etc as $e)
                        {{$e->institution}}
                        <br>
                    @endforeach
                </div>
                <br>
                <div class="individual">
                    <h3>소속</h3>
                    {{$etc[0]->center}}
                </div>
            @else
                <div class="individual">
                    보호자
                </div>
                <div class="individual">

                </div>
            @endif
            <br>
        </div>
    </div>

@endsection