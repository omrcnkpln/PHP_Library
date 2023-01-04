<!-- sürekli tablonun ilk resmini çekiyo o sebepten dosyaya gidiyo-->
<meta charset="utf-8">
<?php include 'baglan.php'?>

<?php

	$name = $_POST["text"];

    $max_boyut = 500000;
    $dosya_uzantisi = substr($_FILES["foto"]["name"],-4,4);
    // $dosya_uzantisi = $_FILES["foto"]["name"];
// ***************************************************************
    // echo $dosya_uzantisi."<br>";
// ***************************************************************
    $dosya_adi = rand(0,999999).$dosya_uzantisi;
// ***************************************************************
    // echo $dosya_adi."<br>";
// ***************************************************************
    $dosya_yolu = "images/".$dosya_adi;
// ***************************************************************
    // echo $dosya_yolu."<br>";
// ***************************************************************

    if($_FILES["foto"]["size"] > $max_boyut){
        echo "Dosya boyutu en fazla <b> 500kb <b> olabilir.";
        // ***************************************************************
    	// echo $_FILES["foto"]["size"]."<br>";
		// ***************************************************************
    }else{

        $d = $_FILES["foto"]["type"];
        // ***************************************************************
    	// echo $_FILES["foto"]["type"]."<br>";
		// ***************************************************************

        if($d == "image/jpeg" || $d == "image/png" || $d == "image/gif"){

            if(is_uploaded_file($_FILES["foto"]["tmp_name"])){
            // ***************************************************************
    		// echo $_FILES["foto"]["tmp_name"]."<br>";
			// ***************************************************************

	                $tasi = move_uploaded_file($_FILES["foto"]["tmp_name"],$dosya_yolu);
	                mysqli_query($baglan,"INSERT INTO foto(foto_yol) VALUES('$dosya_yolu')");

	                if($tasi){
						
						$foto_yolu = mysqli_query($baglan,"SELECT * FROM foto");
						$foto_yolu_cek = mysqli_fetch_assoc($foto_yolu);

						echo $foto_yolu_cek['foto_yol'];
						echo $name;
	                    
	                    echo "
	                    	basarili <br>
	                    	<img src='{$foto_yolu_cek['foto_yol']}' width='400px' height='300px' />
	                    ";
	                }else{
						echo "basarisiz";
	                }

	            }else{
	            	echo "dosya yüklenirken hata oluştu";
	            }

	        }else{
	        	echo "dosya formatı yanlış";
	        }
	    }


?>








