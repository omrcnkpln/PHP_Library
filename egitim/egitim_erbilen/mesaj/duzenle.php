<?php

include("ayarlar.php");

$id = @$_GET["id"];

//Mesajý bul

$bul = mysqli_query($baglan,"SELECT * FROM deneme_2 WHERE id = '$id'");
$goster = mysqli_fetch_array($bul);
@extract($goster);

if($_POST){
	
	$adsoyad = @$_POST["adsoyad"];
	$eposta = @$_POST["eposta"];
	$mesaj = @$_POST["mesaj"];
	$onay = @$_POST["onay"];
	
	$guncelle = mysqli_query($baglan,"UPDATE deneme_2 SET yazan = '$adsoyad',eposta = '$eposta',mesaj = '$mesaj',onay = '$onay' WHERE id = '$id' ");
	if($guncelle){
		echo '<font color = "green">Basariyla Guncellendi</font>';
		header("refresh:2; url = index.php");
	}else{
		echo '<font color = "red">Bir Sorun Olustu !</br>'.mysqli_error($baglan).'</font>';
	}
}else{
	
	echo '
	<h1>Mesaj Güncelleme</h1>
	
	<form action = "" method = "post">

	<table cellpadding = "5" cellspacing = "5">
		
		<tr>
			<td>Ad-Soyad : </td>
			<td><input type = "text" name = "adsoyad" value = "'.$yazan.'" /></td>
		</tr>
		
		<tr>
			<td>E-posta : </td>
			<td><input type = "text" name = "eposta" value = "'.$eposta.'" /></td>
		</tr>
		
		<tr>
			<td>Mesaj : </td>
			<td><textarea rows = "5" cols = "30" name = "mesaj">'.$mesaj.'</textarea></td>
		</tr>
		
		<tr>
			<td>Onayli Mi?</td>
	
			<td>
				<select name = "onay">
				
					<option value = "1"';
						if($onay == 1){
							echo 'selected';
						}
					echo '>EVET</option>
					
					<option value = "0"';
						if($onay == 0){
							echo 'selected';
						}
					echo '>HAYIR</option>
				
				</select>
			</td>
			
		</tr>
		
		<tr>
			<td></td>
			<td><input type = "submit" value = "GÜNCELLE" /></td>
		</tr>
		
	</table>
	
	</form>
';
	
}
/* 
echo '
	<h1>Mesaj Güncelleme</h1>
	
	<form action = "" method = "post">

	<table cellpadding = "5" cellspacing = "5">
		
		<tr>
			<td>Ad-Soyad : </td>
			<td><input type = "text" name = "adsoyad" value = "'.$yazan.'" /></td>
		</tr>
		
		<tr>
			<td>E-posta : </td>
			<td><input type = "text" name = "eposta" value = "'.$eposta.'" /></td>
		</tr>
		
		<tr>
			<td>Mesaj : </td>
			<td><textarea rows = "5" cols = "30" name = "mesaj">'.$mesaj.'</textarea></td>
		</tr>
		
		<tr>
			<td>Onayli Mi?</td>
	
			<td>
				<select name = "onay">
				
					<option value = "1"';
						if($onay == 1){
							echo 'selected';
						}
					echo '>EVET</option>
					
					<option value = "0"';
						if($onay == 0){
							echo 'selected';
						}
					echo '>HAYIR</option>
				
				</select>
			</td>
			
		</tr>
		
		<tr>
			<td></td>
			<td><input type = "submit" value = "GÜNCELLE" /></td>
		</tr>
		
	</table>
	
	</form>
';
 */
?>