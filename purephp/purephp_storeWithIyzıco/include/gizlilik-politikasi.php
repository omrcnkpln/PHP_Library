<?php
if (!empty($_GET["seflink"]))
{
    $seflink=$VT->filter($_GET["seflink"]);
    $bilgi=$VT->VeriGetir("gizlilikpolitikasi","WHERE seflink=? AND durum=?",array($seflink,1),"ORDER BY ID ASC",1);
    if ($bilgi!=false)
    {

        ?>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/profil.css">
        <?php
        if (!empty($_SESSION["uyeID"]))
        {
            ?>
            <meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">
            <?php
            exit();
        }
        ?>

        <section class="options-wrapper">
            <div class="container">
                <div class="row">
                    <center>
                        <div class="login-logo">
                            <!-- <a href="../index.php"><b>Thinker</b>MATH</a> -->
                            <a href="<?=SITE?>">
                                <img src="<?=SITE?>images/Logo.svg" alt="logo">
                            </a>
                        </div>
                    </center>
                        <h1 style="color: white"><?=stripslashes($bilgi[0]["baslik"])?></h1>
                        <?=stripslashes($bilgi[0]["metin"])?>
                 </div>


             </div>
        </section>
        <?php
    }
}
?>