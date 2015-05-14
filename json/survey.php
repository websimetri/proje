<?php
include "../config.php";
include "../lib/siniflar.php";
if(isset($_GET["ref"]) && !empty($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    if($cevap !=false){
        if(isset($_GET["surveyId"])){
        $sonuc=BulutJSON::anket($cevap["id"],$_GET["surveyId"]);
            $JSON =$sonuc;
        }else{
            $sonuc= BulutJSON::anketler($cevap["id"]);
            $JSON=$sonuc;
        }
    }
}else{
    $JSON=array("durum" => false, "mesaj" => "Referans Kodu Eksik");

}
header('Content-Type: application/json');
echo json_encode(array($JSON),JSON_PRETTY_PRINT);
?>