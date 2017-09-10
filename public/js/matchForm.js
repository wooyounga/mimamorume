$(document).ready(function(){
  sidoList();
});

function sidoList(){
  $.ajax({
    url:"../matchAddressDb",
    type:"GET",
    dataType:"jsonp",
    data:{
      "mode":"sido"
    },
    success:function(data){
      for(var i in data){
        $('<li><a href="#" onclick="gugunList(\'' + decodeURI(data[i]) + '\')">'
        + decodeURI(data[i]) + '</a></li>').appendTo('#address_si');
      }
    },
    error:function(){
      $('#address_si').text('エラーが発生しました');
    }
  });
}

function gugunList(sido){
  $.ajax({
    url:"../matchAddressDb",
    type:"GET",
    dataType:"jsonp",
    data:{
      "mode":"gugun",
      "index":sido
    },
    success:function(data){
      $('#address_si').empty();
      for(var i in data){
        $('<li><a href="#" onclick="dongList(\'' + sido + '\',\''
        + decodeURI(data[i]) + '\')">'
        + decodeURI(data[i]) + '</a></li>').appendTo('#address_si');
      }
    },
    error:function(){
      $('#address_si').text('エラーが発生しました');
    }
  });
}

function dongList(sido, gugun){
  $.ajax({
    url:"../matchAddressDb",
    type:"GET",
    dataType:"jsonp",
    data:{
      "mode":"dong",
      "index1":sido,
      "index2":gugun
    },
    success:function(data){
      $('#address_si').empty();
      for(var i in data){
        $('<li><a href="#">'
        + decodeURI(data[i]) + '</a></li>').appendTo('#address_si');
      }
    },
    error:function(){
      $('#address_si').text('エラーが発生しました');
    }
  });
}
