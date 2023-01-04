<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/profil.css">
<?php
if (!empty($_SESSION["uyeID"]) && !empty($_GET["iadekodu"]))
{
    $uyeID=$VT->filter($_SESSION["uyeID"]);
    $iadekodu=$VT->filter($_GET["iadekodu"]);
    $uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyeID,1),"ORDER BY ID ASC",1);
    if ($uyebilgisi!=false)
    {
        $iadeler=$VT->VeriGetir("iadeler","WHERE iadekodu=? AND uyeID=?",array($iadekodu,$uyebilgisi[0]["ID"]),"ORDER BY ID ASC",1);
        if ($iadeler!=false)
        {

        }
        else
        {
            ?>
            <meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">
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
                                        $iadekontrol=$VT->VeriGetir("iadeler","WHERE siparisID=?",array($iadeler[0]["ID"]),"ORDER BY ID ASC",1);
                                        ?>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>İADE KODU</th>
                                                <th>ALICI BİLGİSİ</th>
                                                <th>ADRES BİLGİSİ</th>
                                                <th>DURUM</th>
                                                <th>TARİH</th>
                                                <th>İADE SEBEBİ</th>
                                                <th>İADE CEVABI</th>
                                            </tr>

                                            <td><?=$iadeler[0]["iadekodu"]?></td>
                                            <td>
                                                <?php
                                                if ($uyebilgisi[0]["tipi"]==1)
                                                {
                                                    $adsoyad=stripslashes($uyebilgisi[0]["ad"]." ".$uyebilgisi[0]["soyad"]);
                                                }
                                                else
                                                {
                                                    $adsoyad=stripslashes($uyebilgisi[0]["firmaadi"]);

                                                }
                                                ?>
                                                <?=$adsoyad;?>
                                            </td>
                                            <td>
                                                <?php
                                                $ilBilgi=$VT->VeriGetir("il","WHERE ID=?",array($uyebilgisi[0]["ilID"]),"ORDER BY ID ASC",1);
                                                echo stripslashes($uyebilgisi[0]["adres"]." ".$uyebilgisi[0]["ilce"]);
                                                if ($ilBilgi!=false)
                                                {
                                                    echo "/".mb_convert_case($ilBilgi[0]["ADI"],MB_CASE_UPPER,"UTF-8");
                                                }
                                                ?>
                                            </td>
                                            <td><?php if ($iadeler[0]["durum"]==1)
                                                {
                                                    ?>
                                                    <strong style="color: #FF9800">BEKLİYOR</strong>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <strong style="color: #4caf50">CEVAPLANDI</strong>
                                                    <?php
                                                } ?></td>
                                            <td><?=date("d.m.Y",strtotime($iadeler[0]["tarih"]))?></td>
                                            <td><?=stripslashes($iadeler[0]["metin"])?></td>
                                            <td><?=stripslashes($iadeler[0]["cevap"])?></td>

                                        </table>
                                        <h3 style="color: white">İADE EDİLEN ÜRÜNLER</h3>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>ÜRÜN KODU</th>
                                                <th>RESİM</th>
                                                <th>AÇIKLAMA</th>
                                                <th>ÜRÜN FİYATI</th>
                                                <th>ADET</th>
                                                <th>TOPLAM TUTAR</th>
                                            </tr>
                                            <?php
                                            $iadeurunler=$VT->VeriGetir("iadeurunler","WHERE uyeID=? AND iadeID=?",array($uyebilgisi[0]["ID"],$iadeler[0]["ID"]));
                                            if($iadeurunler!=false)
                                            {
                                                for ($q=0;$q<count($iadeurunler);$q++)
                                                {
                                                    $siparisurunler=$VT->VeriGetir("siparisurunler","WHERE ID=?",array($iadeurunler[$q]["siparisurunID"]),"ORDER BY ID ASC",1);
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
                                                }
                                            }


                                            ?>
                                        </table>
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