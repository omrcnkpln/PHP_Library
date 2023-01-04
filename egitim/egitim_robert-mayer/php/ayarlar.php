<?php

// try-catch yapısını kullanmak lazım galiba
//buraya dışardan giren olursa index e geri dönmesi lazım güvenlik açısından
// $conn = mysqli_connect($servername, $username, $password, $database);
$baglan = mysqli_connect("localhost", "root", "", "robert");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_query($baglan, "SET NAMES utf8");
mysqli_query($baglan, "SET CHARACTER SET utf8");
mysqli_query($baglan, "SET NAMES COLLACTION_CONNECTION = 'utf8_turkish_ci'");
