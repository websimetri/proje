<?php
include "../config.php";
include "../lib/siniflar.php";

if (isset($_GET["ref"]) && !empty($_GET["ref"])) {

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap) {
        // Ref geldi.

        if (isset($_GET["surveyId"]) && !empty($_GET["surveyId"])) {
            $sonuc = BulutJSON::anket($cevap["id"], $_GET["surveyId"]);
            $JSON = $sonuc;
        }

        else {
            if (isset($_GET["start"]) && (!empty($_GET["start"]) || $_GET["start"] == 0)) {
                //referan kodu var ve announcementId olmadında çalısacak kısım
                if (isset($_GET["count"])) {
                    if (is_numeric($_GET["count"])) {

                        if ($_GET["count"] > 20 || empty($_GET["count"])) {
                            $count = 20;
                        } else {
                            $count = $_GET["count"];
                        }
                    } else {
                        $count = 20;
                    }

                } else {
                    $count = 20;
                }
                $sonuc = BulutJSON::anketler($cevap["id"], $_GET["start"], $count);
                $JSON = $sonuc;
            }
            else {
                $JSON = array(
                    "durum" => false,
                    "mesaj" => "Başlangıç değeri eksik."
                );
            }
        }
    } else {
        $JSON = array("durum" => false, "mesaj" => "Referans Kodu Bulanamadı");
    }

} else {
    $JSON = array("durum" => false, "mesaj" => "Referans Kodu Eksik");

}
header('Content-Type: application/json');
echo json_encode(array("Anket" => array($JSON)), JSON_PRETTY_PRINT);
?>