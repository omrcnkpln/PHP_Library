<?php

use Models\VT;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class MailGonder
{
  public $SMTPHost;
  public $SMTPUser;
  public $SMTPPassword;
  public $baglantiPDO;

  public function __construct()
  {
//    $this->baglantiPDO = new parent();
      $VT = new VT();
    $ayarlarInfos = $VT->VeriGetir("ayarlar", "WHERE ID=?", array(1), "ORDER BY ID ASC", 1);

    $this->SMTPHost = $ayarlarInfos[0]["SMTP_host"];
    $this->SMTPUser = $ayarlarInfos[0]["SMTP_username"];
    $this->SMTPPassword = $VT->sifrele($ayarlarInfos[0]["SMTP_password"]);
  }

  public function sendMail($receiver, $subject = "Test subject", $body = "Test body")
  {
    $mail = new PHPMailer();
    $mail->SMTPDebug = 0;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $this->SMTPHost;                            // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $this->SMTPUser;                 // SMTP username
    $mail->Password = $this->SMTPPassword;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->SetLanguage("tr", "phpmailer/language");
    $mail->CharSet = "utf-8";

    $mail->setFrom($this->SMTPUser, "ThinkerMath İletişim Formu");
    foreach ($receiver as $row => $value) {
      $mail->addAddress($value);                     // Add a recipient
    }
    $mail->addReplyTo($this->SMTPUser);

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = $body;

    if ($mail->Send()) {
      return true;
    }
    else {
      return false;
    }
  }
}
