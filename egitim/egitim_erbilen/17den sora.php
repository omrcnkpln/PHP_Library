<?php
#ders 18-------------------------------------------------------
/* 
$a = "   s               kaplan";
//bosluklari kaldirir
trim($a);
//soldan bosluklari kaldirir
ltrim($a);
//sagdan bosluklari kaldirir
rtrim($a);

echo $a;
 */
/*  
$a = "baba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgun
baba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgun
baba yorgunbaba yorgunbaba yorgunbaba yorgun


baba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgunbaba yorgun
baba yorgunbaba yorgun"; 
#satir baslarina br etiketi ekler 
 echo nl2br($a);
 */ 
/*  
 $a = "kaplan";
 echo "omer ".$a."<br/><br/>";
 
 //bu sekilde de olur
 printf("omer %s",$a);
 */ 
  /* 
$a = 2.9;
$b = "baba";
//ters bastirilabilir ve noktadan sonraki basamak olayi
 printf("toplam : %2\$.2f <br/>Alici: %1\$s",$b,$a);
  */
/*  
$a = "omer baba cok yorgun";

echo strtoupper($a)."<br/>";
echo strtolower($a)."<br/>";
echo ucfirst($a)."<br/>";
echo ucwords($a)."<br/>";
 */
/* 
$a = 'omer "BABA" beni yordu..';
#tirnaklarin basina slaş koyar
$b = addslashes($a);
echo $b."</br>";
#kaldirir
echo stripslashes($b);
 */
#ders 19-------------------------------------------------------
//DIZILERDE KULLANILAN BAZI FONKSIYONLAR
/* 
$a = "admin@baba.com";
echo $a."<br/>";
//belli bir yerden ayırıyoruz
$parcala = explode("@",$a);
echo $parcala[0]."<br/>";
echo $parcala[1]."<br/>";

echo var_dump($parcala);
 */
/* 
//mesela
if($parcala[1] != "hotmail.com"){
	echo "yakisti mi simdi";
}else{
	echo "delikanlisin";
}
  */
  /* 
#birlestirmek icin de bu
$birlestir = implode("//||***",$parcala);
echo $birlestir;
 */
 /* 
#baslangic ve ne kadar olacagi
$a = " kaplanomercan";
echo substr($a,-3,3);
 */
/* 
$a = "123123";
echo strlen($a); 
 */
 /* 
 #icerisinde arama yapar bulduktan sonrasini yazdirir
strstr(samanlık,igne);
  */
  /* 
#bulundugu indexi verir daha hızlı calisir  
strpos($a,"deneme");  
 */
 /* 
 //yerine yazmaca
$a = "<font color = '<<renk>>'>KAPLAN</font>";
echo str_replace("<<renk>>","red",$a);
  */
/* 
#icirigi diziler yardimiyle degistirme olayi
$a = "selam evlat baba yorgun ve argin";

$bul = array("selam","evlat","argin");
$degistir = array("merhaba","delikanli","bitkin");
echo str_replace($bul,$degistir,$a);
 */
 
#ders 20-------------------------------------------------------
/* 
#dosya dahiletmeye yarar. Dahil edilmezse fatal error verir.
require();
#dosya dahiletmeye yarar.Yoksa uyari verir.
include();
 */
/* 
require("deneme.txt");
echo "</br>";
#o dosyadaki degiskeni de cagirabiliriz mesela
echo $a;
 */
 /* 
//sayfaya sadece bir kere cagirilsin diye istersek
require_once();
include_once();
  */
?>

<!-- SABLON UYGULAMASI -->
<!-- 
<html>
<head>
	<title>Selam Bitches</title>
	<style type="text/css">
		body{
			font:12px Arial;
			background-color:#eee;
		}
		ul,li,h1,p{
			padding:0;
			margin:0;
			list-style-type:none;
		}
		#menu{
			background-color:brown;
			overflow:auto;
		}
		#menu li{
			float:left;
			padding:5px;
		}
		#menu li a{
			display:block;
			padding:5px;
			color:#fff;
			font-size:14px;
			font-weight:bold;
		}
		.header{
			padding:10px 0;
		}
		#icerik{
			background-color:#fff;
			border:3px solid #ddd;
			padding:10px 0;
			margin-top:10px;
		}
		#footer{
			border-top:3px solid #ddd;
			padding:10px 0;
			margin-top:10px;
		}
	</style>
</head>
<body>
	<div class="header">
		
		<h1>Babalara Geldiniz</h1>
	
		<p>Bu bir sablon denemesidir.</p>
	
	</div>
	
	<ul id="menu">
		<li><a href="17den sora.php">Anasayfa</a></li>
		<li><a href="17den sora?git=hakkimda">Hakkımda</a></li>
		<li><a href="17den sora?git=portfolyo">portfolyo</a></li>
		<li><a href="17den sora?git=iletisim">İletişim</a></li>
	</ul>
	
	<div id="icerik">
	 
		<?php
		/* 
			$git = @$_GET["git"];
			Switch($git){
				
				case "hakkimda";
					include("hakkimda.php");
				break;
				
				case "portfolyo";
					include("portfolyo.php");
				break;	
				
				case "iletisim";
					include("iletisim.php");
				break;
				
				default;
					echo '<h1>Hoşgeldiniz..</h1>
					<p>Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!
					</br></br>Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!
					Burası karışacak vaziyet alın!!</br></br></br>Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!
					Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!Burası karışacak vaziyet alın!!
					</p>';
				break;
			}
		 */	
		?>
		 
	</div>
	
	<div id="footer">
	Tüm Hakları Saklıdır. &copy;2019 - kaplan.com
	</div>
	
</body>
</html>
-->

<?php
#ders 21-------------------------------------------------------

//fonksiyonlar 
#buyuk kucuk harf duyarliligi yoktur
/* 
function kaplan(){
	echo "merhaba dunya";
}
kaplan();
 */
/* 
 #2.paramerenin degerini belirtmezsek 10 degerini alir
 function kaplan($a,$b = 10){
	 $toplam = strlen($a);
	 if($toplam > $b){
		 $a = substr($a,0,$b)."...";
	 }
	 return $a;
 }
$deneme = "benim adım ramazan. Ben bu oyunu bozarım ulen.Ben bu oyunu bozarım ulenBen bu oyunu bozarım ulenBen bu oyunu bozarım ulen";
echo kaplan($deneme,50);
 */

#ders 21-------------------------------------------------------
//VERITABANI BAGLANTISI
#MySQL baglanma olayi
//mysql_connect();
#Veritabanini Secme
//mysql_select_db();
/* 
#3.sü sifre aslinda
$baglan = @mysqli_connect("localhost","root","");
	if($baglan){
		
		echo "<font color = 'green'>MySQL'e Baglanti Saglandi.</fonts></br>";
		$vt_sec = @mysqli_select_db($baglan,"deneme_1");
		
		if($vt_sec){
			echo "<font color = 'green'>Veritabani Secildi.</fonts></br>";
		}else{
			die("Veritabani secilemedi");
		}
	}else{
		die("MySQL'e Baglanti Saglanamadi");
	}
 */
/* 	
#MySQL ile baglantiyi sonlandirmak icin
$kapat = mysqli_close($baglan);
	if($kapat)
		echo "MySQL baglantisi sonlandirildi";
 */
?>































