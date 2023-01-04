<link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/giris.css">
<link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/kayit.css">
<?php
if (!empty($_SESSION["uyeID"]))
{
    ?>
    <meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">
    <?php
    exit();
}
?>

<section class="login register" style="margin-bottom: 30px;">
    <div class="container">
        <center>
        <div class="login-logo">
            <img src="assets/img/logo.png" alt="logo">
        </div>
        </center>
        <div class="row justify-content-end">
            <div class="col-md-6">
                <?php
                if ($_POST) {
                    if (!empty($_POST["giris"]))
                    {
                        if (!empty($_POST["mail"]) && !empty($_POST["sifre"]))
                        {
                            $mail=$VT->filter($_POST["mail"]);
                            $sifre=md5($VT->filter($_POST["sifre"]));

                            $kontrol=$VT->VeriGetir("uyeler","WHERE mail=? AND sifre=? AND durum=?",array($mail,$sifre,1),"ORDER BY ID ASC",1);


                            if ($kontrol!=false)
                            {
                                $_SESSION["uyeID"]=$kontrol[0]["ID"];
                                $_SESSION["uyeTipi"]=$kontrol[0]["tipi"];

                                if ($kontrol[0]["tipi"]==1)
                                {
                                    $_SESSION["uyeAdi"]=$kontrol[0]["ad"];

                                }
                                else
                                {
                                    $_SESSION["uyeAdi"]=$kontrol[0]["firmaadi"];

                                }
                                ?>
                                <meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class="alert alert-danger">Boş Bıraktığınız Alanları Doldurunuz.</div>
                                <?php
                            }

                        }
                        else
                        {
                            ?>
                            <div class="alert alert-danger">E-mail veya şifre hatalı</div>
                            <?php
                        }
                    }

                }
                ?>
                <form action="#" method="post">
                    <input type="hidden" name="giris" value="1">
                <div class="login-box">

                    <!-- /.login-logo -->
                    <div class="card" style="border-radius: 20px;">
                        <div class="card-body login-card-body" style="border-radius: 20px;">
                            <p class="login-box-msg">Giriş Yap</p>

                            <form action="" method="post">
                                <div class="input-group mb-3">

                                    <input type="email" class="form-control" name="mail" id="email" placeholder="Eposta">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                            <!-- <img src="../images/icons/person-black.svg" alt="logo"> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="sifre" id="password_in" placeholder="Şifre">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-key"></span>
                                            <!-- <img src="../images/icons/key-black.png" alt="logo" width="15px"> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember">
                                            <label for="remember">
                                                Beni Hatırla
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-md-6">

                <div class="register-box">
                    <div class="card">
                        <div class="card-body register-card-body">
                            <p class="login-box-msg">Kayıt Ol</p>

                            <form action="" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="kAdi" placeholder="Kullanıcı Adı" required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="isim" placeholder="İsim" required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="soyisim" placeholder="Soyisim" required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="eposta" placeholder="Eposta" required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="okul" placeholder="Okul" required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="sinif" placeholder="Sınıf" required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="tel" class="form-control" name="telNo" placeholder="Telefon Numarası" required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="tcKimlik" placeholder="TC Kimlik Numarası"
                                           required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="sifre1" placeholder="Şifre" required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="sifre2" placeholder="Şifre Tekrar"
                                           required>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>

                                            <label for="agreeTerms" style="color: white">
                                                <?
                                                $bilgiler=$VT->VeriGetir("gizlilikpolitikasi","WHERE durum=?",array(1),"ORDER BY ID ASC",1);
                                                if ($bilgiler!=false)
                                                {
                                                ?>
                                                <a target="_blank" href="<?=SITE?>gizlilik-politikasi/<?=$bilgiler[0]["seflink"]?>">Kullanıcı sözleşmesini</a>
                                                    <?php
                                                }
                                                ?>
                                                kabul ediyorum.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block" name="kaydol">Kaydol</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    $(function () {
        $('input[name="sinif"]').mask("9");
        $('input[name="telNo"]').mask("(500) 000 00 00");
        $('input[name="tcKimlik"]').mask("00000000000");
    })
</script>
