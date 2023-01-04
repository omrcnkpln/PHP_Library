<?php
include "Includes/header.php";

include "DB.php";
$db = new DB();


//$users = $db->select("users");
$files = $db->select("files", array("userID"), array($session["ID"]));

//aktif kullanıcı
$userid = $_SESSION["ID"];

//bu kulanıcının pdf i
//$dene = $db->select("pdf_context", array("user_id"), array($userid));


//burda kelime arattık direkt
$pdfAra = $db->baglantiPDO->prepare("SELECT * FROM pdf_context WHERE pdf_text LIKE ?");
//$aranan = "alskdnaslkdnslak1212";
$aranan = "PROF";
$sonuc = $pdfAra->execute(array("%".$aranan."%"));
//$db->pr($pdfAra->fetch());

//burda kullanıcı id si ile
$pdfAra = $db->baglantiPDO->prepare("SELECT * FROM pdf_context WHERE pdf_text LIKE ? AND user_id =?");
$sonuc = $pdfAra->execute(array("%".$aranan."%", 197));
//$db->pr($pdfAra->fetch());

//sayısı kaç tane var
$db->pr($pdfAra->rowCount());

?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-auto">
            <div class="h1">
                Kullanıcı Paneli
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <div class="btn btn-danger d-block" type="button" data-bs-toggle="collapse"
                         data-bs-target="#pdf-menu">
                        PDF Yükle
                    </div>

                    <div id="pdf-menu" class="collapse">
                        <form action="Requests/pdf-post.php" method="post" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control"
                                               name="file">
                                    </div>

                                    <div class="row justify-content-between">
                                        <div class="col-12">
                                            <button type="submit" name="pdf-yukle"
                                                    class="btn btn-primary btn-warning w-100">
                                                Gönder
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="h3">Yüklediğim Projeler</div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row border-bottom py-2">
                <div class="col-2 font-monospace">Yükleyen</div>
                <div class="col-2 font-monospace">İsim</div>
                <div class="col-2 font-monospace">Dersin Adı</div>
                <div class="col-2 font-monospace">Dönem Bilgisi</div>
            </div>

            <?php
            $i = 0;
            foreach ($files as $row => $value) {
                ?>
                <div class="row border-bottom align-items-center mt-2">
                    <div class="col-2"><?= $value["owner"] ?></div>
                    <div class="col-2"><?= $value["name"] ?></div>
                    <div class="col-2">Matematik</div>
                    <div class="col-2"><?= $value["date"] ?></div>
                    <div class="col-2">
                        <div class="btn btn-primary" type="button" data-bs-toggle="collapse"
                             data-bs-target="#pdf-<?= $i ?>">Detaylar
                        </div>
                    </div>

                    <div class="mt-2">
                        <div id="pdf-<?= $i ?>" class="collapse bg-light">
                            <form action="Requests/pdf-post.php" method="post">
                                <input type="hidden" name="id" value="<?= $value["ID"] ?>">

                                <div class="row py-2">
                                    <div class="col-2">
                                        <div class="input-group">
                                            <input disabled type="text" class="form-control"
                                                   placeholder="Username"
                                                   name="username" value="<?= $value["userID"] ?>">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <!--                                            <button class="btn btn-warning" name="pdf-update">-->
                                        <!--                                                Güncelle-->
                                        <!--                                            </button>-->

                                        <button class="btn btn-danger" name="pdf-delete">
                                            Sil
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="col-12">
                                <?php
                                echo $value["ID"];
                                $text = $db->select("pdf_context", array("files_id"), array($value["ID"]))[0];

//                                bu komple bu file e ait text
                                echo "<pre>";
//                                print_r($text["pdf_text"]);
                                echo "</pre>";
                                ?>
                            </div>


<!--                            //burası bu kullanıcıya ve bu dosyaya ait arama sorgusu -->
                            <div class="col-12">
                                <?php
                                $aranan = "PROFİL";
                                $pdfAra = $db->baglantiPDO->prepare("SELECT * FROM pdf_context WHERE pdf_text LIKE ? AND files_id =?");
                                $sonuc = $pdfAra->execute(array("%".$aranan."%", $value["ID"]));
                                $db->pr($pdfAra->fetch());
//                                $db->pr($pdfAra->rowCount());

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
    </div>
</div>


<?php
include "Includes/footer.php";
?>
