$(function() {
    $(".week > td").on("click", function() {
        var dayCale = $(this).text();
        var clickNum = parseInt(dayCale, 10);
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/calendar',
                type: 'POST',
                data: clickNum,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                alert(data);
            })
            .fail(function(data) {
              alert('ファイルの取得に失敗しました。');
              console.log("ajax通信に失敗しました");
              console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
              console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
              console.log("errorThrown    : " + errorThrown.message); // 例外情報
              console.log("URL            : " + url);
            });
    });


    //予定一覧表示アニメーション
    $(".week > td").on("click", function() {
        $(this).addClass("checked");
        $(".calendar__table").css("height", "40vh");
        $(this).css("border", "solid 2px orange");

        $(".plan-list").css("display", "block");
    });
    $(".calendar-footer").on("click", function() {
        $(".calendar__table").css("height", "65vh");
        $(".week > td").css("border", "none");
        $(".plan-list").css("display", "none");;
    });
});
