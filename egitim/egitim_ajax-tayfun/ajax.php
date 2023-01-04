<?php
	require "ayar.php";

	if ($_POST){
		$lastid = $_POST["lastid"];

		if (!$lastid){
			$array["hata"] = "Geçersiz işlem!";
		} else {
			$query = mysqli_query($baglan, "SELECT * FROM veri WHERE veri_id > $lastid ORDER BY veri_id DESC");

			if (mysqli_affected_rows($baglan)){
				while ($row = mysqli_fetch_object($query)){
					$array["veriler"] = '<li class="new" id="'.$row->veri_id.'">'.$row->veri_id.$row->veri_text.'</li>';
				}
			} else {
				$array["hata"] = '<li class="yok">Yeni eklenmiş veri bulunmuyor</li>';
			}
		}
		echo json_encode($array);
	}
?>