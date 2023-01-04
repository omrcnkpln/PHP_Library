$(document).ready(function() {
    const qdmsCarousel = $(".qdms-page-carousel");

    qdmsCarousel.owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        margin: 10,
        smartSpeed: 666,
        items: 1,
    });
});
