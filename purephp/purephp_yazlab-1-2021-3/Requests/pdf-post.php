<?php
include "../DB.php";
include "../Libraries/FileUpload.php";
$db = new DB();
session_start();
ob_start();

if (isset($_POST["pdf-yukle"])) {
    $file = $_FILES["file"];
    $dosyaYolu = "../Assets/Imports/";
    $ownerID = $_SESSION["ID"];
    $owner = $_SESSION["username"];
    $upload = new FileUpload($file, $dosyaYolu);

    if ($upload) {
        $process = $db->insert("files", array("userID", "owner", "name"), array($ownerID, $owner, $upload->dosya_adi));

        if ($process) {
            include "../Libraries/PDFParser.php";
            $parse = new PDFParser($upload->dosya_adi);
            $text = $parse->text;

            $pdf_id = $db->IDGetir("files") - 1;

            $process2 = $db->insert("pdf_context", array("user_id", "files_id", "pdf_text"), array($ownerID, $pdf_id, $text));

            if ($process2) {
                echo "İşlem Başarılı :)";
            }
            else {
                echo "İşlem Başarısız :/";
            }
        }
        else {
            echo "İşlem Başarısız :/";
        }
    }
    else {
        echo "Yükleme başarısız :/";
    }

    header("refresh:1;url=../index.php");
}
else if (isset($_POST["pdf-update"])) {
    $id = $db->filter($_POST["id"]);
//    $values[0] = $db->filter($_POST["name"]);

//    $process = $db->update("files", array("name"), $values, "ID", $id);

//    if ($process) {
//        echo "İşlem Başarılı :)";
//    }
//    else {
//        echo "İşlem Başarısız :/";
//    }

    header("refresh:1;url=../index.php");
}
else if (isset($_POST["pdf-delete"])) {
    $id = $db->filter($_POST["id"]);

    $process = $db->delete("files", "ID", array($id));

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
