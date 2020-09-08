$(function() {
  // アカウント一覧表示・非表示
    $(".option-btn__acount").on("click", function() {
        $(".profile").addClass("open-profile");
    });
    $(".btn__close").on("click", function() {
        $(".profile").removeClass("open-profile");
    });

    //予定入力 ⇄ コメント・レビュー入力　スイッチャー機能
    $(".change-btn").on("click", function() {
        $(this).toggleClass("active");
        var flg = $(this).hasClass("active");
        if (flg == true) {
            $("#add-plan").css("display", "none");
            $("#done-for-us").css("display", "block");
            $(".change-btn-label").html("DONE FOR US");
            $(".change-btn-label").css("text-shadow", "none");
            $(".color-and-like-btn").html("いいね！追加");
            $("#like").css("display", "block");
            $("#color").css("display", "none");
            $(".coment").prop("disabled", false);
            $(".add-plan").prop("disabled", true);
        } else {
            $("#add-plan").css("display", "block");
            $("#done-for-us").css("display", "none");
            $(".change-btn-label").html("ADD PLAN");
            $(".color-and-like-btn").html("色変更");
            $("#like").css("display", "none");
            $("#color").css("display", "block");
            $(".coment").prop("disabled", true);
            $(".add-plan").prop("disabled", false);
        }
    });

    //フォームの送信先（action）切り替え
    $("#submit").on("click", function() {
        if ($(".change-btn").hasClass("active")) {
            $(this).parents('.plan-form').attr("action", $(this).data("action"));
            $(this).parents('.plan-form').submit();
        }
    });

    // 前月・次月変更
    $(".arrow-pre").on("clck", function(){
      var url = $(location).attr('href');
      url = url + ""
    });

    // 今月の一枚：モーダル表示
    $("body").append('<div class="gray-layer"></div><div class="over-layer"></div>');
    $(".gray-layer").click(function() {
      $(".gray-layer, .over-layer").hide();
    });

    $("a.modal-img").click(function() {
      $(".gray-layer").show();
      $(".over-layer").show().html("<img src='" + $(this).attr("href") + "'>");
      return false;
    });

});
