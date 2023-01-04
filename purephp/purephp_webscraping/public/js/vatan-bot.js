$(document).ready(() => {
    const BASE = $("html").data("url");
    const REQUESTURI = $("html").data("request-uri");
    const URL = BASE.replace("/webscraping", "");

    var hiddenProducts = document.querySelectorAll(".hidden-product");

    let botTable = document.getElementById("bot-table-js");

    var arr = [];
    var product = {
        Title: "",
        Image: "",
        Price: "",
    }
    hiddenProducts.forEach(function (e) {
        var that = e;

        var h3Elem = that.getElementsByTagName("h3");
        let h3 = h3Elem[0].innerHTML;

        var srcElem = that.getElementsByTagName("img");
        // var priceElem = that.querySelectorAll("[data-src='price-current-price']")[0].innerHTML;
        let src = "https://productimages.hepsiburada.net/s/173/222-222/110000136542954.jpg";
        if (srcElem.length > 0) {
            if (srcElem[0].tagName == "IMG") {
                src = srcElem[0].getAttribute("data-src");
            }
        }

        var priceElem = that.getElementsByClassName("product-list__price");
        var price = parseFloat(priceElem[0].innerHTML);

        // link
        var linkElem = that.getElementsByTagName("a");
        var link = linkElem[0].href.replace(URL, "").replace("https://www.vatanbilgisayar.com/", "");
        // var link = linkElem.attr("href").replace(URL, "");
        link = "https://www.vatanbilgisayar.com/" + link;

        product = {
            Title: h3,
            Image: src,
            Price: price,
            Link: link
        }

        arr.push(product);
    });

    $.ajax({
        type: "post",
        url: BASE + "product-ajax-post",
        data: {arr},
        success: function (response) {
            response = JSON.parse(response);
            console.log(response);

            if (response.status = true) {
                window.location.href = BASE + REQUESTURI + "-list";
            }
            else {
                alert("olmaz");
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert("ajax işleminde hata");
        }
    });
});

