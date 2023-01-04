
<?php

// kendi sitemizden değil harici bir smtp hesabı üzerinden gönderdik maili gmail üzerinden
// yalnız imap ayarını etkinleştirmeden gönderebildik postayı belki de imap eski mail() fonksiyonu için gereklidir burada zaten baya bilgi girdik
// maili gönderen olarak kullandığım adresde daha az güvenlikli uygulamalara izin vermemiz gerekiyor ama unutma uygulamam az güvenilir demekkki
include("ayarlar.php");
session_start();



// use PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\PHPMailer;

// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
// require 'vendor/autoload.php';

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

if ($_POST) {
// if (isset($_POST)) {
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->SMTPDebug = 1;                      // Enable verbose debug output
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication

        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted

        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        // $mail->Host       = 'localhost';                    // Set the SMTP server to send through
        $mail->Port       = 465;                                    // TCP port to connect to

        $mail->Username   = 'omercnkpln@gmail.com';                     // SMTP username
        $mail->Password   = 'Adammmol9021.';                               // SMTP password
        $mail->CharSet    = "utf-8";

        //Recipients
        //alıcı ayarları
        $mail->setFrom('omercnkpln@gmail.com');
        $mail->addAddress('omrcnkpln@gmail.com');     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "mail gönderme dene messi";
        $mail->Body    = "deneme deneme 1 2 ";
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            $alert = array(
                "message" => "Mail başarıyla gönderildi",
                "type" => "success"
            );
        } else {
            $alert = array(
                "message" => "Mail gönderilirken bir hata oluştu!!",
                "type" => "danger"
            );
        }
    } catch (Exception $e) {
        $alert = array(
            "message" => $e->getMessage(),
            "type" => "danger"
        );
    }
    // $_SESSION["alert"] = $alert;
    echo var_dump($alert);
    // header("location:index.php");

} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="description" content="Profesyonel Web Sitesi">
        <meta name="author" content="Kaplan Develop">
        <meta name="keywords" content="HTML, CSS, Eğitim">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Robert-Contact</title>

        <!-- css -->
        <link rel="stylesheet" type="text/css" href="../dist/css/reset.css">
        <link rel="stylesheet" type="text/css" href="../dist/css/contact.css">

        <!-- font-awesome -->
        <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">

        <!-- scripts -->
        <script type="text/javascript" src="../src/scripts/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="../src/scripts/custom.js"></script>

    </head>

    <body>
        <section id="section_1">
            <div class="s_capt">

                <form action="contact.php" id="section_1_form" method="POST">
                    <div id="section_1_form_top">
                        <div id="section_1_form_top_left">
                            <ul>
                                <li>İSİM</li>
                                <li><input type="text" placeholder="isminiz.." autofocus required name="sender"></li>
                                <li>MAIL</li>
                                <li><input type="email" placeholder="e-postanız.." required name="to_email"></li>
                                <li>TEL*</li>
                                <li><input type="tel" placeholder="555-444-2222" pattern="[0-9]{10}" required></li>
                            </ul>
                        </div>
                        <div id="section_1_form_top_right">
                            <ul>
                                <li>MESAJ</li>
                                <li><textarea rows="9" placeholder="Mesajınız" name="message" ></textarea></li>
                                <li><input type="submit" value="Gönder"></li>
                            </ul>
                        </div>
                    </div>
                    <div id="section_1_form_bottom">
                        <div id="section_1_form_bottom_left">
                            <ul>
                                <li>Deneme Kurumu</li>
                                <li>deneme@deneme.com</li>
                                <li>+9 0555 444 33 22</li>
                            </ul>
                        </div>
                        <div id="section_1_form_bottom_right">
                            <ul>
                                <li><a href="#">Paşadağ-Kullar Başiskele / Kocaeli / TURKEY</a></li>
                            </ul>
                        </div>
                    </div>
                </form>

            </div>
        </section>

    </body>

    </html>
<?php
}
?>