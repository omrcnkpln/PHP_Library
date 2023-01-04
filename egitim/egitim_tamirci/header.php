<?php
include 'nedmin/netting/baglan.php';

$ayarsor = mysqli_query($baglan,"SELECT * FROM ayarlar");
$ayarcek = mysqli_fetch_assoc($ayarsor);
extract($ayarcek);

?>
<meta charset="utf-8">

<?php 
	echo $ayar_logo;
	echo "<br>";
	echo $ayarcek['ayar_logo'];
?>

<h1>üst dizin header</h1>
<h1>üst dizin header</h1>
<h1>üst dizin header</h1>
<h1>üst dizin header</h1>