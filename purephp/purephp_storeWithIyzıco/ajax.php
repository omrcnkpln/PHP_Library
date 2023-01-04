<?
@session_start();
@ob_start();
define("DATA","data/");
define("SAYFA","include/");
define("SINIF","adminpanel/class/");
include_once(DATA."baglanti.php");
define("SITE",$siteurl);

if ($_POST)
{
    if (!empty($_POST["islemtipi"])) {
        $islemtipi=$VT->filter($_POST["islemtipi"]);
        switch ($islemtipi) {
            case 'sepeteEkle':
                if (!empty($_POST["urunID"]) && !empty($_POST["adet"]) && ctype_digit($_POST["urunID"]) && ctype_digit($_POST["adet"])) {
                    $urunID=$VT->filter($_POST["urunID"]);
                    $adet=$VT->filter($_POST["adet"]);
                    $kontrol=$VT->VeriGetir("urunler","WHERE ID=? AND durum=?",array($urunID,1),"ORDER BY ID ASC",1);
                    if ($kontrol!=false) {
                        $urunstok=$kontrol[0]["stok"];
                        if ($urunstok>=$adet) {
                            $varyasyonkontrol=$VT->VeriGetir("urunvaryasyonlari","WHERE urunID=?",array($kontrol[0]["ID"]),"ORDER BY ID ASC");
                            if ($varyasyonkontrol!=false) {





                                if (!empty($_POST["varyasyon"]) && !empty($_POST["varyasyon"][0]))
                                {
                                    if (count($_POST["varyasyon"])==count($varyasyonkontrol))
                                    {
                                        $islemdurumu=false;
                                        $secenekID=array();

                                        foreach ($_POST["varyasyon"] as $secenek) {
                                            $secenekBilgisi=$VT->filter($secenek);
                                            $secenekKontrol=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=? AND urunID=?",array($secenekBilgisi,$kontrol[0]["ID"]),"ORDER BY ID ASC",1);
                                            if ($secenekKontrol!=false)
                                            {
                                                $secenekID[]=$secenekKontrol[0]["ID"];
                                                $islemdurumu=true;
                                            }
                                            else
                                            {
                                                $islemdurumu=false;
                                                break;
                                            }
                                        }
                                        if ($islemdurumu!=false)
                                        {
                                            if (count($secenekID)>1)
                                            {
                                                $sqlsecenek=implode("@",$secenekID);
                                            }
                                            else
                                            {
                                                $sqlsecenek=$secenekID[0];

                                            }
                                            $secenekStokKontrol=$VT->VeriGetir("urunvaryasyonstoklari","WHERE urunID=? AND secenekID=?",array($kontrol[0]["ID"],$sqlsecenek),"ORDER BY ID ASC",1);
                                            if ($secenekStokKontrol!=false)
                                            {




                                                if (!empty($_SESSION["sepet"]) && !empty($_SESSION["sepet"][$kontrol[0]["ID"]]) && !empty($_SESSION["sepetVaryasyon"][$kontrol[0]["ID"]][$secenekStokKontrol[0]["ID"]]["adet"])) {
                                                    $sepettekiadet=$_SESSION["sepetVaryasyon"][$kontrol[0]["ID"]][$secenekStokKontrol[0]["ID"]]["adet"];
                                                    $toplammiktar=($sepettekiadet+$adet);
                                                    if ($secenekStokKontrol[0]["stok"]>=$toplammiktar) {
                                                        $_SESSION["sepet"][$kontrol[0]["ID"]]["adet"]=$toplammiktar;
                                                        $_SESSION["sepetVaryasyon"][$kontrol[0]["ID"]][$secenekStokKontrol[0]["ID"]]["adet"]=$toplammiktar;
                                                        echo "TAMAM";
                                                    } else {
                                                        echo "STOK";
                                                    }
                                                } else {
                                                    if ($secenekStokKontrol[0]["stok"]>=$adet) {
                                                        $_SESSION["sepet"][$kontrol[0]["ID"]]=array("adet"=>$adet,"varyasyondurumu"=>true);
                                                        $_SESSION["sepetVaryasyon"][$kontrol[0]["ID"]][$secenekStokKontrol[0]["ID"]]=array("adet"=>$adet);
                                                        echo "TAMAM";
                                                    }
                                                    else
                                                    {
                                                        echo "STOK";
                                                    }
                                                }



                                            }
                                            else
                                            {
                                                echo "ERROR";
                                            }
                                        }
                                        else
                                        {
                                            echo "ERROR";
                                        }
                                    }
                                    else
                                    {
                                        echo "ERROR";
                                    }

                                }
                                else
                                {
                                    echo "ERROR";
                                }






                            } else {
                                /*Eğer ürüne ait varyasyon yok ise bu kısmı çalıştır*/
                                if (!empty($_SESSION["sepet"]) && !empty($_SESSION["sepet"][$kontrol[0]["ID"]]) && !empty($_SESSION["sepet"][$kontrol[0]["ID"]]["adet"])) {
                                    $sepettekiadet=$_SESSION["sepet"][$kontrol[0]["ID"]]["adet"];
                                    $toplammiktar=($sepettekiadet+$adet);
                                    if ($urunstok>=$toplammiktar) {
                                        $_SESSION["sepet"][$kontrol[0]["ID"]]["adet"]=$toplammiktar;
                                        echo "TAMAM";
                                    } else {
                                        echo "STOK";
                                    }
                                } else {
                                    $_SESSION["sepet"][$kontrol[0]["ID"]]=array("adet"=>$adet,"varyasyondurumu"=>false);
                                    echo "TAMAM";
                                }
                            }
                        } else {
                            echo "STOK";
                        }
                    } else {
                        echo "ERROR";
                    }

                } else {
                    echo "ERROR";
                }
                break;
            case "sifreIste":
                if (!empty($_POST["mailadresi"]))
                {
                    $mail=$VT->filter($_POST["mailadresi"]);
                    $kontrol=$VT->VeriGetir("uyeler","WHERE mail=? AND durum=?",array($mail,1),"ORDER BY ID ASC",1);
                    if ($kontrol!=false)
                    {
                        $dogrulamaKodu="RFR".rand(10000,99999);
                        $mailGonder=$VT->MailGonder($kontrol[0]["mail"],"Şifre Doğrulama","Doğrulama Kodunuz : ".$dogrulamaKodu);
                        $_SESSION["dogrulamaKodu"]=$dogrulamaKodu;
                        $_SESSION["uyeninSifresiIcınID"]=$kontrol[0]["ID"];
                        echo "TAMAM";

                    }
                    else
                    {
                        echo "ERROR";
                    }
                }
                else
                {
                    echo "ERROR";

                }
                break;
            default:
                echo "ERROR";
                break;
        }
    } else {
        echo "ERROR";
    }
} else {
    echo "ERROR";
}

?>