@extends('layouts.app')
@section('title')
    MIMAMORUME
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- 캘린더 api css -->
<link rel='stylesheet' type='text/css' href='./css/fullcalendar.css' />

<!-- 제이쿼리 -->
<script type='text/javascript' src='./js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='./js/jquery-ui.min.js'></script>

<!-- 부트스트랩 -->
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<!-- 구동에 필요한 js 코드 -->
<script type='text/javascript' src='./js/taskCRUD.js'></script>
<script type='text/javascript' src='./js/addTaskMonth.js'></script>
<script type='text/javascript' src='./js/simpleToggleButton.js'></script>

<!-- DatePicker -->
<script type="text/javascript" src="./js/jquery.simple-dtpicker.js"></script>
<link type="text/css" href="./css/jquery.simple-dtpicker.css" rel="stylesheet" />

<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

	.open_modal{
		text-align: right;
		margin-right: 15%;
	}

	.btns{
		display: inline-block;
	}

	#btn_group_day0 button{
		color: red;
	}

	#btn_group_day6 button{
		color: blue;
	}

</style>

@section('content')

<!-- 캘린더 api -->
<script type='text/javascript' src='./js/fullcalendar.js'></script>

<div class="open_modal">
  <!-- Open Add Task Month Modal Button -->
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addTaskMonthModal">
    일정 추가 (월단위)
  </button>
</div>
<br>

<div class="open_modal">
  <!-- Open Add Task Modal Button -->
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addTaskModal">
    일정 추가
  </button>
</div>
<br><br>

<!-- 일정추가(월단위) Modal -->
<div class="modal fade" id="addTaskMonthModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">일정 추가하기 (월단위)</h4>
      </div>
      <div class="modal-body">
        @php
          $days = ["일", "월", "화", "수", "목", "금", "토"];
        @endphp
        @for($i = 0; $i < 7; $i++)
        <!--버튼 그룹-->
        <div class= "btns" id="btn_group_day{{$i}}">
          <!--처음 보여지는 버튼-->
          <button id="btn1" class="animation_test btn btn-default btn-lg">{{$days[$i]}}</button>
          <!--다음 보여지는 버튼-->
          <button id="btn2" class="animation_test hide btn btn-warning btn-lg">{{$days[$i]}}</button>
          <!--Hide Checkbox-->
          <input type="checkbox" id="cb_day{{$i}}" class="cb_day hide" value="{{$days[$i]}}" />
        </div>
        @endfor

        <br><br>

        @php
          $targets = ["박OO", "김OO"];
        @endphp
        @for($i = 0; $i < 2; $i++)
        <!--버튼 그룹-->
        <div class= "btns" id="btn_group_target{{$i}}">
          <!--처음 보여지는 버튼-->
          <button id="btn1" class="animation_test btn btn-default btn-lg">{{$targets[$i]}}</button>
          <!--다음 보여지는 버튼-->
          <button id="btn2" class="animation_test hide btn btn-success btn-lg">{{$targets[$i]}}</button>
          <!--Hide Checkbox-->
          <input type="checkbox" id="cb_target{{$i}}" class="cb_target hide" value="{{$targets[$i]}}" />
        </div>
        @endfor
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick=createCalMonth()>완료</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
      </div>
    </div>
  </div>
</div>

<!-- 일정추가 Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">일정 추가하기</h4>
      </div>
      <div class="modal-body">
        <h4>일정 이름</h4>
        <input type="text" name="title" value=""><br><br>
        <h4>시작일</h4>
        <input type="text" name="start" value="">
        <script type="text/javascript">
          $(function(){
            $('*[name=start]').appendDtpicker();
          });
        </script><br><br>
        <h4>종료일</h4>
        <input type="text" name="end" value="">
        <script type="text/javascript">
          $(function(){
            $('*[name=end]').appendDtpicker();
          });
        </script><br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick=createCal()>완료</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
      </div>
    </div>
  </div>
</div>

<!-- Calendar -->
<div id='calendar'></div>
<br>

<!-- 일정보기 Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">일정 상세보기</h4>
      </div>
      <div class="modal-body">
        <div id="cal_title"></div><br>
        <div id="cal_start"></div><br>
        <div id="cal_end"></div><br>
        <br>
        <button id="del_cal">일정 지우기</button>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">확인</button> -->
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">취소</button> -->
      </div>
    </div>
  </div>
</div>
@endsection
