<?php

#adi,  degeri,  ne kadar kullanılacagi sn cinsinden
// setcookie("benimki","#ccc", time() + 60);
//Silmek icin tanşmlanan degeri - olarak girdigimiz zaman yok oluyo aq

#boylece depolanan degeri alabiliriz
// echo $_COOKIE["benimki"];

?>

<html>
<head>
	<style>
		body{
			background-color:
			<?php
				#varsa gri yoksa kirmizi anlaminda
				echo @$_COOKIE["benimki"] ? @$_COOKIE["benimki"] : 'red';
			?>;
		}
	</style>
</head>
<body></body>
</html>
















