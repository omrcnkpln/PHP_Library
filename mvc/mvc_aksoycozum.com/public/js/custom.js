$(document).ready(function () {
    var anchor = $("a[href]");
    var goTo = $(".go-to");

    // navbar butonların sayfa içinde hareketi
    $('body').on('click', '.go-to', function (e) {
        var that = $(this);
        toID = that.attr("aim");

        if ($("#" + toID).length) {
            let windowSize = $(window).width();

            if (windowSize > 992) {
                e.preventDefault();

                let scrollSize = $("#" + toID).offset().top - 100;

                $('html, body').animate({
                    scrollTop: scrollSize
                }, 0);
            }
        }
    });

    // navbar ın arkaplan rengi
    var hasBeenTrigged = false;
    const navbar = $(".navbar-wrapper");

    $(window).scroll(function () {
        let scroll = $(this).scrollTop();

        if (scroll >= 250) {
            navbar.addClass("bg-muted");
        }
        else {
            navbar.removeClass("bg-muted");
        }
    });
})
