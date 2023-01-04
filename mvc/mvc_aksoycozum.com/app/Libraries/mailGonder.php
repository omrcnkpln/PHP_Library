<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use System\Config\env;

class mailGonder extends env
{
    public $SMTPHost;
    public $SMTPUser;
    public $SMTPPassword;

    public function __construct()
    {
        $env = new parent();
        $this->SMTPHost = $env->SMTP_SERVER;
        $this->SMTPUser = $env->SMTP_USERNAME;
        $this->SMTPPassword = $env->SMTP_PASSWORD;
    }

    public function sendMail($receiver, $title, $subject = "Test subject", $body = "Test body")
    {
        $mail = new PHPMailer();
        $mail->SMTPDebug = 1;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->SMTPAuth = true;
        $mail->Host = $this->SMTPHost;
        $mail->Username = $this->SMTP_USERNAME;
        $mail->Password = $this->SMTPPassword;
//        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        $mail->SetLanguage("tr", "phpmailer/language");
        $mail->CharSet = "utf-8";

        $mail->setFrom($this->SMTPUser, $title);
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
