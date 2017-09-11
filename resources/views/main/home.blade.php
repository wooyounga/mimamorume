@extends('layouts.app')
@section('title')
    MIMAMORUME
@endsection
@if (session('alert'))
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='{{URL::to('/')}}/js/jquery-migrate-1.4.1.min.js'></script>
<!-- 제이쿼리 -->
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
		margin-right: 5%;
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
    <div id="bgimg">
      <div class="page_title">
        勤務日程
      </div>
      <br>
      <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="position:relative; top:-3px; width:20px; height:20px;"></a> > <a href="{{URL::to('/task')}}">勤務</a> > <a href="{{URL::to('/task')}}"><b>勤務日程</b></a>
    </div>
    <style>
      #bgimg{
        background-image: url("{{ URL::to('/') }}/images/bgimg/bgimg5.png");
        background-size: cover;
        height: 300px;
        padding-left: 75px;
        padding-top: 70px;
        color: white;
        font-size: 17px;
        font-weight: bold;
      }
      #bgimg > a{
        color: white;
        text-decoration: none;
        font-size: 17px;
        font-weight: bold;
      }
      .page_title{
        color: white;
        font-size: 40px;
        margin-bottom: 100px;
      }
    </style>
<div id="body">
  <div class="open_modal">
    <!-- Open Add Task Month Modal Button -->
    <button type="button" class="btn btn-default btn-md" data-toggle="modal" onclick="openModal()">
      日程追加(月)
    </button>
      <!-- Open Add Task Modal Button -->
    <button type="button" class="btn btn-default btn-md" data-toggle="modal" onclick="openModal2()">
      日程追加
    </button>
      <!-- Open Delete All Task Button -->
    <button type="button" class="btn btn-default btn-md" data-toggle="modal" onclick="openModal3()">
      日程削除(全)
    </button>
  </div>
  <br><br>

  <!-- 일정추가(월단위) Modal -->
  <div class="modal fade" id="addTaskMonthModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">日程追加(月)</h4>
        </div>
        <div class="modal-body">
        @php
          $days = ["日", "月", "火", "水", "木", "金", "土"];
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
          <button type="button" class="btn btn-primary" onclick=createCalMonth({{count($targets)}})>完了</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取り消し</button>
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
          <h4 class="modal-title" id="myModalLabel">日程追加</h4>
        </div>
        <div class="modal-body">
          <h4>日程名</h4>
          <input type="text" name="title" value=""><br><br>
          <h4>開始日</h4>
          <input type="text" name="start" value="">
          <script type="text/javascript">
              $(function(){
                  $('*[name=start]').appendDtpicker();
              });
          </script><br><br>
          <h4>終了日</h4>
          <input type="text" name="end" value="">
          <script type="text/javascript">
              $(function(){
                  $('*[name=end]').appendDtpicker();
              });
          </script><br><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick=createCal()>完了</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取り消し</button>
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
          <h4 class="modal-title" id="myModalLabel">全ての日程削除</h4>
        </div>
        <div class="modal-body">
          <p>本当に削除しますか？</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick=delAllCal()>確認</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取り消し</button>
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
          <h4 class="modal-title" id="myModalLabel">日程の詳細を見る</h4>
        </div>
        <div class="modal-body">
          <div id="cal_title"></div><br>
          <div id="cal_start"></div><br>
          <div id="cal_end"></div><br>
          <br>
          <button id="del_cal">日程削除</button>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-primary">確認</button> -->
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">取り消し</button> -->
        </div>
      </div>
    </div>
  </div>
</div>
<br><br>
@endsection
