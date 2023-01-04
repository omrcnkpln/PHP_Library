<?php
include(MODELS . "MODEL.PHP");
//include(HELPERS . "createHash.php");
include(LIBRARIES . "MailGonder.php");
session_start();
ob_start();

if (isset($_POST["forgetPassword"])) {
  $eposta = $VT->filter($_POST["eposta"]);

  $find_user = $VT->baglantiMySQLi->query("SELECT user_mail FROM users WHERE user_mail ='$eposta'");

  if ($find_user) {
    $find_user_number = $find_user->num_rows;
  }
  else {
    $find_user_number = 0;
  }

  if ($find_user_number > 0) {

    $find_hash = $VT->baglantiMySQLi->query("SELECT user_hash FROM users WHERE user_mail ='$eposta' ");

    $get_find_hash = $find_hash->fetch_assoc();
    echo   SITE . 'forget-password/yenile/' . $eposta . "/" . $get_find_hash["user_hash"];

    // mail formatı
    $mail_formati = '
      Sifre değişikliği için tıklayınız 
      <a href="' . SITE . 'forget-password/yenile/' . $eposta . "/" . $get_find_hash["user_hash"] . '">
        Şifremi yenilemek için Thinker Math sayfasına git 
      </a>
    ';

    $subject = "ThinkerMath Şifre Yenileme Formu";
    $alici[0] = $eposta;
    $imageYol = "https://thinkermath.com.tr/tema/thinkermath/images/logo.png";

    $mailer = new mailGonder();
    if ($mailer->sendMail($alici, $subject, $mail_formati)) {
      $_SESSION["durum"] = "1";
    }
    else {
      $_SESSION["durum"] = "0";
    }
    header("location:" . SITE . "forget-password");
  }
  else {
    $_SESSION["durum"] = 0;
    header("location:" . SITE . "forget-password");
  }
}
else if (isset($_POST["sifreYenile"])) {
  $sifre1 = $VT->filter($_POST["sifre1"]);
  $sifre2 = $VT->filter($_POST["sifre2"]);
  $hash = $VT->filter($_POST["hash"]);
  $eposta = $VT->filter($_POST["eposta"]);

  if (!empty($sifre1) && !empty($sifre2)) {
    if ($sifre1 == $sifre2) {
      $yeniHash = \Libraries\Helper::CreateHash();
      $sifre = md5($sifre2);

      $yeniSifre = $VT->baglantiMySQLi->query("UPDATE users SET user_password = '$sifre', user_hash = '$yeniHash' WHERE user_hash = '$hash' && user_mail = '$eposta'");

      if($yeniSifre){
        $_SESSION["durum"] = 3;
      }else{
        $_SESSION["durum"] = 6;
      }
      header("location:" . SITE . "forget-password");
    }
    else {
      $_SESSION["durum"] = 4;
      header("Location:" . SITE . "forget-password/yenile/".$eposta."/".$hash);
    }
  }
  else {
    $_SESSION["durum"] = 5;
    header("Location:" . SITE . "forget-password/yenile/".$eposta."/".$hash);
  }
}
else{
  header("location:" . SITE);
}
