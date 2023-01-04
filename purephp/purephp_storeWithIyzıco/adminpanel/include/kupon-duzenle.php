<?php
if(!empty($_GET["ID"]))
{
    $ID=$VT->filter($_GET["ID"]);

    $veri=$VT->VeriGetir("kuponlar","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
    if($veri!=false)
    {
        ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Kupon Düzenle</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
                                <li class="breadcrumb-item active">Kupon Düzenle</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?=SITE?>kuponlar" class="btn btn-info" style="float:right; margin-bottom:10px; margin-left:10px;"><i class="fas fa-bars"></i> LİSTE</a>
                            <a href="<?=SITE?>kupon-ekle" class="btn btn-success" style="float:right; margin-bottom:10px;"><i class="fa fa-plus"></i> YENİ EKLE</a>
                        </div>
                    </div>
                    <?php
                    if($_POST)
                    {
                        if(!empty($_POST["kod"]))
                        {
                            $kod=$VT->filter($_POST["kod"]);
                            $yuzde=$VT->filter($_POST["yuzde"]);
                            $adet=$VT->filter($_POST["adet"]);
                            $sure=$VT->filter($_POST["sure"]);

                               $ekle=$VT->SorguCalistir("UPDATE kuponlar","SET kod=?, yuzde=?, adet=?, sure=?, durum=?, tarih=? WHERE ID=?",array($kod,$yuzde,$adet,$sure,1,date("Y-m-d"),$veri[0]["ID"]),1);

                            if($ekle!=false)
                            {
                                
                                ?>
                                <div class="alert alert-success">İşleminiz başarıyla kaydedildi.</div>
                                <?php

                            }
                            else
                            {
                                ?>
                                <div class="alert alert-danger">İşleminiz sırasında bir sorunla karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.</div>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
                            <?php
                        }
                    }
                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="card-body card card-primary">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kupon Kodu</label>
                                            <input type="text" class="form-control" placeholder="Kupon Kodu ..." name="kod" value="<?=$veri[0]["kod"]?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>İndirim Oranı(%)</label>
                                            <input type="text" class="form-control" placeholder="İndirim Oranı(%) ..." name="yuzde" value="<?=$veri[0]["yuzde"]?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kaç Kere Kullanılacak</label>
                                            <input type="text" class="form-control" placeholder="Adet Olarak Yazınız ..." name="adet" value="<?=$veri[0]["adet"]?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hangi Tarihe Kadar</label>
                                            <input type="date" class="form-control" name="sure" value="<?=$veri[0]["sure"]?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary">KAYDET</button>
                                        </div>
                                    </div>

                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </form>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <?php
    }
    else
    {
        echo "Hatalı bilgi gönderildi.";
    }
}
else
{
    echo "Bu sayfaya erişim izniniz bulunmamaktadır.";
}
?>