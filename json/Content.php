<?php


include "../config.php";
include "../lib/siniflar.php";


if(isset($_GET["ref"])){

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    $sirket_id = $cevap["id"];

    if($cevap != false){


            $sorgu = $DB->prepare("SELECT *FROM icerik_yonetimi WHERE sirket_id = ? ");
            $sorgu -> execute(array($sirket_id));
            $fetch = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            if($sorgu->rowCount() > 0){
                print_r("başarılı");
                $JSON = $fetch;
                if(isset($_GET["id"])){

                }





            }else{
                print_r("başarısız");
            }







    }else{
        $JSON = array("durum"=>false,"mesaj"=>"  gerekli bilgiler eksik.");
    }
}else{
    $JSON =array( "durum"=>false,"mesaj"=>"Referans Kodu Eksik" );
}
header('Content-Type: application/json');
echo json_encode(array("user" => array($JSON)),JSON_PRETTY_PRINT);





















?>