<?php
//<!-- ders 21------------------------------------------------------- -->
include("ayarlar.php");

$id = @$_GET["id"];
$sil = mysqli_query($baglan,"DELETE FROM deneme_2 WHERE id = '$id' ");
if($sil){
	echo '<font color = "green">Ba�ar�yla Silindi</font>';
	#biraz bekletip bilgiyi g�sterdikten sora sayfaya y�nlendirmemize yarar
	header("Refresh:2; url = 17den sora.php");
}else{
	echo '<font color = "red">Ba�ar�s�z oldu'.mysqli_error($sil).'</font>';
}
//toplu silmeye bakmad�k anlatt� o kadar adam

?>