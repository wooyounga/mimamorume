@extends('layouts.app')
@section('title')
    MIMAMORUME
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- 제이쿼리 -->{{--
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>--}}
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-ui.min.js'></script>

<!-- 부트스트랩 -->
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<!-- 캘린더 api css -->
<link rel='stylesheet' type='text/css' href='{{URL::to('/')}}/css/fullcalendar.css' />
<!-- 구동에 필요한 js 코드 -->
<script type='text/javascript' src='{{URL::to('/')}}/js/taskCRUD.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/addTaskMonth.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/simpleToggleButton.js'></script>

<!-- DatePicker -->
<script type="text/javascript" src="{{URL::to('/')}}/js/jquery.simple-dtpicker.js"></script>
<link type="text/css" href="{{URL::to('/')}}/css/jquery.simple-dtpicker.css" rel="stylesheet" />


<style type='text/css'>
    .head{
      padding: 5% 0 0 5%;
    }
	#body {
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

  .a-event{
    display: block;
    padding: 5px;
  }

  .a-event span{
    font-size: 17px;
  }

</style>

@section('content')
    <script>
        function openModal(){
            $('#addTaskMonthModal').modal('show');
        }
        function openModal2(){
            $('#addTaskModal').modal('show');
        }
        function openModal3(){
            $('#delAllTaskModal').modal('show');
        }
    </script>
    <!-- 캘린더 api -->
    <script type='text/javascript' src='{{URL::to('/')}}/js/fullcalendar.js'></script>
    <div class="head">
      <a href="{{URL::to('/home')}}">Home</a> > <a href="{{URL::to('/task')}}">근무</a> > <a href="{{URL::to('/task')}}"><b>근무일정</b></a>
    </div>
<div id="body">
  <div class="open_modal">
    <!-- Open Add Task Month Modal Button -->
    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" onclick="openModal()">
      일정 추가 (월단위)
    </button>
  </div>
  <br>

  <div class="open_modal">
    <!-- Open Add Task Modal Button -->
    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" onclick="openModal2()">
      일정 추가
    </button>
  </div>
  <br>

  <div class="open_modal">
    <!-- Open Delete All Task Button -->
    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" onclick="openModal3()">
      모든 일정 삭제
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

          @for($i = 0; $i < count($targets); $i++)
          <script type="text/javascript">
            $(document).ready(function() {
              $("#btn_group_target{{$i}}").simpleToggleBtn();
            });
          </script>
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

  <!-- 모든 일정 삭제 Modal -->
  <div class="modal fade" id="delAllTaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">모든 일정 삭제하기</h4>
        </div>
        <div class="modal-body">
          <p>정말 삭제하시겠습니까?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick=delAllCal()>확인</button>
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
</div>
@endsection
