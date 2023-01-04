<?php
/** @var object $VT */

use Libraries\VT;

session_start();
ob_start();

if (isset($_POST["custom-entrance"])) {
    $VT = new VT();

    $username = $VT->filter($_POST["username"]);
    $sifre = $VT->filter($_POST["sifre"]);
    $rutbe = 2; // standart kullanici girisi icin sorgula

    $response = $VT->AuthWithPassUsername($username, $sifre, $rutbe);

    if (!$response) { // basarili degil ise admin icin sorgula
        $rutbe = 1;
        $responseAdmin = $VT->AuthWithPassUsername($username, $sifre, $rutbe);

        if (!$responseAdmin) {
            $_SESSION["durum"] = 4; // Yani basarisiz
        }
    }

    header("Location:" . BASE . "giris");
}
