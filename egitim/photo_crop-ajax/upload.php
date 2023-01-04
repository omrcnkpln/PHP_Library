<?php

namespace Verot\Upload;

require_once "class/class.upload.php";


$upload = new Upload($_FILES["foto"]);

if ($upload->uploaded) {

    $rand = uniqid(true);
    $upload->file_new_name_body = $rand;
    if ($upload->image_src_x > 800) {
        $upload->image_resize = true;
        $upload->image_ratio_y = true;
        $upload->image_x = 300;
    }

    $upload->Process("upload/");
    if ($upload->processed) {
        echo '
            <form method="post" id="resimKirp">
                <img src="upload/' . $rand . '.' . $upload->image_src_type . '" alt="" id="crop"/>
                <input type="text" name="x" id="x"/>
                <input type="text" name="y" id="y"/>
                <input type="text" name="x2" id="x2"/>
                <input type="text" name="y2" id="y2"/>
                <input type="text" name="w" id="w"/>
                <input type="text" name="h" id="h"/>
                <input type="text" name="resimlink" value="upload/' . $rand . '.' . $upload->image_src_type . '"/>
                <input type="submit" value="Kırmayı Bitir" name="resimcrop"/>
            </form>
            ';
    } else {
        echo "Hata: " . $upload->error;
        echo "yapışmadı";
    }
} else {
    echo "Hata: " . $upload->error;
    echo "sınıfta bokluk";
}