<?php

include "../config.php";
include "../lib/siniflar.php";


if (isset($_GET["ref"]) && !empty($_GET["ref"])) {


    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap = !false) {
        if (isset($_GET["reklam_id"]) && !empty($_GET["reklam_id"])) {


            $query = $DB->prepare("SELECT *FROM reklamlar WHERE id=:id and id_sirket=:sirket_id");
            $query->bindParam(":id", $_GET["reklam_id"]);
            $query->bindParam(":sirket_id", $sirket_id);
            $query->execute();

            if ($query->rowCount() > 0) {

                $reklam = $query->fetc(PDO::FETCH_ASSOC);


                $sirket_id = $cevap["id"];
                $iframe = '<iframe><img src="' . $reklam["dosya"] . '"></iframe>';
            }
        }


    }


} else {
    $JSON = array("durum" => false, "mesaj" => "Referans Kodu Yok");
}










?>