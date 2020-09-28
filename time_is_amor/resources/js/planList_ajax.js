$(function() {
    $(".week > td").on("click", function(e) {
        let clickNum = parseInt($(this).text(), 10);
        $(".clickDay").text(clickNum + "日");
        $(".clickMonth").text($(".monthAjax").text() + "月"); //FIX
        var baseUrl = $('meta[name="_base_url"]').attr('content');
        console.log(baseUrl + '/planList');
        console.log(clickNum);
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: baseUrl + '/planList',
                type: 'post',
                data: {
                    'clickNum': clickNum
                },
                dataType: 'text',
            })
            .done(function(data) {
                $(".week > td").addClass("checked");
                $(".calendar__table").css("height", "40vh");
                $(this).css("border", "solid 2px orange");
                $(".plan-list").css("display", "block");
                // テキストの追加の記述
                $(".plan-list").html($.parseJSON(data));
                var target = $(e.target); //ターゲットを使うことでイベント中の箇所のみ取得可能。
                $(".holiday").text("");
                if(target.data('name')){
                  $(".holiday").text(target.data('name'));
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // 通信失敗時の処理
                alert('ファイルの取得に失敗しました。');
                console.log("ajax通信に失敗しました");
                console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
                console.log("textStatus     : " + textStatus); // タイムアウト、パースエラー
                console.log("errorThrown    : " + errorThrown.message); // 例外情報
                console.log("URL            : " + url);
            });
    });

    // 予定一覧表示アニメーション
    $(".calendar-footer").on("click", function() {
        $(".calendar__table").css("height", "65vh");
        $(".plan-list").css("display", "none");;
        $(".clickDay").text("");
        $(".clickMonth").text("");
        $(".holiday").text("");
    });
});
