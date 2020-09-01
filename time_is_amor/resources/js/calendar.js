$(function() {
    $(".option-btn__main").on("click", function() {
        $(".option-btn-items > .sub-item").toggle();
        $(".contents").toggleClass("content-cover");
    });

    $(".option-btn__acount").on("click", function() {
        $(".profile").addClass("open-profile");
    });
    $(".btn__close").on("click", function() {
        $(".profile").removeClass("open-profile");
    });

    $(".option-btn__coment-list").on("click", function() {
        $(".coment-list").addClass("open-coment-list");
    });
    $(".btn__close-coment-list").on("click", function() {
        $(".coment-list").removeClass("open-coment-list");
    });

    //予定入力画面　スイッチャー
    $(".change-btn").on("click", function() {
        $(this).toggleClass("active");
        var flg = $(this).hasClass("active");
        if (flg == true) {
            $("#add-plan").css("display", "none");
            $("#done-for-us").css("display", "block");
            $(".change-btn-label").html("DONE FOR US");
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

    $("#submit").on("click", function() {
        if ($(".change-btn").hasClass("active")) {
          $(this).parents('.plan-form').attr("action", $(this).data("action"));
          $(this).parents('.plan-form').submit();
        }
    });
});
