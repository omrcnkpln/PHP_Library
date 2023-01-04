<!-- klasör isminde türkçe karakter kulanırsan eger hata veriyor dizin bulunamadı gibi bir şey -->
<!-- resmin uzantısına falan bakmadan çağırdığında resmi bastırıyor uyandırayım -->
<!-- sanırsam mime tipini zaten kesiyo ona göre hareket ediyor uzantısı çok da bağlamıyo -->
<?php include 'baglan.php'?>
<meta charset="utf-8">

<form action = "yukle.php" method="post" enctype="multipart/form-data">
	<h1>dosya yükle</h1>
	<p><input type="file" name="foto"></p>
	<p><input type="text" name="text"></p>
	<input type="submit" value="yukle">
</form>