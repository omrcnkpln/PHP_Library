<?php
 
/* 
opendir();
readdir();
closedir();
*/

$dizin = "dosya/";
$ac = opendir($dizin); //dizini a�t�k

while($dosya = readdir($ac)){
	
	#bulundugumuz dizin ve bi onceki dizin anlaminda noktalar ck�or.Onlar icin
	if($dosya != "." && $dosya != ".."){
		echo "<li><a href = 'dosya/{$dosya}' target = '_blank'>{$dosya}</a></li>";
	}
	
}
closedir($ac);
 
?>