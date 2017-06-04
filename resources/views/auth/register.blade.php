@extends('layouts.app')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<!-- jquery 가 필요합니다. -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js"></script>

<!-- 우편번호 찾기 -->
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

<script>

    function execDaumPostCode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;

                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                if(data.userSelectedType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('postCode').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('roadAddress').value = fullAddr;

                // 커서를 상세주소 필드로 이동한다.
                document.getElementById('detailAddress').focus();
            }
        }).open();

    }
    function execPostCode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;

                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                if(data.userSelectedType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('target_epost').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('target_Address').value = fullAddr;

                // 커서를 상세주소 필드로 이동한다.
                document.getElementById('target_restAddress').focus();
            }
        }).open();

    }

</script>
<script>
    $(document).ready(function(){
        var ceri_no = 1;
        var ceri = '';

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
        $('.certified_check').change(function(){
            if($('input[type=radio][name=certified_check]:checked').val() == 'yes'){
                $('.cer').css('display','');
                $('.certified_btn').css('display','');
            } else {
                $('.cer').css('display','none');
                $('.certified_btn').css('display','none');
            }
        });
        $('.certified_btn').click(function(){
            ceri = '<div>';
            ceri+= '<span class="close" style="right: 16%; position: absolute;">X</span>';
            ceri+= '<div class="form-group">';
            ceri+= '<label for="certified_'+ceri_no+'" class="col-md-4 control-label">자격증명</label>';
            ceri+= '<div class="col-md-6">';
            ceri+= '<input id="certified" type="text" class="form-control" name="certified_'+ceri_no+'" value="" required autofocus>';
            ceri+= '@if ($errors->has("certified_'+ceri_no+'"))';
            ceri+= '<span class="help-block">';
            ceri+= '<strong>{{ $errors->first("certified_'+ceri_no+'") }}</strong>';
            ceri+= '</span>';
            ceri+= '@endif';
            ceri+= '</div>';
            ceri+= '</div>';
            ceri+= '<div class="form-group">';
            ceri+= '<label for="certified_no_'+ceri_no+'" class="col-md-4 control-label">자격증 번호</label>';
            ceri+= '<div class="col-md-6">';
            ceri+= '<input id="certified_no_'+ceri_no+'" type="text" class="form-control" name="certified_no_'+ceri_no+'" value="" required autofocus>';
            ceri+= '@if ($errors->has("certified_no_'+ceri_no+'"))';
            ceri+= '<span class="help-block">';
            ceri+= '<strong>{{ $errors->first("certified_no_'+ceri_no+'") }}</strong>';
            ceri+= '</span>';
            ceri+= '@endif';
            ceri+= '</div>';

            ceri+= '</div>';
            ceri+= '</div>';

            $('.cer').append(ceri);

            ceri_no++;
        });
        $(document).on("click", "span.close", function(){
            $(this).parent().remove();
            ceri_no--;
        });

    });
