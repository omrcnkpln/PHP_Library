<link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/sepetim.css">

<link href="<?=SITE?>dest/css/default/card.css" rel="stylesheet">
<style>

    @media (max-width: 767px) {
        .mo {
            display: none !important;
        }
    }
    @media (min-width: 767px) {
        .ma {
            display: none !important;
        }
    }

</style>


<?

if (!empty($_SESSION["sepet"]))

{

?>

<?php

if ($_POST)

{

    if (!empty($_POST["adet"]))

    {

        $toplamNesneAdeti=count($_POST["adet"]);

        $adetsayaci=0;

        foreach ($_SESSION["sepet"] as $urunID => $bilgi)
        {

            $urunbilgisi=$VT->VeriGetir("urunler","WHERE durum=? AND ID=?",array(1,$urunID),"ORDER BY ID ASC",1);

            if ($urunbilgisi!=false)
            {

                if ($bilgi["varyasyondurumu"]!=false)

                {

                    if (!empty($_SESSION["sepetVaryasyon"]))

                    {

                        foreach ($_SESSION["sepetVaryasyon"][$urunbilgisi[0]["ID"]] as $secenekID => $secenekAdet)

                        {

                            $stokTablo=$VT->VeriGetir("urunvaryasyonstoklari","WHERE ID=? AND urunID=?",array($secenekID,$urunbilgisi[0]["ID"]),"ORDER BY ID ASC",1);

                            if ($stokTablo!=false)

                            {

                                $varyasyonOzellikleri="";

                                $varyasyonID=$stokTablo[0]["varyasyonID"];

                                $secimID=$stokTablo[0]["secenekID"];



                                if(strpos($varyasyonID,"@")!=false)

                                {

                                    /*Eğer Birden fazla varyasyon var ise*/

                                    $varyasyondizi=explode("@",$varyasyonID);

                                    $secenekdizi=explode("@",$secimID);

                                    for ($i=0;$i<count($varyasyondizi);$i++)

                                    {

                                        $varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyondizi[$i]),"ORDER BY ID ASC",1);

                                        $secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secenekdizi[$i]),"ORDER BY ID ASC",1);

                                        if ($varyasyonBilgisi!=false && $secenekBilgisi!=false)

                                        {

                                            $varyasyonOzellikleri.=stripslashes($secenekBilgisi[0]["baslik"])." ".$varyasyonBilgisi[0]["baslik"]." ";

                                        }

                                    }

                                }

                                else

                                {

                                    /*Eğer 1 varyasyon var ise*/

                                    $varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyonID),"ORDER BY ID ASC",1);

                                    $secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secimID),"ORDER BY ID ASC",1);

                                    if ($varyasyonBilgisi!=false && $secenekBilgisi!=false)

                                    {

                                        $varyasyonOzellikleri=stripslashes($secenekBilgisi[0]["baslik"])." ".$varyasyonBilgisi[0]["baslik"];

                                    }



                                }



                                /*Burada varyasyonlu ürün stok kontrolü yapılacak*/



                                $adetpost=$VT->filter($_POST["adet"][$adetsayaci]);

                                if ($stokTablo[0]["stok"]>=$adetpost)

                                {

                                    $_SESSION["sepetVaryasyon"][$urunbilgisi[0]["ID"]][$stokTablo[0]["ID"]]["adet"]=$adetpost;

                                }



                            }

                            $adetsayaci++;



                        }

                    }

                }

                else

                {

                    /*Burada varyasyonsuz ürün stok kontrolü yapılacak*/



                    $adetpost=$VT->filter($_POST["adet"][$adetsayaci]);



                    if ($urunbilgisi[0]["stok"]>=$adetpost)

                    {

                        $_SESSION["sepet"][$urunbilgisi[0]["ID"]]["adet"]=$adetpost;

                    }



                    $adetsayaci++;

                }
            }
        }
        ?>

