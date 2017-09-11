@extends('layouts.app')
@section('title')
    個人情報
@endsection
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>
<link rel="stylesheet" href="{{URL::to('/')}}/css/individual_app.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

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
        <div class="pro">
            <img src="{{ URL::to('/') }}/{{$etc[0]->profile_image}}">
            <h3>{{$user[0]->name}}({{$user[0]->user_type}})</h3>
            <a href="{{route('individual.create',$user[0]->id)}}">
                <button class="btn btn-default">
                    修正
                </button>
            </a>
        </div>
        <div class="resume">
            <div class="individual">
                <h3>アドレス</h3>
                {{$user[0]->main_address}}
                <br>
                {{$user[0]->rest_address}}
            </div>
            <br>
            <div class="individual">
                <h3>連絡先</h3>
                {{$user[0]->telephone}}
                <br>
                {{$user[0]->cellphone}}
            </div>
            <br>
            @if($user[0]->user_type == '介護職員')
                <div class="individual">
                    <h3>資格</h3>
                    @foreach($etc as $e)
                        {{$e->license_kind}}
                        {{$e->license_grade}}
                        <br>
                    @endforeach
                    <br>
                    <h3>発給先</h3>
                    @foreach($etc as $e)
                        {{$e->institution}}
                        <br>
                    @endforeach
                </div>
                <br>
                <div class="individual">
                    <h3>所属</h3>
                    {{$etc[0]->center}}
                </div>
            @else
                @foreach($etc as $e)
                    <div class="individual">
                        <h3>対象の情報</h3>
                        <br><label>氏名 : </label>{{$e->name}}
                        <br><label>年齢 : </label>{{$e->age}}
                        <br><label>性別 : </label>{{$e->gender}}
                    </div>
                    <div class="individual">

                    </div>
                @endforeach
            @endif
            <br>
        </div>
    </div>

@endsection
