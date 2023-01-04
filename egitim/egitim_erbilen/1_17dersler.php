


<!-- ders 6*********************************************************** -->
<!--
<form action="kontrol.php" method="post">

 <table cellpadding="5" cellspacing="5">

	<tr>
		<td>Ad-Soyad:</td>
		<td><input type="text" name="adsoyad" /></td>
	</tr>

	<tr>
		<td>Yas:</td>
		<td><input type="text" name="yas" /></td>
	</tr>

	<tr>
		<td>Sehir</td>
		<td><select name="sehir">
			<option value="Eskisehir">Eskisehir</option>
			<option value="Ankara">Ankara</option>
			<option value="Kocaeli">Kocaeli</option>
		</select></td>
	</tr>

	<tr>
		<td></td>
		<td><input type="submit" value="Gonder"/></td>
	</tr>

 </table>

</form>
-->

<?php
//ders 7************************************************************
/*
$sayfa = @$_GET["sayfa"];

echo '<a href="1_17dersler.php?sayfa=hakkimda">Hakkimda</a> | <a href="1_17dersler.php?sayfa=iletisim">iletisim</a> | <a href="1_17dersler.php?sayfa=referanslar">referanlar</a>' ;

if($sayfa == "hakkimda"){
	echo "<h1>Hakkimda</h1><p>Baba Yorgun</p>";
}elseif($sayfa == "iletisim"){
	echo "<h1>Iletisim</h1><p>Benimle <a href='mailto:omrcnkpln@gmail.com'>omrcnkpln@gmail.com<a/> adresinden temasa gecebilirsiniz</p>";
}elseif($sayfa == "referanslar"){
	echo "<h1>Referanslar</h1><p>Referanslar yakinda eklenecek.</p>";
}else{
	echo "</br><h2>Boyle bir sayfa bulunamadi.Muhtemelen <b>GIRIS</b> sayfasindasiniz</h2>";
}
 */
//ders 14************************************************************

//Dosya işlemleri

$ac = fopen("test.txt","w");
$yaz = fwrite($ac,"baba yorgun ");

//$ac = fopen("deneme.txt","r");
//$oku = fgets($ac, 999);
//$oku2 = fgetss($ac, 999, "<b><i>");

//	echo $oku2;

 /*
while($goster = fgetcsv($ac, 999, " ")){

	$say = count($goster);
//ayni isi gorur
	$say = sizeof($goster);

	for($i=0;$i<$say;$i++){
		echo $goster[$i]."<br />";
	}

}
	 */
 /* dosyanin acilmasi gerekmez */
 /*
readfile("deneme.txt");

//bunda acmak gerekir
$ac = fopen("deneme.txt","r");
fpassthru($ac);
 */
/*
echo file_get_contents("deneme.txt");

file_exists();
filesize();
 */
 /*
//dosya olusturur
touch("dosya_olustur.txt");
//dosyayi siler
unlink("dosya_sil.txt");
  */

//ders 15************************************************************
//DIZILER
/*
$kaplan = array("baba","yorgun","ve",10,"numara");
$kaplan[5] = "gardas";

$toplam = count($kaplan);

foreach($kaplan as $a){
	echo $a."<br />";
}
 */
/*
$dizi = array(
	'ad' => "omer",
	'okul no' => 29,
	'sinif' => "12/A"
);
foreach($dizi 	as $a => $b){
	echo $a." : ".$b."<br/ >";
}
 */
/*
$dizi = array(
	array("omer can","kaplan",29),
	array("omer","baba",29),
	array("omer","kaplan",29),
);

echo var_dump($dizi);
echo $dizi[0][1];

	for($i=0;$i < 3;$i++){
		for($x=0;$x<3;$x++){
			echo $dizi[$i][$x]."<br />";
		}
	}
 */
//DIZILERDE FONKSIYONLAR
/*
$dizi = array("ahmet","omer","mehmet","can");
//alfabetik siralar
sort($dizi);
//ters alfabetik siralar
rsort($dizi);

foreach($dizi as $a){
	echo $a."<br />";
}
 */

// $dizi = array('domates' => 2, 'paatlican' => 1, 'erik' => 5);
/*
//sag tarafa gore
asort($dizi);
//sag tarafa gore ters
arsort($dizi);
//sol tarafa gore
ksort($dizi);
//her yenilendiginde rastgele gostermek icin
shuffle($dizi);

//dizinin sonuna ekleme yapmak
array_push($dizi,'eklenmek istenen');

//ne var ne yok gosterir
echo var_dump($dizi);
//aynisindan kac tane var diye bakar
// $a = array_count_values($dizi);
 */
 /*
//soldakileri degiskene donusturur
extract($dizi);
echo $domates;
 */

//ders 17************************************************************
//PHP Mailer - Calistiramadik
/*
if($_POST){

	$diger = 'MIME-Version : 1.0'."\r\n";
	$diger .= 'Content-type : text/html; charset = iso-8859-9'."\r\n";
	$adsoyad = $_POST["adsoyad"];
	$eposta = $_POST["eposta"];
	$mesaj = $_POST["mesaj"];
	$konu = "iletisim bildirimi";
	$kime = "omrcnkpln@gmail.com";
	$icerik = "Gonderen : ".$adsoyad."</br>
				Eposta : ".$eposta."</br>
				Konu : ".$konu;
	$diger .= 'From : '.$eposta;

	$gonder = mail($kime,$icerik,$mesaj,$diger);
	if($gonder){
		echo "Iletisim gonderildi";
	}else{
		echo $gonder -> ErrorInfo;"Gonderme basarisiz";
	}
}else{
	echo'
	<form action = "" method = "post">

		<h2>Iletisim Formu</h2>

		<table cellpadding = "5" cellspacing = "5">

			<tr>
				<td>Ad-Soyad : </td>
				<td><input type = "text" name = "adsoyad" /></td>
			</tr>

			<tr>
				<td>E-Posta : </td>
				<td><input type = "text" name = "eposta" /></td>
			</tr>

			<tr>

				<td>Mesaj : </td>
				<td><textarea rows = "3" cols = "30" name = "mesaj"></textarea></td>
			</tr>

			<tr>
				<td></td>
				<td><input type = "submit" value = "Gönder"/></td>
			</tr>

		</table>
	</form>
	';
}

 */
?>



















