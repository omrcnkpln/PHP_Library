<?php
include "Includes/header.php";

include "DB.php";
$db = new DB();


$users = $db->select("users");
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-auto">
            <h1>Yazılım Laboratuvarı Proje 3</h1>

            <p class="text-center text-muted">
                Yazılım Laboratuvarı üçüncü proje için geliştirilmiştir.
            </p>
        </div>
    </div>
</div>

<?php
include "Includes/footer.php";
?>