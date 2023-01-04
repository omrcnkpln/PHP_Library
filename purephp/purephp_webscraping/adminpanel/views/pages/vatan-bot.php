<!--
bu sayfanın işi bot ile çekip php, ardından js gücü ile ürünleri kendi ajax sayfasına yollaması
ajax ile yollanan veri session a kaydedilir ve otomatik list sayfasına yönlendirilir
o sayfada formatlanmış liste halindeki ürünler ve php ile db işlemlerine devam edilebilir
-->
<div class="content-wrapper">
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

unset($_SESSION["products"]);

use Libraries\CurlLibrary;
use Libraries\VT;
use PHPHtmlParser\Dom;
use System\Helpers\Helper;

$products = array();
$productIndex = 0;
$requestCount = 1;
while ($productIndex < 100) {
    $curl = new CurlLibrary();
    $url = "https://www.vatanbilgisayar.com/notebook/?page=" . $requestCount;
    $curl->SetUrl($url);
    //$curl->SetTimeout(0);
    $curl->Follow(true);
    $curl->SetReferer("http://www.google.com/");
    $curl->SetUserAgent($_SERVER["HTTP_USER_AGENT"]);

    if ($curl->Execute()) {
//        $aranan = '@<div class="productListContent(.*?)<div class="container">@si';
        $aranan = '@<div id="productsLoad" class="wrapper-product wrapper-product--list-page clearfix">(.*?)<div class="catTags clearfix">@si';
        preg_match_all($aranan, $curl->response, $sonuc);
        $file = dir . "public/botPages/vatan.html";
        fopen($file, "w");
        file_put_contents($file, $sonuc[0]);

        $dom = new Dom;
        $dom->loadFromFile($file);
        $products = $dom->find('div.product-list.product-list--list-page');

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

<script src="<?= ASSETS ?>js/vatan-bot.js"></script>
