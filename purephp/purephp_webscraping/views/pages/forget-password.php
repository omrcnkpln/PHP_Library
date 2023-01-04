<?php
include(MODELS . "MODEL.PHP");
?>

<title>TM | Şifremi Unuttum</title>

<!-- _____________________________ header _____________________________________________________________ -->
<?php
include(LAYOUTS . "_header-bg-white-2.php");

$paramCount = count($param);

if ($paramCount == 4) {
    if ($param[1] == "yenile") {
        $epostaGet = $VT->filter($param[2]);
        $hashGet = $VT->filter($param[3]);

        $find_hash = $VT->baglantiMySQLi->query("SELECT * FROM users WHERE user_hash = '$hashGet'");

        if ($find_hash) {
            $find_hash_number = $find_hash->num_rows;
        }
        else {
            $find_hash_number = 0;
        }

        if ($find_hash_number > 0) {
            ?>

            <div class="f-password">
                <div class="col-auto">
                    <div class="login-box">
                        <div class="card">
                            <div class="card-body login-card-body">
                                <p class="login-box-msg">Yeni bir şifre belirleyin.</p>

                                <?php
                                if (isset($_SESSION["durum"])) {
                                    if ($_SESSION["durum"] == 1) {
                                        echo '<div style="margin-top: 1rem;" class="alert alert-success">Şifre yenileme linki mail adresinize gonderildi... <br> Mail adersinize gönderilen bağlantı ile ile şifrenizi yenileyebilirsiniz :)</div>';
                                    }
                                    else if ($_SESSION["durum"] == 2) {
                                        echo '<div style="margin-top: 1rem;" class="alert alert-warning">Bir hata oluştu. Onaylama linki gönderilemedi..</div>';
                                    }
                                    else if ($_SESSION["durum"] == 3) {
                                        echo '<div style="margin-top: 1rem;" class="alert alert-success">Yeni şifre oluşturma başarılı :)</div>';
                                    }
                                    else if ($_SESSION["durum"] == 4) {
                                        echo '<div style="margin-top: 1rem;" class="alert alert-warning">Şifreler eşleşmiyor. Lütfen tekrar deneyin !</div>';
                                    }
                                    else if ($_SESSION["durum"] == 5) {
                                        echo '<div style="margin-top: 1rem;" class="alert alert-warning">Lütfen tüm alanları doldurup tekrar deneyin !</div>';
                                    }
                                    else if ($_SESSION["durum"] == 6) {
                                        echo '<div style="margin-top: 1rem;" class="alert alert-warning">İşlem başarısız <br> Daha sonra tekrar deneyin :(</div>';
                                    }
                                    else {
                                        echo '
                                <div style="margin-top: 1rem;" class="alert alert-warning">
                                    Sisteme kayıtlı böyle bir kullanıcı bulunamadı !
                                </div>
                            ';
                                    }
                                    unset($_SESSION["durum"]);
                                }
                                ?>

                                <form action="<?= BASE ?>forget-password-post" method="post">
                                    <input type="hidden" name="hash" value="<?= $hashGet ?>">
                                    <input type="hidden" name="eposta" value="<?= $epostaGet ?>">

                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Şifre" autofocus
                                               name="sifre1">

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Şifre Tekrar" autofocus
                                               name="sifre2">

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary btn-block" name="sifreYenile">
                                                Şifremi
                                                Yenile
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="d-flex justify-content-between">
                                    <p class="mt-3 mb-1">
                                        <a href="<?= BASE ?>giris">Giriş Yap</a>
                                    </p>

                                    <p class="mt-3 mb-1">
                                        <a href="<?= BASE ?>kaydol" class="text-center">Kaydol</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        else {
            echo '<div style="margin-top: 1rem;" class="alert alert-danger">Hata <br>Lütfen daha sora tekrar deneyin..</div>';
            header("refresh:2; url = anasayfa");
        }
    }
    else {
        echo '<div style="margin-top: 1rem;" class="alert alert-danger">Tekrar deneyiniz..</div>';
        header("refresh:1; url = anasayfa");
    }
}
else {
    ?>
    <div class="f-password">
        <div class="col-auto">
            <div class="login-box">
                <div class="login-logo">
                </div>

                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Şifrenizi mi unuttunuz? <br>Yeni bir tane alın.</p>
                        <?php
                        if (isset($_SESSION["durum"])) {
                            if ($_SESSION["durum"] == 1) {
                                echo '<div style="margin-top: 1rem;" class="alert alert-success">Şifre yenileme linki mail adresinize gonderildi... <br> Mail adersinize gönderilen bağlantı ile ile şifrenizi yenileyebilirsiniz :)</div>';
                            }
                            else if ($_SESSION["durum"] == 2) {
                                echo '<div style="margin-top: 1rem;" class="alert alert-warning">Bir hata oluştu. Onaylama linki gönderilemedi..</div>';
                            }
                            else if ($_SESSION["durum"] == 3) {
                                echo '<div style="margin-top: 1rem;" class="alert alert-success">Yeni şifre oluşturma başarılı :)</div>';
                            }
                            else if ($_SESSION["durum"] == 4) {
                                echo '<div style="margin-top: 1rem;" class="alert alert-warning">Şifreler eşleşmiyor. Lütfen tekrar deneyin !</div>';
                            }
                            else if ($_SESSION["durum"] == 5) {
                                echo '<div style="margin-top: 1rem;" class="alert alert-warning">Lütfen tüm alanları doldurup tekrar deneyin !</div>';
                            }
                            else if ($_SESSION["durum"] == 6) {
                                echo '<div style="margin-top: 1rem;" class="alert alert-warning">İşlem başarısız <br> Daha sonra tekrar deneyin :(</div>';
                            }
                            else {
                                echo '
                                <div style="margin-top: 1rem;" class="alert alert-warning">
                                    Sisteme kayıtlı böyle bir kullanıcı bulunamadı !
                                </div>
                            ';
                            }
                            unset($_SESSION["durum"]);
                        }
                        ?>

                        <form action="<?= BASE ?>forget-password-post" method="post">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Eposta" autofocus
                                       name="eposta">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block" name="forgetPassword">
                                        Şifre oluşturma linkimi mail adresime gönder
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="d-flex justify-content-between">
                            <p class="mt-3 mb-1">
                                <a href="<?= BASE ?>giris">Giriş Yap</a>
                            </p>

                            <p class="mt-3 mb-1">
                                <a href="<?= BASE ?>" class="text-center">Kaydol</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
include(LAYOUTS . "_footer.php");
?>
<!-- _____________________________ header _____________________________________________________________ -->
<script type="text/javascript" src="<?= SOURCES ?>js/header-bg-white-2.js"></script>
