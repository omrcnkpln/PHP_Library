<!--
bu sayfanın işi bot ile çekip php, ardından js gücü ile ürünleri kendi ajax sayfasına yollaması
ajax ile yollanan veri session a kaydedilir ve otomatik list sayfasına yönlendirilir
o sayfada formatlanmış liste halindeki ürünler ve php ile db işlemlerine devam edilebilir
-->
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//header("Content-Type: application/xml; charset=utf-8");
//unset($_SESSION["products"]);

use Libraries\CurlLibrary;
use Libraries\VT;
use PHPHtmlParser\Dom;
use System\Helpers\Helper;

$VT = new VT();

$products = array();
$productIndex = 0;
$requestCount = 1;
while ($productIndex < 100) {
    $curl = new CurlLibrary();
//    $url = "https://www.hepsiburada.com/laptop-notebook-dizustu-bilgisayarlar-c-98";
//    $url = "https://www.hepsiburada.com/laptop-notebook-dizustu-bilgisayarlar-c-98?sayfa=10";
    $url = "https://www.hepsiburada.com/laptop-notebook-dizustu-bilgisayarlar-c-98?sayfa=" . $requestCount;
    $curl->SetUrl($url);
    //$curl->SetTimeout(0);
    $curl->Follow(true);
    $curl->SetReferer("http://www.google.com/");
    $curl->SetUserAgent($_SERVER["HTTP_USER_AGENT"]);

    if ($curl->Execute()) {
        $aranan = '@<div class="productListContent(.*?)<div class="container">@si';
        preg_match_all($aranan, $curl->response, $sonuc);
        $file = dir . "public/botPages/hp.html";
        fopen($file, "w");
        file_put_contents($file, $sonuc[0]);

        $dom = new Dom;
        $dom->loadFromFile($file);
        $products = $dom->find('li.productListContent-zAP0Y5msy8OHn5z7T_K_');

        if (empty($products)) {
            //hiç urun bulunamdi
            break;
        }
        else {
            foreach ($products as $product) {
                ?>
                <div class="hidden-product">
                    <?php
                    print_r($product->outerHtml);
                    ?>
                </div>
                <?php

//                $img = $content->find('img');
//                $src = $img->getAttribute('src');
//                $h3Elem = $content->find('h3');
//                $h3 = html_entity_decode(strip_tags($h3Elem));
//                $price = $h3Elem->nextSibling()->nextSibling();
////                $price = $content->find('.moria-ProductCard-iymOAa .bRTNe .stnncwq2g2v');
//                echo $price;
////                exit();
//                $products[$productIndex]["title"] = $h3;
//                $products[$productIndex]["image"] = $src;

                $productIndex++;
            }
        }
    }
    else {
        echo "giriş başarısız";
    }

    $requestCount++;
}
?>

<script src="<?= ASSETS ?>js/hp-bot.js"></script>
