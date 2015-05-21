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
        $JSON = array(
            "durum" => false,
            "mesaj" => "Referans kodu hatalı veya kullanıcı bulunamadı."
        );

        header('Content-Type: application/json');
        echo json_encode(array("News Category" => array($JSON)), JSON_PRETTY_PRINT);
    }
}

else {
    header('Content-Type: application/json');
    $JSON = array(
        "durum" => false,
        "mesaj" => "Referans kodu bulunamadı."
    );

    echo json_encode(array("News Category" => array($JSON)), JSON_PRETTY_PRINT);
}


?>
