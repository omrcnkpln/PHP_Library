<meta charset = "utf-8">
<?php
// eger yorumu yaptıkatan hemen sonra sayfayı yenilersen tekrarlıyo acaip

include("ayarlar.php"); //burada ayarları tekrar çağırmasan dahi devam ediyo ??!
//gerekiyo kanka galiba

if(isset($_POST['new_comment'])){
    session_start();

    if(isset($_SESSION["oturum"])){

        $user_id = $_SESSION["user_id"];
        $yorum = $_POST["yorum"];
        $item_id = $_POST["item_id"];
    
        if(!empty($yorum)){
    
            $comment = mysqli_query($baglan,"INSERT INTO comments(item_id, user_id, comment) VALUES('$item_id', '$user_id', '$yorum') ");
            
            if(isset($comment)){
                echo "<font color = 'green'>good job bru!</font>";
                header("refresh:2; url = index.php");
            }else{
                echo "Yorumda bir hata oluştu. Anasayfaya yönlendiriliyorsunuz !";
                header("refresh:2; url = index.php");
            }
        }else{
            echo "Lütfen yorumunuzu belirtin !";
            header("refresh:2; url = index.php");
        }

    }else{

        echo "Lütfen oturum açın !";
        header("refresh:2; url = giris.php");

    }

}else{
    $yorum = NULL;
    echo "Beklenmeyen bir hata oluştu !";
    header("refresh:2; url = index.php");
}




?>