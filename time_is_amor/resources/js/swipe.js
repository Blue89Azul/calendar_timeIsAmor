$(function() {
    var baseUrl = $('meta[name="_base_url"]').attr("content");
    var addMonthUrl = baseUrl + '/calendar' + $(".arrow-next").attr('href');
    var subMonthUrl = baseUrl + '/calendar' + $(".arrow-pre").attr('href');

    $("#swipe").on("mousedown", function(e) {
        $(this).data("clickPointX", e.pageX - $("#swipe").offset().left);

    });

    $("#swipe").on("mousemove", function(e) {
        $(this).css("left", e.pageX - $(this).data("clickPointX") + "px");
        console.log(parseInt($("#swipe").css("left")));
    });

    $("#swipe").on("mouseup", function(e) {
        if (parseInt($(this).css("left")) > 100) {
            location.href = addMonthUrl;
        } else if (parseInt($(this).css("left")) < -100) {
            location.href = subMonthUrl;
        }
        $(this).off("mousemove");
    });

});
