<!--<base href="https://thinkermath.com.tr/">-->
<?php
//if (extension_loaded("curl")) {
//    echo "Curl kurulu.";
//} else {
//    echo "Curl kurulu değil.";
//}

include "libraries/CurlLibrary.php";
//echo php_ini_loaded_file();

$curl = new CurlLibrary();

$posts = array(
    "name" => "Ömer Can KAPLAN",
    "mail" => "test@test.com",
    "tel" => "444 333 22 11",
    "message" => "Bu mesaj bot ile gönderildi..",
    "iletisim-post" => true,
);

//$posts2 = "name=Ömer+Can+KAPLAN&mail=test@test.com&tel=222+333+44+55&message=Bu+mesaj+bot+ile+gönderildi..&iletisim-post=0";

//$ch = curl_init();

//https://thinkermath.com.tr/dene
//http://denemeler:8064/bot/dene.php

$curl->SetUrl("https://thinkermath.com.tr/iletisim-post");
$curl->SetTimeout(0);
$curl->SetReferer("http://www.google.com/");
$curl->SetUserAgent($_SERVER["HTTP_USER_AGENT"]);
$curl->SetRequestMethod("post");
$curl->SetPostFields($posts);
$curl->Execute();

//curl_setopt($ch, CURLOPT_URL, 'https://thinkermath.com.tr/iletisim-post');
//curl_setopt($ch, CURLOPT_TIMEOUT, 0);
//curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/");

//curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
//curl_setopt($ch, CURLOPT_COOKIE, "testkukisi=degeribuna eşitleyebilirim kukinin");
//curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
//curl_setopt($ch, CURLOPT_PROXY, "170.140.119.70");
//curl_setopt($ch, CURLOPT_PROXYPORT, "3124");

//$sonuc = curl_exec($ch);

//curl_close($ch);

//echo $sonuc;
