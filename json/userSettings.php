<?php


include "../config.php";
include "../lib/siniflar.php";


if(isset($_GET["ref"])) {

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap = !false) {

        if(isset($_GET["userName"]))





    } else {
        $JSON = array("durum" => false, "mesaj" => "Referans Kodu Hatalı");

    }

    }else{
    $JSON =array( "durum"=>false,"mesaj"=>"Referans Kodu Eksik" );
}





















?>