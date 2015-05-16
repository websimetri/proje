<?php
include "../config.php";
include "../lib/siniflar.php";
if (isset($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap != false) {

        $cevap2 = BulutJSON::getNewsCategory($cevap["id"]);

        header('Content-Type: application/json');
        echo json_encode(array("News Category" => array($cevap2)), JSON_PRETTY_PRINT);


    } else {
        $JSON = array("durum" => false, "mesaj" => "Aktif Kullanıcı Bulunamadı");
        echo json_encode(array("user" => array($JSON)));
    }
}

?>
