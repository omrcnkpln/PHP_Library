<?php
include "../ayarlar.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../../dist/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../dist/css/nedmin.css">    
</head>
<body>

<!-- HEADER -->
<header>
        <div class="center">

            <div class="header_left">
                <div class="logo">

                </div>
            </div>

            <div class="header_right">

                <?php
                if (isset($_SESSION["oturum"])) {
                    echo '
                        <ul id = "online">

                            <li>
                                <a href="../user_page.php">' . $_SESSION["isim"] . $_SESSION["soyisim"] . '</a>
                            </li>

                            <li>
                                <a href="../cikis.php">Çıkış Yap</a>
                            </li>
                        
                        </ul>
                    ';
                } else {
                    echo '
                        <ul id = "offline">
                    
                            <li>
                                <a href="giris.php">GİRİŞ YAP</a>
                            </li>

                            <li>
                                <a href="kayit.php">KAYDOL</a>
                            </li>
                    
                        </ul>
                    ';
                }
                 ?>
            </div>

        </div>
    </header>

<div class="container">

<!-- LEFT_SECTION -->
    <div id="left_section">

        <div id="left_container">
            <ul>
                <li>
                    <a href="index.php"><i class="fa fa-home"></i></a>
                </li>
                <li>
                    <a href="#"><em class="fa fa-search"></em></a>
                </li>
                <li>
                    <a href="#item_top"><em class="fa fa-angle-double-up"></em></a>
                </li>
                <li>
                    <a href="#"><em class="fa fa-angle-double-up"></em></a>
                </li>
                <li>
                    <a href="#"><em class="fa fa-angle-double-down"></em></a>
                </li>
                <li>
                    <a href="#footer"><em class="fa fa-angle-double-down"></em></a>
                </li>
            </ul>
        </div>

    </div>

