<?php

include "../config.php";
include "../lib/siniflar.php";


if (isset($_GET["ref"]) && !empty($_GET["ref"])) {


    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap != false) {
        $sirketId = $cevap["id"];
        if (isset($_GET["advertisementId"]) && !empty($_GET["advertisementId"])) {

            $query = $DB->prepare("SELECT * FROM reklamlar WHERE id= :id AND id_sirket= :sirket_id");
            $query->bindParam(":id", $_GET["advertisementId"]);
            $query->bindParam(":sirket_id", $sirketId);
            $query->execute();
            $reklam = $query->fetch(PDO::FETCH_ASSOC);

            if ($reklam) {

                $iframe = '<iframe><img src="' . $reklam["dosya"] . '"/></iframe>';

                $gosterim = $reklam["gosterim"] + 1;
                $query = $DB->prepare("UPDATE reklamlar SET gosterim = :gosterim WHERE id = :id");
                $query->bindParam(":gosterim", $gosterim);
                $query->bindParam(":id", $_GET["advertisementId"]);
                $query->execute();

                if ($query) {
                    echo "işlem başarılı";
                } else {
                    echo "işlem başarısız";
                }


                $JSON = array("durum" => true, "mesaj" => "başarılı", "reklam" => $iframe);
            } else {
                $JSON = array("durum" => false, "mesaj" => "belirtilen id de reklam yok");
            }
        } else {
            $JSON = array("durum" => false, "mesaj" => "reklam id giriniz");
        }


    } else {
        $JSON = array("durum" => false, "mesaj" => "ref kodu hatalı");
    }


} else {
    $JSON = array("durum" => false, "mesaj" => "Referans Kodu Yok");
}

header('Content-Type: application/json');
echo json_encode(array("advertise" => array($JSON)), JSON_PRETTY_PRINT);








?>