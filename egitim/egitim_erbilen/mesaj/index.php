
<!-- ders 21------------------------------------------------------- -->
<!-- Veritabanına benzersiz deyince aynisindan kaydetmiyo galiba mesela bi gmailden bi tane olcak falan -->
<!-- Tabloda iki tane anahtar oldu yada iki tane benzersiz oldu nasil düzelcek -->
<!-- hatali girislerde de id yi artiriyor !bilgi-->
<?php 
include("ayarlar.php"); 
?>

<html>
<head>
	<title>kaplanDevelop</title>
	<meta charset = "utf-8" />
	<!-- bise fark etmedi ayni -->
	 <!-- <meta http-equiv = "Content-Type" content = "text/html; charset = iso-8859-9" /> -->
	<style>
		.yazan{
			border :  2px solid #ddd; padding : 10px; margin-bottom : 10px;
		}
	</style>
</head>
<body>
<?php

if($_POST){
	$adsoyad = $_POST["adsoyad"];
	$mesaj = $_POST["mesaj"];
	$eposta = $_POST["eposta"];
	
	if(!empty($adsoyad) && !empty($eposta) &&!empty($mesaj)){
		#format bu sekilde. Bu sekilde kullaniliyo
		// mysqli_query($baglan,"SELECT * FROM deneme");
		
		#verileri ekleme
		$ekle = mysqli_query($baglan,"INSERT INTO deneme_2(yazan,eposta,mesaj,onay) VALUES('$adsoyad','$eposta','$mesaj',0)");
		if($ekle){
			echo "<font color = 'green'>Veriler basariyla eklendi!!</font>";
			header("refresh:2; url = index.php");
		}else{
			echo "<font color = 'red'>Basarisiz oldu!!!</font>";
		}
	}
}else{
	
	#nerde islemler yapilacagini belirtiyoruz kosullarla beraber
	#DESC deyince tersten oluyo, ASC yaparsak normal duz, sondan 2 tane gostermis olduk
	//$bul = mysqli_query($baglan,"SELECT * FROM deneme_2 WHERE onay = '1' ORDER BY id DESC LIMIT 0,2");
	/* 
	#toplam kac tane dersek
	$bul = mysqli_query($baglan,"SELECT * FROM deneme_2");
	$toplam = mysqli_num_rows($bul);
	echo "<h1>Toplam Veri : {$toplam}</h1>";
	 */
	  
	#yada boyle daha hizli olabilir
	$bul = mysqli_query($baglan,"SELECT * FROM deneme_2");
	/* 
	$toplam_2 = mysqli_fetch_array(mysqli_query($baglan,"SELECT COUNT(id) FROM deneme_2"));
		echo "<h1>Toplam Veri : {$toplam_2[0]}</h1>";		
	 */	 
	#bu da bir ornek
	/* $bul = mysqli_query($baglan,"SELECT * FROM deneme_2 WHERE onay = '1' && eposta = 'omrcnkpln@hotmail.com' ORDER BY id DESC "); */
	while($goster = mysqli_fetch_array($bul)){
		/* 
		echo "
			<div class = 'yazan'>
				<strong>Gönderen : {$goster['yazan']}</strong></br>
				<strong>Mail : {$goster["eposta"]}</strong></br>
				<strong>Mesaj : {$goster['mesaj']}</strong></br>
			</div>
		";
		 */
		#degerleri direk degisken olarak gostermis olduk.
		
		extract($goster);
		//echo var_dump($goster);
		
		#a ile gonderip get ile alacagin zaman bosluk olayina dikkat !!
		echo "
			<div class = 'yazan'";
			if($onay == 0){
				echo 'style = "background-color : #ff3489"';
			}
			echo ">
				<strong>Gönderen : {$yazan}</strong></br>
				<strong>Mail : {$eposta}</strong></br>
				<strong>Mesaj : {$mesaj}</strong></br>
				<a href='duzenle.php?id={$id}'>[Bu Mesaji Duzenle]</a> | <a href='sil.php?id={$id}'>[Mesajı Sil]</a>
			</div>
		";
	
	}
}

?>

<!-- HTML -->

<h1>Arama</h1>

<form action = "arama.php" method = "post">

	<input type = "text" name="kelime" />	<input type = "submit" value = "ARA" />
	
</form>

<h1>Mesaj Gonder</h1>

<form action = "" method = "post">

	<table cellpadding = "5" cellspacing = "5">
		
		<tr>
			<td>Ad-Soyad:</td>
			<td><input type = "text" name = "adsoyad" /></td>
		</tr>
		
		<tr>
			<td>E-Posta</td>
			<td><input type = "text" name = "eposta" /></td>
		</tr>
		
		<tr>
			<td>Mesaj</td>
			<td><textarea rows = "5" cols = "30" name = "mesaj"></textarea></td>
		</tr>
		
		<tr>
			<td></td>
			<td><input type = "submit" value = "Gonder"</textarea></td>
		</tr>
		
	</table>

</form>

</body>
</html>
