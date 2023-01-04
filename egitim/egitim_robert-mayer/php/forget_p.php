<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include("ayarlar.php");

function createHash($uzunluk = 16)
{
    $karakterler = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
    return substr(str_shuffle($karakterler), 0, $uzunluk);
}



if (isset($_POST["ara"])) {
    $eposta = $_POST["mail"];

    $f_user = mysqli_query($baglan, "SELECT user_mail FROM users WHERE user_mail ='$eposta' ");

    if ($f_user) {
        $v_user = mysqli_num_rows($f_user);
    } else {
        $v_user = 0;
    }

    if ($v_user > 0) {

        $hash = createHash();
        $f_user = mysqli_query($baglan, "SELECT user_hash FROM users WHERE user_mail ='$eposta' ");

        $e = mysqli_fetch_array($f_user);

// yaparsan değişken olur
// extract($e);
// echo $user_mail;
// echo var_dump($e);
// echo $e["user_mail"];
// echo "<br>";
// echo $e["user_hash"];
// echo "<br>";

// burda mail göndereceğiz

$g_mail = "Sifre deg. için tıklayınız <a href =\"http://localhost/phpprojects/Robert_Mayer/php/forget_p.php?yenile=" . $e["user_hash"] . "\">http://localhost/phpprojects/Robert_Mayer/php/forget_p.php?yenile=" . $e["user_hash"] . " </a>";
// echo $g_mail;

// phpmailer composer******************************************

        

        // Load Composer's autoloader
        require 'vendor/autoload.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'omercnkpln@gmail.com';                     // SMTP username
            $mail->Password   = 'Adammmol9021.';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->CharSet    = "utf-8";
            //Recipients
            $mail->setFrom('omercnkpln@gmail.com', 'Mailer Gönderen');
            $mail->addAddress($eposta, 'Joe User dedik adına');     // Add a recipient
            // $mail->addAddress('ockaplan911@gmail.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // bu 3.yü göstermiyo
            // $mail->addCC('cc@example.com', 'cc2@example.com', 'cc3@example.com');
            // bu gözükmeyen
            // $mail->addBCC('bcc@example.com', 'bcc2@example.com', 'bcc3@example.com', 'bcc4@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Şifre Yenileme İşlemi';
            $mail->Body    = 'This is the HTML message body from ROBERT MAYER<b>in bold!</b>'.$g_mail;
            // bunu kesemedim
            $mail->AltBody = 'Burası tıklayınca açılan yer , çift tırnak yemiyo bir de';

            $mail->send();
            // echo 'Message has been sent';

            // javascript ile gönderdik
            echo "<script>window.location.assign('index.php')</script>";

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        // phpmailer composer******************************************

    } else {
        echo "Böyle bir kullanıcı bulunamadı";
    }
} else {
}

if (isset($_GET["yenile"])) {
    $hashGet = $_GET["yenile"];
    // echo "---".$hashGet."---";

    $is_hash = mysqli_query($baglan, "SELECT * FROM users WHERE user_hash = '$hashGet' ");

    if ($is_hash) {
        $v_hash = mysqli_num_rows($is_hash);
    } else {
        $v_hash = 0;
    }

    if ($v_hash > 0) {
        if (isset($_POST["sifreYenile"])) {
            $password = $_POST["sifre"];

            $yeniHash = createHash();

            mysqli_query($baglan, "UPDATE users SET user_password = '$password', user_hash = '$yeniHash' WHERE user_hash = '$hashGet'");
            echo "Şifre değişikliği başarılı..";
            header("refresh:2; url = index.php");
        }
?>
        <form action="" method="post">
            yeni şifre girin : <input type="password" name="sifre">
            <input type="submit" name="sifreYenile" value="Şifreyi Yenile">
        </form>

    <?php
    } else {
        echo "Bir hata oluştu. Daha sora tekrar deneyin..";
        header("refresh:2; url = index.php");
    }
} else {

    ?>

    <form action="" method="post">
        <table cellpadding="5" cellspacing="5">
            <tr>
                <td colspan=2>Mail Adresiniz:</td>
                <td><input type="text" name="mail" autofocus /></td>
            </tr>
            <tr>
                <td><input type="submit" value="Şifremi Yenile" name="ara" /></td>

            </tr>


        </table>
    </form>

<?php
}
?>