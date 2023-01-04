<?php
$username = "root";
$password = "";
$sunucu = "localhost";
$database = "tamirci";

//daha güzeli robert_mayer projesinde bulunmakta
$baglan = mysqli_connect($sunucu,$username,$password);
mysqli_query($baglan,"SET NAMES UTF8");

if(!$baglan){
	mysqli_close($baglan);
	// echo "<meta http-equiv = 'refresh' content = '0; URL = http://falan.com/nedmin/netting/baglanti_hata/hata.php?hata = baglanti_hata'>";
	exit();
}
$db = mysqli_select_db($baglan,$database);

if(!$db){
	echo "veritabanı hatası : ".mysqli_error($db);
	echo "<br>";
	// echo "<meta http-equiv = 'refresh' content = '0; URL = http://falan.com/hata.php?hata = veritabani_hata'>";
	exit();
}

?>