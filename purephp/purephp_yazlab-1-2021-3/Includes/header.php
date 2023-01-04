<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yazlab 3 | 2021</title>

    <!--bootstrap-5.1.3-->
    <link rel="stylesheet" href="Assets/bootstrap-5.1.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php
session_start();
ob_start();

$session = $_SESSION;
?>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                    aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="index.php">Yazlab</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php
                        if (isset($session["rank"])) {
                            if ($session["rank"] == 1) {
                                ?>
                                <a class="nav-link active" aria-current="page" href="yonetim-paneli.php">Yönetim Paneli</a>
                                <?php
                            }
                            else {
                                ?>
                                <a class="nav-link active" aria-current="page" href="kullanici-paneli.php">Kullanıcı Paneli</a>
                                <?php
                            }
                        }
                        else {
                            ?><?php
                        }
                        ?>
                    </li>
                </ul>

                <div>
                    <?php
                    if (isset($session["oturum"])) {
                        ?>
                        <a href="cikis.php" class="btn btn-danger">Çıkış Yap</a>
                        <?php
                    }
                    else {
                        ?>
                        <a href="giris.php" class="btn btn-primary">Giriş Yap</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</div>
