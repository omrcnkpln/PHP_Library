$(document).ready(function () {
    const ebaPageOwl = $(".eba-page-carousel");

    ebaPageOwl.owlCarousel({
        items: 1,
        autoplay: false,
        loop: true,
        // nav: true,
        // touchDrag: false,
        // mouseDrag: false,
        smartSpeed: 666,
        margin: 10
    });
});
