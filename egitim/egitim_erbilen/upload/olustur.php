<?php
/* 
mkdir(); //dizin olusturur
rmdir(); //dizin siler
umask(); //umask ayarini yapar
 */
 
 if($_POST){
	 
	 #ikinci parametre icin gerekli umask ayari
	 $eski = umask(0);
	$olustur = mkdir($_POST["klasor_o"],0777);
	umask($eski);
	if($olustur){
		echo $_POST["klasor_o"]."adlý klasör baþarýyla oluþturuldu!";
	}else{
		echo "Klasör oluþturulurken sýkýntý çýktý! Hass..";
	}
	 
 }else{
	 //olusturma islemi
	 echo '
		<form action = "" method = "post">
			<input type = "text" name = "klasor_o" />
			<input type = "submit" value = "Olustur" />
		</form>
	 ';
	 //silme islemi
	 echo '
		<form action = "klasor_sil.php" method = "post">
			<input type = "text" name = "klasor_s" />
			<input type = "submit" value = "Sil" />
		</form>
	 ';
	 
 }
 
?>