<?php

//echo $param[0];

if (url(1) == "ekle") {
    $query = $db->insert("users")
        ->set(array(
            "name" => url(2),
            "url" => url(2)
        ));

    if ($query) {
        echo "üye eklendi";
    }
    else {
        echo "Ekleme işleminde hata :/";
    }
}
else {
    $url = url(1);

    $query = $db->from('users')->where('url', $url)->first();

    if ($query) {
        echo "Hoşgeldiniz " . $query["name"];
    }else{
        echo "user not found";
    }
}
