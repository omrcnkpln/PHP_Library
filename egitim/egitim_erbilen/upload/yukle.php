<?php
/* 
$_FILES
tmp_name
name
size
type
is_uploaded_file()
move_uploaded_file()
 */

#500kb a denk geliyo
$maxboyut = 500000;
$dosyauzantisi = substr($_FILES["dosya"]["name"],-4,4);
$dosyaadi = rand(0,99999999).".".$dosyauzantisi;
$dosyayolu = "dosya/".$dosyaadi;

if($_FILES["dosya"]["size"] > $maxboyut){
	echo "Dosya boyutu en fazla <b>500kb</b> olabilir...";
}else{
	$d = $_FILES["dosya"]["type"];
	if($d == "image/png" || $d = "image/jpeg" || $d == "image/gif"){
		
		if(is_uploaded_file($_FILES["dosya"]["tmp_name"])){
			
			$tasi = move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyayolu);
			if($tasi){
				echo "<b>{$dosyaadi}</b> adlý dosya basariyla yüklendi</br>
				<img src = 'http://localhost/upload/{$dosyayolu}' />	";
			}else{
				echo "Dosya taþýnýrken bir sorun oluþtu!!"; 
			}
			
		}else{
			echo "Dosya yüklenirken bir hata oluþtu!!";
		}
		
	}else{
		echo "Dosya formatý <b>GIF, PNG yada JPEG</b> formatýnda olmalýdýr";
	}
}
?>