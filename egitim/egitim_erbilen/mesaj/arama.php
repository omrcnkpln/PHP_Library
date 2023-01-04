<?php
include("ayarlar.php");

$kelime = $_POST["kelime"];


if(empty($kelime)){
	echo "<font color = 'red'>Lütfen boþ býrakmayýn!!</font></br>";
}else{
		
	$bul = mysqli_query($baglan,"SELECT * FROM deneme_2 WHERE yazan LIKE '%$kelime%'");
	$toplam = mysqli_num_rows($bul);
	if($toplam > 0){
		echo "<font color = 'green'>Toplam {$toplam} sonuc bulundu</font></br>";
		while($goster = mysqli_fetch_array($bul)){
			extract($goster);
			echo "
				<div class = 'yazan'";
				if($onay == 0){
					echo 'style = "background-color : #ff3489"';
				}
				echo ">
					<strong>Gönderen : {$yazan}</strong></br>
					<strong>Mail : {$eposta}</strong></br>
					<strong>Mesaj : {$mesaj}</strong></br>
					<a href='duzenle.php?id={$id}'>[Bu Mesaji Duzenle]</a> | <a href='sil.php?id={$id}'>[Mesajý Sil]</a>
				</div>
			";
		}
	}else{
		echo "<font color = 'red'>Hiç Sonuç Bulunamadý!!</font></br>";
}

		
}
?>