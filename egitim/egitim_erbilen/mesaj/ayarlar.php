<?php
$baglan = @mysqli_connect("localhost","root","");
$vt_sec = @mysqli_select_db($baglan,"deneme_1");

#tr karakter sikimtis olmamasi icin gereklimis
mysqli_query($baglan,"SET CHARACTER SET latin5");

?>