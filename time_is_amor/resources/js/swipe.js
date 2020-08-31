$(function() {
    $("tbody#swipe").on({
        'mousedown': function(event) {
            event.preventDefault(); //バブリング防止
            this.pageX = event.pageX;
            this.slideX = $(this).position().left;
        },
        'mousemove': function(event) {
            event.preventDefault();
            this.slideX = this.slideX - (this.touch - event.pageX);
            $(this).css({
                left: this.slideX
            });
        },
        'mouseup': function(event) {
            if (this.slideX < 100 && this.slideX > -100) { //当月表示処理
                this.slideX = 0;
                $(this).animate({
                    left: this.slideX
                }, 500);
            }
            if (this.slideX <= -100) { //次月表示処理
                window.location.href = '/calendar?year={$subY}&month={$subM}';
                $(this).animate({
                    left: this.slideX
                }, 500);
            }
            if (this.slideX >= 100) { //前月表示処理
                window.location.href = '/calendar?year={$addY}&month={$addM}';
                $(this).animate({
                    left: this.slideX
                }, 500);
            }
        }
    });
});
