<?php
include_once(VIEWS . "statics/_structureTop.php");
?>
Anasayfa
<a href="<?= BASE ?>admin">Admin</a>
<a href="<?= BASE ?>">Anasayfa</a>

<div class="content-wrapper">
    <?php

    use Libraries\VT;
    use System\Helpers\Helper;

    $VT = new VT();

    $urunler = $VT->VeriGetir("urunler", "", "", "ORDER BY ID ASC");

    ?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ürün Liste</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE ?>">Anasayfa</a></li>

                        <li class="breadcrumb-item active">Ürün Liste</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table id="" class="table example1 table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sıra</th>
                            <th>Gorsel</th>
                            <th>Baslik</th>
                            <th>Marka</th>
                            <th>Model Adı</th>
                            <th>Model No</th>
                            <th>İşletim Sistemi</th>
                            <th>İşlemci Tipi</th>
                            <th>İşlemci Nesli</th>
                            <th>Ram</th>
                            <th>Disk Boyutu</th>
                            <th>Disk Türü</th>
                            <th>Ekran Boyutu</th>
                            <th>Puan</th>
                            <th>Fiyat</th>
                            <th>Operations</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $i = 1;
                        foreach ($urunler as $value) {
                            $title = html_entity_decode($value["Title"]);
                            //                                echo var_dump($value["title"]);
                            //                                echo var_dump($VT->filter($value["title"]));
                            $isUnique = $VT->IsUnique("urunler", "Title", $title);
                            ?>
                            <tr>
                                <form action="<?= BASE ?>nedmin-bot-urun" method="post">
                                    <td><?= $i ?></td>
                                    <td>
                                        <!--                                        <img src="-->
                                        <?//= $value["image"] ?><!--" alt="">-->
                                        <!--                                        <input type="hidden" value="-->
                                        <?//= $value["image"] ?><!--" name="image">-->
                                    </td>

                                    <td>
                                        <div><?= $value["Title"] ?></div>
                                        <input type="hidden" value='<?= $value["Title"] ?>' name="title">
                                    </td>
                                    <td>null</td>
                                    <td>null</td>
                                    <td>null</td>
                                    <td>null</td>
                                    <td>null</td>
                                    <td>null</td>
                                    <td>null</td>
                                    <td>null</td>
                                    <td>null</td>
                                    <td>null</td>
                                    <td>null</td>

                                    <td>
                                        <?= $value["Price"] ?>&#8378
                                    </td>

                                    <td>
                                        <a href="#">Sepete Ekle</a>
                                    </td>
                                </form>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th style="width:50px;">Sıra</th>
                            <th>Gorsel</th>
                            <th style="width: 300px;">Baslik</th>
                            <th>Marka</th>
                            <th>Model Adı</th>
                            <th>Model No</th>
                            <th>İşletim Sistemi</th>
                            <th>İşlemci Tipi</th>
                            <th style="width:50px;">İşlemci Nesli</th>
                            <th style="width:50px;">Ram</th>
                            <th>Disk Boyutu</th>
                            <th style="width:250px;">Disk Türü</th>
                            <th style="width:250px;">Ekran Boyutu</th>
                            <th style="width:250px;">Puan</th>
                            <th style="width:250px;">Fiyat</th>
                            <th style="width:250px;">Site İsmi</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
