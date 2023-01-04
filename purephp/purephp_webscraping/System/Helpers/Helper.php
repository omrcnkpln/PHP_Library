<?php

namespace System\Helpers;

class Helper
{
    public static function Pr($param)
    {
        echo '</br><pre>';
        print_r($param);
        echo '</br></pre>';
    }

    public static function Filter($val, $tag = false)
    {
        if ($tag == false) {
            $val = addslashes(strip_tags(trim($val)));
        }
        else {
            $val = addslashes(trim($val));
        }
        return $val;
    }

    //$activePage, $pageLocated
    public static function ForceMvc()
    {
        //nokta var mı kontrolü
        $point = strpos(REQUESTURI, ".", $başlangıç = 0);

        //bu kısma gerek yok gibi
        //açılan dosya konumundan bağlamışsa - index den yönlendirilmemiş ise olmamalı
//    if ($activePage == $pageLocated){
//        return $actual_link;
//    }

        if (!empty($point)) {

            // google ın gönderdiği linkte "." olduğu için benim nokta varsa kontrolüm patladı bu bu sebepten
            if (!isset($_GET["code"])) {
                return BASE;
            }
        }

        return false;
    }

    public static function FetchAllWitKeys($param)
    {
        while ($row = mysqli_fetch_assoc($param)) {
            $array[] = $row;
        }

        return $array;
    }

    public static function IncludeWithObject($str, $includeObject, $prm = null)
    {
//        $urunler = $object;
        include($str);
//        return $object;
    }

    public static function SessionState()
    {
        if (isset($_SESSION["durum"])) {
            $state = $_SESSION["durum"];
            if ($state == 1) {
                ?>
                <div class="alert alert-success text-center">Admin Girişi</div>
                <?php
                header("refresh:2;url=" . BASE . "admin");
            }
            else if ($state == 2) {
                ?>
                <div class="alert alert-success text-center">Öğretmen Girişi</div>
                <?php
                header("refresh:2;url=" . BASE . "ogretmen");
            }
            else {
                echo '<div class="alert alert-danger text-center">Giriş işlemi Başarısız :( <br> Tekrar Deneyiniz</div>';
            }

            unset($_SESSION["durum"]);
        }

        if (isset($_SESSION["register-state"])) {
            if ($_SESSION["register-state"] == 0) {
                echo '<div style="margin-top: 1rem;" class="alert alert-warning text-center">Tüm alanları doldurunuz !</div>';
//                              header("refresh:2; url = admin");
            }
            else if ($_SESSION["register-state"] == 1) {
                echo '<div style="margin-top: 1rem;" class="alert alert-warning text-center">Bu mail adresi ile kayit bulunmakta</div>';
//                              header("refresh:2; url = anasayfa");
            }
            else if ($_SESSION["register-state"] == 2) {
                echo '<div style="margin-top: 1rem;" class="alert alert-warning text-center">Sifreler eşleşmiyor. Tekrar deneyin !</div>';
//                              header("refresh:2; url = anasayfa");
            }
            else if ($_SESSION["register-state"] == 3) {
                echo '<div style="margin-top: 1rem;" class="alert alert-danger text-center">Kayit işleminde hata.Daha sonra tekrar deneyin :(</div>';
//                              header("refresh:2; url = anasayfa");
            }
            else if ($_SESSION["register-state"] == "giris1") {
                echo '<div style="margin-top: 1rem;" class="alert alert-success text-center">Admin girişi sağlandı</div>';
                header("refresh:2; url = anasayfa");
            }
            else if ($_SESSION["register-state"] == "giris2") {
                echo '<div style="margin-top: 1rem;" class="alert alert-success text-center">Öğretmen girişi başarılı :)</div>';
                header("refresh:2; url = anasayfa");
            }
            else if ($_SESSION["register-state"] == "giris3") {
                echo '<div style="margin-top: 1rem;" class="alert alert-success text-center">Giriş Başarılı :)</div>';
                header("refresh:2; url = anasayfa");
            }
            else {
                echo '<div style="margin-top: 1rem;" class="alert alert-danger text-center">Giriş işlemi Başarısız :( <br> Tekrar Deneyiniz</div>';
            }
            unset($_SESSION["register-state"]);
        }
    }

    public static function CreateHash($uzunluk = 16)
    {
        $karakterler = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
        return substr(str_shuffle($karakterler), 0, $uzunluk);
    }
}
