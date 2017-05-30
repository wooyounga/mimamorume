@extends('layouts.app')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<!-- jquery 가 필요합니다. -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js"></script>

<!-- roadzip.min.js -->
<!-- roadzip.min.js 을 이용하려면 jquery ui 가 필요합니다. -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.min.css" />

<!-- 구버전 IE 에 placeholder 지원 : https://code.google.com/p/jqueryplaceholder/ -->

<!-- ssl 대응 됩니다. cdn 이용하듯 서버에 저장하지 말고 그대로 링크하세요.
    예고 없이 스크립트가 변경될 수 있으며, 저장할 경우 호환되지 않을 수 있습니다.
    이곳에 적혀 있는 이용방법대로만 이용해주세요. -->
<link rel="stylesheet" href="//xenosi.de/load/roadzip/roadzip.css" />
<script src="//xenosi.de/load/roadzip/roadzip.min.js"></script>

<script>
    $(function() {
        $('input.XenoFindZip').each(XenoZipFinder); // input 에 검색스크립트 연결
    });
</script>
<!-- / roadzip.min.js -->

<!-- roadzip.mobile.min.js -->
<!-- roadzip.mobile.min.js 을 이용하려면 select2 가 필요합니다. http://ivaynberg.github.io/select2/ -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.min.js"></script>

<!-- ssl 대응 됩니다. cdn 이용하듯 서버에 저장하지 말고 그대로 링크하세요.
    예고 없이 스크립트가 변경될 수 있으며, 저장할 경우 호환되지 않을 수 있습니다.
    이곳에 적혀 있는 이용방법대로만 이용해주세요. -->
<script src="//xenosi.de/load/roadzip/roadzip.mobile.min.js"></script>
<script>
    $(document).ready(function(){
        var ceri_no = 1;
        var ceri = '';

        $('#user_type').change(function(){
            if ($('#user_type').val()=="care") {
                $(".nok_div").hide();
                $(".care_div").show();
            } else if ($('#user_type').val()=="nok") {
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

                            <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                                <label for="user_type" class="col-md-4 control-label">회원 구분</label>

                                <div class="col-md-6">
                                    <select id="user_type" class="form-control" name="user_type">
                                        <option value="">선택</option>
                                        <option value="care">요양보호사</option>
                                        <option value="nok">보호자</option>
                                    </select>
                                    @if ($errors->has('user_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('user_type') }}</strong>
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

                            <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                <label for="telephone" class="col-md-4 control-label">전화번호</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="text" class="form-control" name="phone" value="{{ old('telephone') }}" required autofocus>

                                    @if ($errors->has('telephone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
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

                            <div class="form-group{{ $errors->has('epost') ? ' has-error' : '' }}">
                                <label for="epost" class="col-md-4 control-label">우편번호</label>
                                <div class="col-md-6">
                                    <input id="epost" type="text" class="form-control" name="zip" readonly>
                                    @if ($errors->has('epost'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('epost') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">주소</label>

                                <div class="col-md-6">
                                    <input type="text" id="address" class="XenoFindZip form-control" name="ad" placeholder="엔터를 누르면 검색됩니다." data-z="zip" data-a="ad" data-r="adr">
                                    <span class="XenoFindZipLabel"></span>

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
                                    <input id="restAddress" type="text" class="form-control" name="adr" value="{{ old('restAddress') }}" required autofocus>

                                    @if ($errors->has('restAddress'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('restAddress') }}</strong>
                                    </span>
                                    @endif
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
                                        <input id="target_epost" type="text" class="form-control" name="target_zip" readonly>
                                        @if ($errors->has('target_epost'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('target_epost') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_address') ? ' has-error' : '' }}">
                                    <label for="target_address" class="col-md-4 control-label">주소</label>

                                    <div class="col-md-6">
                                        <input type="text" id="target_address" class="XenoFindZip form-control" name="target_ad" placeholder="엔터를 누르면 검색됩니다." data-z="target_zip" data-a="target_ad" data-r="target_adr">
                                        <span class="XenoFindZipLabel"></span>

                                        @if ($errors->has('target_address'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('target_address') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('target_restAddress') ? ' has-error' : '' }}">
                                    <label for="target_restAddress" class="col-md-4 control-label">나머지 주소</label>

                                    <div class="col-md-6">
                                        <input id="target_restAddress" type="text" class="form-control" name="target_adr" value="{{ old('target_restAddress') }}" required autofocus>

                                        @if ($errors->has('target_restAddress'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('target_restAddress') }}</strong>
                                    </span>
                                        @endif
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
