$(function () {

    $("#fotoYukle").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "upload.php",
            type: "POST",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            // dataType: "json",
            success: function (data) {
                // alert(data.rand);
                // alert(data.image_src_type);
                $(".kırp").html(data);



                $("#crop").Jcrop({
                    onChange: showCoords,
                    onSelect: showCoords,
                    aspectRatio: 2 / 2,
                });

                $("#crop").addClass("jcrop-ux-no-outline");

                $("#resimKirp").on("submit", function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: "kirp.php",
                        type: "POST",
                        data: new FormData(this),
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            // if (data) {
                            //     alert("data var");
                            // } else {
                            //     alert("data yok");
                            // }
                            $(".kırp").html(data);
                        }
                    });
                });

            }
        });
    });
});

function showCoords(c) {
    $("#x").val(c.x).css("background-color", "red");
    // console.log(c.x);
    $("#y").val(c.y);
    $("#x2").val(c.x2);
    $("#y2").val(c.y2);
    $("#w").val(c.w);
    $("#h").val(c.h);
}
