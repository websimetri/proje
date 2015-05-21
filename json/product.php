<?php
include "../config.php";
include "../lib/siniflar.php";
if (isset($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap != false) {
        if (isset($_GET["start"]) && (!empty($_GET["start"]) || $_GET["start"] == 0)) {

            if (isset($_GET["count"])) {
                if (is_numeric($_GET["count"])) {

                    if ($_GET["count"] > 20 || empty($_GET["count"])) {
                        $count = 20;
                    } else {
                        $count = $_GET["count"];
                    }
                } else {
                    $count = 20;
                }

            } else {
                $count = 20;
            }

            $JSON = BulutJSON::getProducts($cevap["id"],$_GET["start"],$count);
        }
    }else{
        $JSON = array("durum" => false, "mesaj" => "referans kodu hatalı");
    }


}else{
    $JSON = array("durum" => false, "mesaj" => "referans kodu Eksik");
}

header('Content-Type: application/json');
echo json_encode(array("ProductCategory" => array($JSON)), JSON_PRETTY_PRINT);

?>