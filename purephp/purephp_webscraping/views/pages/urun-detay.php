<?php
include(MODELS . "MODEL.PHP");
include(FUNC . "siralama.php");
?>

<title>TM | Ürün Detay</title>

<!-- _____________________________ header _____________________________________________________________ -->
<?php
include(LAYOUTS . "_header-bg-white-2.php");

if (!empty($param[1])) {
    $seflink = $VT->filter($param[1]);

    $urunbilgisi = $VT->VeriGetir("urunler", "WHERE durum=? AND seflink=?", array(1, $seflink), "ORDER BY ID ASC", 1);

    if ($urunbilgisi != false) {
        ?>
        <div class="main">
            <section class="urun-detay">
                <div class="">
                    <div class="row justify-content-between t-shirt-bg">
                    <!-- col-md-5 -->
                        <div class="col-lg-3 pr-md-0">
                            <ul class="urun-left">
                                <li class="urun-wrapper text-center">
                                    <ul>
                                        <li class="urun-w-image-wrapper" data-toggle="modal" data-target="#foto"
                                            style="cursor: pointer">
                                            <img style="width: 100%;max-height: 400px;"
                                                 src="<?= ASSETS ?>images/urunler/<?= $urunbilgisi[0]["image_two"] ?>"
                                                 alt="urun-foto">
                                        </li>

                                        <li class="">
                                            <div class="adet-string">
                                                <ul class="adet-string-parallax">
                                                    <li></li>
                                                    <input type="hidden" value="1" id="adet" class="qty2 adet"
                                                           name="adet">
                                                </ul>
                                            </div>
                                        </li>

                                        <div class="price-wrapper">
                                            <?php
                                            if (!empty($urunbilgisi[0]["indirimlifiyat"])) {
                                                $indirimlifiyat = $urunbilgisi[0]["indirimlifiyat"] . "." . $urunbilgisi[0]["indirimlikurus"];
                                                $normalfiyat = $urunbilgisi[0]["fiyat"] . "." . $urunbilgisi[0]["kurus"];
                                                $hesapla = (($indirimlifiyat / $normalfiyat) * 100);
                                                $indirimorani = round(100 - $hesapla);

                                                ?>
                                                <div class="price-left">
                                                    %<?= $indirimorani ?>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <div class="price-right pt-2">
                                                <?php
                                                if (!empty($urunbilgisi[0]["indirimlifiyat"])) {
                                                    $fiyat = $urunbilgisi[0]["indirimlifiyat"] . "." . $urunbilgisi[0]["indirimlikurus"];
                                                    $normalfiyat = $urunbilgisi[0]["fiyat"] . "." . $urunbilgisi[0]["kurus"];

                                                    if ($urunbilgisi[0]["kdvdurum"] == 1) {
                                                        if ($urunbilgisi[0]["kdvoran"] > 9) {
                                                            $oran = "1." . $urunbilgisi[0]["kdvoran"];
                                                        }
                                                        else {
                                                            $oran = "1.0" . $urunbilgisi[0]["kdvoran"];
                                                        }

                                                        $fiyat = ($fiyat / $oran);/*kdvsiz hali*/
                                                        $normalfiyat = ($normalfiyat / $oran);
                                                    }
                                                    ?>
                                                    <li class="last-price"><?= number_format($urunbilgisi[0]["fiyat"], 2, ",", ".") ?>
                                                        TL
                                                    </li>

                                                    <li class="current-price"><?= number_format($urunbilgisi[0]["indirimlifiyat"], 2, ",", ".") ?>
                                                        TL
                                                    </li>
                                                    <?php
                                                }
                                                else {
                                                    $fiyat = $urunbilgisi[0]["fiyat"] . "." . $urunbilgisi[0]["kurus"];

                                                    if ($urunbilgisi[0]["kdvdurum"] == 1) {
                                                        if ($urunbilgisi[0]["kdvoran"] > 9) {
                                                            $oran = "1." . $urunbilgisi[0]["kdvoran"];
                                                        }
                                                        else {
                                                            $oran = "1.0" . $urunbilgisi[0]["kdvoran"];
                                                        }

                                                        $fiyat = ($fiyat / $oran);/*kdvsiz hali*/
                                                    }
                                                    ?>
                                                    <li class="current-price">
                                                        <?= number_format($urunbilgisi[0]["fiyat"], 2, ",", ".") ?>
                                                        TL
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </ul>
                                </li>


                            </ul>

                            <div class="row d-f-options">
                                <div class="col-6 mt-5">
                                    <?php
                                    $catSef = $VT->seflink($urunbilgisi[0]["kategori"]);
                                    $catSefExp = explode("-", $catSef);
                                    if (is_numeric($catSefExp[0])) {
                                        array_shift($catSefExp);
                                    }
                                    $altFiltre = implode("-", $catSefExp);
                                    if ($altFiltre == "yeterlik-belirleme-yarismasi") {
                                        $veri = $VT->baglantiMySQLi->query("SELECT * FROM yarisma_tab WHERE tab_id = 7");
                                        $sorularinDagilimi = $veri->fetch_assoc();
                                        ?>
                                        <a href="#" class="btn btn-outline-turuncu " data-toggle="modal"
                                           data-target="#sorularin-dagilimi-modal">

                                            <div>
                                                Soruların Dağılımı
                                            </div>
                                        </a>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <a href="#" class="btn btn-outline-turuncu px-lg-0" data-toggle="modal"
                                           data-target="#icerik">
                                            İçerik
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="col-6 mt-5">
                                    <?php
                                    $catSef = $VT->seflink($urunbilgisi[0]["kategori"]);
                                    $catSefExp = explode("-", $catSef);
                                    if (is_numeric($catSefExp[0])) {
                                        array_shift($catSefExp);
                                    }
                                    $altFiltre = implode("-", $catSefExp);
                                    if ($altFiltre == "yeterlik-belirleme-yarismasi") {
                                        ?>
                                        <a href="#" class="btn btn-outline-turuncu" data-toggle="modal"
                                           data-target="#ornek-sorular-modal">
                                            <!--                                        <img src="<?= ASSETS ?>images/icons/d-f-play.svg" alt="icon">-->
                                            Örnek Sorular
                                        </a>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <a href="#" class="btn btn-outline-turuncu px-lg-0" data-toggle="modal"
                                           data-target="#video">
                                            Videolar
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if ($urunbilgisi[0]['stok'] > 0) {
                                ?>
                                <a href="#" class="sepete-ekle btn d-block btn-outline-turuncu"
                                   onclick="sepeteEkle(event, 1,'<?= POSTS ?>', <?= $urunbilgisi[0]['ID'] ?>);">
                                    SEPETE EKLE
                                </a>
                                <?php
                            }
                            else {
                                ?>
                                <a href="#" class="sepete-ekle btn d-block btn-outline-turuncu btn-disabled" disabled
                                   onclick="sepeteEkle(event);">
                                    Stokta Yok
                                </a>
                                <?php
                            }
                            ?>
                        </div>

                        <!-- col-md-7 -->
                        <div class="col-lg-9 mt-md-0 mt-4">
                            <div class="urun-right">
                                <div class="row justify-content-center genel-bilgiler">
                                    <div class="col-12">
                                        <div class="genel-bilgiler-left pl-3">
                                            <h3><?= stripslashes($urunbilgisi[0]["baslik"]) ?></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-between urun-bilgileri-topic">
                                    <div class="col-12 ml-3">
                                        Ürün Bilgileri
                                    </div>
                                </div>

                                <div class="row justify-content-center bilgiler-main">
                                    <div class="col-12">
                                        <div class="row px-3">
                                            <div class="col-lg-9 pr-lg-0 pr-3 mb-lg-0 mb-3 urun-bilgiler-card-wrapper">
                                                <?php
                                                //                                        1.bilgiler kartı var ise
                                                if ($urunbilgisi[0]["ek1"] != NULL) {
                                                    ?>
                                                    <div class="ikili">
                                                        <div class="ikili-item-head">
                                                            <?= $urunbilgisi[0]["ek1"] ?>
                                                        </div>

                                                        <div class="ikili-item-body">
                                                            <img src="<?= (!empty($urunbilgisi[0]["ek111"])) ? $urunbilgisi[0]["ek111"] : "public/images/icons/k-b-author.svg" ?>"
                                                                 alt="icon">

                                                            <span>
                                                            <?= $urunbilgisi[0]["ek11"] ?>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }

                                                //                                        2.bilgiler kartı var ise
                                                if ($urunbilgisi[0]["ek2"] != NULL) {
                                                    ?>
                                                    <div class="ikili">
                                                        <div class="ikili-item-head">
                                                            <?= $urunbilgisi[0]["ek2"] ?>
                                                        </div>

                                                        <div class="ikili-item-body">
                                                            <img src="<?= (!empty($urunbilgisi[0]["ek222"])) ? $urunbilgisi[0]["ek222"] : "public/images/icons/k-b-author.svg" ?>"
                                                                 alt="icon">

                                                            <span><?= $urunbilgisi[0]["ek22"] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }

                                                //                                         3.bilgiler kartı var ise
                                                if ($urunbilgisi[0]["ek3"] != NULL) {
                                                    ?>
                                                    <div class="ikili">
                                                        <div class="ikili-item-head">
                                                            <?= $urunbilgisi[0]["ek3"] ?>
                                                        </div>

                                                        <div class="ikili-item-body">
                                                            <img src="<?= (!empty($urunbilgisi[0]["ek333"])) ? $urunbilgisi[0]["ek333"] : "public/images/icons/k-b-author.svg" ?>"
                                                                 alt="icon">

                                                            <span><?= $urunbilgisi[0]["ek33"] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }

                                                //                                         4.bilgiler kartı var ise
                                                if ($urunbilgisi[0]["ek4"] != NULL) {
                                                    ?>
                                                    <div class="ikili">
                                                        <div class="ikili-item-head">
                                                            <?= $urunbilgisi[0]["ek4"] ?>
                                                        </div>

                                                        <div class="ikili-item-body">
                                                            <img src="<?= (!empty($urunbilgisi[0]["ek444"])) ? $urunbilgisi[0]["ek444"] : "public/images/icons/k-b-author.svg" ?>"
                                                                 alt="icon">

                                                            <span><?= $urunbilgisi[0]["ek44"] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }

                                                //                                         5.bilgiler kartı var ise
                                                if ($urunbilgisi[0]["ek5"] != NULL) {
                                                    ?>
                                                    <div class="ikili">
                                                        <div class="ikili-item-head">
                                                            <?= $urunbilgisi[0]["ek5"] ?>
                                                        </div>

                                                        <div class="ikili-item-body">
                                                            <img src="<?= (!empty($urunbilgisi[0]["ek555"])) ? $urunbilgisi[0]["ek555"] : "public/images/icons/k-b-author.svg" ?>"
                                                                 alt="icon">

                                                            <span><?= $urunbilgisi[0]["ek55"] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }

                                                //                                         6.bilgiler kartı var ise
                                                if ($urunbilgisi[0]["ek6"] != NULL) {
                                                    ?>
                                                    <div class="ikili">
                                                        <div class="ikili-item-head">
                                                            <?= $urunbilgisi[0]["ek6"] ?>
                                                        </div>

                                                        <div class="ikili-item-body">
                                                            <img src="<?= (!empty($urunbilgisi[0]["ek666"])) ? $urunbilgisi[0]["ek666"] : "public/images/icons/k-b-author.svg" ?>"
                                                                 alt="icon">

                                                            <span><?= $urunbilgisi[0]["ek66"] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>

                                            <div class="col-lg-3">
                                                <?php
                                                if (!empty($urunbilgisi[0]["yazar_id"])) {
                                                    ?>
                                                    <div class="bilgiler-author" data-toggle="modal"
                                                         data-target="#author-modal">
                                                        <div class="bilgiler-image-wrapper">
                                                            <img src="<?= ASSETS ?>images/anasayfa_ekip_images/<?= $urunbilgisi[0]["yazarImage"] ?>"
                                                                 alt="book-author">
                                                        </div>

                                                        <div class="author-name">
                                                            <?= $urunbilgisi[0]["yazarAd"] ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                $catSef = $VT->seflink($urunbilgisi[0]["kategori"]);
                                                $catSefExp = explode("-", $catSef);
                                                if (is_numeric($catSefExp[0])) {
                                                    array_shift($catSefExp);
                                                }
                                                $altFiltre = implode("-", $catSefExp);
                                                if ($altFiltre == "yeterlik-belirleme-yarismasi") {
                                                    ?>
                                                    <div class="bilgiler-author" data-toggle="modal"
                                                         data-target="#karne-modal">
                                                        <div class="bilgiler-image-wrapper">
                                                            <img src="<?= ASSETS ?>images/abone-ol-owl.png"
                                                                 alt="book-author">
                                                        </div>

                                                        <div class="author-name">
                                                            Karne
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-between urun-bilgileri-topic">
                                    <div class="col-12 ml-3">
                                        Daha Fazla
                                    </div>
                                </div>


                                <div class="row justify-content-between urun-bilgileri-topic">
                                    <div class="col-12 ml-3">
                                        <div class="divider"></div>
                                    </div>
                                </div>

                                <div class="row d-f-options d-f-options-3">
                                    <div class="col-12 d-f-options-icerik ml-3">
                                        <p>
                                            <?= $urunbilgisi[0]["metin"] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-none">
                            <div class="row justify-content-center">
                                <div class="col-9">
                                    <div class="diger-urunler">
                                        <h3 class="text-start ml-3">
                                            DİĞER ÜRÜNLER
                                        </h3>

                                        <div class="overflow-wrapper">
                                            <div class="diger-urunler-parallax">
                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="diger-urunler-parallax-img-wrapper">
                                                        <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg"
                                                             alt="fasikül">
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

            <div class="container d-none">
                <div class="row">
                    <div class="col-12">
                        <div class="filter">
                            <li id="tumu" class="btn active">
                                Tümü
                            </li>

                            <li id="sinif-4" class="btn">
                                4. Sınıf
                            </li>

                            <li id="sinif-5" class="btn">
                                5. Sınıf
                            </li>

                            <li id="sinif-6" class="btn">
                                6. Sınıf
                            </li>

                            <li id="sinif-7" class="btn">
                                7. Sınıf
                            </li>

                            <li id="sinif-8" class="btn">
                                8. Sınıf
                            </li>
                        </div>
                    </div>
                </div>

                <div class="row kart-section">
                    <div class="col-12 kart-section-grid px-0">
                        <div class="card sinif-4">
                            <div class="card-header">
                                <div class="image-wrapper">
                                    <img src="<?= ASSETS ?>images/urun-sayfalari/fasikul.svg" class="card-img-top" alt="...">
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    Kitap ismi 4.sinif
                                </h5>

                                <p class="card-text">
                                    Yazar İsmi
                                </p>
                            </div>

                            <div class="card-footer">
                                <a href="<?= BASE ?>" class="card-option incele has-bg">
                                    <img src="<?= ASSETS ?>images/icons/search-black.svg" alt="search icon">
                                </a>

                                <div class="card-option fiyat">
                                    <div class="prev-price">
                                        20.00 TL
                                    </div>

                                    <div class="current-price">
                                        41.00 TL
                                    </div>
                                </div>

                                <a href="#" class="card-option sepet-ikon has-bg">
                                    <img src="<?= ASSETS ?>images/icons/backpack.svg" alt="">

                                    <div class="badge" id="sepet-badge">
                                        01
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="image-wrapper">
                                    <img src="<?= ASSETS ?>images/t-shirt/b1.jpg" class="card-img-top" alt="...">
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    Kitap ismi
                                </h5>

                                <p class="card-text">
                                    Yazar İsmi
                                </p>
                            </div>

                            <div class="card-footer">
                                <a href="<?= BASE ?>" class="card-option incele has-bg">
                                    <img src="<?= ASSETS ?>images/icons/search-white.svg" alt="search icon">
                                </a>

                                <div class="card-option fiyat">
                                    <div class="prev-price">
                                        20.00 TL
                                    </div>

                                    <div class="current-price">
                                        41.00 TL
                                    </div>
                                </div>

                                <a href="#" class="card-option sepet-ikon has-bg has-badge">
                                    <img src="<?= ASSETS ?>images/icons/backpack.svg" alt="">

                                    <div class="badge" id="sepet-badge">
                                        01
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="image-wrapper">
                                    <img src="<?= ASSETS ?>images/t-shirt/b1.jpg" class="card-img-top" alt="...">
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    Kitap ismi
                                </h5>

                                <p class="card-text">
                                    Yazar İsmi
                                </p>
                            </div>

                            <div class="card-footer">
                                <a href="<?= BASE ?>" class="card-option incele has-bg">
                                    <img src="<?= ASSETS ?>images/icons/search-white.svg" alt="search icon">
                                </a>

                                <div class="card-option fiyat">
                                    <div class="prev-price">
                                        20.00 TL
                                    </div>

                                    <div class="current-price">
                                        41.00 TL
                                    </div>
                                </div>

                                <a href="#" class="card-option sepet-ikon has-bg has-badge">
                                    <img src="<?= ASSETS ?>images/icons/backpack-white.svg" alt="">

                                    <div class="badge" id="sepet-badge">
                                        01
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card sinif-4">
                            <div class="card-header">
                                <div class="image-wrapper">
                                    <img src="<?= ASSETS ?>images/t-shirt/b1.jpg" class="card-img-top" alt="...">
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    Kitap ismi 4.sinif
                                </h5>

                                <p class="card-text">
                                    Yazar İsmi
                                </p>
                            </div>

                            <div class="card-footer">
                                <a href="<?= BASE ?>" class="card-option incele has-bg">
                                    <img src="<?= ASSETS ?>images/icons/search-black.svg" alt="search icon">
                                </a>

                                <div class="card-option fiyat">
                                    <div class="prev-price">
                                        20.00 TL
                                    </div>

                                    <div class="current-price">
                                        41.00 TL
                                    </div>
                                </div>

                                <a href="#" class="card-option sepet-ikon has-bg has-badge">
                                    <img src="<?= ASSETS ?>images/icons/backpack.svg" alt="">

                                    <div class="badge" id="sepet-badge">
                                        01
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="image-wrapper">
                                    <img src="<?= ASSETS ?>images/t-shirt/b1.jpg" class="card-img-top" alt="...">
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    Kitap ismi
                                </h5>

                                <p class="card-text">
                                    Yazar İsmi
                                </p>
                            </div>

                            <div class="card-footer">
                                <a href="<?= BASE ?>" class="card-option incele has-bg">
                                    <img src="<?= ASSETS ?>images/icons/search-black.svg" alt="search icon">
                                </a>

                                <div class="card-option fiyat">
                                    <div class="prev-price">
                                        20.00 TL
                                    </div>

                                    <div class="current-price">
                                        41.00 TL
                                    </div>
                                </div>

                                <a href="#" class="card-option sepet-ikon has-bg has-badge">
                                    <img src="<?= ASSETS ?>images/icons/backpack.svg" alt="">

                                    <div class="badge" id="sepet-badge">
                                        01
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="store-2">
                <div class="container">
                    <?php
                    $urunler = $VT->baglantiMySQLi->query("SELECT urunID, COUNT('urunID')*adet AS toplam FROM siparisurunler GROUP BY urunID ORDER BY toplam DESC LIMIT 10");
                    if ($urunler) {
                        ?>
                        <div class="row hizmetler-slider-body">
                            <div class="col-12 pr-0">
                                <div class="hizmetler-slider-body-topic">
                                    En Çok Satanlar
                                </div>

                                <div class="carousel-shadow">
                                </div>

                                <div class="hizmetler-carousel owl-carousel">
                                    <?php
                                    while ($value = $urunler->fetch_assoc()) {

                                        $urun = $VT->VeriGetir("urunler", "WHERE ID=?", array($value["urunID"]), "ORDER BY ID ASC", 1);
                                        if ($urun) {
                                            if (!empty($urun[0]["stok"])) {
                                                ?>
                                                <div class="box">
                                                    <div class="box-content">
                                                        <div class="col-auto box-img-side">
                                                            <img src="<?= ASSETS ?>images/urunler/<?= $urun[0]["image"] ?>"
                                                                 alt="product-image">
                                                        </div>

                                                        <div class="col-auto box-right-side">
                                                            <div class="row">
                                                                <div class="col-12 kitap-ismi text-center">
                                                                    <?= $urun[0]["baslik"]
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-12 yazar-ismi text-center">
                                                                    <?= $urun[0]["yazarAd"]
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <div class="box-options-wrapper">
                                                                <?php
                                                                if ($urun[0]["indirimlifiyat"] == NULL) {
                                                                    ?>
                                                                    <div class="box-option fiyat">
                                                                        <div class="prev-price">
                                                                            <?= $urun[0]["indirimlifiyat"] ?> TL
                                                                        </div>

                                                                        <div class="current-price">
                                                                            <?= $urun[0]["fiyat"] ?> TL
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                else {
                                                                    ?>
                                                                    <div class="box-option fiyat has-prev-price">
                                                                        <div class="prev-price">
                                                                            <?= $urun[0]["indirimlifiyat"] ?> TL
                                                                        </div>

                                                                        <div class="current-price">
                                                                            <?= $urun[0]["fiyat"] ?> TL
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <a href="urun-detay/<?= $urun[0]["seflink"] ?>"
                                                                   class="box-option search">
                                                                    <!--                                                      <img src="<?= ASSETS ?>images/icons/search-white.svg" alt="search icon">-->
                                                                    <em class="tiger-search"></em>
                                                                </a>

                                                                <a href="#" class="box-option sepet-ikon has-bg d-none">
                                                                    <img src="<?= ASSETS ?>images/icons/backpack.svg" alt="">

                                                                    <div class="badge">
                                                                        01
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </section>
        </div>

        <!-- sol taraf içerik butonu modal -->
        <div class="modal fade icerik" id="icerik">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body px-0">
                        <div class="row m-0">
                            <div class="col-12 p-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="row modal-main m-0">
                                <?php
                                if (!empty($urunbilgisi[0]["dosya"])) {
                                    ?>
                                    <embed src="public/uploads/urunler/<?= $urunbilgisi[0]["dosya"] ?>">
                                    <?php
                                }
                                else {
                                    echo "Döküman Bununmuyor";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- yeterlik belirleme icerik yerine soruların dağılımı modal -->
        <div class="modal fade ekip-modal" id="sorularin-dagilimi-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?= $sorularinDagilimi["tab_baslik"] ?>
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="col-12">
                        <div class="dropdown-divider"></div>
                    </div>

                    <div class="modal-body">
                        <div class="row modal-main m-0">
                            <div class="col-6">
                                <div class="image-side">
                                    <div class="image-wrapper">
                                        <img src="<?= ASSETS ?>images/yarisma_tab_images/<?= $sorularinDagilimi["tab_image"] ?>"
                                             alt="akademisyen-photo">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="aciklama-side">
                                    <div class="aciklama">
                                        <?= $sorularinDagilimi["tab_yazi"] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- video modal -->
        <div class="modal fade video" id="video">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body px-0">
                        <div class="row m-0">
                            <div class="col-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        onclick="stopvideo()">
                                    <span>&times;</span>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="row modal-main m-0">
                                <iframe id="videoIframe" width="560" height="315"
                                        src="https://www.youtube.com/embed/2G6lNcwGn6Y" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- yerine yeterlik-belirleme için örnek sorular modal -->
        <div class="modal fade icerik" id="ornek-sorular-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body px-0">
                        <div class="row m-0">
                            <div class="col-12 p-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="row modal-main m-0">
                                <embed src="../../public/docs/ornek-sorular.pdf">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- foto modal -->
        <div class="modal fade foto" id="foto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body px-0">
                        <div class="row m-0">
                            <div class="col-12 p-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                        </div>

                        <div class="modal-main">
                            <div class="has-overflow">
                                <?php
                                //ürünün kategori_ID si ile kategoriler tablosundan modul id sinin getirilmesi
                                $kategoriID = $urunbilgisi[0]["kategori_ID"];
                                $modulIDGetir = $VT->baglantiMySQLi->query("SELECT tablo FROM kategoriler WHERE ID = '$kategoriID'");
                                $modulID = $modulIDGetir->fetch_assoc()["tablo"];

                                $fotolar = $VT->VeriGetir("resimler", "WHERE tablo=? AND KID=?", array($modulID, $urunbilgisi[0]["ID"]), "ORDER BY ID ASC");
                                if ($fotolar) {
                                    foreach ($fotolar as $row => $value) {
                                        ?>
                                        <div class="overflow-item">
                                            <div class="image-wrapper">
                                                <img src="<?= ASSETS ?>images/site-resimleri/<?= $value["resim"] ?>" alt="">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                else {
                                    echo "Ürün görseli bulunamadı";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- mini-kitap kategorisi yazar modal -->
        <div class="modal fade ekip-modal" id="author-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?= $urunbilgisi[0]["yazarAd"] ?>
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="col-12">
                        <div class="dropdown-divider"></div>
                    </div>

                    <div class="modal-body">
                        <div class="row modal-main m-0">
                            <div class="col-6">
                                <div class="image-side">
                                    <div class="image-wrapper">
                                        <img src="<?= ASSETS ?>images/anasayfa_ekip_images/<?= $urunbilgisi[0]["yazarImage"] ?>"
                                             alt="akademisyen-photo">
                                    </div>

                                    <p>
                                        <?= $urunbilgisi[0]["baslik"] ?>
                                    </p>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="aciklama-side">
                                    <div class="aciklama">
                                        <?php
                                        $hocaBilgisi = $VT->VeriGetir("anasayfa_ekip", "WHERE ekip_id=?", array($urunbilgisi[0]["yazar_id"]));
                                        ?>
                                        <?= $hocaBilgisi[0]["ekip_ozgecmis"] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- yeterlik belirleme yazar bilgisi yerine karne modal -->
        <div class="modal fade icerik" id="karne-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body px-0">
                        <div class="row m-0">
                            <div class="col-12 p-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="row modal-main m-0">
                                <embed src="../../public/docs/ornek-sorular.pdf">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    else {
        echo '<div class="alert alert-warning text-center mt-3">Ürün Artık Satışta Değil :/</div>';

        header("refresh:2;url=" . SITE . "hizmetler/");
    }
}
else {
    echo "urun paramatresi yok";
}

?>

<!-- _____________________________ footer _____________________________________________________________ -->
<?php
include(LAYOUTS . "_footer.php");
?>

<!-- _____________________________ header-bg-white.js _____________________________________________________________ -->
<script type="text/javascript" src="<?= SOURCES ?>js/header-bg-white-2.js"></script>

<!-- _____________________________ site.js _____________________________________________________________ -->
<!--<script type="text/javascript" src="<?= ASSETS ?>js/site.min.js"></script>-->

<!-- _____________________________ hizmetler.js _____________________________________________________________ -->
<script type="text/javascript" src="<?= SOURCES ?>js/hizmetler-2.js"></script>
