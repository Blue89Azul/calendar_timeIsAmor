$(function() {
    $(".week > td").on("click", function() {
        let clickNum = parseInt($(this).text(), 10);
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/planList',
                type: 'post',
                data: {
                    'clickNum': clickNum
                },
                dataType: 'json',
            })
            .done(function(data) {
                alert(data);
            })
            .fail(function(data) {
                alert('ファイルの取得に失敗しました');
            });
    });


    // 予定一覧表示アニメーション
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
