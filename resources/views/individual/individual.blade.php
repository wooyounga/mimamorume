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
        <div class="resume">
            <span class="individual">
                <h3>주소</h3>
                {{$user[0]->adressCity}}
                {{$user[0]->adressGu}}
                {{$user[0]->adressDong}}
                <br>
                {{$user[0]->adressRest}}
            </span>
            <br>
            <span class="individual">
                <h3>연락처</h3>
                {{$user[0]->telephone}}
                <br>
                {{$user[0]->cellphone}}
            </span>
            @if($user[0]->userType == '보호사')
                <span class="individual">
                    보호사
                </span>
                <span class="individual">
                    <h3>자격증</h3>
                    {{$etc[0]->licenseKind}}
                    {{$etc[0]->licenseGrade}}
                    <br>
                    <h3>발급처</h3>
                    {{$etc[0]->institution}}
                </span>
                <span class="individual">
                    <h3>소속</h3>
                    {{$etc[0]->center}}
                </span>
            @else
                <span class="individual">
                    보호자
                </span>
                <span class="individual">

                </span>
            @endif
        </div>
        <a href="{{route('individual.create')}}">
            <button class="btn btn-default">
                수정
            </button>
        </a>
    </div>
@endsection