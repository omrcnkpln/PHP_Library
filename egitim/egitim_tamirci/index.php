<!-- uyarıları kod içerisinde yapıyorum -->
<!-- a tagında hrefin içerisini de yine tablodan dolduracağık -->
<!-- header.php ye ayarlar tablosunu çekip onu da buraya dahil ettiğimizde o tablonun elemanlarına buradan da ulaşabiliyoruz -->
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<title>Admin Template</title>

</head>
<body>

	<!-- exract yaparsan değişken olarak kullanabiliyorsun yoksa yukardaki gibi kullanman gerekiyor -->
	<!-- header.php yi buraya dahil ettiğim için ordaki değişkenleri de kullanabiliyorum alttaki gibi -->
	<img src=" <?php echo $ayarcek['ayar_logo']?> " width = "400px" height = "400px">
	<img src=" <?php echo $ayar_logo ?> " width = "400px" height = "400px">
	<h4>üst dizin index</h4>
	<h4>üst dizin index</h4>
	<h4>üst dizin index</h4>
	<h4>üst dizin index</h4>

</body>
</html>

<?php include 'footer.php'; ?>
