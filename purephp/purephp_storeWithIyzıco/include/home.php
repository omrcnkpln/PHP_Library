

<div id="time-bar" class="time-bar"></div>

<!-- _____________________________ header _____________________________________________________________ -->
<header class="bg-1 akademi-slider">
    <div class="center">
        <div id="btnUp" class="btn btn-up">
            <img src="<?=SITE?>images/arrow-down-white.svg" alt="btn">
        </div>

        <div class="content-wrapper">
            <!-- comeFromBottom -->
            <!-- comeFromTop -->
            <!-- goToTop -->
            <!-- goToBottom -->
            <!-- 10 harf den büyük kelime girilmez -->
            <!-- <ul class="content">
                <li>@</li>
                <li>P</li>
                <li>a</li>
                <li>s</li>
                <li>a</li>
                <li>d</li>
                <li>a</li>
                <li>g</li>
                <li>l</li>
                <li>i</li>
            </ul> -->
            <!--  -->
            <ul class="content show">
                <li>k</li>
                <li>e</li>
                <li>s</li>
                <li>f</li>
                <li>e</li>
                <li>t</li>
            </ul>

            <ul class="content">
                <li>k</li>
                <li>a</li>
                <li>m</li>
                <li>p</li>
                <li>a</li>
                <li>n</li>
                <li>y</li>
                <li>a</li>
            </ul>

            <ul class="content">
                <li>S</li>
                <li>a</li>
                <li>t</li>
                <li>ı</li>
                <li>ş</li>
                <li>t</li>
                <li>a</li>
            </ul>

            <ul class="content">
                <li>y</li>
                <li>a</li>
                <li>k</li>
                <li>ı</li>
                <li>n</li>
                <li>d</li>
                <li>a</li>
            </ul>

            <ul class="content">
                <li>i</li>
                <li>n</li>
                <li>d</li>
                <li>i</li>
                <li>r</li>
                <li>i</li>
                <li>m</li>
            </ul>

            <!-- <ul class="content">
                <li>ş</li>
                <li>i</li>
                <li>m</li>
                <li>d</li>
                <li>i</li>
                <li>&nbsp</li>
                <li>m</li>
                <li>a</li>
                <li>ğ</li>
                <li>a</li>
                <li>z</li>
                <li>a</li>
                <li>d</li>
                <li>a</li>
            </ul> -->
        </div>

        <ul class="image-wrapper">
            <li class="img5 image-from-top">
                <img src="<?=SITE?>images/img1.jpg" alt="images">
            </li>

            <li class="img1 previous">
                <img src="<?=SITE?>images/img2.jpg" alt="images">
            </li>

            <li class="img2 present">
                <img src="<?=SITE?>images/img3.jpg" alt="images">
            </li>

            <li class="img3 next">
                <img src="<?=SITE?>images/img4.jpg" alt="images">
            </li>

            <li class="img4 image-to-bottom">
                <img src="<?=SITE?>images/img5.jpg" alt="images">
            </li>
        </ul>

        <div class="h-bottom">
            <ul class="play-stop">
                <li id="stop" class="btn stop show">
                    <img src="<?=SITE?>images/pause-white.svg" alt="pause-white">
                </li>

                <li id="play" class="btn play">
                    <img src="<?=SITE?>images/play-arrow-white.svg" alt="play-arrow-white">
                </li>
            </ul>

            <div class="progress">
                <div id="progressBar" class="progress-bar animate__animated progress-1"></div>
            </div>

            <div id="count" class="count animate__animated">
                01
            </div>

            <div class="count d-sm-none">
                /06
            </div>
        </div>

        <div id="btnDown" class="btn btn-down">
            <img src="<?=SITE?>images/arrow-down-white.svg" alt="btn">
        </div>
    </div>
</header>

<section class="videolar urunk pt-0">
    <div class="container">
        <div class="row">
            <?php

            $secilenkategoriler=$VT->VeriGetir("kategoriler","WHERE durum=? AND tablo=?",array(1,"urunler"),"ORDER BY RAND() ASC",3);
            if ($secilenkategoriler!=false)
            {
            for ($i=0;$i<count($secilenkategoriler);$i++)
            {
            ?>
            <div class="col-md-6 pb-4">
                <div class="video-alan">
                    <img src="<?=SITE?>images/kategoriler/<?=$secilenkategoriler[$i]["resim"]?>" style="filter: brightness(60%);width: 100%;height: 350px;object-fit: cover;" class="img-fluid" alt="">
                    <h3><?=stripslashes($secilenkategoriler[$i]["baslik"])?></h3>
                    <p>
                        <a href="<?=SITE?>kategori/<?=$secilenkategoriler[$i]["seflink"]?>"><i class="fas fa-chevron-right"></i> Bilgi Al</a>
                        <a href="<?=SITE?>kategori/<?=$secilenkategoriler[$i]["seflink"]?>"><i class="fas fa-chevron-right"></i> İncele</a>
                    </p>
                </div>
            </div>
                <?php
            }
            }

            ?>
        </div>
    </div>

</section>
