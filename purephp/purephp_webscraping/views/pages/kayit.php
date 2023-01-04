<?php

use Libraries\GoogleSignIn;
use System\Helpers\Helper;

include(MODELS . "MODEL.PHP");
?>

<title>TM | Kayıt Ol</title>

<!-- _____________________________ header _____________________________________________________________ -->
<?php
include(VIEWS . "statics/_structureTop.php");

$googleSignIn = new GoogleSignIn();

?>
<div class="register">
    <div class="col-xl-6 col-lg-7 col-md-10">
        <div class="register-box">
            <div class="register-logo">
                <a href="<?= BASE ?>" class="img-wrapper">
                    <img src="<?= ASSETS ?>images/marka-gorselleri/t-logo.svg" alt="logo">
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <p class="login-box-msg">Kayıt Ol</p>

                    <form action="<?= BASE ?>kayit-post" method="post">
                        <?php
                        Helper::SessionState();
                        ?>

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
                            <input type="tel" class="form-control" name="telNo" placeholder="Telefon Numarası"
                                   required>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <!--                        <div class="input-group mb-3">-->
                        <!--                            <input type="text" class="form-control" name="tcKimlik" placeholder="TC Kimlik Numarası"-->
                        <!--                                   required>-->
                        <!---->
                        <!--                            <div class="input-group-append">-->
                        <!--                                <div class="input-group-text">-->
                        <!--                                    <span class="fas fa-envelope"></span>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

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

                        <div class="row align-items-center mb-3">
                            <div class="col-sm-9">
                                <div class="icheck-primary sozlesme">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>

                                    <label for="agreeTerms">
                                        <a href="../../index.php" target="_blank">Kullanıcı sözleşmesini</a> kabul ediyorum.
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary btn-block" name="kaydol">Kaydol
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <a href="<?= $googleSignIn->client->createAuthUrl() ?>" class="googleSignInBtn w-100">
                                <div class="img-wrapper">
                                    <img src="<?= ASSETS ?>images/icons/png/btn_google_light_normal_ios.png"
                                         alt="google-icon">
                                </div>

                                <div class="text-side">
                                    Sign In With Google
                                </div>
                            </a>
                        </div>
                    </form>

                    <a href="<?= BASE ?>giris" class="girese-git">Hesabınız var mı?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include(VIEWS . "statics/_structureBottom.php");
?>

<script>
    $(function () {
        $('input[name="sinif"]').mask("9");
        $('input[name="telNo"]').mask("(500) 000 00 00");
        $('input[name="tcKimlik"]').mask("00000000000");
    })
</script>

<!-- _____________________________ header _____________________________________________________________ -->
<script type="text/javascript" src="<?= BASE ?>src/js/header-bg-white-2.js"></script>
