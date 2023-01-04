<?php

use System\Config\Config;

/**
 * @note
 * tanımlamalar configure metodu ile yapıldı
 */
include __DIR__ . '/vendor/autoload.php';

Config::Configure();

if (isset($_GET["param"])) {
    $param = array_filter(explode("/", $_GET["param"]));

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sayfa = POSTS . $param[0] . ".php";

        include($sayfa);
    }
    else {
        $sayfa = PAGES . $param[0] . ".php";

        if ($param[0] == "admin") {
            if (isset($param[1])) {
                $sayfa = $param[1] . ".php";

                if (file_exists(ADMINPAGES . $sayfa)) {
                    include_once(ADMINLAYOUTS . "_header.php");

                    include_once(ADMINLAYOUTS . "_sidebar.php");

                    include(ADMINPAGES . $sayfa);

                    include_once(ADMINLAYOUTS . "_footer.php");
                }
                else {
                    include_once(ADMINLAYOUTS . "_header.php");

                    include_once(ADMINLAYOUTS . "_sidebar.php");

                    include(ADMINPAGES . "default.php");

                    include_once(ADMINLAYOUTS . "_footer.php");
                }
            }
            else {
                include_once(ADMINLAYOUTS . "_header.php");

                include_once(ADMINLAYOUTS . "_sidebar.php");

                include(ADMINPAGES . "default.php");

                include_once(ADMINLAYOUTS . "_footer.php");
            }
        }
        else {
            if ($sayfa == "index.php") {
                include("anasayfa.php");
            }
            else {
                if (file_exists($sayfa)) {
                    include($sayfa);
                }
                else {
                    include(PAGES . "anasayfa.php");
                }
            }
        }
    }
}
else {
    include(PAGES . "anasayfa.php");
}


/*<meta http-equiv="refresh" content="0;url=--><?//= BASE ?><!--giris">*/
//tip kurumsal bireysel icindi galiba