<div class="container" style="margin-top: 15px;">

        <div class="alert alert-success">Sepetiniz Başarıyla Güncellenmiştir</div>

</div>



        <?php

    }

}

?>



<?php
if(isset($_POST['kupon']) && $_POST['kupon']) {
	$kuponBilgisin=$VT->VeriGetir("kuponlar","WHERE kod=?",array($_POST['kupon']),"ORDER BY kod ASC",1);
	$nowtime = date('Y-m-d');
	$kupontime = $kuponBilgisin[0]["sure"];
	$kupondurum = $kuponBilgisin[0]["durum"];
	if($kupondurum == 1) { 
		if(strtotime($nowtime) >= strtotime($kupontime)) {
?>
		<div class="container" style="margin-top: 15px;">
		        <div class="alert alert-danger">Kuponun süresi sona erdi.</div>

		</div>
	<?php } ?>
<?php } else { ?>
<div class="container" style="margin-top: 15px;">
        <div class="alert alert-danger">Kuponun kodu aktif değil.</div>
</div>
<?php } } ?>
<!-- /page_header -->



<?php

$sepetkdvharictutar=0;

$sepetkdvtutar18=0;

$sepetkdvtutar8=0;

$sepetkdvtutar6=0;

$sepetkdvtutar1=0;

$sepetTutar=0;



?>

