<?php
$baglan = mysqli_connect("localhost","root");

$db_select = mysqli_select_db($baglan,"db_1") or die(mysqli_error($baglan));

#oturumu baslattik
session_start();

if($_POST){
	
	$kadi = $_POST["kadi"];
	$sifre = $_POST["sifre"];
	
	$bul = mysqli_query($baglan,"SELECT * FROM uye WHERE kadi = '$kadi' && sifre = '$sifre' ");
	$say = mysqli_num_rows($bul);
	
	if($say > 0){
		$goster = mysqli_fetch_array($bul);
		$_SESSION["oturum"] = true;
		$_SESSION["kadi"] = $kadi;
		$_SESSION["sifre"] = $sifre;
		$_SESSION["eposta"] = $goster["eposta"];
		$_SESSION["rutbe"] = $goster["rutbe"];
		header("Location:index.php");
	}else{
		echo '
			<font color = "red">Giri� Ba�ar�s�z Oldu</font>
		';
	}
	
}else{
	
	if(isset($_SESSION["oturum"])){
		
		//Girisi basarili olanlar�n yeri
		echo '
			Merhaba,Ho�geldiniz<b>'.$_SESSION["kadi"].' [<a href = "cikis.php">��k�� Yap</a>]
		';
		
		if($_SESSION["rutbe"] == 1){
			//Sadece adminlere
			echo '
				<a href = "admin.php">Y�netim Panelini G�ster<a/>
			';
		}
		
	}
	
	if(!isset($_SESSION["oturum"])){
		
		echo '
			<form action = "" method = "post">

			<table cellpadding = "5" cellspacing = "5">
				
				<tr>
					<td>Kullanici Adi : </td>
					<td><input type = "text" name = "kadi" /></td>
				</tr>
				
				<tr>
					<td>�ifre : </td>
					<td><input type = "password" name = "sifre" /></td>
				</tr>
				
				<tr>
					<td></td>
					<td><input type = "submit" value = "Giri� Yap" /></td>
				</tr>
				
			</table>
			
			</form>
		';
	
	}
}


?>




























