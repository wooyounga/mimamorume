@extends('layouts.app')
@section('title')
    個人情報修正
@endsection
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>

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
    </script>
    <script>
        $(function(){

            <?php $cer_no = 0; ?>
            var ceri = '';

            $('.certified_check').on('change',function(){
                if($('input[type=radio][name=certified_check]:checked').val() == 'yes'){//자격증이 있을 경우
                    $('.cer').css('display','');//자격증 입력폼을 보여줌
                    $('.certified_btn').css('display','');
                } else {
                    $('.cer').css('display','none');//아닐 경우 자격증 입력폼을 숨김
                    $('.certified_btn').css('display','none');
                }
            });

            $('.certified_btn').click(function(){//자격증 추가 버튼을 누를 시 입력폼 추가
                ceri = '<div>';
                ceri+= '<span class="close" style="right: 15%; position: absolute;">X</span>';
                ceri+= '<div class="form-group">';
                ceri+= '<label for="certified_<?= $cer_no?>" class="col-md-4 control-label">資格名</label>';
                ceri+= '<div class="col-md-6">';
                ceri+= '<input id="certified" type="text" class="form-control" name="certified_<?= $cer_no?>" value="" required autofocus>';
                ceri+= '</div>';
                ceri+= '</div>';
                ceri+= '<div class="form-group">';
                ceri+= '<label for="certified_no_<?= $cer_no?>" class="col-md-4 control-label">資格級</label>';
                ceri+= '<div class="col-md-6">';
                ceri+= '<input id="certified_no_<?= $cer_no?>" type="text" class="form-control" name="certified_no_<?= $cer_no?>" value="" required autofocus>';
                ceri+= '</div>';
                ceri+= '</div>';
                ceri+= '</div>';

                $('.cer').append(ceri);

                <?php $cer_no++?>
            });
            $(document).on("click", "span.close", function(){//x버튼을 누를시 삭제
                $(this).parent().remove();
                <?php $cer_no--?>
            });
        });
    </script>
    <div class="body">
        <form class="form-horizontal" name="form-horizontal" role="form" method="POST" action="{{ route('individual.update',[$user[0]->id]) }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">氏名</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user[0]->name }}" required autofocus>
                </div>
            </div>
            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                <label for="id" class="col-md-4 control-label">アカウント名</label>

                <div class="col-md-6">
                    <input id="id" type="text" class="form-control" name="id" value="{{ $user[0]->id }}" readonly>
                </div>
            </div>

            <div class="form-group{{ $errors->has('pw') ? ' has-error' : '' }}">
                <label for="pw" class="col-md-4 control-label">パスワード</label>

                <div class="col-md-6">
                    <input id="pw" type="password" class="form-control" name="pw" required>
                </div>
            </div>
            <div class="form-group">
                <label for="pw-confirm" class="col-md-4 control-label">パスワード確認</label>

                <div class="col-md-6">
                    <input id="pw-confirm" type="password" class="form-control" name="pw_confirmation" required>
                </div>
            </div>
            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                <label for="age" class="col-md-4 control-label">年齢</label>

                <div class="col-md-6">
                    <input id="age" type="text" class="form-control" name="age" value="{{ $user[0]->age }}" required autofocus>
                </div>
            </div>
            @if($user[0]->gender == '男')
                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">性別</label>

                    <div class="col-md-6">
                        <label for="man">男</label><input id="man" type="radio" name="gender" value="男" checked>
                        <label for="woman">女</label><input id="woman" type="radio" name="gender" value="女">
                    </div>
                </div>
            @else
                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">性別</label>

                    <div class="col-md-6">
                        <label for="man">男</label><input id="man" type="radio" name="gender" value="男">
                        <label for="woman">女</label><input id="woman" type="radio" name="gender" value="女" checked>
                    </div>
                </div>
            @endif
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-4 control-label">電話番号</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control" name="phone" value="{{ $user[0]->telephone }}" required autofocus>
                </div>
            </div>
            <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                <label for="cellphone" class="col-md-4 control-label">携帯番号</label>

                <div class="col-md-6">
                    <input id="cellphone" type="text" class="form-control" name="cellphone" value="{{ $user[0]->cellphone }}" required autofocus>
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">イメール</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user[0]->email }}" required>
                </div>
            </div>
            <div class="form-group{{ $errors->has('postCode') ? ' has-error' : '' }}">
                <label for="postCode" class="col-md-4 control-label">郵便番号</label>
                <div class="col-md-6">
                    <input id="postCode" type="text" class="form-control" value="{{$user[0]->zip_code}}" style="width: 130px; float: left;" name="postCode" readonly>
                    &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-default" value="우편번호 찾기" onClick="execDaumPostCode()"><br/>
                </div>
            </div>
            <div class="form-group{{ $errors->has('roadAddress') ? ' has-error' : '' }}">
                <label for="roadAddress" class="col-md-4 control-label">アドレス</label>

                <div class="col-md-6">
                    <input type="text" id="roadAddress" class="form-control" name="roadAddress" value="{{$user[0]->main_address}}" readonly>

                </div>
            </div>
            <div class="form-group{{ $errors->has('detailAddress') ? ' has-error' : '' }}">
                <label for="detailAddress" class="col-md-4 control-label">残りのアドレス</label>

                <div class="col-md-6">
                    <input id="detailAddress" type="text" class="form-control" name="adr" value="{{ $user[0]->rest_address }}" required autofocus>

                </div>
            </div>
            @if($user[0]->user_type=='介護職員')
            <div class="care_div">
                @if($etc[0]->lisence == 'yes')
                    <div class="form-group{{ $errors->has('certified') ? ' has-error' : '' }}">
                        <label for="certified_yes" class="col-md-4 control-label">資格有無</label>
                        <div class="col-md-6">
                            <label for="certified_yes">有</label><input id="certified_yes" type="radio" class="certified_check" name="certified_check" value="yes" checked>
                            <label for="certified_no">無</label><input id="certified_no" type="radio" class="certified_check" name="certified_check" value="no" >
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('belong') ? ' has-error' : '' }}">
                        <label for="belong" class="col-md-4 control-label">所属</label>
                        <div class="col-md-6">
                            <input id="belong" type="text" class="form-control" name="belong" value="{{ $etc[0]->center }}" required autofocus>
                        </div>
                    </div>
                    <div class="cer">
                        @foreach($etc as $e)
                            <div class="form-group">
                                <label for="certified_<?= $cer_no?>" class="col-md-4 control-label">資格名</label>
                                <div class="col-md-6">
                                    <input id="certified" type="text" class="form-control" name="certified_no_<?= $cer_no?>" value="{{$e->license_kind}}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="certified_no_<?= $cer_no?>" class="col-md-4 control-label">資格級</label>
                                <div class="col-md-6">
                                    <input id="certified_no_<?= $cer_no?>" type="text" class="form-control" name="certified_no_<?= $cer_no?>" value="{{$e->license_grade}}" required autofocus>
                                </div>
                            </div>
                            <?php $cer_no++;?>
                        @endforeach
                    </div>
                @else
                    <div class="form-group{{ $erSrors->has('certified') ? ' has-error' : '' }}">
                        <label for="certified_yes" class="col-md-4 control-label">資格有無</label>
                        <div class="col-md-6">
                            <label for="certified_yes">有</label><input id="certified_yes" type="radio" class="certified_check" name="certified_check" value="yes">
                            <label for="certified_no">無</label><input id="certified_no" type="radio" class="certified_check" name="certified_check" value="no" checked>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('belong') ? ' has-error' : '' }}">
                        <label for="belong" class="col-md-4 control-label">所属</label>
                        <div class="col-md-6">
                            <input id="belong" type="text" class="form-control" name="belong" value="{{ $etc[0]->center }}" required autofocus>
                        </div>
                    </div>
                @endif
            </div>

            @else
            <div class="nok_div">
                <br/><hr/><br/>
                <h4 style="text-align: center;">対象の情報</h4><br/>
                <div class="form-group{{ $errors->has('no') ? ' has-error' : '' }}">
                    <label for="target_no" class="col-md-4 control-label">固有ナンバー</label>

                    <div class="col-md-6">
                        <input id="target_no" type="text" class="form-control" name="target_no" value="{{ old('target_no') }}" required autofocus readonly>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('target_name') ? ' has-error' : '' }}">
                    <label for="target_name" class="col-md-4 control-label">氏名</label>

                    <div class="col-md-6">
                        <input id="target_name" type="text" class="form-control" name="target_name" value="{{ old('target_name') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('target_age') ? ' has-error' : '' }}">
                    <label for="target_age" class="col-md-4 control-label">年齢</label>

                    <div class="col-md-6">
                        <input id="target_age" type="text" class="form-control" name="target_age" value="{{ old('target_age') }}" required>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('target_gender') ? ' has-error' : '' }}">
                    <label for="target_gender" class="col-md-4 control-label">性別</label>

                    <div class="col-md-6">
                        <label for="target_man">男</label><input id="target_man" type="radio" name="target_gender" required autofocus>
                        <label for="target_woman">女</label><input id="target_woman" type="radio" name="target_gender" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">プロフィール写真</label>

                    <div class="col-md-6">
                        <img src="" style="margin-bottom: 20px; width:100px; height: 130px;" class="img-thumbnail" onerror="javascript:this.src=''">
                        <input type="file" value="사진 업로드">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('target_phone') ? ' has-error' : '' }}">
                    <label for="target_phone" class="col-md-4 control-label">電話番号</label>

                    <div class="col-md-6">
                        <input id="target_phone" type="text" class="form-control" name="target_phone" value="{{ old('target_phone') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('target_cellphone') ? ' has-error' : '' }}">
                    <label for="cellphone" class="col-md-4 control-label">携帯番号</label>

                    <div class="col-md-6">
                        <input id="target_cellphone" type="text" class="form-control" name="target_cellphone" value="{{ old('target_cellphone') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('target_epost') ? ' has-error' : '' }}">
                    <label for="target_epost" class="col-md-4 control-label">郵便番号</label>
                    <div class="col-md-6">
                        <input id="target_epost" type="text" class="form-control" name="target_zip" readonly>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('target_address') ? ' has-error' : '' }}">
                    <label for="target_address" class="col-md-4 control-label">アドレス</label>

                    <div class="col-md-6">
                        <input type="text" id="target_address" class="XenoFindZip form-control" name="target_ad" placeholder="엔터를 누르면 검색됩니다." data-z="target_zip" data-a="target_ad" data-r="target_adr">
                        <span class="XenoFindZipLabel"></span>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('target_restAddress') ? ' has-error' : '' }}">
                    <label for="target_restAddress" class="col-md-4 control-label">残りのアドレス</label>

                    <div class="col-md-6">
                        <input id="target_restAddress" type="text" class="form-control" name="target_adr" value="{{ old('target_restAddress') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('disability') ? ' has-error' : '' }}">
                    <label for="disability" class="col-md-4 control-label">障害種類(主)</label>
                    <div class="col-md-6">
                        <select id="disability" class="form-control" name="disability" required autofocus>
                            <option value="無">無</option>
                            <option value="肢体障害">肢体障害</option>
                            <option value="視覚障害">視覚障害</option>
                            <option value="聴覚障害">聴覚障害</option>
                            <option value="言語障害">言語障害</option>
                            <option value="顔面障害">顔面障害</option>
                            <option value="脳血管障害">脳血管障害</option>
                            <option value="知的障害">知的障害</option>
                            <option value="自閉症障害">自閉症障害</option>
                        </select>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('disability_2') ? ' has-error' : '' }}">
                    <label for="disability_2" class="col-md-4 control-label">障害種類(副)</label>

                    <div class="col-md-6">
                        <input id="disability_2" type="text" class="form-control" name="disability_2" value="{{ old('disability_2') }}" required autofocus placeholder="ない場合は「なし」を入力してください">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('special ') ? ' has-error' : '' }}">
                    <label for="special " class="col-md-4 control-label">特異事項</label>

                    <div class="col-md-6">
                        <input id="special " type="text" class="form-control" name="special " value="{{ old('special ') }}" required autofocus>
                    </div>
                </div>
            </div>
            @endif
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    @if($user[0]->user_type == '介護職員')
                        <a class="btn btn-primary certified_btn">
                            資格追加
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary">
                        修正
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
