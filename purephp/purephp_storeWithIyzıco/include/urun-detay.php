<?php

if(!empty($_GET["seflink"]))
{
    $seflink=$VT->filter($_GET["seflink"]);
    $urunbilgisi=$VT->VeriGetir("urunler","WHERE durum=? AND seflink=?",array(1,$seflink),"ORDER BY ID ASC",1);
    if($urunbilgisi!=false)
    {


        ?>
        <link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/t-shirt-ozellikleri.css">
        <link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/t-shirt.css">
        <style>
            input[type=number], select {
                width: 100%;
                padding: 3px 6px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
        </style>
        <form action="#" method="post" id="urunbilgisi" class="urunbilgisi">
        <section class="t-shirt" style="margin-bottom: 30px;">
            <div class="container">
                <div class="row t-shirt-bg">
                    <?php
                    $url = htmlspecialchars($_SERVER['HTTP_REFERER']);  // hangi sayfadan gelindigi degerini verir.
                    echo "<a style='color: white' class=\"sepete-ekle btn\" href='$url'><i class='fa fa-hand-point-left'></i> Önceki Sayfa</a>"; // dugmeye o degeri atiyoruz.
                    ?>
                    <div class="col-12">
                        <div class="row justify-content-between">
                            <div class="col-xl-3 col-lg-4 col-md-5 p-0">
                                <ul class="urun-left">
                                    <li>
                                        <h2>
                                            <?=stripslashes($urunbilgisi[0]["baslik"])?>
                                        </h2>
                                    </li>

                                    <li class="urun-wrapper text-center">
                                        <ul>
                                            <li class="urun-w-image-wrapper">
                                                <img style="width: 100%;max-height: 400px;" src="<?=SITE?>images/urunler/<?=$urunbilgisi[0]["resim"]?>" alt="fasikül">
                                            </li>

                                            <li class="">
                                                <div class="adet-string">
                                                    <input type="hidden" value="1" id="adet" class="qty2 adet" name="adet">
                                                </div>
                                            </li>

                                            <div class="price-wrapper">

                                                <?php
                                                if (!empty($urunbilgisi[0]["indirimlifiyat"]))
                                                {
                                                    $indirimlifiyat=$urunbilgisi[0]["indirimlifiyat"].".".$urunbilgisi[0]["indirimlikurus"];
                                                    $normalfiyat=$urunbilgisi[0]["fiyat"].".".$urunbilgisi[0]["kurus"];
                                                    $hesapla=(($indirimlifiyat/$normalfiyat)*100);
                                                    $indirimorani=round(100-$hesapla);
                                                    ?><div class="price-left">%<?=$indirimorani?></div><?php } ?>


                                                <div class="price-right">

                                                    <?php
                                                    if (!empty($urunbilgisi[0]["indirimlifiyat"]))
                                                    {
                                                        $fiyat=$urunbilgisi[0]["indirimlifiyat"].".".$urunbilgisi[0]["indirimlikurus"];
                                                        $normalfiyat=$urunbilgisi[0]["fiyat"].".".$urunbilgisi[0]["kurus"];
                                                        if($urunbilgisi[0]["kdvdurum"]==1)
                                                        {
                                                            if($urunbilgisi[0]["kdvoran"]>9)
                                                            {
                                                                $oran="1.".$urunbilgisi[0]["kdvoran"];
                                                            }
                                                            else
                                                            {
                                                                $oran="1.0".$urunbilgisi[0]["kdvoran"];
                                                            }
                                                            $fiyat=($fiyat/$oran);/*kdvsiz hali*/
                                                            $normalfiyat=($normalfiyat/$oran);
                                                        }

                                                        ?>
                                                        <li class="current-price"><?=number_format($urunbilgisi[0]["indirimlifiyat"],2,",",".")?> TL</li>
                                                        <li class="last-price"><?=number_format($urunbilgisi[0]["fiyat"],2,",",".")?> TL</li>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        $fiyat=$urunbilgisi[0]["fiyat"].".".$urunbilgisi[0]["kurus"];
                                                        if($urunbilgisi[0]["kdvdurum"]==1)
                                                        {
                                                            if($urunbilgisi[0]["kdvoran"]>9)
                                                            {
                                                                $oran="1.".$urunbilgisi[0]["kdvoran"];
                                                            }
                                                            else
                                                            {
                                                                $oran="1.0".$urunbilgisi[0]["kdvoran"];
                                                            }
                                                            $fiyat=($fiyat/$oran);/*kdvsiz hali*/
                                                        }

                                                        ?>
                                                        <li class="current-price"><?=number_format($urunbilgisi[0]["fiyat"],2,",",".")?> TL</li>

                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </ul>
                                    </li>

                                    <li class="sepete-ekle btn d-block"><a onclick="sepeteEkle('<?=SITE?>',<?=$urunbilgisi[0]['ID']?>);" class="btn_1">SEPETE EKLE</a></li>

                                    <li class="diger-urunler">
                                        <h3 class="text-start py-2">
                                            DİĞER ÜRÜNLER
                                        </h3>

                                        <ul class="diger-urunler-parallax">
                                            <?
                                            $urunler=$VT->VeriGetir("urunler","WHERE durum=? AND kategori=? AND ID<>?",array(1,$urunbilgisi[0]["kategori"],$urunbilgisi[0]["ID"]),"ORDER BY RAND() ASC",16);
                                            if ($urunler!=false)
                                            {
                                                for ($i=0;$i<count($urunler);$i++)
                                                {
                                                    ?>
                                                    <li>
                                                        <a href="<?=SITE?>urun/<?=$urunler[$i]["seflink"]?>">
                                                            <div class="diger-urunler-parallax-img-wrapper">
                                                                <img style="width: 90px;height: 130px;object-fit: cover;" src="<?=SITE?>images/urunler/<?=$urunler[$i]["resim"]?>" alt="fasikül">

                                                            </div>
                                                            <h2 style="color: white;font-size: 16px;margin-top: -14px;margin-bottom: -18px;"><?=stripslashes($urunler[$i]["baslik"])?></h2>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }

                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-8 col-lg-7 col-md-6 urun-right mt-md-0 mt-4 urun-right">
                                <div class="row genel-bilgiler justify-content-center">
                                    <div class="col-11">
                                        <div class="d-flex justify-content-between">
                                            <div class="genel-bilgiler-left">
                                                <h3>Genel Bilgiler</h3>
                                            </div>

                                            <div class="genel-bilgiler-right">
                                                <?
                                                if (!empty($_SESSION["uyeID"]))
                                                {
                                                    echo "Hoşgeldiniz ".$_SESSION["uyeAdi"];
                                                }
                                                else
                                                {

                                                    ?>
                                                    <a href="<?=SITE?>uyelik" class="btn">Giriş Yap</a>

                                                    <?php
                                                }
                                                ?>
                                                <div class="btn sepet-icon">
                                                    <a href="<?=SITE?>sepet"><img src="<?=SITE?>images/icons/shopping-cart.svg" alt="icon"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row bilgiler-main justify-content-center">
                                    <div class="col-11">


                                        <?
                                        if (!empty($urunbilgisi[0]["yazarAd"]))
                                        {
                                            ?>
                                            <div  class="row k-y-bilgileri justify-content-center">
                                                <div class="col-11" style="margin-top: -20px;">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            Kitap Bilgileri
                                                        </div>

                                                        <div class="offset-4 col-5">
                                                            Yazar Bilgileri
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <ul class="ikili-ayır">
                                                        <li>
                                                            <ul class="ikili">
                                                                <li class="ikili-item-1">
                                                                    <?=stripslashes($urunbilgisi[0]["ek1"])?>
                                                                </li>

                                                                <li class="ikili-item-2">
                                                                    <img src="<?=stripslashes($urunbilgisi[0]["ek111"])?>" alt="icon">
                                                                    <span><?=stripslashes($urunbilgisi[0]["ek11"])?></span>
                                                                </li>
                                                            </ul>
                                                        </li>

                                                        <li>
                                                            <ul class="ikili">
                                                                <li class="ikili-item-1">
                                                                    <?=stripslashes($urunbilgisi[0]["ek2"])?>
                                                                </li>

                                                                <li class="ikili-item-2">
                                                                    <img src="<?=stripslashes($urunbilgisi[0]["ek222"])?>" alt="icon">
                                                                    <span><?=stripslashes($urunbilgisi[0]["ek22"])?></span>
                                                                </li>
                                                            </ul>
                                                        </li>

                                                        <li>
                                                            <ul class="ikili">
                                                                <li class="ikili-item-1">
                                                                    <?=stripslashes($urunbilgisi[0]["ek3"])?>
                                                                </li>

                                                                <li class="ikili-item-2">
                                                                    <img src="<?=stripslashes($urunbilgisi[0]["ek333"])?>" alt="icon">
                                                                    <span><?=stripslashes($urunbilgisi[0]["ek33"])?></span>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="col-lg-3 col-6">
                                                    <ul class="ikili-ayır">
                                                        <li>
                                                            <ul class="ikili">
                                                                <li class="ikili-item-1">
                                                                    <?=stripslashes($urunbilgisi[0]["ek4"])?>
                                                                </li>

                                                                <li class="ikili-item-2">
                                                                    <img src="<?=stripslashes($urunbilgisi[0]["ek444"])?>" alt="icon">
                                                                    <span><?=stripslashes($urunbilgisi[0]["ek44"])?></span>
                                                                </li>
                                                            </ul>
                                                        </li>

                                                        <li>
                                                            <ul class="ikili">
                                                                <li class="ikili-item-1">
                                                                    <?=stripslashes($urunbilgisi[0]["ek5"])?>
                                                                </li>

                                                                <li class="ikili-item-2">
                                                                    <img src="<?=stripslashes($urunbilgisi[0]["ek555"])?>"
                                                                         alt="icon">
                                                                    <span><?=stripslashes($urunbilgisi[0]["ek55"])?></span>
                                                                </li>
                                                            </ul>
                                                        </li>

                                                        <li>
                                                            <ul class="ikili">
                                                                <li class="ikili-item-1">
                                                                    <?=stripslashes($urunbilgisi[0]["ek6"])?>
                                                                </li>

                                                                <li class="ikili-item-2">
                                                                    <img src="<?=stripslashes($urunbilgisi[0]["ek666"])?>" alt="icon">
                                                                    <span><?=stripslashes($urunbilgisi[0]["ek66"])?></span>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="offset-lg-1 col-lg-5 mt-lg-0 mt-4">
                                                    <ul class="bilgiler-author">
                                                        <li class="bilgiler-image-wrapper">
                                                            <img src="<?=SITE?>images/urunler/<?php echo $urunbilgisi[0]["yazarResim"];?>" alt="book-author">
                                                        </li>

                                                        <li>
                                                            <h3><?=stripslashes($urunbilgisi[0]["yazarAd"])?></h3>
                                                        </li>

                                                        <li>
                                                            <p><?=stripslashes($urunbilgisi[0]["yazarDetay"])?></p>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                            <?php
                                        }
                                        ?>









                                        <div style="margin-top: 15px;" class="col-xl-8 col-lg-8 col-md-8 col-8">
                                            <?php
                                            $varyasyonlar=$VT->VeriGetir("urunvaryasyonlari","WHERE urunID=?",array($urunbilgisi[0]["ID"]),"ORDER BY ID ASC");
                                            if($varyasyonlar!=false)
                                            {
                                                for ($e=0;$e<count($varyasyonlar);$e++)
                                                {
                                                    ?>

                                                    <div class="row">
                                                        <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong><?=stripslashes($varyasyonlar[$e]["baslik"])?></strong></label>
                                                        <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                                            <div class="custom-select-form">
                                                                <select class="wide" name="varyasyon[]">
                                                                    <?php
                                                                    $secenekler=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE urunID=? AND varyasyonID=?",array($urunbilgisi[0]["ID"],$varyasyonlar[$e]["ID"]),"ORDER BY ID ASC");
                                                                    if($secenekler!=false)
                                                                    {
                                                                        for ($t=0;$t<count($secenekler);$t++)
                                                                        {
                                                                            ?>
                                                                            <option value="<?=$secenekler[$t]["ID"]?>"><?=stripslashes($secenekler[$t]["baslik"])?></option>
                                                                            <?php
                                                                        }
                                                                    }

                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row daha-fazla f-18 justify-content-center">
                                    <div class="col-11">
                                        <div class="row justify-content-between">
                                            <div class="col-12">
                                                Daha Fazla
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-f-options d-f-options-1 justify-content-center">
                                    <div class="col-11">
                                        <div class="row justify-content-between">
                                            <div class="col-12 d-f-options-icerik">
                                                <div class="d-fazla-image-wrapper">
                                                    <img src="<?=SITE?>images/icons/d-f-list-icon.svg" alt="icon">
                                                </div>

                                                <div class="f-18">
                                                    İçerik
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-f-options d-f-options-2 justify-content-center">
                                    <div class="col-11">
                                        <div class="row justify-content-between">
                                            <div class="col-12 d-f-options-icerik">
                                                <div class="d-fazla-image-wrapper">
                                                    <img src="<?=SITE?>images/icons/d-f-play.svg" alt="icon">
                                                </div>

                                                <div class="f-18">
                                                    Videolar
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-f-options d-f-options-3 justify-content-center">
                                    <div class="col-11">
                                        <div class="row justify-content-between">
                                            <div class="col-12 d-f-options-icerik">
                                                <div class="d-fazla-image-wrapper">
                                                    <img src="<?=SITE?>images/icons/d-f-picture-book.svg" alt="icon">
                                                </div>

                                                <div class="f-18">
                                                    Fotoğraflar
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-f-options d-f-options-4 justify-content-center">
                                    <div class="col-11">
                                        <div class="row justify-content-between">
                                            <div class="col-12 d-f-options-icerik">
                                                <div class="d-fazla-image-wrapper">
                                                    <img src="<?=SITE?>images/icons/d-f-comment.svg" alt="icon">
                                                </div>

                                                <div class="f-18">
                                                    Yorumlar
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </form>

        <?php
    }

    else
    {
        ?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>">
        <?php
        exit();
    }
}
else
{
    ?>
    <meta http-equiv="refresh" content="0;url=<?=SITE?>">
    <?php
    exit();
}
?>