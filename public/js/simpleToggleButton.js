// TODO:심플한 토글 버튼
//<div id="btn_group">
//    <button>button1</button>
//    <button class="hide">button2</button>
//    <input type="checkbox" class="hide"/>
//</div>
//.hide { display: none; }
$(document).ready(function() {
  (function ($) {
      $.fn.simpleToggleBtn = function () {

          var btns = $(this).find("button"); // 버튼 그룹 내 버튼들;
          var checkBox = $(this).find("input:checkbox");

          btns.on("click", function () { // 버튼들 중 클릭한 버튼에 함수;
              $(this).addClass("hide");
              $(this).siblings("button").removeClass("hide");
              if(checkBox.is(":checked")){
                checkBox.prop("checked", false);
              }
              else{
                checkBox.prop("checked", true);
              }
          });
      }
  }(jQuery));

  // 실행
  $("#btn_group_day0").simpleToggleBtn();
  $("#btn_group_day1").simpleToggleBtn();
  $("#btn_group_day2").simpleToggleBtn();
  $("#btn_group_day3").simpleToggleBtn();
  $("#btn_group_day4").simpleToggleBtn();
  $("#btn_group_day5").simpleToggleBtn();
  $("#btn_group_day6").simpleToggleBtn();
});
