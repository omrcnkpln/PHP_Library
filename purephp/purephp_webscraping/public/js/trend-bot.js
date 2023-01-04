$(document).ready(() => {
    const BASE = $("html").data("url");
    const REQUESTURI = $("html").data("request-uri");
    const URL = BASE.replace("/webscraping", "");

    // var hiddenProducts = document.querySelectorAll(".hidden-product");
    var hiddenProducts = $(".hidden-product");

    // let botTable = document.getElementById("bot-table-js");

    var arr = [];
    var product = {
        Title: "",
        Image: "",
        Price: "",
    }

    hiddenProducts.each(function () {
        // hiddenProducts.forEach(function (e) {
        var that = $(this);
        // var that = e;

        // var h3Elem = that.getElementsByClassName(".prdct-desc-cntnr")[0].getElementsByTagName("span");
        var h3Elem = that.find(".prdct-desc-cntnr").find("span");
        let h3 = "";
        h3Elem.each(function () {
            h3 += $(this).text() + " ";
        });

        let src = "https://productimages.hepsiburada.net/s/173/222-222/110000136542954.jpg";
        // var srcElem = that.find(".p-card-img").attr("src");
        // let newSrc = that.find(".p-card-img-wr").find("img.p-card-img").prop("src");
        // if (newSrc != null) {
        //     src = newSrc;
        // }

        // var srcElem = that.getElementsByClassName("p-card-img");
        // let src = "https://productimages.hepsiburada.net/s/173/222-222/110000136542954.jpg";
        // if (srcElem.length > 0) {
        //     if (srcElem[0].tagName == "IMG") {
        //         // src = srcElem[0].getAttribute("src");
        //     }
        // }

        // var priceElem = that.querySelectorAll("[data-src='price-current-price']")[0].innerHTML;
        var priceElem = that.find(".prc-box-dscntd");
        // console.log(priceElem);
        var price = parseFloat(priceElem.text());

        // link
        var linkElem = that.find("a");
        // var link = linkElem[0].href.replace(URL, "https://www.trendyol.com/");
        var link = linkElem.attr("href").replace(URL, "").replace("https://www.trendyol.com/", "");
        link = "https://www.trendyol.com/" + link;
        // var link = linkElem.attr("href").replace(URL, "https://www.trendyol.com/");
        // console.log(URL);
        // console.log(link);

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

