<?php

	/**
		- Erbilen.NET 
		- Prototurk.com 
		- UzmanVideo.Org
	**/

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db   = "ajax";
	
	$baglan = mysqli_connect($host, $user, $pass) or die (mysql_errno());
	mysqli_select_db($baglan, $db) or die (mysqli_errno());
	mysqli_query($baglan, "SET CHARACTER SET 'utf8'");
	mysqli_query($baglan, "SET NAMES 'utf8'");

?>