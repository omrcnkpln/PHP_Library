<?php
include("../ayarlar.php");
session_start();
?>

<html>

<head>
    <title>kaplanDevelop</title>
    <meta charset="utf-8" />
    <!-- bise fark etmedi ayni -->
    <!-- <meta http-equiv = "Content-Type" content = "text/html; charset = iso-8859-9" /> -->

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../../dist/css/reset.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- font-awesome -->
    <!-- <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css"> -->

    <!-- Jquery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- custom.js -->
    <script type="text/javascript">
        document.onkeydown = mesajGonder;

        function mesajGonder(x) {
            var tus;
            tus = x.which;
            if (tus == 13) {
                $("textarea[name=mesaj]").attr("disabled", "disabled");
                var mesaj = $("textarea[name = mesaj]").val();
                $.ajax({
                    type: "POST",
                    url: "chat.php",
                    data: {
                        "tip": "gonder",
                        "mesaj": mesaj
                    },
                    success: function(sonuc) {
                        if (sonuc == "bos") {
                            alert("lütfen boş meaj göndermeyin..!");
                            $("textarea[name = mesaj]").removeAttr("disabled");
                        } else {
                            $("textarea[name = mesaj]").removeAttr("disabled");
                            // omer
                            $("textarea[name = mesaj]").val("");
                            $("textarea[name = mesaj]").focus();
                        }
                    }
                });
            }
        }

        function sohbetGuncelle() {
            $.ajax({
                type: "POST",
                url: "chat.php",
                data: {
                    "tip": "guncelle"
                },
                success: function(sonuc) {
                    $("#sohbetIcerik").html(sonuc);
                }
            });
        }

        function sohbetTemizle() {
            $.ajax({
                type: "POST",
                url: "chat.php",
                data: {
                    "tip": "temizle"
                },
                success: function(sonuc) {
                    alert(sonuc);
                }
            });
        }

        sohbetGuncelle();
        setInterval("sohbetGuncelle()", 1000);
    </script>

</head>

<body>
    <?php

    if (isset($_SESSION["oturum"])) {

    ?>
        <div id="sohbetGenel">
            <div id="sohbetIcerik"></div>
            <div class="mesajGonder">
                <h3>Mesaj Gönder:</h3><textarea name="mesaj" cols="0" rows="10" autofocus></textarea>
            </div>
            <?php
            if ($_SESSION["user_rutbe"] == 1) {
            ?>
                <div class="sohbetTemizle">
                    <a href="javascript:void()" onclick="sohbetTemizle()">Sohbeti Temizle</a>
                </div>
            <?php } ?>
        </div>
    <?php
    } else {
        echo "Lütfen giriş yapın..";
    ?>
        <a href="../giris.php">Giriş Yap</a>
    <?php
    }
    ?>

</body>

</html>