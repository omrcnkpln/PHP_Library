$(document).ready(function() {
    const ensembleCarousel = $(".ensemble-page-carousel");

    ensembleCarousel.owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        margin: 10,
        smartSpeed: 666,
        items: 1,
    });
});
