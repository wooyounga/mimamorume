function createCal(){
  var title = $('*[name=title]').val();
  var start = $('*[name=start]').val();
  var end = $('*[name=end]').val();

  $.ajax({
    url:"calendar",
    type:"POST",
    data:{
      "title":title,
      "start":start,
      "end":end
    }
  });

  location.href = "task";
}

function viewCal(num){
  $.ajax({
    url:"calendar/" + num,
    dataType:"json",
    success:function(data){
      console.log(data);

      var button = '<button onclick=delCal(' +
      num + ')>' + '日程削除'	+ '</button>';

      $("#cal_title").html(data['title']);
      $("#cal_start").html(data['start_month'] +
    "月 " + data['start_day'] + "日 " +
    data['start_hour'] + ":" + data['start_minute'] +
    "から");
      $("#cal_end").html(data['end_month'] +
    "月 " + data['end_day'] + "日 " +
    data['end_hour'] + ":" + data['end_minute'] +
    "まで");
      $("#del_cal").attr('onclick', 'delCal(' + num + ')');
    }
  });

  $("#viewModal").modal("show");
}

function delCal(num){
  $.ajax({
    url:"delcal?num=" + num
  });

  location.href = "task";
}

function delAllCal(){
  $.ajax({
    url:"delallcal"
  });

  location.href = "task";
}

$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url:"calendar",
    dataType:"json",
    success:function(data){
      console.log(data);

      // 캘린더 DB가 null 이 아닐때 작동
      if(data != "1"){
        var schedule = [];
        var arr_index = 0;

        // DB의 각 일정들을 한 배열에 저장
        for (var i in data) {
          var temp_arr = {
            num: data[i]['num'],
            title: data[i]['title'],
            start: new Date(data[i]['start_year'],
            data[i]['start_month']-1, data[i]['start_day'],
            data[i]['start_hour'], data[i]['start_minute']),
            end: new Date(data[i]['end_year'],
            data[i]['end_month']-1, data[i]['end_day'],
            data[i]['end_hour'], data[i]['end_minute']),
            allDay: false
          };

          schedule[arr_index] = temp_arr;
          arr_index = arr_index + 1;
        }
      }

      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,basicWeek,basicDay'
        },
        editable: false,
        events: schedule
        // dummy data
        // events: [
        // 	{
        // 		title: 'Birthday Party',
        // 		start: new Date(y, m, d+1, 19, 0),
        // 		end: new Date(y, m, d+1, 22, 30),
        // 		allDay: false
        // 	},
        // 	{
        // 		title: 'Click for Google',
        // 		start: new Date(y, m, 28),
        // 		end: new Date(y, m, 29),
        // 		url: 'http://google.com/'
        // 	}
        // ]
      });
    }
  });
});
