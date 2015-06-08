<?php
include "../config.php";
include "../lib/siniflar.php";

if (isset($_GET["ref"])) {

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap) {
        $JSON =BulutJSON::getCompany($cevap["id"]);
    }
    else{
        $JSON =array("durum" => false, "mesaj" => "Şirket Bulunamadı.");

    }
}

else{
    $JSON =array("durum" => false, "mesaj" => "Referans kodu eksik.");
}


header('Content-Type: application/json');
echo json_encode(array("Company" => array($JSON)), JSON_PRETTY_PRINT);


?>