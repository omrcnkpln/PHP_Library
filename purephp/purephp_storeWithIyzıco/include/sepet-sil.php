<?
if (!empty($_SESSION["sepet"]))
{
    if(!empty($_GET["urunID"]) && ctype_digit($_GET["urunID"]))
    {
        $urunID=$VT->filter($_GET["urunID"]);
        if (!empty($_GET["varyasyonID"]) && ctype_digit($_GET["varyasyonID"]))
        {
            $varyasyonID=$VT->filter($_GET["varyasyonID"]);
            if (!empty($_SESSION["sepetVaryasyon"][$urunID][$varyasyonID]))
            {
                /*varyasyon olan ürünü siliyoruz*/
                unset($_SESSION["sepetVaryasyon"][$urunID][$varyasyonID]);
            }

            if (!empty($_SESSION["sepetVaryasyon"][$urunID]))
            {

            }
            else
            {
                unset($_SESSION["sepet"][$urunID]);
            }
        }
        else
        {
            if (!empty($_SESSION["sepet"][$urunID]))
            {
                /*varyasyonsuz ürünü siliyoruz*/
                unset($_SESSION["sepet"][$urunID]);
            }
        }
    }
    else
    {
        if ($_GET["urunID"]=="clear")
        {
            unset($_SESSION["sepet"]);
            if (!empty($_SESSION["sepetVaryasyon"]))
            {
                unset($_SESSION["sepetVaryasyon"]);
            }
        }

    }
}
?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>sepet">

