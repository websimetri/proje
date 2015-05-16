<?php
include "../config.php";
include "../lib/siniflar.php";
if (isset($_GET["ref"]) && !empty($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap != false) {

        $cevap2 = BulutJSON::getirSirketKategori($cevap["id"]);
        $JSON = $cevap2;


    } else {
        $JSON = array("durum" => false, "mesaj" => "Referans Kodu Hatalı");
    }


} else {
    $JSON = array("durum" => false, "mesaj" => "Referans Kodu Eksik");
}

header('Content-Type: application/json');
echo json_encode(array("Kategoriler" => array($JSON)), JSON_PRETTY_PRINT);




?>