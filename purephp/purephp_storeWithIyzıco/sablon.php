<section class="urun">
    <div class="container">
        <div class="row"  style="margin-top: 20px;">
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="row justify-content-between">
                            <?
                            $urunler=$VT->VeriGetir("urunler","WHERE durum=?",array(1),"ORDER BY RAND() ASC",8);
                            if ($urunler!=false)
                            {
                                for ($i=0;$i<count($urunler);$i++)
                                {
                                    ?>
                                    <div class="col-4">
                                        <ul class="urun-left">
                                            <li class="urun-wrapper text-center">
                                                <ul>
                                                    <li class="urun-w-image-wrapper">
                                                        <img style="width: 100%;height: 250px;object-fit: cover;" src="<?=SITE?>images/urunler/<?=$urunler[$i]["resim"]?>" alt="fasikül">
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
                                                    <div style="margin-bottom: 10px;"><?=stripslashes($urunler[$i]["baslik"])?></div>
                                                    <?php
                                                    if (!empty($urunler[$i]["indirimlifiyat"]))
                                                    {
                                                        $fiyat=$urunler[$i]["indirimlifiyat"].".".$urunler[$i]["indirimlikurus"];
                                                        $normalfiyat=$urunler[$i]["fiyat"].".".$urunler[$i]["kurus"];

                                                        ?>
                                                        <li class="last-price"><?=number_format($normalfiyat,2,",",".")?> TL</li>
                                                        <li class="current-price"><?=number_format($fiyat,2,",",".")?> TL</li>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        $fiyat=$urunler[$i]["fiyat"].".".$urunler[$i]["kurus"];

                                                        ?>
                                                        <li class="current-price"><?=number_format($fiyat,2,",",".")?> TL</li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </li>

                                            <li style="margin-top: 5px;" class="sepete-ekle btn"><a style="color: white" href="<?=SITE?>urun/<?=$urunler[$i]["seflink"]?>">Ürüne Git</a></li>


                                        </ul>
                                    </div>
                                    <?php
                                }
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section></section>