<?php
include "Includes/header.php";

include "DB.php";
$db = new DB();


$users = $db->select("users");
$files = $db->select("files");
//$dene = $db->select("pdf");


?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="h1">
                    Yönetim Paneli
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="btn btn-success d-block" type="button" data-bs-toggle="collapse"
                             data-bs-target="#ekle-menu">
                            Kullanıcı Ekleme
                        </div>

                        <div id="ekle-menu" class="collapse">
                            <form action="Requests/user-post.php" method="post">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                   placeholder="Username"
                                                   name="username">

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    Username
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                   placeholder="Name"
                                                   name="name">

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    Name
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                   placeholder="Surname"
                                                   name="surname">

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    Surname
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                   placeholder="Password"
                                                   name="password">

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    Password
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control"
                                                   placeholder="Rank"
                                                   name="rank">

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    Rank
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between">
                                            <div class="col-12">
                                                <button type="submit" name="user-insert"
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

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="h3">Kayıtlı Kullanıcılar</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row border-bottom py-2">
                    <div class="col-2 font-monospace">Username</div>
                    <div class="col-2 font-monospace">Name</div>
                    <div class="col-2 font-monospace">Surname</div>
                    <div class="col-2 font-monospace">Password</div>
                    <div class="col-2 font-monospace">Rank</div>
                    <div class="col-2 font-monospace">İşlemler</div>
                </div>

                <?php
                $i = 0;
                foreach ($users as $row => $value) {
                    ?>
                    <div class="row border-bottom align-items-center mt-2">
                        <div class="col-2"><?= $value["username"] ?></div>
                        <div class="col-2"><?= $value["name"] ?></div>
                        <div class="col-2"><?= $value["surname"] ?></div>
                        <div class="col-2"><?= $value["password"] ?></div>
                        <div class="col-2"><?= $value["rank"] ?></div>
                        <div class="col-2">
                            <div class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#user-<?= $i ?>">Detaylar
                            </div>
                        </div>

                        <div class="mt-2">
                            <div id="user-<?= $i ?>" class="collapse bg-light">
                                <form action="Requests/user-post.php" method="post">
                                    <input type="hidden" name="id" value="<?= $value["ID"] ?>">

                                    <div class="row py-2">
                                        <div class="col-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       placeholder="Username"
                                                       name="username" value="<?= $value["username"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       placeholder="Name"
                                                       name="name" value="<?= $value["name"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       placeholder="Surname"
                                                       name="surname" value="<?= $value["surname"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       placeholder="Password"
                                                       name="password" value="<?= $value["password"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="input-group">
                                                <input type="number" class="form-control"
                                                       placeholder="Rank"
                                                       name="rank" <?= $value["rank"] ?>>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <button class="btn btn-warning" name="user-update">
                                                Güncelle
                                            </button>

                                            <button class="btn btn-danger" name="user-delete">
                                                Sil
                                            </button>
                                        </div>
                                    </div>
                                </form>
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

    <div class="container my-5 pb-5">
        <div class="row">
            <div class="col-12">
                <div class="h3">Yüklenen Projeler</div>
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
                                            <button class="btn btn-warning" name="pdf-update">
                                                Güncelle
                                            </button>

                                            <button class="btn btn-danger" name="pdf-delete">
                                                Sil
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
