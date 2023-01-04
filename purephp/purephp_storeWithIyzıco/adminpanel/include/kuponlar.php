<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kupon Listesi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Kupon Listesi</li>
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
                    <a href="<?=SITE?>kupon-ekle" class="btn btn-success" style="float:right; margin-bottom:10px;"><i class="fa fa-plus"></i> YENİ EKLE</a>
                </div>
            </div>
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width:50px;">Kupon Kodu</th>
                            <th style="width:50px;">Yüzde Oranı</th>
                            <th style="width:50px;">Adet</th>
                            <th style="width:50px;">Kupon Tarih</th>
                            <th style="width:50px;">Durum</th>
                            <th style="width:80px;">Tarih</th>
                            <th style="width:120px;">İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $veriler=$VT->VeriGetir("kuponlar","","","ORDER BY ID ASC");
                        if($veriler!=false)
                        {
                            for($i=0;$i<count($veriler);$i++)
                            {

                                if($veriler[$i]["durum"]==1){$aktifpasif=' checked="checked"';}else{$aktifpasif='';}
                                ?>
                                <tr>
                                    <td><?=stripslashes($veriler[$i]["kod"])?></td>
                                    <td>%<?=stripslashes($veriler[$i]["yuzde"])?> İndirim</td>
                                    <td><?=stripslashes($veriler[$i]["adet"])?> Adet</td>
                                    <td><?=stripslashes($veriler[$i]["sure"])?></td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input aktifpasif<?=$veriler[$i]["ID"]?>" id="customSwitch3<?=$veriler[$i]["ID"]?>"<?=$aktifpasif?> value="<?=$veriler[$i]["ID"]?>" onclick="aktifpasif(<?=$veriler[$i]["ID"]?>,'kuponlar');">
                                            <label class="custom-control-label" for="customSwitch3<?=$veriler[$i]["ID"]?>"></label>
                                        </div>
                                    </td>
                                    <td><?=$veriler[$i]["tarih"]?></td>
                                    <td>
                                        <a href="<?=SITE?>kupon-duzenle/<?=$veriler[$i]["ID"]?>" class="btn btn-warning btn-sm">Düzenle</a>
                                        <a href="<?=SITE?>kupon-sil/<?=$veriler[$i]["ID"]?>" class="btn btn-danger btn-sm silmeAlani">Kaldır</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Kupon Kodu</th>
                            <th>Yüzde Oranı</th>
                            <th>Adet</th>
                            <th>Kupon Tarih</th>
                            <th>Durum</th>
                            <th>Tarih</th>
                            <th>İşlem</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
