$(document).ready(function () {
    const envanterCarousel = $(".envanter-carousel");
    const envanterTab = $(".envanter-tab");
    const envanterTabOwl = $(".envanter-tab-carousel");

    envanterCarousel.owlCarousel({
        loop: true,
        nav: false,
        mouseDrag: false,
        touchDrag: false,
        dots: false,
        margin: 10,
        smartSpeed: 666,
        items: 1,
    });

    envanterTabOwl.children().each( function( index ) {
        $(this).attr( 'data-position', index );
    });

    envanterCarousel.children().each( function( index ) {
        $(this).attr( 'data-position', index );
    });

    envanterTabOwl.owlCarousel({
        loop:true,
        margin:10,
        center: true,
        nav:false,
        smartSpeed: 666,
        items: 2
    });

    var envanterTabOwlClick = $("body").on("click", ".envanter-tab-carousel .owl-item", function () {
        that = $(this);
        that.find(".envanter-tab").addClass("active").parents(".owl-item").siblings().find(".envanter-tab").removeClass("active");
        index = that.find(".envanter-tab").data("position");
        envanterCarousel.trigger('to.owl.carousel', [index, 666]);
        envanterTabOwl.trigger('to.owl.carousel', [index, 666]);
    });

    // _____________________________ dot sync elle kaydırırsa _____________________________________________________________
    envanterTabOwl.on('translated.owl.carousel', (e) => {
        let dotIndex = e.page.index;
        $(this).find(".owl-item.center").find(".envanter-tab").addClass("active").parents(".owl-item").siblings().find(".envanter-tab").removeClass("active");
        envanterCarousel.trigger('to.owl.carousel', [dotIndex, 666]);
    });
});
