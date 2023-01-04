<?php
if (!empty($_GET["iadekodu"]))
{
    $iadekodu=$VT->filter($_GET["iadekodu"]);

    $iadeler=$VT->VeriGetir("iadeler","WHERE iadekodu=?",array($iadekodu),"ORDER BY ID ASC",1);
    if ($iadeler!=false)
    {
        $uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($iadeler[0]["uyeID"],1),"ORDER BY ID ASC",1);
        if ($uyebilgisi!=false)
        {

        }
        else
        {
            ?>
            <meta http-equiv="refresh" content="0;url=<?=SITE?>iade-liste">
            <?php
        }
    }
    else
    {
        ?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>iade-liste">
        <?php
        exit();
    }

    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">İade Yönetim Ekranı</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
                            <li class="breadcrumb-item active">İade Yönetim Ekranı</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>SİPARİŞ KODU</th>
                                <th>ALICI BİLGİSİ</th>
                                <th>ADRES</th>
                                <th>DURUM</th>
                                <th>TARİH</th>
                                <th>İADE SEBEBİ</th>
                                <th>İADE CEVABI</th>
                            </tr>
                            <tr>
                                <td><?=$iadeler[0]["iadekodu"]?></td>
                                <td>
                                    <?php
                                    if ($uyebilgisi[0]["tipi"]==1)
                                    {
                                        $adsoyad=stripslashes($uyebilgisi[0]["ad"]." ".$uyebilgisi[0]["soyad"]);
                                    }
                                    else
                                    {
                                        $adsoyad=stripslashes($uyebilgisi[0]["firmaadi"]);

                                    }
                                    ?>
                                    <?=$adsoyad?>
                                </td>
                                <td><?=$uyebilgisi[0]["adres"]?></td>
                                <td>
                                    <?php if ($iadeler[0]["durum"] == 1) {
                                        ?>
                                        <strong style="color: #FF9800">BEKLİYOR</strong>
                                        <?php
                                    } else {
                                        ?>
                                        <strong style="color: #4caf50">CEVAPLANDI</strong>
                                        <?php
                                    } ?>
                                </td>
                                <td><?=date("d.m.Y",strtotime($iadeler[0]["tarih"]))?></td>
                                <td width="400"><?=stripslashes($iadeler[0]["metin"])?></td>
                                <td width="400">
                                    <?php
                                    if ($_POST)
                                    {
                                        if (!empty($_POST["cevap"]))
                                        {
                                            $cevap=$VT->filter($_POST["cevap"]);
                                            $guncelle=$VT->SorguCalistir("UPDATE iadeler","SET durum=?, cevap=? WHERE ID=?",array(2,$cevap,$iadeler[0]["ID"]),1);
                                            ?>
                                            <meta http-equiv="refresh" content="0;url=<?=SITE?>iade-liste">
                                            <?php
                                        }
                                    }
                                    ?>
                                    <form action="#" method="post">
                                        <textarea class="textarea" name="cevap" id="" style="width: 100%;height: 220px;"><?=stripslashes($iadeler[0]["cevap"])?></textarea>
                                        <input type="submit" name="gonder" value="YANITLA" class="btn btn-primary btn-sm">
                                    </form>
                                </td>
                            </tr>

                        </table>
                        <h3>İADE EDİLEN ÜRÜNLER</h3>
                        <table class="table">
                            <tr>
                                <th>ÜRÜN KODU</th>
                                <th>RESİM</th>
                                <th>AÇIKLAMA</th>
                                <th>ÜRÜN FİYATI</th>
                                <th>ADET</th>
                                <th>TOPLAM TUTAR</th>
                            </tr>
                            <?php
                            $iadeurunler=$VT->VeriGetir("iadeurunler","WHERE uyeID=? AND iadeID=?",array($uyebilgisi[0]["ID"],$iadeler[0]["ID"]));
                            if($iadeurunler!=false)
                            {
                                for ($q=0;$q<count($iadeurunler);$q++)
                                {
                                    $siparisurunler=$VT->VeriGetir("siparisurunler","WHERE ID=?",array($iadeurunler[$q]["siparisurunID"]),"ORDER BY ID ASC",1);
                                    if ($siparisurunler!=false)
                                    {
                                        for ($i=0;$i<count($siparisurunler);$i++)
                                        {
                                            $urunler=$VT->VeriGetir("urunler","WHERE ID=?",array($siparisurunler[$i]["urunID"]),"ORDER BY ID ASC",1);
                                            if ($urunler!=false)
                                            {
                                                $ozellikler="";
                                                if (!empty($siparisurunler[$i]["varyasyonID"]))
                                                {
                                                    $varyasyonKontrol=$VT->VeriGetir("urunvaryasyonstoklari","WHERE ID=?",array($siparisurunler[$i]["varyasyonID"]),"ORDER BY ID ASC",1);
                                                    if ($varyasyonKontrol!=false)
                                                    {
                                                        $varyasyonID=$varyasyonKontrol[0]["varyasyonID"];
                                                        $secenekID=$varyasyonKontrol[0]["secenekID"];
                                                        if (strpos($varyasyonID,"@")>0)
                                                        {
                                                            $varyasyonDizi=explode("@",$varyasyonID);
                                                            $secenekDizi=explode("@",$secenekID);
                                                            for ($x=0;$x<count($varyasyonDizi);$x++)
                                                            {
                                                                $varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyonDizi[$x]),"ORDER BY ID ASC",1);
                                                                $secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secenekDizi[$x]),"ORDER BY ID ASC",1);
                                                                if ($varyasyonBilgisi!=false && $secenekBilgisi!=false)
                                                                {
                                                                    $ozellikler.=stripslashes($secenekBilgisi[0]["baslik"])." ".stripslashes($varyasyonBilgisi[0]["baslik"])." ";
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyonID),"ORDER BY ID ASC",1);
                                                            $secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secenekID),"ORDER BY ID ASC",1);
                                                            if ($varyasyonBilgisi!=false && $secenekBilgisi!=false)
                                                            {
                                                                $ozellikler=stripslashes($secenekBilgisi[0]["baslik"])." ".stripslashes($varyasyonBilgisi[0]["baslik"]);
                                                            }

                                                        }
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td><?=$urunler[0]["urunkodu"]?></td>
                                                    <td><img style="height: 50px;width: auto; display: block" src="<?=ANASITE?>images/urunler/<?=$urunler[0]["resim"]?>" alt=""></td>
                                                    <td><?=stripslashes($urunler[0]["baslik"])?><br><small style="color: #009688;font-size: 13px;"><?=$ozellikler;?></small></td>
                                                    <td><?=number_format($siparisurunler[$i]["uruntutar"],2,".",".")?> TL</td>
                                                    <td><?=$siparisurunler[$i]["adet"]?></td>
                                                    <td><?=number_format($siparisurunler[$i]["toplamtutar"],2,".",".")?> TL</td>
                                                </tr>
                                                <?php
                                            }

                                        }
                                    }
                                }
                            }


                            ?>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <?php
}
?>