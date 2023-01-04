<!-- bundan sonra itemları sıralayacağız -->
<meta charset="utf-8">
<?php

include "ayarlar.php";
session_start();

if (isset($_SESSION["oturum"])) {
    
    if(isset($_POST['new_share'])){

        $max_boyut = 500000;
        $dosya_uzantisi = substr($_FILES["share_photo"]["name"],-4,4);
        $dosya_adi = rand(0,999999).$dosya_uzantisi;
        $dosya_yolu = "item_photos/".$dosya_adi;
        if($_FILES["share_photo"]["size"] > $max_boyut){
            echo "Dosya boyutu en fazla <b> 500kb <b> olabilir.";
        }else{
            $d = $_FILES["share_photo"]["type"];

            if($d == "image/jpeg" || $d == "image/png" || $d == "image/gif"){

                if(is_uploaded_file($_FILES["share_photo"]["tmp_name"])){

                    $tasi = move_uploaded_file($_FILES["share_photo"]["tmp_name"],$dosya_yolu);

                    $share_comment = $_POST["share_comment"];
                    $user_id = $_SESSION["user_id"];
            
                    $put_item = mysqli_query($baglan,"INSERT INTO items(user_id, item_content, item_comment) VALUES( '$user_id', '$dosya_yolu', '$share_comment')");
            
                    echo "well done !</br>";
                    echo "
                        <img src='{$dosya_yolu}' width='400px' height='300px'>
                    ";
                    echo $share_comment;
            
                    header("refresh:2 ; url = index.php");


                // burası deneme şekli zaten sadece tablonun ilk fotoyu denersin
                // if($tasi){
					
				// 	$foto_yolu = mysqli_query($baglan,"SELECT * FROM foto");
				// 	$foto_yolu_cek = mysqli_fetch_assoc($foto_yolu);

				// 	echo $foto_yolu_cek['foto_yol'];
				// 	echo $name;
                    
                //     echo "
                //     	basarili <br>
                //     	<img src='{$foto_yolu_cek['foto_yol']}' width='400px' height='300px' />
                //     ";
                // }else{
				// 	echo "basarisiz";
                // }

            }else{
            	echo "dosya yüklenirken hata oluştu";
            }

        }else{
        	echo "dosya formatı yanlış";
        }
    }

        //buraya bk bak öncesi
       
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Share</title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../dist/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../dist/css/share.css">

    <!-- font-awesome -->
    <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">
    
</head>
<body>

<!-- HEADER -->
<header>
        <div class="center">

            <div class="header_left">
                <div class="logo">

                </div>
            </div>

            <div class="header_right">

                <?php
                if (isset($_SESSION["oturum"])) {
                    echo '
                        <ul id = "online">

                            <li>
                                <a href="user_page.php">' . $_SESSION["isim"] . $_SESSION["soyisim"] . '</a>
                            </li>

                            <li>
                                <a href="cikis.php">Çıkış Yap</a>
                            </li>
                        
                        </ul>
                    ';
                } else {
                    echo '
                        <ul id = "offline">
                    
                            <li>
                                <a href="giris.php">GİRİŞ YAP</a>
                            </li>

                            <li>
                                <a href="kayit.php">KAYDOL</a>
                            </li>
                    
                        </ul>
                    ';
                }
                 ?>
            </div>

        </div>
    </header>

<div class="container">

<!-- LEFT_SECTION -->
    <div id="left_section">

        <div id="left_container">
            <ul>
                <li>
                    <a href="index.php"><i class="fa fa-home"></i></a>
                </li>
                <li>
                    <a href="#"><em class="fa fa-search"></em></a>
                </li>
                <li>
                    <a href="#item_top"><em class="fa fa-angle-double-up"></em></a>
                </li>
                <li>
                    <a href="#"><em class="fa fa-angle-double-up"></em></a>
                </li>
                <li>
                    <a href="#"><em class="fa fa-angle-double-down"></em></a>
                </li>
                <li>
                    <a href="#footer"><em class="fa fa-angle-double-down"></em></a>
                </li>
            </ul>
        </div>

    </div>

    <div class="form">

        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Photo seçin:</td>
                    <td><input type="file" name="share_photo"/></td>
                </tr>
                <tr>
                    <td>Yorumunuzu giriniz:</td>
                    <td><input type="text" name="share_comment" autofocus/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="new_share" value="Paylaş" /></td>
                </tr>
            </table> 
        </form>

    </div>
</div>

</body>
</html>
<?php
    }
}else{
    echo "Lütfen önce giriş yapın !";
    header("refresh:2 ; url = giris.php");

}
?>

