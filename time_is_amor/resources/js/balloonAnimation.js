$(function() {
    if ($(".balloonAnime").data("animation") !== $(".balloonAnime").data("status")) {
        if ($(".balloonAnime").data("animation") > $(".balloonAnime").data("status")) {
            $(".balloon").addClass("balloonAnimation");
            $("span").toggleClass("moveStraight");
        }
        $(".balloon:nth-child(10)").on('transitionend webkitTransitionEnd', function() {
            $(".balloon").removeClass("balloonAnimation");
            var baseUrl = $('meta[name="_base_url"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: baseUrl + '/balloon',
                type: 'post',
                data: {
                    'status': Number($(".balloonAnime").data("animation"))
                },
                dataType: 'text',
            });
        });
    }

});
