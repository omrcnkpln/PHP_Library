<div class="content-wrapper">
    <?php
//    header("Cache-Control: no-cache, must-revalidate");
//    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

    use Libraries\VT;

    $VT = new VT();

    $products = $_SESSION["products"];
    ?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ürün Liste Bot</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE ?>">Anasayfa</a></li>

                        <li class="breadcrumb-item active">Ürün Liste Bot</li>
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
                        <?php
                        $i = 1;
                        foreach ($products as $value) {
                            $title = html_entity_decode($value["Title"]);
//                                echo var_dump($value["title"]);
//                                echo var_dump($VT->filter($value["title"]));
                            $isUnique = $VT->IsUnique("bot_hepsiburada", "Title", $title);
                            ?>
                            <tr>
                                <form action="<?= BASE ?>nedmin-bot-urun" method="post">
                                    <td><?= $i ?></td>
                                    <td>
                                        <img src="<?= $value["Image"] ?>" alt="">
                                        <input type="hidden" value="<?= $value["Image"] ?>" name="image">
                                    </td>

                                    <td>
                                        <a href="<?= $value["Link"] ?>" target="_blank"><?= $value["Title"] ?></a>
                                        <input type="hidden" value='<?= $value["Title"] ?>' name="title">
                                        <input type="hidden" value='<?= $value["Link"] ?>' name="link">
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
                                        <div><?= $value["Price"] ?>&#8378</div>
                                        <input type="hidden" value="<?= $value["Price"] ?>" name="price">
                                    </td>

                                    <td>
                                        <input type="hidden" value="bot_hepsiburada" name="tablo">
                                        <button style="margin-top: 5px;" href="<?= BASE ?>admin/"
                                                class="btn btn-primary btn-sm <?= $isUnique ? "" : "d-none" ?>"
                                                name="bot-urun-ekle">
                                            Ekle
                                        </button>

                                        <button style="margin-top: 5px;" href="<?= BASE ?>admin/urun-sil/"
                                                class="btn btn-danger btn-sm <?= $isUnique ? "d-none" : "" ?>" name="bot-urun-sil">
                                            Kaldır
                                        </button>
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
