<link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/urun-sayfasi.css">


<link href="<?=SITE?>css/listing.css" rel="stylesheet">
<?php
if(!empty($_GET["seflink"]))
{
    $seflink=$VT->filter($_GET["seflink"]);
    $kategoriler=$VT->VeriGetir("kategoriler","WHERE durum=? AND seflink=?",array(1,$seflink),"ORDER BY ID ASC",1);
    if($kategoriler!=false)
    {


        ?>

<section class="urun">
    <div class="container">
        <div class="row"  style="margin-top: 20px;">
            <div class="col-12">
                <?php
                $url = SITE;
                echo "<a style='color: white' class=\"sepete-ekle btn\" href='$url'><i class='fa fa-hand-point-left'></i> Anasayfaya Dön</a>"; // dugmeye o degeri atiyoruz.
                ?>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="row justify-content-between">
                            <?php
                                $tablo=$kategoriler[0]["tablo"];
                                if($tablo=="urunler")
                                {
                                    $altkategoriler=$VT->VeriGetir("kategoriler","WHERE durum=? AND tablo=?",array(1,$kategoriler[0]["seflink"]),"ORDER BY ID ASC");
                                    if($altkategoriler!=false)
                                    {
                                        for ($i=0; $i <count($altkategoriler) ; $i++) {
                                            $urunler=$VT->VeriGetir("urunler","WHERE durum=? AND kategori=?",array(1,$altkategoriler[$i]["ID"]),"ORDER BY sirano ASC");
                                            if($urunler!=false)
                                            {
                                                for ($x=0; $x <count($urunler) ; $x++) {
                                                ?>
                                                    <div class="col-3">
                                                        <ul class="urun-left">
                                                            <li class="urun-wrapper text-center">
                                                                <ul>
                                                                    <li class="urun-w-image-wrapper">
                                                                        <img style="width: 100%;height: 250px;object-fit: cover;" src="<?=SITE?>images/urunler/<?=$urunler[$x]["resim"]?>" alt="fasikül">
                                                                    </li>

                                                                    <li class="">
                                                                        <div class="adet-string">
                                                                            <ul class="adet-string-parallax">
                                                                                <li class=""></li>
                                                                                <!-- <li class=""></li>
                                                                                <li class=""></li>
                                                                                <li class=""></li>
                                                                                <li class=""></li>
                                                                                <li class=""></li> -->
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <div style="margin-bottom: 10px;"><?=stripslashes($urunler[$x]["baslik"])?></div>
                                                                    <?php
                                                                    if (!empty($urunler[$x]["indirimlifiyat"]))
                                                                    {
                                                                        $fiyat=$urunler[$x]["indirimlifiyat"].".".$urunler[$x]["indirimlikurus"];
                                                                        $normalfiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];

                                                                        ?>
                                                                        <li class="last-price"><?=number_format($normalfiyat,2,",",".")?> TL</li>
                                                                        <li class="current-price"><?=number_format($fiyat,2,",",".")?> TL</li>
                                                                        <?php
                                                                    }
                                                                    else
                                                                    {
                                                                        $fiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];

                                                                        ?>
                                                                        <li class="current-price"><?=number_format($fiyat,2,",",".")?> TL</li>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </li>

                                                            <li style="margin-top: 5px;" class="sepete-ekle btn"><a style="color: white" href="<?=SITE?>urun/<?=$urunler[$x]["seflink"]?>">Ürüne Git</a></li>


                                                        </ul>
                                                    </div>

                                                    <?php

                                                }
                                            }
                                        }

                                }else {
                                        ?>
        <section class="urun">
        <div class="container">
        <div class="row"  style="margin-top: 20px;">
        <div class="col-12">
        <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
             aria-labelledby="pills-home-tab">
        <div class="row justify-content-between">

            <div class="col-12">
                <ul class="urun-left">
                    <li class="urun-wrapper text-center">
                        İlgili kategoriye ait ürün bulunmamaktadır</li></ul></div>
        </div></div></div></div></div></div></section>
                                        <?php
                                    }
                            }
                                else
                                {
                                    $urunler=$VT->VeriGetir("urunler","WHERE durum=? AND kategori=?",array(1,$kategoriler[0]["ID"]),"ORDER BY sirano ASC");
                                    if($urunler!=false)
                                    {
                                        for ($x=0; $x <count($urunler) ; $x++) {
                                            ?>
                                            <div class="col-3">
                                                <ul class="urun-left">
                                                    <li class="urun-wrapper text-center">
                                                        <ul>
                                                            <li class="urun-w-image-wrapper">
                                                                <img style="width: 100%;height: 250px;object-fit: cover;" src="<?=SITE?>images/urunler/<?=$urunler[$x]["resim"]?>" alt="fasikül">
                                                            </li>

                                                            <li class="">
                                                                <div class="adet-string">
                                                                    <ul class="adet-string-parallax">
                                                                        <li class=""></li>
                                                                        <!-- <li class=""></li>
                                                                        <li class=""></li>
                                                                        <li class=""></li>
                                                                        <li class=""></li>
                                                                        <li class=""></li> -->
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <div style="margin-bottom: 10px;"><?=stripslashes($urunler[$x]["baslik"])?></div>
                                                            <?php
                                                            if (!empty($urunler[$x]["indirimlifiyat"]))
                                                            {
                                                                $fiyat=$urunler[$x]["indirimlifiyat"].".".$urunler[$x]["indirimlikurus"];
                                                                $normalfiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];

                                                                ?>
                                                                <li class="last-price"><?=number_format($normalfiyat,2,",",".")?> TL</li>
                                                                <li class="current-price"><?=number_format($fiyat,2,",",".")?> TL</li>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                $fiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];

                                                                ?>
                                                                <li class="current-price"><?=number_format($fiyat,2,",",".")?> TL</li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>

                                                    <li style="margin-top: 5px;" class="sepete-ekle btn"><a style="color: white" href="<?=SITE?>urun/<?=$urunler[$x]["seflink"]?>">Ürüne Git</a></li>


                                                </ul>
                                            </div>

                                            <?php

                                        }
                                    }
                                }

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <?php
    }
}
?>