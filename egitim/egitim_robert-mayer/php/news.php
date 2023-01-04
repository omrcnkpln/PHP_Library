<meta charset="utf-8">
<?php

// zaman aşımı süresi olmaması için
set_time_limit(0);
date_default_timezone_set('Europe/Istanbul');
// echo file_get_contents("https://www.haberler.com/");
// $veri = file_get_contents("https://www.haberler.com/");

// kullanım
// echo strip_tags($veri);

$kaynak = file_get_contents("https://www.haberler.com/gunun-mansetleri/");
$aranan = '@<li style="width:510px;  height:370px;">(.*?)</li>@si';
preg_match_all($aranan, $kaynak, $sonuc);
echo $say = count($sonuc[1]); 
echo " adet manşet bulundu.";
echo "</br>";
echo "</br>";
// echo var_dump($sonuc[1][0]);

//enteresan
// echo "<pre>";
// print_r($sonuc[1]);
// echo "/<pre>";

if($say > 0){
    for($i = 0;$i < $say;$i++){
        echo "</br>";
        echo $sonuc[1][$i] . "<br/>";
    }
}

// ************************************************************
// foreach ile güzel olmadı tam

// $kaynak = "<div>Birinci Bölüm</div> <div>İkinci Bölüm</div> <div>Üçüncü Bölüm</div> <div>Dördüncü Bölüm</div>";
//$aranan = "@  BAŞLANGIÇ TAGI  (.*?)   BİTİŞ TAGI  @si";
//bitiş taginin sonuna boşluk koyunca hepsini aldı yoksa 2 tane alıyordu
// $aranan = '@<li style="width:510px;  height:370px;">(.*?)</li>@si';
//böyle de oluyo heralde
// $aranan = '@<li style="width:510px;  height:370px;">(.*?) Bİ TANE DAHA/(.*?)</li>@si';
// preg_match_all($aranan, $kaynak, $sonuc);
// echo "</br>";
// echo "</br>";

// print_r($sonuc);
// echo "</br>";
// echo "</br>";
// foreach ($sonuc as $key => $value) {
//     // echo $sonuc[1][$key] . "<br/>";
//     echo strip_tags($sonuc[1][$key]);

// }
// foreach ($sonuc as $key => $value) {
//     echo $sonuc[1][$key]."<br/>";
// }
?>



