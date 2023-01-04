<?
@session_start();
@ob_start();
define("DATA","data/");
define("SAYFA","include/");
define("SINIF","adminpanel/class/");
include_once(DATA."baglanti.php");
define("SITE",$siteurl);
?>

    <?
    include_once(DATA."ust.php");

    if($_GET && !empty($_GET["sayfa"]))
    {
        $sayfa=$_GET["sayfa"].".php";
        if(file_exists(SAYFA.$sayfa))
        {
            include_once(SAYFA.$sayfa);
        }
        else
        {
            include_once(SAYFA."home.php");
        }

    }
    else
    {
        include_once(SAYFA."home.php");
    }

    include_once(DATA."footer.php");
    ?>
