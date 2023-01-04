<?php
if(!empty($_GET["ID"]))
{
    $ID=$VT->filter($_GET["ID"]);
    $urunBilgisi=$VT->VeriGetir("urunler","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
    if($urunBilgisi!=false)
    {
        ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Kitap Bilgileri</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
                                <li class="breadcrumb-item active">Kitap Bilgileri</li>
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
                            <a href="<?=SITE?>urun-liste" class="btn btn-info" style="float:right; margin-bottom:10px;
margin-left:10px;"><i class="fas fa-bars"></i> LİSTE</a>
                            <a href="<?=SITE?>urun-ekle" class="btn btn-success" style="float:right; marginbottom:10px;"><i class="fa fa-plus"></i> YENİ EKLE</a>
                        </div>
                    </div>
                    <form action="#" method="post" class="kitapguncelle" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body card card-primary">
                                    <div class="row">
                                        <h1>Yazar Bilgileri</h1>
                                        <table class="table">
                                            <tr>
                                                <th>Yazar Adı</th>
                                                <th>Yazar Açıklaması</th>
                                                <th>Yazar Resmi</th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" placeholder="Anahtar ..." name="anahtar"
                                                           value="<?=stripslashes($urunBilgisi[0]["anahtar"])?>"></td>
                                                <td><input type="text" class="form-control" placeholder="Anahtar ..." name="anahtar"
                                                           value="<?=stripslashes($urunBilgisi[0]["anahtar"])?>"></td>
                                                <td><input type="file" class="form-control" placeholder="Resim Seçiniz ..." name="resim"></td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card-body card card-primary">
                                    <div class="row">
                                        <h1>Kitap İçerik</h1>
                                        <table class="table">
                                            <tr>
                                                <th>Başlık</th>
                                                <th>İkon Kodu</th>
                                                <th>Açıklama</th>
                                            </tr>

                                            <tr>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                                <td><input type="text" class="form-control" name="alan1" value=""></td>
                                            </tr>

                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>

                </div>
                </form>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        </div>
<?php
    }
}
?>