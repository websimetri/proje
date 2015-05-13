<?php

include "../config.php";
include "../lib/siniflar.php";


if(isset($_GET["ref"])) {

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    if ($cevap != false) {
        if(isset($_GET["userName"]) && isset($_GET["userSurname"])
            && isset($_GET["userMail"]) && isset($_GET["userPhone"])
            && isset($_GET["userPass"]) ){
            $kulbilgi = BulutJSON::kullaniciEkle($cevap["id"],$_GET["userName"],$_GET["userSurname"],$_GET["userMail"],$_GET["userPhone"],$_GET["userPass"]);
            $JSON=$kulbilgi;
        } else{
        $JSON = array("durum"=>false,"mesaj"=>"Kaydolmak için gerekli bilgiler eksik.");
            }
        } else{
        $JSON = array("durum"=>false,"mesaj"=>"Referans kodu yanlış"); 
    } 
} else{
    $JSON =array( "durum"=>false,"mesaj"=>"Referans Kodu Eksik" );
}
header('Content-Type: application/json');
echo json_encode(array("user" => array($JSON)),JSON_PRETTY_PRINT);
?>
