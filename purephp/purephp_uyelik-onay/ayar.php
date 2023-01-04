<?php 


  try {
	  
	  $db = new PDO("mysql:host=localhost;dbname=deneme;charset=utf8","root","");
	  
  }catch(PDOException $mesaj) {
	  
	  echo $mesaj->getmessage();
	  
  }
 


?>