<?php
@session_start();
@ob_start();
define("DATA","data/");
define("SAYFA","include/");
define("SINIF","adminpanel/class/");
include_once(DATA."baglanti.php");
define("SITE",$siteurl);
/***********************************************/

include_once('IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey("Anv6JwJZrfOMv0BJ7mOpdjIlufR5U5yd");
        $options->setSecretKey("cA5OjZBuUeBSd9aq0V6IQRXGLnOTwifS");
        $options->setBaseUrl("https://api.iyzipay.com");
        return $options;
    }
}

$token=$_POST['token'];
$siparis_no=$_SESSION["siparisKodu"];

$request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("$siparis_no");
$request->setToken("$token");
$checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, Config::options());

//print_r($checkoutForm->getStatus());
echo $odeme_durum=$checkoutForm->getPaymentStatus();
echo "<br>";
$islem_no=$checkoutForm->getpaymentId();

if ($odeme_durum=="FAILURE") {
	
	echo "Başarısız Ödeme...";

} elseif ($odeme_durum=="SUCCESS") {

    ?>
    <meta http-equiv="refresh" content="0;url=<?=SITE?>kk-kayit">

    <?php

	/*echo "Başarılı Ödeme işlem numaranız :".$islem_no;*/
	
}
?>