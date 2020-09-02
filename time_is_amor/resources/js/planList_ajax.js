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
                alert("非同期失敗");
                console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                console.log("textStatus     : " + textStatus);
                console.log("errorThrown    : " + errorThrown.message);
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
