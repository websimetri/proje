<?php

include "../config.php";
include "../lib/siniflar.php";


if (isset($_GET["ref"]) && !empty($_GET["ref"])) {


    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap != false) {

        $sirket_id = $cevap["id"];


        if (isset($_GET["advertisementId"]) && !empty($_GET["advertisementId"])) {


            $query = $DB->prepare("SELECT *FROM reklamlar WHERE id_sirket = :sirket_id AND id = :id");
            $query->bindParam(":sirket_id", $sirket_id);
            $query->bindParam(":id", $_GET["advertisementId"]);
            $query->execute();

            if ($query->rowCount() > 0) {
                $reklam = $query->fetch(PDO::FETCH_ASSOC);

                $ilk = strtotime($reklam["tarih_bitis"]);
                $tarih = strtotime(date("Y-m-j H:i:s"));
                $zaman = $tarih - $ilk;

                if ($zaman < 0) {

                    $reklam["kod"] = htmlentities('<iframe src="'.SITEURL.'/json/showAds.php?ref='.$_GET["ref"].'&advertisementId='.$_GET["advertisementId"].'" width="'.$reklam["genislik"].'" height="'.$reklam["yukseklik"].'" />');

					 $reklam["kod"]  = str_replace("\\","", $reklam["kod"]);

                    $JSON = array("durum" => true, "mesaj" => "başarılı.", "reklam" => $reklam);
                } else {
                    $JSON = array("durum" => false, "mesaj" => "Reklam SÜreniz dOLMUŞ");
                }


            } else {
                $JSON = array("durum" => false, "mesaj" => "Reklam id bulunamadı.");
            }

        } else {
            $JSON = array("durum" => false, "mesaj" => "Reklam id giriniz.");
        }


    } else {
        $JSON = array("durum" => false, "mesaj" => "referans kodu hatalı");
    }


} else {
    $JSON = array("durum" => false, "mesaj" => "referans kodu yok");

}
header('Content-Type: application/json');
echo json_encode(array("reklam" => array($JSON)), JSON_PRETTY_PRINT);












?>