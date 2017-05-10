@extends('layouts.app')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
    $(document).ready(function(){
        $('#information').change(function(){
            if ($('#information').val()=="care") {
                $(".nok_div").hide();
                $(".care_div").show();
            } else if ($('#information').val()=="nok") {
                $(".care_div").hide();
                $(".nok_div").show();
            } else {
                $(".care_div").hide();
                $(".nok_div").hide();
            }
        });
    });
</script>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" name="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('information') ? ' has-error' : '' }}">
                                <label for="information" class="col-md-4 control-label">회원 구분</label>

                                <div class="col-md-6">
                                    <select id="information" class="form-control" name="information">
                                        <option value="">선택</option>
                                        <option value="care">보호사</option>
                                        <option value="nok">보호자</option>
                                    </select>
                                    @if ($errors->has('information'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('information') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">이름</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                <label for="id" class="col-md-4 control-label">아이디</label>

                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control" name="id" value="{{ old('id') }}" required autofocus>

                                    @if ($errors->has('id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('pw') ? ' has-error' : '' }}">
                                <label for="pw" class="col-md-4 control-label">비밀번호</label>

                                <div class="col-md-6">
                                    <input id="pw" type="pw" class="form-control" name="pw" required>

                                    @if ($errors->has('pw'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('pw') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pw-confirm" class="col-md-4 control-label">비밀번호 확인</label>

                                <div class="col-md-6">
                                    <input id="pw-confirm" type="password" class="form-control" name="pw_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age" class="col-md-4 control-label">나이</label>

                                <div class="col-md-6">
                                    <input id="age" type="email" class="form-control" name="age" value="{{ old('age') }}" required>

                                    @if ($errors->has('age'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">성별</label>

                                <div class="col-md-6">
                                    <label for="gender">여</label><input id="gender" type="radio" name="gender" value="{{ old('woman') }}" required autofocus>
                                    <label for="gender">남</label><input id="gender" type="radio" name="gender" value="{{ old('man') }}" required autofocus>

                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">전화번호</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">이메일</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">주소</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('restAddress') ? ' has-error' : '' }}">
                                <label for="restAddress" class="col-md-4 control-label">나머지 주소</label>

                                <div class="col-md-6">
                                    <input id="restAddress" type="text" class="form-control" name="restAddress" value="{{ old('restAddress') }}" required autofocus>

                                    @if ($errors->has('restAddress'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('restAddress') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="care_div" style="display: none;">
                                <div class="form-group{{ $errors->has('certified') ? ' has-error' : '' }}">
                                    <label for="certified" class="col-md-4 control-label">자격증 여부</label>

                                    <div class="col-md-6">
                                        <label for="certified">있음</label><input id="certified" type="radio" name="certified" value="{{ old('yes') }}" required autofocus>
                                        <label for="certified">없음</label><input id="certified" type="radio" name="certified" value="{{ old('no') }}" required autofocus>
                                        @if ($errors->has('certified'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('certified') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('belong') ? ' has-error' : '' }}">
                                    <label for="belong" class="col-md-4 control-label">소속</label>

                                    <div class="col-md-6">
                                        <input id="belong" type="text" class="form-control" name="belong" value="{{ old('belong') }}" required autofocus>

                                        @if ($errors->has('belong'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('belong') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="nok_div" style="display: none;">
                                <br/><hr/><br/>
                                <h4 style="text-align: center;">대상자 정보</h4><br/>
                                <div class="form-group{{ $errors->has('no') ? ' has-error' : '' }}">
                                    <label for="no" class="col-md-4 control-label">고유넘버</label>

                                    <div class="col-md-6">
                                        <input id="no" type="text" class="form-control" name="name" value="{{ old('no') }}" required autofocus>

                                        @if ($errors->has('no'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('no') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">이름</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                    <label for="age" class="col-md-4 control-label">나이</label>

                                    <div class="col-md-6">
                                        <input id="age" type="email" class="form-control" name="age" value="{{ old('age') }}" required>

                                        @if ($errors->has('age'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label for="gender" class="col-md-4 control-label">성별</label>

                                    <div class="col-md-6">
                                        <label for="gender">여</label><input id="gender" type="radio" name="gender" value="{{ old('woman') }}" required autofocus>
                                        <label for="gender">남</label><input id="gender" type="radio" name="gender" value="{{ old('man') }}" required autofocus>

                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone" class="col-md-4 control-label">전화번호</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-4 control-label">주소</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('restAddress') ? ' has-error' : '' }}">
                                    <label for="restAddress" class="col-md-4 control-label">나머지 주소</label>

                                    <div class="col-md-6">
                                        <input id="restAddress" type="text" class="form-control" name="restAddress" value="{{ old('restAddress') }}" required autofocus>

                                        @if ($errors->has('restAddress'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('restAddress') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('restAddress') ? ' has-error' : '' }}">
                                    <label for="disability" class="col-md-4 control-label">장애 종류</label>

                                    <div class="col-md-6">
                                        <input id="disability" type="text" class="form-control" name="disability" value="{{ old('disability') }}" required autofocus>

                                        @if ($errors->has('disability'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('disability') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('special ') ? ' has-error' : '' }}">
                                    <label for="special " class="col-md-4 control-label">특이사항</label>

                                    <div class="col-md-6">
                                        <input id="special " type="text" class="form-control" name="special " value="{{ old('special ') }}" required autofocus>

                                        @if ($errors->has('special '))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('special ') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        회원가입
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
