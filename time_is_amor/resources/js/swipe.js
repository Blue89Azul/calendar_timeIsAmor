$(function() {
    var baseUrl = $('meta[name="_base_url"]').attr("content");
    var addMonthUrl = baseUrl + '/calendar' + $(".arrow-next").attr('href');
    var subMonthUrl = baseUrl + '/calendar' + $(".arrow-pre").attr('href');

    $("#swipe").on("mousedown", function(e) {
        $("#swipe").data("clickPointX", e.pageX - $("#swipe").offset().left);
        $("#swipe").addClass("onlyThisAnimation");
    });

    $(document).on("mousemove", function(e) {
        $("#swipe").css({
            "left": e.pageX - $("#swipe").data("clickPointX") + "px"
        });
    });

    $("#swipe").on("mouseup", function(e) {
        if ($("#swipe").css("left") > 10) {
            location.href = addMonthUrl;
        } else if ($("#swipe").css("left") < -10) {
            location.href = subMonthUrl;
        }
        $(this).off("mousemove");
    });

});
