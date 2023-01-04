<!--
bu sayfanın işi bot ile çekip php, ardından js gücü ile ürünleri kendi ajax sayfasına yollaması
ajax ile yollanan veri session a kaydedilir ve otomatik list sayfasına yönlendirilir
o sayfada formatlanmış liste halindeki ürünler ve php ile db işlemlerine devam edilebilir
-->
<div class="content-wrapper">
    <?php
//    header("Cache-Control: no-cache, must-revalidate");

//    unset($_SESSION["products"]);

    use Libraries\CurlLibrary;
    use Libraries\VT;
    use PHPHtmlParser\Dom;
    use System\Helpers\Helper;

    $products = array();
    $productIndex = 0;
    $requestCount = 1;
    while ($productIndex < 100) {
        $curl = new CurlLibrary();
        $url = "https://www.n11.com/bilgisayar/dizustu-bilgisayar?ipg=" . $requestCount;
        $curl->SetUrl($url);
        //$curl->SetTimeout(0);
        $curl->Follow(true);
        $curl->SetReferer("http://www.google.com/");
        $curl->SetUserAgent($_SERVER["HTTP_USER_AGENT"]);

        if ($curl->Execute()) {
//        $aranan = '@<div class="productListContent(.*?)<div class="container">@si';
            $aranan = '@<ul class="list-ul"(.*?)<div class="iLoading"></div>@si';
            preg_match_all($aranan, $curl->response, $sonuc);
            $file = dir . "public/botPages/n11.html";
            fopen($file, "w");
            file_put_contents($file, $sonuc[0]);

            $dom = new Dom;
            $dom->loadFromFile($file);
            $products = $dom->find('li.column');

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

    <script src="<?= ASSETS ?>js/n11-bot.js"></script>
