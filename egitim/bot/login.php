
<div class="login">
    <div class="col-lg-4 col-md-6">
        <div class="login-box">
            <div class="login-logo">
                <?php
                if (isset($_SESSION["durum"])) {
                    if ($_SESSION["durum"] == 1) {
                        echo '<div style="margin-top: 1rem;" class="alert alert-success text-center">Admin Girişi</div>';
                        header("refresh:2; url = admin");
                    }
                    else if ($_SESSION["durum"] == 2) {
                        echo '<div style="margin-top: 1rem;" class="alert alert-success text-center">Öğretmen Girişi</div>';
                        header("refresh:2; url = anasayfa");
                    }
                    else if ($_SESSION["durum"] == 3) {
                        echo '<div style="margin-top: 1rem;" class="alert alert-success text-center">Kullanıcı Girişi Başarılı</div>';
                        header("refresh:2; url = anasayfa");
                    }
                    else {
                        echo '<div style="margin-top: 1rem;" class="alert alert-danger text-center">Giriş işlemi Başarısız :( <br> Tekrar Deneyiniz</div>';
                    }
                    unset($_SESSION["durum"]);
                }
                ?>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Giriş Yap</p>

                    <form action="giris-post" method="post">
                        <div class="input-group mb-3">

                            <input type="email" class="form-control" name="mail" placeholder="Eposta">
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

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" name="custom-entrance" class="btn btn-primary btn-block">
                                    Giriş Yap
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <p class="mb-1">
                        <a href="forget-password">Sifremi Unuttum</a>
                    </p>

                    <p class="mb-0">
                        <a href="kayit" class="text-center">Kaydol</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
