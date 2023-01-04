<?php

$klasor_s = $_POST["klasor_s"];
$sil = rmdir($klasor_s);
if($sil){
	echo "Dizin basariyla silindi";
}else{
	echo "Babayý alýrsýn";
}
?>