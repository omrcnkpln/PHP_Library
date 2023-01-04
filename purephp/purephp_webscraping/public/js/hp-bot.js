$(document).ready(() => {
    const BASE = $("html").data("url");
    const REQUESTURI = $("html").data("request-uri");
    const URL = BASE.replace("/webscraping", "");
    // var aaa = $('[data-target="' + target + '"]')

    // var hiddenProducts = $(".hidden-product");
    var hiddenProducts = document.querySelectorAll(".hidden-product");

    // let botTable = $(".bot-table-js");
    // let botTable = document.querySelectorAll(".bot-table-js"); // class ile secersem appenChild calismaz
    let botTable = document.getElementById("bot-table-js");

    var arr = [];
    var product = {
        Title: "",
        Image: "",
        Price: "",
    }
    // hiddenProducts.each(function () { Jquery
    hiddenProducts.forEach(function (e) {
        // var that = $(this);
        var that = e;

        // console.log(that);
        // var h3 = that.find("h3").text();
        var h3Elem = that.getElementsByTagName("h3");
        let h3 = h3Elem[0].innerHTML;

        // var src = that.find("img").attr("src"); // jquery
        var srcElem = that.getElementsByTagName("img");
        let src = "https://productimages.hepsiburada.net/s/173/222-222/110000136542954.jpg";
        if (srcElem.length > 0) {
            if (srcElem[0].tagName == "IMG") {
                src = srcElem[0].src;
            }
        }

        // var price = parseFloat(that.find('[data-test-id="price-current-price"]').text(), 10);
        // var price = that.find('[data-test-id="price-current-price"]').text();
        var priceElem = that.querySelectorAll("[data-test-id='price-current-price']")[0].innerHTML;
        var price = parseFloat(priceElem);

        // href
        var linkElem = that.getElementsByTagName("a");
        // var link = linkElem[0].href.replace(URL, "https://www.hepsiburada.com/");
        var link = linkElem[0].href.replace(URL, "").replace("https://www.hepsiburada.com/", "");
        // var link = linkElem[0].href.replace(URL, "").replace("https://www.vatanbilgisayar.com/", "");
        // var link = linkElem.attr("href").replace(URL, "");
        link = "https://www.hepsiburada.com/" + link;

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
            // console.log(response);
            // alert(response);
            // odul = JSON.parse(response);
            // odulPutInfos(odul);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert("ajax işleminde hata");
            // alert(xhr.status);
            // alert(thrownError);
        }
    });

    //--- buraya kadar burdan sonrası js ile form oluşturulmaya çalışıldı ama başarısız



    // var formattedPriceString = "23.066,14 TL".replace(",", ".").replace(".", "");
    // var floatPrice = parseFloat(formattedPriceString);


    function FormElemBuild() {
        console.log("form alirim");
        // var htmlString2 = '<form action="" method="post"></form>';
        // botTable.find("tr").html(htmlString2); // jquery


    }

    function TdElemBuild() {
        console.log("td düştü");
        // setTimeout(() => {
        $.each(product, function (key, value) {
            let htmlString3 = '<td></td>';
            // botTable.find("tr").find("form").eq(i).find("form").html(htmlString3);
            botTable.find("tr").find("form").append(htmlString3);
            console.log("each lan");
        });


        // }, 5555)
        console.log("td çikti");
    }

    function InputElemBuild() {
        console.log("input alirim");
        let i = 0;
        arr.forEach((e) => {
            // let htmlString3 = '<td><input type="text" value="'+ e.title +'"/></td>';

            let j = 0;
            // console.log(e);
            $.each(e, function (key, value) {
                // alert( key + ": " + value );
                let htmlString4 = '<input type="text" value="' + value + '"/>';
                botTable.find("tr").eq(i).find("form").find("td").eq(j).html(htmlString4);

                j++;
            });

            i++;
        });
    }

    function TrElemBuild() {
        // console.log(arr.length);
        // console.log(arr);
        // arr.forEach(() =>  { değil
        let i = 0;
        arr.forEach(function (item) {
            // console.log(e);
            // alert(e.title);
            //todo bu şekilde yanlış ekliyor
            // let htmlString = '<tr><form action=""><td><input type="text" value="' + e.title + '"/></td></form></tr>';
            // let htmlString2 = '<tr><form action=""></form></tr>';
            // let htmlString3 = '<tr>';
            // botTable.append(htmlString3);

            var tr = document.createElement("tr");
            tr.id = "tr" + i;
            // tr.style.width("30px");
            // tr.style.height("30px");
            const div = document.createElement("div");
            const form = document.createElement("form");
            // $.each(item, function (key, value) {
            // item.forEach(function () {
            // console.log(item);
            for (const property in item) {
                const input = document.createElement("input");
                input.value = item[property];

                const div2 = document.createElement("div");
                div2.appendChild(input);

                const td = document.createElement("td");
                td.appendChild(div2);

                form.appendChild(td);
            }
            botTable.appendChild(tr).appendChild(div).appendChild(form);
            // document.getElementById(".bot-table-js").appendChild();
        });
    }

    // TrElemBuild();

    // $.when(TrElemBuild()).then(function () {
    //     $.when(FormElemBuild()).then(function () {
    //         $.when(TdElemBuild()).then(function () {
    //             InputElemBuild()
    //         });
    //     });
    // });

    // botTable.find("tr").append($('<form>', {}));
    //
    // for (let i =0 ; i < Object.keys(product).length ; i++){
    //     botTable.find("tr").find("form").append($('<td>', {}));
    // };
    //
    // botTable.find("tr").find("form").find("td").append($('<input>', {
    //     name: title
    // }));
});

