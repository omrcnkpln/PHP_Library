<?php
//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

session_start();
ob_start();

$resp = array(
    "status" => false
);

if (isset($_POST["arr"])) {
    $arr = $_POST["arr"];
    $_SESSION["products"] = $arr;
    $resp["status"] = true;
}

echo json_encode($resp);

