<?php
//<!-- ders 21------------------------------------------------------- -->
include("ayarlar.php");

$id = @$_GET["id"];
$sil = mysqli_query($baglan,"DELETE FROM deneme_2 WHERE id = '$id' ");
if($sil){
	echo '<font color = "green">Baþarýyla Silindi</font>';
	#biraz bekletip bilgiyi gösterdikten sora sayfaya yönlendirmemize yarar
	header("Refresh:2; url = 17den sora.php");
}else{
	echo '<font color = "red">Baþarýsýz oldu'.mysqli_error($sil).'</font>';
}
//toplu silmeye bakmadýk anlattý o kadar adam

?>