<?php
include "../config.php";
include "../lib/siniflar.php";
if (isset($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap != false) {

        $JSON = BulutJSON::getProducts($cevap["id"]);



    }else{
        $JSON = array("durum" => false, "mesaj" => "referans kodu hatalı");
    }


}else{
    $JSON = array("durum" => false, "mesaj" => "referans kodu Eksik");
}

header('Content-Type: application/json');
//echo json_encode(array("ProductCategory" => array($JSON)), JSON_PRETTY_PRINT);

?>