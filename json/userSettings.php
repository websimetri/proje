<?php

include "../config.php";
include "../lib/siniflar.php";


if(isset($_GET["ref"]) && !empty($_GET["ref"])) {

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    if ($cevap != false) {
        if(isset($_GET["userName"]) && isset($_GET["userSurname"])
            && isset($_GET["userMail"]) && isset($_GET["userPhone"])
             && isset($_GET["userId"]) && !empty($_GET["userName"]) && !empty($_GET["userSurname"]) && !empty($_GET["userMail"]) && !empty($_GET["userPhone"]) && !empty($_GET["userId"])){
            $kulbilgi = BulutJSON::kullaniciAyarlar($cevap["id"],$_GET["userId"],$_GET["userName"],$_GET["userSurname"],$_GET["userMail"],$_GET["userPhone"]);
            $JSON=$kulbilgi;
            $JSON = array("durum"=>true,"mesaj"=>"Güncelleme başarıyla gerçekleşti.");

        }else{
            $JSON = array("durum"=>false,"mesaj"=>"Gerekli bilgiler eksik.");
        }
    }
    else{
        $JSON = array("durum"=>false,"mesaj"=>"Referans Kodu Eksik veya Yanlış.");
}
}else{
    $JSON =array( "durum"=>false,"mesaj"=>"Referans Kodu Yok" );
}
header('Content-Type: application/json');
echo json_encode(array("user" => array($JSON)),JSON_PRETTY_PRINT);


?>















?>