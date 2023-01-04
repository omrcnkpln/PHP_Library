<?php
 
/* 
opendir();
readdir();
closedir();
*/

$dizin = "dosya/";
$ac = opendir($dizin); //dizini açtýk

while($dosya = readdir($ac)){
	
	#bulundugumuz dizin ve bi onceki dizin anlaminda noktalar ckýor.Onlar icin
	if($dosya != "." && $dosya != ".."){
		echo "<li><a href = 'dosya/{$dosya}' target = '_blank'>{$dosya}</a></li>";
	}
	
}
closedir($ac);
 
?>