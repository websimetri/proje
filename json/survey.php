<?php
include "../config.php";
include "../lib/siniflar.php";
if(isset($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if($cevap !=false){

        $sonuc=BulutJSON::anket($cevap["id"],$_GET["anketId"]);
        //var_dump($sonuc);
        // $cevap2 = BulutJSON::anketSorulari($cevap["id"]);

        header('Content-Type: application/json');
        echo json_encode(array("Survey"=>array($sonuc)),JSON_PRETTY_PRINT);
        //echo json_encode(array("SurveyTopics" => array($cevap2)),JSON_PRETTY_PRINT);
    }
}
?>