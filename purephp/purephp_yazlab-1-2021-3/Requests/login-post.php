<?php
include "../DB.php";
$db = new DB();
session_start();
ob_start();

if (isset($_POST["login"])) {
    $username = $db->filter($_POST["username"]);
    $password = $db->filter($_POST["password"]);

    $users = $db->select("users", array("username", "password"), array($username, $password));

    if ($users) {
        if ($users[0]["rank"] == 1) {
            $_SESSION["oturum"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["ID"] = $users[0]["ID"];
            $_SESSION["rank"] = 1;

            header("refresh:1;url=../yonetim-paneli.php");
        }
        else {
            $_SESSION["oturum"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["ID"] = $users[0]["ID"];
            $_SESSION["rank"] = 0;

            header("refresh:1;url=../kullanici-paneli.php");
        }
    }
    else {
        echo "Giriş Başarısız :/";

        header("refresh:1;url=../giris.php");
    }
}
else {
    echo "izinsiz giriş :/";
}
