<?php
/**
 * Kullanıcılar için insert update delete işlemleri yapılmıştır
 */
include "../DB.php";
$db = new DB();

if (isset($_POST["user-insert"])) {
    $values[0] = $db->filter($_POST["username"]);
    $values[1] = $db->filter($_POST["name"]);
    $values[2] = $db->filter($_POST["surname"]);
    $values[3] = $db->filter($_POST["password"]);
    $values[4] = $db->filter($_POST["rank"]);

    $process = $db->insert("users", array("username", "name", "surname", "password", "rank"), $values);

    if ($process) {
        echo "İşlem Başarılı :)";
    }
    else {
        echo "İşlem Başarısız :/";
    }

    header("refresh:1;url=../index.php");
}
else if (isset($_POST["user-update"])) {
    $id = $db->filter($_POST["id"]);
    $values[0] = $db->filter($_POST["username"]);
    $values[1] = $db->filter($_POST["name"]);
    $values[2] = $db->filter($_POST["surname"]);
    $values[3] = $db->filter($_POST["password"]);
    if (empty($_POST["rank"])) {
        $values[4] = 0;
    }else{
        $values[4] = $db->filter($_POST["rank"]);
    }

    $process = $db->update("users", array("username", "name", "surname", "password", "rank"), $values, "ID", $id);

    if ($process) {
        echo "İşlem Başarılı :)";
    }
    else {
        echo "İşlem Başarısız :/";
    }

    header("refresh:1;url=../index.php");
}
else if (isset($_POST["user-delete"])) {
    $id = $db->filter($_POST["id"]);

    $process = $db->delete("users", "ID", array($id));

    if ($process) {
        echo "İşlem Başarılı :)";
    }
    else {
        echo "İşlem Başarısız :/";
    }

    header("refresh:1;url=../index.php");
}
else {
    echo "izinsiz giriş :/";
}