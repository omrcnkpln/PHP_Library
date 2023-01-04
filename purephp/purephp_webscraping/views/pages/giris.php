<?php

use System\Helpers\Helper;

include(VIEWS . "statics/_structureTop.php");
?>

<div class="login">
    <div class="col-lg-4 col-md-6">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?= BASE ?>" class="img-wrapper">
                    Web Scraping
<!--                    <img src="--><?//= ASSETS ?><!--images/marka-gorselleri/t-logo.svg" alt="logo">-->
                </a>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Giriş Yap</p>

                    <form action="<?= BASE ?>giris-post" method="post">
                        <?php
                        Helper::SessionState();
                        ?>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="sifre" placeholder="Şifre">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <button type="submit" name="custom-entrance" class="btn btn-primary btn-block">
                                    Giriş Yap
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <p class="px-3">
                                <a href="<?= BASE ?>">Sifremi Unuttum</a>
                            </p>
                        </div>

                        <div class="col-auto">
                            <p class="px-3">
                                <a href="<?= BASE ?>kayit" class="text-center">Kaydol</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include(VIEWS . "statics/_structureBottom.php");
?>
