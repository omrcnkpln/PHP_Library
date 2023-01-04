<?php
      
	  
	  include("mail/PHPMailerAutoload.php");
			
            $mail = new PHPMailer;            
 			
			$mail->IsSMTP();
			//$mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls'; // Güvenli baglanti icin ssl normal baglanti icin tls
			$mail->Host = "smtp.yandex.com"; // Mail sunucusuna ismi
			$mail->Port = 587; // Gucenli baglanti icin 465 Normal baglanti icin 587
			$mail->IsHTML(true);
			$mail->SetLanguage("tr", "phpmailer/language");
			$mail->CharSet  ="utf-8";
			$mail->Username = "nuralpmehmet@yandex.com"; // Mail adresimizin kullanicý adi
			$mail->Password = "deneme123"; // Mail adresimizin sifresi
			$mail->SetFrom("nuralpmehmet@yandex.com",$isim); // Mail attigimizda gorulecek ismimiz
			$mail->AddAddress("mehmet.cemil.nuralp@gmail.com"); // Maili gonderecegimiz kisi yani alici
			$mail->addReplyTo($email, $isim);
			$mail->Subject = $baslik; // Konu basligi
			$mail->Body = "<div style='background:#eee;padding:5px;margin:5px;width:300px;'> eposta : ".$email."</div> <br /> mesaj : <br />".$mesaj; // Mailin icerigi
			if(!$mail->Send()){
			
                  echo 'mail gonderilemedi';
			
			}else {
				
				echo 'mail gonderildi...';
				
			}
				
				
				?>