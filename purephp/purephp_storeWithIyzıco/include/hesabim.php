<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/profil.css">
<?php
if (!empty($_SESSION["uyeID"]))
{
    $uyeID=$VT->filter($_SESSION["uyeID"]);
    $uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyeID,1),"ORDER BY ID ASC",1);
    if ($uyebilgisi!=false)
    {
        ?>






            <section class="options-wrapper">
                <div class="container">
                    <div class="row">
                        <center>
                        <div class="login-logo">
                            <!-- <a href="../index.php"><b>Thinker</b>MATH</a> -->
                            <a href="<?=SITE?>">
                                <img src="<?=SITE?>images/Logo.svg" alt="logo">
                            </a>
                        </div>
                        </center>
                        <div class="col-12">
                            <ul class="nav nav-pills my-5 justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="pill" href="#pills-hesabim" role="tab"
                                       aria-controls="pills-hesabim" aria-selected="true">Hesabım</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="pill" href="#pills-siparis" role="tab"
                                       aria-controls="pills-siparis" aria-selected="false">Sipariş Takibi</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="pill" href="#pills-iade" role="tab"
                                       aria-controls="pills-iade" aria-selected="true">İade Takibi</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="<?=SITE?>sepet">Sepetim</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="<?=SITE?>cikis-yap">Çıkış</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-hesabim" role="pills-hesabim"
                                     aria-labelledby="pills-iade-tab">
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <div class="login-box">


                                                <div class="card">
                                                    <div class="card-body login-card-body">
                                                        <?php
                                                        if ($_POST) {
                                                            if (!empty($_POST["giris"]))
                                                            {
                                                                if (!empty($_POST["esifre"]) && !empty($_POST["sifre"]))
                                                                {
                                                                    $esifre=md5($VT->filter($_POST["esifre"]));
                                                                    $sifre=md5($VT->filter($_POST["sifre"]));
                                                                    if ($uyebilgisi[0]["sifre"]==$esifre)
                                                                    {
                                                                        $sifreguncelle=$VT->SorguCalistir("UPDATE uyeler","SET sifre=? WHERE ID=?",array($sifre,$uyebilgisi[0]["ID"]),1);
                                                                        ?>
                                                                        <div class="alert alert-success">İşleminiz başarılıyla güncellendi.</div>
                                                                        <?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                        <div class="alert alert-danger">Eski şifreniz doğrulanamadı!</div>
                                                                        <?php
                                                                    }
                                                                }


                                                                else
                                                                {
                                                                    ?>
                                                                    <div class="alert alert-danger">Boş Bıraktığınız Alanları Doldurunuz.</div>
                                                                    <?php
                                                                }

                                                            }

                                                        }
                                                        ?>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="giris" value="1">
                                                            <div class="input-group mb-3">
                                                                <input type="password"  name="esifre" class="form-control" placeholder="Eski Şifre" autofocus
                                                                      >

                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="fas fa-envelope"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <input type="password" class="form-control" placeholder="Yeni Şifre" autofocus
                                                                       name="sifre">

                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="fas fa-envelope"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <button type="submit" class="btn btn-primary btn-block"
                                                                            name="sifreYenile">Şifremi Yenile</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-siparis" role="pills-siparis"
                                     aria-labelledby="pills-siparis-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>SİPARİŞ KODU</th>
                                                <th> KDV HARİÇ TUTAR</th>
                                                <th>KDV TUTAR</th>
                                                <th>ÖDENEN TUTAR</th>
                                                <th>ÖDEME TİPİ</th>
                                                <th>ÖDEME DURUMU</th>
                                                <th>TARİH</th>
                                                <th>İNCELE</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php
                                            $siparisler=$VT->VeriGetir("siparisler","WHERE uyeID=?",array($uyebilgisi[0]["ID"]),"ORDER BY ID DESC");
                                            if ($siparisler!=false)
                                            {
                                                for ($i=0;$i<count($siparisler);$i++)
                                                {
                                                    if ($siparisler[$i]["odemetipi"]==1){$odemetipi="Kredi Kartı";}
                                                    if ($siparisler[$i]["odemetipi"]==2){$odemetipi="Havale/Eft İle Ödeme";}
                                                    if ($siparisler[$i]["odemetipi"]==3){$odemetipi="Kapıda Ödeme";}
                                                    ?>
                                                    <tr>
                                                        <td><?=$siparisler[$i]["sipariskodu"]?></td>
                                                        <td><?=number_format($siparisler[$i]["kdvharictutar"],2,".",".")?> TL</td>
                                                        <td><?=number_format($siparisler[$i]["kdvtutar"],2,".",".")?> TL</td>
                                                        <td><?=number_format($siparisler[$i]["odenentutar"],2,".",".")?> TL</td>
                                                        <td><?=$odemetipi;?></td>
                                                        <td><?php if ($siparisler[$i]["durum"]==1)
                                                            {
                                                                ?>
                                                                <strong style="color: #4caf50">ÖDENDİ</strong>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <strong style="color: #FF9800">ÖDEME BEKLİYOR</strong>
                                                                <?php
                                                            } ?></td>
                                                        <td><?=date("d.m.Y",strtotime($siparisler[$i]["tarih"]))?></td>
                                                        <td><a href="<?=SITE?>siparis-detay/<?=$siparisler[$i]["sipariskodu"]?>">İncele</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td colspan="7">Henüz kayıtlı bir siparişiniz bulunmamaktadır.</td>
                                                </tr>
                                                <?php
                                            }

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="pills-iade" role="pills-iade"
                                     aria-labelledby="pills-iade-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>İADE KODU</th>
                                                <th>AÇIKLAMA</th>
                                                <th>İADE DURUMU</th>
                                                <th>TARİH</th>
                                                <th>İNCELE</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php
                                            $iadeler=$VT->VeriGetir("iadeler","WHERE uyeID=?",array($uyebilgisi[0]["ID"]),"ORDER BY ID DESC");
                                            if ($iadeler!=false)
                                            {
                                                for ($i=0;$i<count($iadeler);$i++)
                                                {

                                                    ?>
                                                    <tr>
                                                        <td><?=$iadeler[$i]["iadekodu"]?></td>
                                                        <td><?=mb_substr(stripslashes($iadeler[$i]["metin"]),0,55,"UTF-8")?>...</td>
                                                        <td><?php if ($iadeler[$i]["durum"]==1)
                                                            {
                                                                ?>
                                                                <strong style="color: #FF9800">BEKLİYOR</strong>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <strong style="color: #4caf50">CEVAPLANDI</strong>
                                                                <?php
                                                            } ?></td>
                                                        <td><?=date("d.m.Y",strtotime($iadeler[$i]["tarih"]))?></td>
                                                        <td><a href="<?=SITE?>iade-detay/<?=$iadeler[$i]["iadekodu"]?>">İncele</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td colspan="5">Henüz kayıtlı bir iade bildiriminiz bulunmamaktadır.</td>
                                                </tr>
                                                <?php
                                            }

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>





        <?php
    }
    else
    {
        ?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>uyelik">
        <?php
        exit();
    }
}
else
{
    ?>
    <meta http-equiv="refresh" content="0;url=<?=SITE?>uyelik">
    <?php
    exit();
}
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
        crossorigin="anonymous"></script>