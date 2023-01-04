<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/profil.css">
<?php
if (!empty($_SESSION["uyeID"]) && !empty($_GET["sipariskodu"]))
{
    $uyeID=$VT->filter($_SESSION["uyeID"]);
    $sipariskodu=$VT->filter($_GET["sipariskodu"]);
    $uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyeID,1),"ORDER BY ID ASC",1);
    if ($uyebilgisi!=false)
    {
        $siparisler=$VT->VeriGetir("siparisler","WHERE sipariskodu=? AND uyeID=?",array($sipariskodu,$uyebilgisi[0]["ID"]),"ORDER BY ID ASC",1);
        if ($siparisler!=false)
        {

        }
        else
        {
            ?>
            <meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim#pills-siparis">
            <?php
            exit();
        }

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
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-siparis" role="pills-siparis"
                                 aria-labelledby="pills-siparis-tab">
                                <?php

                                $url = "/hesabim";  // hangi sayfadan gelindigi degerini verir.

                                echo "<a style='color: white;margin-top: -20px;margin-left: -20px;' class=\"sepete-ekle btn\" href='$url'><i class='fa fa-hand-point-left'></i> Hesabıma Dön</a>"; // dugmeye o degeri atiyoruz.

                                ?>
                                <div class="table-responsive">
                                        <form action="#" method="post">
                                            <?
                                            $iadekontrol=$VT->VeriGetir("iadeler","WHERE siparisID=?",array($siparisler[0]["ID"]),"ORDER BY ID ASC",1);
                                            ?>
                                            <table class="table table-hover">
                                                <tr>
                                                    <th>SİPARİŞ KODU</th>
                                                    <th> KDV HARİÇ TUTAR</th>
                                                    <th>KDV TUTAR</th>
                                                    <th>ÖDENEN TUTAR</th>
                                                    <th>ÖDEME TİPİ</th>
                                                    <th>ÖDEME DURUMU</th>
                                                    <th>KARGO BİLGİLERİ</th>
                                                    <th>TARİH</th>
                                                </tr>

                                                <?php


                                                if ($siparisler[0]["odemetipi"]==1){$odemetipi="Kredi Kartı";}
                                                if ($siparisler[0]["odemetipi"]==2){$odemetipi="Havale/Eft İle Ödeme";}
                                                if ($siparisler[0]["odemetipi"]==3){$odemetipi="Kapıda Ödeme";}
                                                ?>
                                                <tr>
                                                    <td><?=$siparisler[0]["sipariskodu"]?></td>
                                                    <td><?=number_format($siparisler[0]["kdvharictutar"],2,".",".")?> TL</td>
                                                    <td><?=number_format($siparisler[0]["kdvtutar"],2,".",".")?> TL</td>
                                                    <td><?=number_format($siparisler[0]["odenentutar"],2,".",".")?> TL</td>
                                                    <td><?=$odemetipi;?></td>
                                                    <td><?php if ($siparisler[0]["durum"]==1)
                                                        {
                                                            ?>
                                                            <strong style="color: #4caf50">ÖDENDİ</strong>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <strong style="color: #FF9800">ÖDEME BEKLİYOR</strong>
                                                            <?php
                                                        } ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($siparisler[0]["kargoadi"]))
                                                        {
                                                            echo $siparisler[0]["kargoadi"]."<br>Takip Numarası: ".$siparisler[0]["takipno"];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?=date("d.m.Y",strtotime($siparisler[0]["tarih"]))?></td>
                                                </tr>

                                            </table>
                                            <h3 style="color: white">SİPARİŞ VERİLEN ÜRÜNLER</h3>
                                            <?php
                                            if ($_POST)
                                            {
                                                if (!empty($_POST["urunID"]) && !empty($_POST["urunID"][0]) && !empty($_POST["metin"]))
                                                {
                                                    $iadesebebi=$VT->filter($_POST["metin"]);
                                                    $iadekodu=$VT->IDGetir("iadeler").rand(1000,9999);
                                                    $iadeID=$VT->IDGetir("iadeler");
                                                    $iadekayit=$VT->SorguCalistir("INSERT INTO iadeler","SET uyeID=?, siparisID=?, iadekodu=?, metin=?, durum=?, tarih=?",array($uyebilgisi[0]["ID"],$siparisler[0]["ID"],$iadekodu,$iadesebebi,1,date("Y-m-d")));
                                                    foreach ($_POST["urunID"] as $urunIDdizi)
                                                    {
                                                        $urunID=$VT->filter($urunIDdizi);
                                                        $iadeurunkayit=$VT->SorguCalistir("INSERT INTO iadeurunler","SET uyeID=?, iadeID=?, siparisurunID=?, tarih=?",array($uyebilgisi[0]["ID"],$iadeID,$urunID,date("Y-m-d")));

                                                    }
                                                    ?>
                                                    <meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">

                                                    <?php
                                                    exit();
                                                }
                                            }
                                            ?>
                                            <table class="table table-hover">
                                                <tr>
                                                    <?php
                                                    if ($iadekontrol!=false || $siparisler[0]["durum"]==2)
                                                    {

                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <th>SEÇ</th>
                                                        <?php
                                                    }
                                                    ?>
                                                    <th>ÜRÜN KODU</th>
                                                    <th>RESİM</th>
                                                    <th>AÇIKLAMA</th>
                                                    <th>ÜRÜN FİYATI</th>
                                                    <th>ADET</th>
                                                    <th>TOPLAM TUTAR</th>
                                                </tr>
                                                <?php
                                                $siparisurunler=$VT->VeriGetir("siparisurunler","WHERE siparisID=?",array($siparisler[0]["ID"]),"ORDER BY ID ASC");
                                                if ($siparisurunler!=false)
                                                {
                                                    for ($i=0;$i<count($siparisurunler);$i++)
                                                    {
                                                        $urunler=$VT->VeriGetir("urunler","WHERE ID=?",array($siparisurunler[$i]["urunID"]),"ORDER BY ID ASC",1);
                                                        if ($urunler!=false)
                                                        {
                                                            $ozellikler="";
                                                            if (!empty($siparisurunler[$i]["varyasyonID"]))
                                                            {
                                                                $varyasyonKontrol=$VT->VeriGetir("urunvaryasyonstoklari","WHERE ID=?",array($siparisurunler[$i]["varyasyonID"]),"ORDER BY ID ASC",1);
                                                                if ($varyasyonKontrol!=false)
                                                                {
                                                                    $varyasyonID=$varyasyonKontrol[0]["varyasyonID"];
                                                                    $secenekID=$varyasyonKontrol[0]["secenekID"];
                                                                    if (strpos($varyasyonID,"@")>0)
                                                                    {
                                                                        $varyasyonDizi=explode("@",$varyasyonID);
                                                                        $secenekDizi=explode("@",$secenekID);
                                                                        for ($x=0;$x<count($varyasyonDizi);$x++)
                                                                        {
                                                                            $varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyonDizi[$x]),"ORDER BY ID ASC",1);
                                                                            $secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secenekDizi[$x]),"ORDER BY ID ASC",1);
                                                                            if ($varyasyonBilgisi!=false && $secenekBilgisi!=false)
                                                                            {
                                                                                $ozellikler.=stripslashes($secenekBilgisi[0]["baslik"])." ".stripslashes($varyasyonBilgisi[0]["baslik"])." ";
                                                                            }
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        $varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyonID),"ORDER BY ID ASC",1);
                                                                        $secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secenekID),"ORDER BY ID ASC",1);
                                                                        if ($varyasyonBilgisi!=false && $secenekBilgisi!=false)
                                                                        {
                                                                            $ozellikler=stripslashes($secenekBilgisi[0]["baslik"])." ".stripslashes($varyasyonBilgisi[0]["baslik"]);
                                                                        }

                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <?php
                                                                if ($iadekontrol!=false || $siparisler[0]["durum"]==2)
                                                                {

                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <td><input type="checkbox" name="urunID[]" value="<?=$siparisurunler[$i]["ID"]?>"></td>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <td><?=$urunler[0]["urunkodu"]?></td>
                                                                <td><img style="height: 50px;width: auto; display: block" src="<?=SITE?>images/urunler/<?=$urunler[0]["resim"]?>" alt=""></td>
                                                                <td><?=stripslashes($urunler[0]["baslik"])?><br><small style="color: #009688;font-size: 13px;"><?=$ozellikler;?></small></td>
                                                                <td><?=number_format($siparisurunler[$i]["uruntutar"],2,".",".")?> TL</td>
                                                                <td><?=$siparisurunler[$i]["adet"]?></td>
                                                                <td><?=number_format($siparisurunler[$i]["toplamtutar"],2,".",".")?> TL</td>
                                                            </tr>
                                                            <?php
                                                        }

                                                    }
                                                }

                                                ?>
                                            </table>
                                            <?php
                                            if ($iadekontrol!=false || $siparisler[0]["durum"]==2)
                                            {

                                            }
                                            else
                                            {
                                                ?>
                                                <table class="table table-hover">
                                                    <tr>
                                                        <td>
                                                            İade Sebebiniz : <br>
                                                            <textarea name="metin" style="width: 100%;height: 220px;"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="submit" name="gonder" value="İade Talebinde Bulun" class="btn_1">
                                                        </td>
                                                    </tr>
                                                </table>
                                                <?php
                                            }
                                            ?>
                                        </form>
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