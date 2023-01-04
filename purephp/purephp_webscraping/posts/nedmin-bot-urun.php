<?php

use Libraries\VT;

$VT = new VT();

if (isset($_POST["bot-urun-ekle"])) {
//    $title = $_POST["title"];
    $title = $VT->filter($_POST["title"]);
    $price = $VT->filter($_POST["price"]);
    $tablo = $VT->filter($_POST["tablo"]);
    $link = $VT->filter($_POST["link"]);

    $isUnique = $VT->IsUnique($tablo, "Title", $title);

    if (!$isUnique) {
        echo "kayit var";
        exit();
    }
    else {
        $title = $VT->filter($_POST["title"]);

        $sql = "INSERT INTO {$tablo}(Title, Price, Link) VALUES('$title', '$price', '$link')";
        $kayit_ekle = $VT->baglantiMySQLi->query($sql);

        if ($kayit_ekle) {
            echo "ekledi";
        }
        else {
            echo "ekleyemedi :/";
        }
    }
}
else if (isset($_POST["bot-urun-duzenle"])) {
    echo "duzenle";
}
else {
    $title = $VT->filter($_POST["title"]);
    $tablo = $VT->filter($_POST["tablo"]);

    $sqlSelect = "SELECT * FROM {$tablo} WHERE Title='{$title}' LIMIT 1";
    $varMi = $VT->baglantiMySQLi->query($sqlSelect);

    if ($varMi->num_rows) {
        $sqlDelete = "DELETE FROM {$tablo} WHERE Title='{$title}' LIMIT 1";
        $silindiMi = $VT->baglantiMySQLi->query($sqlDelete);

        if ($silindiMi) {
            echo "Silme işlemi başarılı";
        }
        else {
            echo "Silme işlemi başarısız :/";
        }
    }
    else {
        echo "Bu başlık ile eşleşen kayıt bulunamadı :/";
    }
}
