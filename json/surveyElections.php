<?php
include "../config.php";
include "../lib/siniflar.php";
if(isset($_GET["ref"]) && !empty($_GET["ref"])){
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    if($cevap !=false){

        if(isset($_GET["choiceId"])&&isset($_GET["surveyId"])&&isset($_GET["customerId"])&& !empty($_GET["choiceId"])&& !empty($_GET["surveyId"])&& !empty($_GET["customerId"])){
            $oy = new Anket();
            $oyver = $oy->yanitTopla($_GET["choiceId"], $_GET["surveyId"], $_GET["customerId"]);
            if($oyver!=false){
                $json = array("durum"=>true,"mesaj"=>"seçiminiz kaydedildi");
            }else {

                $json = array("durum"=>false,"mesaj"=>"daha önce oy kullandınız");

            }
        }else {
            $json = array("durum" => false, "mesaj" => "eksik ve boş alanları doldurunuz");
        }
    }else {
        $json = array("durum" => false, "mesaj" => "ref kodu hatalı");
    }
}else{
    $json = array("durum"=>false,"mesaj"=>"ref kodu girmelisiniz");
}

header('Content-Type: application/json');
echo json_encode(array("yourChoice" => array($json)),JSON_PRETTY_PRINT);
?>