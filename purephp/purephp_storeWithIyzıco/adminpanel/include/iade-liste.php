<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">İade Listesi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
                        <li class="breadcrumb-item active">İade Listesi</li>
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>KODU</th>
                            <th>MÜŞTERİ BİLGİSİ</th>
                            <th>DURUM</th>
                            <th>TARİH</th>
                            <th>İNCELE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $iadeler=$VT->VeriGetir("iadeler","","","ORDER BY ID DESC");
                        if ($iadeler!=false)
                        {
                            for ($i=0;$i<count($iadeler);$i++) {
                                $uyebilgisi = $VT->VeriGetir("uyeler", "WHERE ID=? AND durum=?", array($iadeler[$i]["uyeID"], 1), "ORDER BY ID ASC", 1);
                                if ($uyebilgisi != false) {
                                    if ($uyebilgisi[0]["tipi"]==1)
                                    {
                                        $adsoyad=stripslashes($uyebilgisi[0]["ad"]." ".$uyebilgisi[0]["soyad"]);
                                    }
                                    else
                                    {
                                        $adsoyad=stripslashes($uyebilgisi[0]["firmaadi"]);

                                    }
                                    ?>
                                    <tr>
                                        <td><?= $iadeler[$i]["iadekodu"] ?></td>
                                        <td><?= $adsoyad?></td>
                                        <td><?php if ($iadeler[$i]["durum"] == 1) {
                                                ?>
                                                <strong style="color: #FF9800">BEKLİYOR</strong>
                                                <?php
                                            } else {
                                                ?>
                                                <strong style="color: #4caf50">CEVAPLANDI</strong>
                                                <?php
                                            } ?></td>
                                        <td><?= date("d.m.Y", strtotime($iadeler[$i]["tarih"])) ?></td>
                                        <td><a class="btn btn-primary btn-sm" href="<?= SITE ?>iade-detay/<?= $iadeler[$i]["iadekodu"] ?>">İncele</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="5">Henüz kayıtlı bir iade bildiriminiz bulunmamaktadır.</td>
                            </tr>
                            <?php
                        }

                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>KODU</th>
                            <th>MÜŞTERİ BİLGİSİ</th>
                            <th>DURUM</th>
                            <th>TARİH</th>
                            <th>İNCELE</th>
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
