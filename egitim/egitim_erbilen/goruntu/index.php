<?php
//Tuvali olusturduk
$tuval = ImageCreateTrueColor(400,200);
//Rengi Belirleyecegiz
$renk1 = ImageColorAllocate($tuval, 165, 42, 42);
$renk2 = ImageColorAllocate($tuval, 8064, 8058, 8057);
//Tuvali Boyayalim
ImageFill($tuval, 0, 0,$renk1);
//Cizgi cizelim
ImageLine($tuval, 0, 0, 400, 200,$renk2);
//yazi yazalim
ImageString($tuval, 5, 160,30, 'KaplanDevelop',$renk2);
//Cikti alinacak
header("Content-type: image/png");
ImagePng($tuval);





?>
































