<?php
include("ayarlar.php");

$sayfa = @$_GET["s"];
if(empty($sayfa) || !is_numeric($sayfa)){
	$sayfa = 1;
}

//kacar kcar gosterilecek
$kacar = 2;
//toplam kayit sayisi
$ksayisi = mysqli_num_rows(mysqli_query($baglan,"SELECT id FROM deneme_2"));

//sayiyi yukari yuvarlar
$ssayisi = ceil($ksayisi / $kacar);
//nereden baþlasýn
$nereden = ($sayfa * $kacar) - $kacar;

$bul = mysqli_query($baglan,"SELECT * FROM deneme_2 ORDER BY id DESC LIMIT $nereden,$kacar ");

//Veriler Gösterilsin
while($goster = mysqli_fetch_array($bul)){
	extract($goster);
	echo "
		<div style = 'border : 2px solid #ggg; padding : 5px; margin-bottom : 10px'>
			<b>Gönderen :</b> {$yazan}</br>
			<b>Mail :</b> {$eposta}</br>
			<b>Mesaj :</b> {$mesaj}</br>
		</div>
	";
}
for($i = 1;$i <= $ssayisi;$i++){
	echo "<a href = 'sayfala.php?s={$i}'";
		if($i == $sayfa){
			#aktif klasý atamasý yaptýk.Ozellestimek istenebilir diye.
			echo "class = 'active'";
		}
	echo ">{$i}</a>";
}


?>