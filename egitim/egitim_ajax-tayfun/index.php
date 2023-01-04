<?php require "ayar.php"; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>jQuery Ajax ile Anlık Veri Güncelleme Uygulaması</title>

	<style type="text/css">
		ul,
		li {
			padding: 0;
			margin: 0;
			list-style: none;
			font: 14px Arial
		}

		ul li {
			padding: 5px;
			background: #eee;
			margin-bottom: 5px
		}

		ul li.new {
			background: lightgreen;
		}
		.yok {
			background: tomato;
		}
	</style>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="ajax.js"></script>
</head>

<body>

	<ul>
		<?php
		$query = mysqli_query($baglan, "SELECT * FROM veri ORDER BY veri_id DESC");

		while ($row = mysqli_fetch_object($query)) {
			echo '
				<li id="' . $row->veri_id . '">'. $row->veri_id . $row->veri_text . '</li>
				';
			}
		?>
	</ul>

	<div id="sonuc"></div>

</body>

</html>