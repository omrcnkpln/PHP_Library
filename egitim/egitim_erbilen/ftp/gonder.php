<?php

//zaman asimini engellemek icin
#normali bu galiba arttirinca cozulur
// set_time_limit(30);


//form bilgileri alindi
$ftp_server = $_POST["ftp_sunucu"];
$ftp_kadi = $_POST["ftp_kadi"];
$ftp_sifre = $_POST["ftp_sifre"];
$ftp_dyolu = $_POST["ftp_dyolu"];
$gecici_dosya = $_FILES["dosya"]["tmp_name"];
$dosya_uzantisi = substr($_FILES["dosya"]["name"],-4);
$dosya_adi = rand(1,9999).$dosya_uzantisi;

//ftpye baglan
$baglan = ftp_connect($ftp_server);
if($baglan){
	
	//ftp ye giris yapalim
	$giris = ftp_login($baglan, $ftp_kadi, $ftp_sifre);
	if(){
		
		//dosyalari ftp ye yukleyelim
		$yukle = ftp_put($baglan, $ftp_dyolu."/".$dosya_adi, $gecici_dosya, FTP_BINARY);
		if($yukle){
			echo "Ftp ye <b>".$dosya_adi."</b>adli dosyaniz basariyla yuklendi";
		}else{
			echo "Dosya yukleme islemi basarisiz";
		}
		
	}else{
		echo "Ftp girisi baþarýsýz";
	}
	
}else{
	echo "Ftp sunucusuna baðlanirken hata olustu";
}

?>






