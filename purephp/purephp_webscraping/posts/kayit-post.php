<?php

use System\Helpers\Helper;

include(MODELS . "MODEL.PHP");
//include("functions/createHash.php");
session_start();
ob_start();

if (isset($_POST["kaydol"])) {
    $isim = $VT->filter($_POST["isim"]);
    $soyisim = $VT->filter($_POST["soyisim"]);
    $eposta = $VT->filter($_POST["eposta"]);
    $kadi = $eposta;
    $okul = $VT->filter($_POST["okul"]);
    $sinif = $VT->filter((int)$_POST["sinif"]);
    $telNo = $VT->filter($_POST["telNo"]);
//  $tcKimlik = $VT->filter((int)$_POST["tcKimlik"]);
    $sifre1 = $VT->filter($_POST["sifre1"]);
    $sifre2 = $VT->filter($_POST["sifre2"]);
    $hash = md5(Helper::CreateHash());
    $rutbe = 3; // standart kullanici register

    $response = $VT->Register($isim, $soyisim, $eposta, $okul, $sinif, $telNo, $sifre1, $sifre2, $hash, $rutbe);

    if (!$response) {
//        $_SESSION["durum"] = 4; // Yani basarisiz
//        echo "something went wrong :/";
    }
    header("Location:kayit");
}
elseif (isset($_POST["kaydol-ogretmen"])) {
    $isim = $VT->filter($_POST["isim"]);
    $soyisim = $VT->filter($_POST["soyisim"]);
    $eposta = $VT->filter($_POST["eposta"]);
    $kadi = $eposta;
    $okul = $VT->filter($_POST["okul"]);
    $sinif = isset($_POST["sinif"]) ? $VT->filter((int)$_POST["sinif"]) : null;
    $telNo = $VT->filter($_POST["telNo"]);
//  $tcKimlik = $VT->filter((int)$_POST["tcKimlik"]);
    $sifre1 = $VT->filter($_POST["sifre1"]);
    $sifre2 = $VT->filter($_POST["sifre2"]);
    $hash = md5(Helper::CreateHash());
    $rutbe = 2; // ogretmen kullanici register

    $response = $VT->Register($isim, $soyisim, $eposta, $okul, $sinif, $telNo, $sifre1, $sifre2, $hash, $rutbe);

    if (!$response) {
//        $_SESSION["durum"] = 4; // Yani basarisiz
//        echo "something went wrong :/";
    }
    header("Location:kayit-ogretmen");
}
else {
    header("Location:anasayfa");
}
