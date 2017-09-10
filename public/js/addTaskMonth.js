function createCalMonth(targetNum){

  // 체크박스 체크돼있는 요일을 구함
  var days = new Array();

  for(var i = 0; i < 7; i++){
    var tag1 = "input:checkbox[id=cb_day" + i + "]";

    if($(tag1).is(":checked")){
      days.push($(tag1).val());
    }
  }

  // 체크박스 체크돼있는 대상자를 구함
  var targets = new Array();

  for(var i = 0; i < targetNum; i++){
    var tag2 = "input:checkbox[id=cb_target" + i + "]";

    if($(tag2).is(":checked")){
      targets.push($(tag2).val());
    }
  }

  // 올해와 이번달을 구함
  var date = new Date();
  var year = date.getFullYear();
  var month = date.getMonth();

  // 선택한 요일에 해당하는 이번달의 모든 날짜를 구함
  var day_arr = new Array();

  for(var i = 0; i < days.length; i++){
    day_arr.push(getTargetDays(month, days[i]));
  }

  $.ajax({
    url:"calmonth",
    type:"POST",
    data:{
      days:days,
      day_arr:day_arr,
      targets:targets,
      month:month,
      year:year
    }
  });

  location.href = "task";
}

// 특정 달의 특정 요일에 해당하는 날짜들을 구하는 함수
// 인자 : 몇 월, 무슨 요일(한글)
function getTargetDays(targetMonth, targetDayKor){

  var daysKor = ["日", "月", "火", "水", "木", "金", "土"];

  // 무슨 요일인지를 한글로 인자로 받으면
  // 숫자로 변환하여 Date객체와 계산이 가능하게 만듦
  for(var i in daysKor){
    if(targetDayKor == daysKor[i]){
      var targetDay = i;
    }
  }

  var now = new Date();
  var nowYear = now.getFullYear();
  // 특정 달의 시작일
  var start = new Date(nowYear, targetMonth, 1);
  // 특정 달의 말일
  var end = new Date(nowYear, targetMonth+1, 0);
  var startDate = start.getDate();
  var endDate = end.getDate();

  // 특정 달의 시작일부터 하루씩 비교하여
  // 특정 요일에 해당하는 첫번째 날짜를 구함
  for(var i = startDate; i <= endDate; i++){
    var temp = new Date(nowYear, targetMonth, i);

    if(targetDay == temp.getDay()){
      var firstDateInTargetDays = i;
      break;
    }
  }

  // 특정 요일에 해당하는 날짜들을 저장할 배열
  var targetDays = new Array();

  // 특정 요일에 해당하는 첫번째 날짜를 포함하여
  // 7을 더해가며 배열에 저장 (~해당 달의 말일)
  for(var i = firstDateInTargetDays; i <= endDate; i = i+7){
    targetDays.push(i);
  }

  // 특정 요일에 해당하는 날짜들을 배열로 반환
  return targetDays;
}
