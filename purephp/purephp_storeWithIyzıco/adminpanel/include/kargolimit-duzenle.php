<?php
if(!empty($_GET["ID"]))
{
    $ID=$VT->filter($_GET["ID"]);

    $veri=$VT->VeriGetir("kargolimit","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
    if($veri!=false)
    {
        ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Kargo Limit Düzenle</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
                                <li class="breadcrumb-item active">Kargo Limit Düzenle</li>
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
                            <a href="<?=SITE?>kargolimit-liste" class="btn btn-info" style="float:right; margin-bottom:10px; margin-left:10px;"><i class="fas fa-bars"></i> LİSTE</a>
                            <a href="<?=SITE?>kargolimit-ekle" class="btn btn-success" style="float:right; margin-bottom:10px;"><i class="fa fa-plus"></i> YENİ EKLE</a>
                        </div>
                    </div>
                    <?php
                    if($_POST)
                    {
                        if(!empty($_POST["baslik"]))
                        {
                            $baslik=$VT->filter($_POST["baslik"]);
                            $sinir=$VT->filter($_POST["sinir"]);
                            $kargotutar=$VT->filter($_POST["kargotutar"]);

                            $ekle=$VT->SorguCalistir("UPDATE kargolimit","SET baslik=?, sinir=?, kargotutar=?, durum=?, tarih=? WHERE ID=?",array($baslik,$sinir,$kargotutar,1,date("Y-m-d"),$veri[0]["ID"]),1);

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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kargo Limit Başlık Giriniz</label>
                                            <input type="text" class="form-control" placeholder="Kargo Limit Başlık Giriniz ..." name="baslik" value="<?=$veri[0]["baslik"]?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hangi Tutara Kadar</label>
                                            <input type="text" class="form-control" placeholder="Hangi Tutara Kadar ..." name="sinir" value="<?=$veri[0]["sinir"]?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kaç TL Kargo Ödenecek</label>
                                            <input type="text" class="form-control" placeholder="Kaç TL Kargo Ödenecek ..." name="kargotutar" value="<?=$veri[0]["kargotutar"]?>">
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