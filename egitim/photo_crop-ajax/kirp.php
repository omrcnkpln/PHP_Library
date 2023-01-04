<?php

namespace Verot\Upload;

require_once "class/class.upload.php";


$x = $_POST["x"];
$y = $_POST["y"];
// $x2 = $_POST["x2"];
$x2 = $_POST["x"] + 100;
$y2 = $_POST["y2"];
$w = $_POST["w"];
$h = $_POST["h"];

if ($w < 10 || $y < 10) {
    echo "en az 10px olmalı";
} else {

    $upload = new Upload($_POST["resimlink"]);

    if ($upload->uploaded) {

        $rand = uniqid(true);
        $upload->file_new_name_body = $rand;

        $resimWidth = $upload->image_src_x - $x2;
        $resimYukseklik = $upload->image_src_y - $y2;

        $upload->image_crop = "{$y} {$resimWidth} {$resimYukseklik} {$x}";
        $upload->Process("upload/");
        if ($upload->processed) {
            echo '
                <img src="upload/' . $rand . '.' . $upload->image_src_type . '" alt=""/>
            ';
        } else {
            echo "Hata: " . $upload->error;
            echo "yapışmadı";
        }
    } else {
        echo "Hata: " . $upload->error;
        echo "sınıfta bokluk";
    }
}