</script>
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">회원가입</div>
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
                                    <input id="pw" type="password" class="form-control" name="pw" required>

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
                                    <input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}" required>

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
                                    <label for="man">남</label><input id="man" type="radio" name="gender" required autofocus>
                                    <label for="woman">여</label><input id="woman" type="radio" name="gender" required autofocus>

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
                            <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                                <label for="cellphone" class="col-md-4 control-label">휴대폰번호</label>

                                <div class="col-md-6">
                                    <input id="cellphone" type="text" class="form-control" name="cellphone" value="{{ old('cellphone') }}" required autofocus>

                                    @if ($errors->has('cellphone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cellphone') }}</strong>
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
                            <div class="form-group{{ $errors->has('postCode') ? ' has-error' : '' }}">
                                <label for="postCode" class="col-md-4 control-label">우편번호</label>
                                <div class="col-md-6">
                                    <input id="postCode" type="text" class="form-control" style="width: 130px; float: left;" name="postCode" readonly>
                                    &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-default" value="우편번호 찾기" onClick="execDaumPostCode()"><br/>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('roadAddress') ? ' has-error' : '' }}">
                                <label for="roadAddress" class="col-md-4 control-label">주소</label>

                                <div class="col-md-6">
                                    <input type="text" id="roadAddress" class="form-control" name="roadAddress" readonly>

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('detailAddress') ? ' has-error' : '' }}">
                                <label for="detailAddress" class="col-md-4 control-label">나머지 주소</label>

                                <div class="col-md-6">
                                    <input id="detailAddress" type="text" class="form-control" name="adr" value="{{ old('detailAddress') }}" required autofocus>

                                </div>
                            </div>
                            <div class="care_div" style="display: none;">
                                <div class="form-group{{ $errors->has('certified') ? ' has-error' : '' }}">
                                    <label for="certified_yes" class="col-md-4 control-label">자격증 여부</label>

                                    <div class="col-md-6">
                                        <label for="certified_yes">있음</label><input id="certified_yes" type="radio" class="certified_check" name="certified_check" value="yes" required autofocus>
                                        <label for="certified_no">없음</label><input id="certified_no" type="radio" class="certified_check" name="certified_check" value="no" required autofocus>
                                        @if ($errors->has('certified_check'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('certified_check') }}</strong>
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
                              <div class="cer" style="display: none;">
                                  <div class="form-group">
                                      <label for="certified_0" class="col-md-4 control-label">자격증명</label>

                                      <div class="col-md-6">
                                          <input id="certified" type="text" class="form-control" name="certified_0" value="" required autofocus>

                                          @if ($errors->has("certified_0"))
                                              <span class="help-block">
                                            <strong>{{ $errors->first("certified_0") }}</strong>
                                        </span>
                                          @endif
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="certified_no_0" class="col-md-4 control-label">자격증 번호</label>

                                      <div class="col-md-6">
                                          <input id="certified_no_0" type="text" class="form-control" name="certified_no_0" value="" required autofocus>

                                          @if ($errors->has("certified_no_0"))
                                              <span class="help-block">
                                            <strong>{{ $errors->first("certified_no_0") }}</strong>
                                        </span>
                                          @endif
                                      </div>
                                  </div>
                              </div>
                              </div>
                            <div class="nok_div" style="display: none;">
                                <br/><hr/><br/>
                                <h4 style="text-align: center;">대상자 정보</h4><br/>
                                <div class="form-group{{ $errors->has('no') ? ' has-error' : '' }}">
                                    <label for="target_no" class="col-md-4 control-label">고유넘버</label>

                                    <div class="col-md-6">
                                        <input id="target_no" type="text" class="form-control" name="target_no" value="{{ old('target_no') }}" required autofocus readonly>

                                        @if ($errors->has('target_no'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('target_no') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_name') ? ' has-error' : '' }}">
                                    <label for="target_name" class="col-md-4 control-label">이름</label>

                                    <div class="col-md-6">
                                        <input id="target_name" type="text" class="form-control" name="target_name" value="{{ old('target_name') }}" required autofocus>

                                        @if ($errors->has('target_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('target_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_age') ? ' has-error' : '' }}">
                                    <label for="target_age" class="col-md-4 control-label">나이</label>

                                    <div class="col-md-6">
                                        <input id="target_age" type="text" class="form-control" name="target_age" value="{{ old('target_age') }}" required>

                                        @if ($errors->has('target_age'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('target_age') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_gender') ? ' has-error' : '' }}">
                                    <label for="target_gender" class="col-md-4 control-label">성별</label>

                                    <div class="col-md-6">
                                        <label for="target_man">남</label><input id="target_man" type="radio" name="target_gender" required autofocus>
                                        <label for="target_woman">여</label><input id="target_woman" type="radio" name="target_gender" required autofocus>

                                        @if ($errors->has('target_gender'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('target_gender') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">프로필 사진</label>

                                    <div class="col-md-6">
                                        <img src="" style="margin-bottom: 20px; width:100px; height: 130px;" class="img-thumbnail" onerror="javascript:this.src=''">
                                        <input type="file" value="사진 업로드">
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_phone') ? ' has-error' : '' }}">
                                    <label for="target_phone" class="col-md-4 control-label">전화번호</label>

                                    <div class="col-md-6">
                                        <input id="target_phone" type="text" class="form-control" name="target_phone" value="{{ old('target_phone') }}" required autofocus>

                                        @if ($errors->has('target_phone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('target_phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_cellphone') ? ' has-error' : '' }}">
                                    <label for="cellphone" class="col-md-4 control-label">휴대폰번호</label>

                                    <div class="col-md-6">
                                        <input id="target_cellphone" type="text" class="form-control" name="target_cellphone" value="{{ old('target_cellphone') }}" required autofocus>

                                        @if ($errors->has('target_cellphone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('target_cellphone') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_epost') ? ' has-error' : '' }}">
                                    <label for="target_epost" class="col-md-4 control-label">우편번호</label>
                                    <div class="col-md-6">
                                        <input id="target_epost" type="text" class="form-control" style="width: 130px; float: left;" name="target_epost" readonly>
                                        &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-default" value="우편번호 찾기" onClick="execPostCode()"><br/>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_Address') ? ' has-error' : '' }}">
                                    <label for="target_Address" class="col-md-4 control-label">주소</label>

                                    <div class="col-md-6">
                                        <input type="text" id="target_Address" class="form-control" name="target_Address" readonly>

                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_restAddress') ? ' has-error' : '' }}">
                                    <label for="target_restAddress" class="col-md-4 control-label">나머지 주소</label>

                                    <div class="col-md-6">
                                        <input id="target_restAddress" type="text" class="form-control" name="adr" value="{{ old('target_restAddress') }}" required autofocus>

                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('disability') ? ' has-error' : '' }}">
                                    <label for="disability" class="col-md-4 control-label">장애 종류(주)</label>

                                    <div class="col-md-6">
                                        <select id="disability" class="form-control" name="disability" required autofocus>
                                            <option value="장애없음">장애없음</option>
                                            <option value="지체장애">지체장애</option>
                                            <option value="시각장애">시각장애</option>
                                            <option value="청각장애">청각장애</option>
                                            <option value="언어장애">언어장애</option>
                                            <option value="안면장애">안면장애</option>
                                            <option value="뇌병변장애">뇌병변장애</option>
                                            <option value="지적장애">지적장애</option>
                                            <option value="자폐성장애">자폐성장애</option>
                                        </select>
                                        @if ($errors->has('disability'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('disability') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('disability_2') ? ' has-error' : '' }}">
                                    <label for="disability_2" class="col-md-4 control-label">장애 종류(부)</label>

                                    <div class="col-md-6">
                                        <input id="disability_2" type="text" class="form-control" name="disability_2" value="{{ old('disability_2') }}" required autofocus placeholder="없을 경우 없음을 입력해주십시오.">

                                        @if ($errors->has('disability_2'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('disability_2') }}</strong>
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
                                        <a class="btn btn-primary certified_btn" style="display: none;">
                                            자격증 추가
                                        </a>
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
