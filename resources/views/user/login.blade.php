@extends('layouts.app')

@section('content')
<style>
  body{
    background-image: url("/images/main/main_bg.png");
    background-size: cover;
    background-repeat: no-repeat;
  }
  .pn{
    background: rgba(0, 0, 0, 0.6);
    border-radius: 10px;
    color: white;
    margin-top: 20%;
    margin-left: 25%;
    width: 50%;
  }
  .logbtn{
    margin-left: 25%;
    width: 50%;
  }
  #id{
    margin-top: 5px;
    margin-left: 25%;
    width: 50%;
  }
  #pw{
    margin-top: 5px;
    margin-left: 25%;
    width: 50%;
  }
  .st{
    font-weight: bold;
    margin-left: 26%;
  }
</style>
<div class="container">
    <div class="row">
        <div class="pn">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login.store') }}">
                    {{ csrf_field() }}
                    <br>
                    <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                        <span class="st">USERNAME</span>
                        <br>
                        <input id="id" type="id" class="form-control" name="id" value="{{ old('id') }}" required autofocus>
                    </div>
                    <div class="form-group{{ $errors->has('pw') ? ' has-error' : '' }}">
                        <span class="st">PASSWORD</span>
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
                        <button type="submit" class="btn btn-info logbtn">
                            LOGIN
                        </button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
@endsection
