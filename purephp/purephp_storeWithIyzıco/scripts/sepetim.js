$(function () {
    var giftButton = $("#giftButton");
    var basketBilgilerDefault = $("#basketBilgilerDefault");
    var basketBilgilerGift = $("#basketBilgilerGift");
    var basketBilgilerGift = $("#basketBilgilerGift");


    giftButton.click(function () {
        basketBilgilerDefault.toggleClass("show");
        basketBilgilerGift.toggleClass("show");
    });

    var decreaseProduct = $(".urun-list .decreaseProduct");
    var increaseProduct = $(".urun-list .increaseProduct");
    var removeProduct = $(".urun-list .cikar");
    var productCountItem;
    var productCount;

    removeProduct.click(function () {
        $(this).parent(".basket-list-r").parent(".basket-list").css("display", "none");
    })

    increaseProduct.click(function () {
        productCountItem = $(this).siblings(".productCountItem");
        productCount = productCountItem.val();
        productCount++;
        productCountItem.val(productCount);
    });

    decreaseProduct.click(function () {
        productCountItem = $(this).siblings(".productCountItem");
        productCount = productCountItem.val();
        if(productCount > 1){
            productCount--;
            productCountItem.val(productCount);
        }
    });

    var odemeTuruOnlineButton = $("#odemeTuruOnlineButton");
    var odemeTuruHavaleButton = $("#odemeTuruHavaleButton");
    var odemeTuruOnline = $("#odemeTuruOnline");
    var odemeTuruHavale = $("#odemeTuruHavale");

    odemeTuruOnlineButton.click(function(){
        $(this).addClass("active");
        odemeTuruHavaleButton.removeClass("active");
        odemeTuruOnline.addClass("active");
        odemeTuruHavale.removeClass("active");
    })
    odemeTuruHavaleButton.click(function(){
        $(this).addClass("active");
        odemeTuruOnlineButton.removeClass("active");
        odemeTuruHavale.addClass("active");
        odemeTuruOnline.removeClass("active");
    })
})