<?php
session_start();
include("../ayarlar.php");

header("Content-type: text/html; charset=iso-8859-9");

if (isset($_SESSION["oturum"])) {

    $tip = strip_tags($_POST["tip"]);

    switch ($tip) {

            // mesaj gonderme
        case 'gonder':
            $mesaj = iconv("UTF-8", "ISO-8859-9", strip_tags(trim($_POST["mesaj"])));
            $kullanici = $_SESSION["isim"];
            $rutbe = $_SESSION["user_rutbe"];
            date_default_timezone_set('Europe/Istanbul');
            $tarih = date("d.m.Y H:i:s");
            // $tarih = ('d.m.Y H:i:s', time());



            if (empty($mesaj)) {
                echo "bos";
            } else {
                $ac = fopen("chat.txt", "ab");
                $eklenecekler = $tarih . "\t" . $kullanici . "\t" . $mesaj . "\t" . $rutbe . "\n";
                $ekle = fwrite($ac, $eklenecekler);
            }

            break;

            // sohbet güncelleme
        case 'guncelle':
            $dosya = file("chat.txt");
            $toplam = count($dosya);
            if ($toplam > 100) {
                unlink("chat.txt");
                touch("chat.txt");
            } else {
                arsort($dosya);
                foreach ($dosya as $mesaj) {
                    $bol = explode("\t", $mesaj);
                    echo "<div class='sohbetMesaji'><strong";
                    if ($bol[3] == 1) {
                        echo ' style = "background-color: red"';
                    }
                    echo ">{$bol[1]}</strong><span>{$bol[2]}</span></div>";
                }
            }
            break;

            // sohebt temizleme
        case 'temizle':
            if ($_SESSION["oturum"] == 1) {
                unlink("chat.txt");
                touch("chat.txt");
                echo "Sohbet Temizlendi";
            } else {
                echo "Admin değilsin be yavrum !";
            }
            break;
    }
}
