$(function(){
  //baseURLの作成
  //data属性から、値を拝借（直打ちは、反応しない）
  //まずはパソコン処理ができるかどうか。。。
  $("#calendarTable").on("mousedown", onMouseDown);
  $("#calendarTable").on("mousemove", onMouseMove);
  $("#calendarTable").on("mouseup", onMouseUp);
  var direction, position;

  //座標取得
  function getPosition(e){
    var posiX = e.pageX;
  }
  //スワイプ開始時の座標
  function onMouseDown(e){
    position = getPosition(e);
    direction = "";
  }
  // baseUrl
  var baseUrl = $('meta[name="_base_url"]').attr("content");
  //url
  var addMonthUrl = baseUrl + $(".arrow-next").attr('href');
  var subMonthUrl = baseUrl + $(".arrow-pre").attr('href');

  function onMouseMove(e){
    if(posiX - e.pageX > 10){
      direction = "left";
    } else if (posiX - e.pageX  < -10) {
      direction = "right";
    }
  }

  function onMouseUp(e){
    if (direction === "left") {
      location.href = addMonthUrl;
    } else if (direction === "right") {
      location.href = subMonthUrl;
    }
  }

});