<div class="main" style="margin-bottom: 20px;margin-top: 20px;">

    <form action="#" method="post">

    <section class="basket">

        <div class="container basket-bg">

            <?php

            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);  // hangi sayfadan gelindigi degerini verir.

            echo "<a style='color: white;margin-top: -20px;margin-left: -20px;' class=\"sepete-ekle btn\" href='$url'><i class='fa fa-hand-point-left'></i> Önceki Sayfa</a>"; // dugmeye o degeri atiyoruz.

            ?>

            <div class="row justify-content-between">



                <!-- order-lg-1 order-2 -->

                <div class="col-lg-7 basket-listele pt-lg-0 pt-4">

                    <div class="row basket-baslik">

                        <ul>

                            <li>

                                <h1>Sepetim</h1>

                            </li>



                            <li>

                                <p id="giftButton" class="hediye-kuponu-item">

                                    Hediye Kuponunuz var mı?

                                </p>

                            </li>

                        </ul>

                    </div>



                    <div class="row">

                        <div class="col urun-list">



                            <?php





                            foreach ($_SESSION["sepet"] as $urunID => $bilgi)

                            {

                                $urunbilgisi=$VT->VeriGetir("urunler","WHERE durum=? AND ID=?",array(1,$urunID),"ORDER BY ID ASC",1);

                                if ($urunbilgisi!=false)

                                {

                                    if ($bilgi["varyasyondurumu"]!=false)

                                    {

                                        if (!empty($_SESSION["sepetVaryasyon"]))

                                        {

                                            foreach ($_SESSION["sepetVaryasyon"][$urunbilgisi[0]["ID"]] as $secenekID => $secenekAdet)

                                            {

                                                $stokTablo=$VT->VeriGetir("urunvaryasyonstoklari","WHERE ID=? AND urunID=?",array($secenekID,$urunbilgisi[0]["ID"]),"ORDER BY ID ASC",1);

                                                if ($stokTablo!=false)

                                                {

                                                    $varyasyonOzellikleri="";

                                                    $varyasyonID=$stokTablo[0]["varyasyonID"];

                                                    $secimID=$stokTablo[0]["secenekID"];



                                                    if(strpos($varyasyonID,"@")!=false)

                                                    {

                                                        /*Eğer Birden fazla varyasyon var ise*/

                                                        $varyasyondizi=explode("@",$varyasyonID);

                                                        $secenekdizi=explode("@",$secimID);

                                                        for ($i=0;$i<count($varyasyondizi);$i++)

                                                        {

                                                            $varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyondizi[$i]),"ORDER BY ID ASC",1);

                                                            $secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secenekdizi[$i]),"ORDER BY ID ASC",1);

                                                            if ($varyasyonBilgisi!=false && $secenekBilgisi!=false)

                                                            {

                                                                $varyasyonOzellikleri.=stripslashes($secenekBilgisi[0]["baslik"])." ".$varyasyonBilgisi[0]["baslik"]." ";

                                                            }

                                                        }

                                                    }

                                                    else

                                                    {

                                                        /*Eğer 1 varyasyon var ise*/

                                                        $varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyonID),"ORDER BY ID ASC",1);

                                                        $secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secimID),"ORDER BY ID ASC",1);

                                                        if ($varyasyonBilgisi!=false && $secenekBilgisi!=false)

                                                        {

                                                            $varyasyonOzellikleri=stripslashes($secenekBilgisi[0]["baslik"])." ".$varyasyonBilgisi[0]["baslik"];

                                                        }



                                                    }



                                                    ?>

                                                    <div class="row basket-list">

                                                        <div class="col-6 basket-list-l">

                                                            <ul>

                                                                <li class="basket-list-img-wrapper">

                                                                    <img src="<?=SITE?>images/urunler/<?=$urunbilgisi[0]["resim"]?>" alt="img">

                                                                </li>



                                                                <li>

                                                                    <h3><?=stripslashes($urunbilgisi[0]["baslik"])?></h3>

                                                                    <p>#STK—001</p>

                                                                    <small style="float: left;color: #d24474;font-weight: 400;"><?=$varyasyonOzellikleri?></small>

                                                                </li>

                                                            </ul>

                                                        </div>



                                                        <div class="col-6 basket-list-r">

                                                            <ul>

                                                                <li class="basket-a-e decreaseProduct">

                                                                    -

                                                                </li>



                                                                <input type="text" value="<?=$secenekAdet["adet"]?>" id="adet" class="basket-list-item-count productCountItem adet" name="adet[]">

                                                                <li class="basket-a-e increaseProduct">

                                                                    +

                                                                </li>

                                                            </ul>



                                                            <div class="fiyat">

                                                                <input type="hidden" value="20">

                                                                <?php

                                                                if (!empty($urunbilgisi[0]["indirimlifiyat"]))

                                                                {

                                                                    $fiyat=$urunbilgisi[0]["indirimlifiyat"].".".$urunbilgisi[0]["indirimlikurus"];

                                                                }

                                                                else

                                                                {

                                                                    $fiyat=$urunbilgisi[0]["fiyat"].".".$urunbilgisi[0]["kurus"];

                                                                }



                                                                ?>

                                                                <span class="fiyat"><?php

                                                                    $toplamtutar=($fiyat*$secenekAdet["adet"]);

                                                                    if ($urunbilgisi[0]["kdvdurum"]==1)

                                                                    {

                                                                        /*KDV'Lİ FİYAT*/



                                                                        if ($urunbilgisi[0]["kdvoran"]>9)

                                                                        {

                                                                            $oran="1.".$urunbilgisi[0]["kdvoran"];

                                                                        }

                                                                        else

                                                                        {

                                                                            $oran="1.0".$urunbilgisi[0]["kdvoran"];

                                                                        }

                                                                        $kdvlifiyat=$toplamtutar;

                                                                        $kdvsizfiyat=($toplamtutar/$oran); /*Kdv'siz hali*/

                                                                        $kdvtutari=($toplamtutar-$kdvsizfiyat); /*Kdv Fiyatı*/

                                                                        if ($urunbilgisi[0]["kdvoran"]==18){$sepetkdvtutar18=($sepetkdvtutar18+$kdvtutari);}

                                                                        if ($urunbilgisi[0]["kdvoran"]==8){$sepetkdvtutar8=($sepetkdvtutar8+$kdvtutari);}

                                                                        if ($urunbilgisi[0]["kdvoran"]==6){$sepetkdvtutar6=($sepetkdvtutar6+$kdvtutari);}

                                                                        if ($urunbilgisi[0]["kdvoran"]==1){$sepetkdvtutar1=($sepetkdvtutar1+$kdvtutari);}

                                                                        $sepetkdvharictutar=($sepetkdvharictutar+$kdvsizfiyat);

                                                                        $sepetTutar=($sepetTutar+$kdvlifiyat);
                                                                    }

                                                                    else

                                                                    {

                                                                        /*KDV HARİÇ FİYAT*/

                                                                        $oran=$urunbilgisi[0]["kdvoran"];

                                                                        $kdvsizfiyat=$toplamtutar;

                                                                        $kdvtutari=(($kdvsizfiyat*$oran)/100);

                                                                        $kdvlifiyat=($kdvsizfiyat+$kdvtutari);

                                                                        if ($urunbilgisi[0]["kdvoran"]==18){$sepetkdvtutar18=($sepetkdvtutar18+$kdvtutari);}

                                                                        if ($urunbilgisi[0]["kdvoran"]==8){$sepetkdvtutar8=($sepetkdvtutar8+$kdvtutari);}

                                                                        if ($urunbilgisi[0]["kdvoran"]==6){$sepetkdvtutar6=($sepetkdvtutar6+$kdvtutari);}

                                                                        if ($urunbilgisi[0]["kdvoran"]==1){$sepetkdvtutar1=($sepetkdvtutar1+$kdvtutari);}

                                                                        $sepetkdvharictutar=($sepetkdvharictutar+$kdvsizfiyat);

                                                                        $sepetTutar=($sepetTutar+$kdvlifiyat);

                                                                    }

                                                                    echo number_format($toplamtutar,2,",",".")." TL";

                                                                    ?></span>

                                                            </div>



                                                            <div class="cikar">

                                                                <a style="color: white;font-size: 23px;" href="<?=SITE?>sepet-sil/<?=$urunbilgisi[0]["ID"]?>/<?=$secenekID?>"><i class="fa fa-trash"></i></a>

                                                            </div>

                                                        </div>



                                                        <div class="dropdown-divider"></div>

                                                    </div>

                                                    <?php



                                                }



                                            }

                                        }

                                    }

                                    else

                                    {

                                        ?>





                                        <div class="row basket-list">

                                            <div class="col-6 basket-list-l">

                                                <ul>

                                                    <li class="basket-list-img-wrapper">

                                                        <img src="<?=SITE?>images/urunler/<?=$urunbilgisi[0]["resim"]?>" alt="img">

                                                    </li>



                                                    <li>

                                                        <h3><?=stripslashes($urunbilgisi[0]["baslik"])?></h3>



                                                        <p>#STK—001</p>

                                                    </li>

                                                </ul>

                                            </div>



                                            <div class="col-6 basket-list-r">

                                                <ul>

                                                    <li class="basket-a-e decreaseProduct">

                                                        -

                                                    </li>



                                                    <input type="text" value="<?=$bilgi["adet"]?>" id="adet" class="basket-list-item-count productCountItem adet" name="adet[]">



                                                    <li class="basket-a-e increaseProduct">

                                                        +

                                                    </li>

                                                </ul>



                                                <div class="fiyat">

                                                    <input type="hidden" value="20">

                                                    <span class="fiyat"><?php

                                                        if (!empty($urunbilgisi[0]["indirimlifiyat"]))

                                                        {

                                                            $fiyat=$urunbilgisi[0]["indirimlifiyat"].".".$urunbilgisi[0]["indirimlikurus"];

                                                        }

                                                        else

                                                        {

                                                            $fiyat=$urunbilgisi[0]["fiyat"].".".$urunbilgisi[0]["kurus"];

                                                        }



                                                        ?></span>

                                                    <span class="fiyat"><?php
                                                			
                                                        $toplamtutar=($fiyat*$bilgi["adet"]);

                                                        if ($urunbilgisi[0]["kdvdurum"]==1)

                                                        {

                                                            /*KDV'Lİ FİYAT*/

                                                            if ($urunbilgisi[0]["kdvoran"]>9)

                                                            {

                                                                $oran="1.".$urunbilgisi[0]["kdvoran"];

                                                            }

                                                            else

                                                            {

                                                                $oran="1.0".$urunbilgisi[0]["kdvoran"];

                                                            }

                                                            $kdvlifiyat=$toplamtutar;

                                                            $kdvsizfiyat=($toplamtutar/$oran); /*Kdv'siz hali*/

                                                            $kdvtutari=($toplamtutar-$kdvsizfiyat); /*Kdv Fiyatı*/

                                                            if ($urunbilgisi[0]["kdvoran"]==18){$sepetkdvtutar18=($sepetkdvtutar18+$kdvtutari);}

                                                            if ($urunbilgisi[0]["kdvoran"]==8){$sepetkdvtutar8=($sepetkdvtutar8+$kdvtutari);}

                                                            if ($urunbilgisi[0]["kdvoran"]==6){$sepetkdvtutar6=($sepetkdvtutar6+$kdvtutari);}

                                                            if ($urunbilgisi[0]["kdvoran"]==1){$sepetkdvtutar1=($sepetkdvtutar1+$kdvtutari);}

                                                            $sepetkdvharictutar=($sepetkdvharictutar+$kdvsizfiyat);

                                                            $sepetTutar=($sepetTutar+$kdvlifiyat);
                                                        }

                                                        else

                                                        {

                                                            /*KDV HARİÇ FİYAT*/

                                                            $oran=$urunbilgisi[0]["kdvoran"];

                                                            $kdvsizfiyat=$toplamtutar;

                                                            $kdvtutari=(($kdvsizfiyat*$oran)/100);

                                                            $kdvlifiyat=($kdvsizfiyat+$kdvtutari);

                                                            if ($urunbilgisi[0]["kdvoran"]==18){$sepetkdvtutar18=($sepetkdvtutar18+$kdvtutari);}

                                                            if ($urunbilgisi[0]["kdvoran"]==8){$sepetkdvtutar8=($sepetkdvtutar8+$kdvtutari);}

                                                            if ($urunbilgisi[0]["kdvoran"]==6){$sepetkdvtutar6=($sepetkdvtutar6+$kdvtutari);}

                                                            if ($urunbilgisi[0]["kdvoran"]==1){$sepetkdvtutar1=($sepetkdvtutar1+$kdvtutari);}

                                                            $sepetkdvharictutar=($sepetkdvharictutar+$kdvsizfiyat);

                                                            $sepetTutar=($sepetTutar+$kdvlifiyat);
                                                        }

                                                        echo number_format($toplamtutar,2,",",".")." TL";

                                                        ?></span>

                                                </div>



                                                <div class="cikar">

                                                    <a  style="color: white;font-size: 23px;"  href="<?=SITE?>sepet-sil/<?=$urunbilgisi[0]["ID"]?>"><i class="fa fa-trash"></i></a>



                                                </div>

                                            </div>



                                            <div class="dropdown-divider"></div>

                                        </div>

                                        <?php

                                    }







                                }

                            }



                            ?>





                        </div>

                    </div>



                    <div class="row basket-sum">

                        <div class="col-sm-3 text-left">

                            <button style="color: white;" type="submit" class="btn">Sepeti Güncelle</button>

                        </div>

                        <div class="col-sm-3 text-left">

                            <a style="color: white;" href="<?=SITE?>sepet-sil/clear" type="button" class="btn">Sepeti Temizle</a>

                        </div>
                        
                        <div class="col-sm-5" style="color: white">

                        	<table class="table table-bordered">
	                                            <tbody>

	                                            <tr>
	                            <td class="text-right"><strong style="color: white">Kargo Ücreti:</strong></td>
	                            <td class="text-right" style="color: white">
                                    <?php
                                                $kargoBilgisi=$VT->VeriGetir("kargolimit","WHERE durum=?",array(1),"ORDER BY ID ASC",1);
                                                $kargo_fiyat = $kargoBilgisi[0]["sinir"];

                                                if($sepetTutar >= $kargo_fiyat) {
                                                    $kargotutar = 0;
                                                } else {
                                                    $kargotutar = $kargoBilgisi[0]["kargotutar"];
                                                }
                                                ?>
                                    <?=number_format($kargotutar,2,",",".")?> TL</td>

	                        </tr>

                            <?php
                                if($sepetkdvtutar1>0)
                                {
                                    ?><tr>
                                    <td class="text-right"><strong style="color: white">KDV Tutar (%1)</strong>
                                    <td class="text-right" style="color: white"><?=number_format(($sepetkdvtutar1),2,",",".")?> TL</td>
                            </tr>
                            <?php
                                }
                                if($sepetkdvtutar6>0)
                                {
                                    ?><tr>
                                    <td class="text-right"><strong style="color: white">KDV Tutar (%6)</strong>
                                    <td class="text-right" style="color: white"><?=number_format(($sepetkdvtutar6),2,",",".")?> TL</td>
                            </tr>
                                    <?php
                                }
                                if($sepetkdvtutar8>0)
                                {
                                    ?><tr>
                                    <td class="text-right"><strong style="color: white">KDV Tutar (%8)</strong>
                                    <td class="text-right" style="color: white"><?=number_format(($sepetkdvtutar8),2,",",".")?> TL</td>
                                    </tr>
                                <?php
                                }
                                if($sepetkdvtutar18>0)
                                {
                                    ?>
                                <tr>
                                    <td class="text-right"><strong style="color: white">KDV Tutar (%18)</strong>
                                    <td class="text-right" style="color: white"><?=number_format(($sepetkdvtutar18),2,",",".")?> TL</td>
                                </tr>
                                <?php
                                }
                                ?>
                            <tr>
                                <td class="text-right"><strong style="color: white">KDV Hariç Tutar:</strong></td>
                                <td class="text-right" style="color: white"><?=number_format(($sepetkdvharictutar),2,",",".")?> TL</td>
                            </tr>
                                                <tr>
                                <td class="text-right"><strong style="color: white">Toplam KDV Tutar:</strong></td>
                                <td class="text-right" style="color: white"><?=number_format(($sepetkdvtutar1+$sepetkdvtutar6+$sepetkdvtutar8+$sepetkdvtutar18),2,",",".")?> TL</td>
                            </tr>
                                                <?php
                                                $kargoBilgisi=$VT->VeriGetir("kargolimit","WHERE durum=?",array(1),"ORDER BY ID ASC",1);
                                                $kargo_fiyat = $kargoBilgisi[0]["sinir"];

                                                if($sepetTutar >= $kargo_fiyat) {
                                                    $kargotutar = 0;
                                                } else {
                                                    $kargotutar = $kargoBilgisi[0]["kargotutar"];
                                                }

                                                if(isset($_POST['kupon']) && $_POST['kupon']) {
                                                    $kuponBilgisi=$VT->VeriGetir("kuponlar","WHERE kod=?",array($_POST['kupon']),"ORDER BY kod ASC",1);
                                                    $nowtime = date('Y-m-d');
                                                    $kupontime = $kuponBilgisi[0]["sure"];
                                                    $kupondurum = $kuponBilgisi[0]["durum"];
                                                    if(strtotime($nowtime) <= strtotime($kupontime) && $kupondurum == 1) {
                                                        $kupon_fiyat = $sepetTutar*$kuponBilgisi[0]["yuzde"]/100;
                                                    } else {
                                                        $kupon_fiyat = 0;
                                                    }
                                                } else {
                                                    $kupon_fiyat = 0;
                                                }
                                                ?>
                                                <?php if(isset($kupon_fiyat) && $kupon_fiyat) { ?>
                                                    <tr>
                                                        <td class="text-right"><strong style="color: white">Kupon İndirimi (%<?php echo $kuponBilgisi[0]["yuzde"]; ?>):</strong></td>
                                                        <td class="text-right" style="color: white"><?=number_format($kupon_fiyat,2,",",".")?> TL</td>
                                                    </tr>
                                                <?php } ?>
	                                            <tr>
	                            <td class="text-right"><strong style="color: white">Ödenecek Tutar:</strong></td>
	                            <?php
	                            $kargoBilgisi=$VT->VeriGetir("kargolimit","WHERE durum=?",array(1),"ORDER BY ID ASC",1);
                    			$kargo_fiyat = $kargoBilgisi[0]["sinir"];

                    			if($sepetTutar >= $kargo_fiyat) {
                    				$kargotutar = 0;
                    			} else {
                    				$kargotutar = $kargoBilgisi[0]["kargotutar"];
                    			}

                    			if(isset($_POST['kupon']) && $_POST['kupon']) {
                                    $kuponBilgisi=$VT->VeriGetir("kuponlar","WHERE kod=?",array($_POST['kupon']),"ORDER BY kod ASC",1);
                                    $_SESSION['kupon'] = $_POST['kupon'];
                                    $nowtime = date('Y-m-d');
                                    $kupontime = $kuponBilgisi[0]["sure"];
                                    $kupondurum = $kuponBilgisi[0]["durum"];
                                    if(strtotime($nowtime) <= strtotime($kupontime) && $kupondurum == 1) {
                                        $kupon_fiyat = $sepetTutar*$kuponBilgisi[0]["yuzde"]/100;
                                    } else {
                                        $kupon_fiyat = 0;
                                    }
                                } else {
                                    $kupon_fiyat = 0;
                                }
                    			?>
	                            <td class="text-right" style="color: white"><?=number_format($sepetTutar+$kargotutar-$kupon_fiyat,2,",",".")?> TL</td>
	                        </tr>
	                                    </tbody></table>

                            

                        </div>

                    </div>

                    <div class="row basket-sum"><a style="color: white" href="<?=SITE?>">Alışverişe Devam Et</a></div>

                </div>

                <!-- order-lg-2 order-1 -->

                <div id="basketBilgilerDefault" class="col-lg-5 basket-bilgiler show">

                    <div class="row bilgiler-baslik">

                        <div class="col-auto">

                            <h1>

                                ÖDEME BİLGİLERİ

                            </h1>

                        </div>



                        <div class="col-auto">

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

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-6">

                            <div id="odemeTuruOnlineButton" class="odeme-turu-button active">

                                <ul>

                                    <li class="odeme-turu-start">

                                        <h2 class="odeme-turu-baslik">Kredi Kartı İle Ödeme</h2>



                                        <div class="odeme-turu-icon-1">

                                            <img src="<?=SITE?>images/icons/sepet-point.svg" alt="img">

                                        </div>



                                        <div class="odeme-turu-icon-2">

                                            <img src="<?=SITE?>images/icons/sepet-point-muted.svg" alt="img">

                                        </div>

                                    </li>



                                    <li>

                                        <p>

                                            Online ödeme ile anında güvenli bir alış gerçekleştirebiliriz.

                                        </p>

                                    </li>

                                </ul>

                            </div>

                        </div>



                        <div class="col-6">

                            <div id="odemeTuruHavaleButton" class="odeme-turu-button">

                                <ul>

                                    <li class="odeme-turu-start">

                                        <h2 class="odeme-turu-baslik">EFT / HAVALE</h2>



                                        <div class="odeme-turu-icon-1">

                                            <img src="<?=SITE?>images/icons/sepet-point.svg" alt="img">

                                        </div>



                                        <div class="odeme-turu-icon-2">

                                            <img src="<?=SITE?>images/icons/sepet-point-muted.svg" alt="img">

                                        </div>

                                    </li>



                                    <li>

                                        <p>

                                            Eft ve Havale ile ödeme

                                            yapabilirsiniz.

                                        </p>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>



                    <div id="odemeTuruHavale" class="odeme-turu havale">

                        <div class="row">

                            <h1 class="havale-h1">

                                EFT / Havale İle Ödeme

                            </h1>

                        </div>



                        <div class="row havale-aciklama">

                            <?php

                                $bankabilgileri=$VT->VeriGetir("bankabilgileri","WHERE durum=?",array(1),"ORDER BY sirano ASC");

                                if ($bankabilgileri!=false)

                                {

                                    for ($i=0;$i<count($bankabilgileri);$i++)

                                    {

                                    ?>

                                        <?=$bankabilgileri[$i]["metin"]?>

                                        <?php

                                    }

                                }



                            ?>

                        </div>

                        <?php
                        if ($_POST)
                        {
                            if ($_POST["odemetipi"]>1)
                            {
                                $odemetipi=$VT->filter($_POST["odemetipi"]);
                                $_SESSION["odemetipi"]=$odemetipi;
                                ?>
                                <meta http-equiv="refresh" content="0;url=<?=SITE?>odeme-yap">
                                <?php
                                exit;
                            }
                        }
                        ?>
                        <form action="" method="post">

                        <div class="row">
                            <div class="col-12 tamamla">
                                <select class="wide add_bottom_10 mo ma" name="odemetipi">
                                    <option value="2">Havale / Eft ile Ödeme</option>
                                </select>
                                <input type="submit" class="btn" value="ÖDEMEMİ YAPTIM">
                            </div>
                        </div>
                        </form>


                    </div>



                    <div id="odemeTuruOnline" class="odeme-turu active">

                        <?php
                        if ($_POST)
                        {
                            if ($_POST["odemetipi"]<2)
                            {
                                $odemetipi=$VT->filter($_POST["odemetipi"]);
                                $_SESSION["odemetipi"]=$odemetipi;
                                ?>
                                <meta http-equiv="refresh" content="0;url=<?=SITE?>odeme-yap">
                                <?php
                                exit;
                            }
                        }
                        ?>
                        <form action="" method="post">

                            <div class="row">
                                <div class="col-12 tamamla">
                                    <select class="wide add_bottom_10 mo ma" name="odemetipi">
                                        <option value="1">Kredi Kartı Ödemesi</option>
                                    </select>
                                    <input type="submit" class="btn" value="KREDİ KARTI ÖDEMESİ YAP">
                                </div>
                            </div>
                        </form>

                    </div>

                </div>



                <div id="basketBilgilerGift" class="col-lg-5 basket-bilgiler">

                    <div class="row">

                        <h1 class="bilgiler-baslik">

                            Hediye Kodu

                        </h1>

                    </div>

                    <form method="post">

                    <div class="row">

                        <ul class="kart-bil">

                            <li class="kart-bil-baslik">HEDİYE KODUNUZU GİRİNİZ</li>

                            <input name="kupon" class="kart-bil-input" type="text" placeholder="HEDİYE KODU">

                        </ul>

                    </div>

                    

                    <div class="row">

                        <div class="col-12 tamamla">

                            <button type="submit" class="btn">HEDİYE KODUNU KULLAN</button>

                        </div>

                    </div>

                    </form>
                </div>

            </div>

        </div>

        </form>

    </section>

</div>



    <?php

}else{



    ?>

<div class="main" style="margin-bottom: 20px;margin-top: 20px;">

    <section class="basket" style="margin-bottom: 150px;">

        <div class="container basket-bg">

            <div class="row justify-content-between">

                <div class="col-12 basket-listele">

                    <div class="row basket-baslik">

                        <ul>

                            <li>

                                <h1>Sepetim</h1>

                            </li>

                        </ul>



                    </div>

                    <p style="color:#fff;">Sepetinizde ürün bulunmamaktadır.</p>

                    <p ><a  style="color:yellow;" href="<?=SITE?>" class="btn_1">Alışverişe Başla</a></p>

                </div></div></div></section></div>



    <?php

}

?>



