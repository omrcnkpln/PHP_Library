<?php
include("ayarlar.php");

if ($_POST) {

    $mail = strip_tags(trim($_POST["mail"]));
    $sifre = strip_tags(trim($_POST["sifre"]));

    if (!empty($mail) && !empty($sifre)) {

        $find_user = mysqli_query($baglan, "SELECT * FROM users WHERE user_mail ='$mail' AND user_password ='$sifre'");

        if ($find_user) {
            $verify_user = mysqli_num_rows($find_user);
        } else {
            $verify_user = 0;
        }

        if ($verify_user > 0) {

            extract(mysqli_fetch_array($find_user));
            if ($user_rutbe == 1) {
                session_start();

                $_SESSION["oturum"] = true;
                $_SESSION["mail"] = $mail;
                $_SESSION["sifre"] = $sifre;
                $_SESSION["isim"] = $user_name;
                $_SESSION["soyisim"] = $user_surname;
                $_SESSION["user_id"] = $user_id;
                $_SESSION["user_rutbe"] = $user_rutbe;

                echo "Hoşgeldiniz ".$user_name." Bey!!";

                header("refresh:2; url = nedmin/admin.php");
            } else {
                session_start();

                $_SESSION["oturum"] = true;
                $_SESSION["mail"] = $mail;
                $_SESSION["sifre"] = $sifre;
                $_SESSION["isim"] = $user_name;
                $_SESSION["soyisim"] = $user_surname;
                $_SESSION["user_id"] = $user_id;
                $_SESSION["user_rutbe"] = $user_rutbe;

                header("location:index.php");
            }
        } else {
            echo "Kullanıcı adı ya da şifre hatalı.. <br> Tekrar deneyin !";
            header("refresh:1; url = giris.php");
        }
    } else {
        echo "Lütfen tüm alanları doldurun..";
        header("refresh:1; url = giris.php");
    }
} else {
    header("refersh: 2; url = index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giris Yap</title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../dist/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../dist/css/giris.css">

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


        <div class="content">

            <form action="" method="post">
                <table cellpadding="5" cellspacing="5">
                    <tr>
                        <td colspan=2>Mail:</td>
                        <td><input type="text" name="mail" autofocus /></td>
                    </tr>
                    <tr>
                        <td colspan=2>Sifre:</td>
                        <td><input type="password" name="sifre" /></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Giris Yap" /></td>
                        <!-- tipi buton olan input tagını formdan bağımsız olarak başka sayfaya yönlendirdik -->
                        <td><input type="button" value="Kaydol" onclick="window.location='kayit.php';"></td>

                        <td><a href="forget_p.php">Sifremi Unuttum</a></td>
                    </tr>


                </table>
            </form>

        </div>

</body>

</html>