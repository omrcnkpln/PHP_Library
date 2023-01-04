<?php

use System\Helpers\Helper;

session_start();
ob_start();

if (isset($_POST["mail-gonder"])) {
    if (!empty($_POST["name"]) && !empty($_POST["mail"])) {
        include(LIBRARIES . "mailGonder.php");

        $isim = Helper::filter($_POST["name"]);
        $eposta = Helper::filter($_POST["mail"]);
        $telNo = Helper::filter($_POST["tel"]);
        $position = Helper::filter($_POST["position"]);
        $company = Helper::filter($_POST["company"]);
        $talep = null;

        if (!empty($_POST['talep-konusu']) && isset($_POST['talep-konusu'])) {
            $talep_konusu = $_POST["talep-konusu"];

            foreach ($talep_konusu as $value) {
                $talep .= $value . ",";
            }

            $talep = rtrim($talep, ",");
        }
        else {
            $talep = null;
        }

        $gonderen = $eposta;
        $subject = "Aksoy Cözüm Demo Talep Formu";
        $title = "Aksoy Cözüm Demo Talep Formu";
        $mailOwners = array(
            array(
                "eposta" => "ebadestek@aksoycozum.com",
                "eposta" => "dkocak@aksoycozum.com"
            )
        );
//        $alici[0] = $gonderen;
        $alici[0] = "omercnkpln@gmail.com";
        $i = 1;

        if (!empty($mailOwners)) {
            foreach ($mailOwners as $row => $value) {
                $alici[$i] = $value["eposta"];
                $i++;
            }
        }
//        $imageYol = "https://thinkermath.com.tr/public/images/marka-gorselleri/t-logo.png";
        $imageYol = false;

        // mail formatı
        $mail_formati = '
        <div style="width: 80%; padding: 1rem; margin: 0 auto; background-color: #eee; border-radius: 15px;">
            <table style="width: 100%;">
                <tr style="display: grid; place-items: center;">
                    <td style="text-align: center;">
                          <img src="' . $imageYol . '" style="width: 100px; border: 1px solid #e6e6e6; border-radius: 100px;">          
                    </td>       
                </tr>    
            </table>
            <h2>' . $gonderen . ' kullanıcısının yeni bir iletisi var.</h2>
            <p style="margin-left: 1rem;">' . $talep . ' konularında demo talebinde bulunuldu..</p>
            <br>
            <h3>Formdan Gelen Bilgiler</h3>
            <div style="padding: 1rem; border-radius: 10px; background-color: #ddd;">
                <p><strong>İsim    :</strong> ' . $isim . '</p>
                <p><strong>Tel. No :</strong> ' . $telNo . '</p>
                <p><strong>E-posta :</strong> ' . $eposta . '</p>
                <p><strong>Şirket  :</strong> ' . $company . '</p>
                <p><strong>Pozisyon :</strong> ' . $position . '</p>
            </div>
        </div>
    ';

        $mailer = new mailGonder();
        if ($mailer->sendMail($alici, $subject, $title, $mail_formati)) {
            $_SESSION["mailDurum"] = "1";
        }
        else {
            $_SESSION["mailDurum"] = "0";
        }

        header("location:" . BASE . "Home/Index#contact");
    }
}
else {
    ?>
    <div class="alert alert-danger">Bir hata ile karşılaşıldı :/ </br> Daha sonra tekrar deneyiniz !</div>
    <?php
    header("location:" . BASE . "Home/Index");
}

?>
