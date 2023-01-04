<?php
session_start();

if($_POST){
    include "libraries/CurlLibrary.php";

    $mail = $_POST["mail"];
    $sifre = $_POST["sifre"];

    $posts = array(
        "mail" => $mail,
        "sifre" => $sifre,
        "custom-entrance" => ""
    );

    $curl = new CurlLibrary();

    $curl->SetUrl("http://phpprojects:8064/tm-unified/giris-post");
    $curl->SetTimeout(0);
    $curl->SetReferer("http://www.google.com/");
    $curl->SetUserAgent($_SERVER["HTTP_USER_AGENT"]);
    $curl->SetRequestMethod("post");
    $curl->SetPostFields($posts);
    $curl->SetCookieJar(session_id());

    if($curl->Execute()){
        echo "giriş başarılı";
    }else{
        echo "giriş başarısız";
    }

    header("refresh:2;url=../bot");
}
