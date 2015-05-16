<?php
include "../config.php";
include "../lib/siniflar.php";
if (isset($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    if ($cevap != false) {
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $sonuc = BulutJSON::getnewId($cevap["id"], $_GET["id"]);
            $JSON = array("news" => array($sonuc));
        } else {
            $JSON = array("durum" => false, "mesaj" => "Haber id bilgileri eksik");


        }
    } else {
        $JSON = array("durum" => false, "mesaj" => "Ref Kodu Yanlış");

    }
} else {
    $JSON = array("durum" => false, "mesaj" => "Gönderilen Bilgiler Hatalı");

}

header('Content-Type: application/json');
echo json_encode(array($JSON), JSON_PRETTY_PRINT);
?>