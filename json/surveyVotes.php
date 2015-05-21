<?php
/**
 * Anketlerin seçenekleri için oy toplanması.
 *
 */

/**
 * NOTLAR:
 * =======
 * - Müşteri kontrolu eklenmesi gerekebilir. Gelen müşteri id'sinin gerçekten veritabanında olup olmadığı
 * kontrol edilmiyor şu anda.
 */

include "../config.php";
include "../lib/siniflar.php";

if(isset($_GET["ref"]) && !empty($_GET["ref"])){

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if($cevap !=false){

        if (isset($_GET["choiceId"]) and isset($_GET["surveyId"]) and isset($_GET["customerId"]) and
            !empty($_GET["choiceId"]) and !empty($_GET["surveyId"]) and !empty($_GET["customerId"])){

            $oy = new Anket();
            $oyver = $oy->yanitTopla($_GET["choiceId"], $_GET["surveyId"], $_GET["customerId"]);

            if ($oyver){
                $json = array(
                    "durum" => true,
                    "mesaj" => "Seçiminiz kaydedildi."
                );
            }

            else {
                $json = array(
                    "durum" => false,
                    "mesaj" => "Daha önce oy kullandınız ya da anket bulunamadı."
                );
            }
        }

        else {
            // Eksik bilgi.
            $json = array(
                "durum" => false,
                "mesaj" => "Eksik bilgi girdiniz.");
        }
    }

    else {
        // Hatalı referans kodu.
        $json = array(
            "durum" => false,
            "mesaj" => "API referans kodunuz hatalı."
        );
    }
}

else{
    $json = array(
        "durum" => false,
        "mesaj" => "API referans kodunuz eksik."
    );
}

header('Content-Type: application/json');
echo json_encode(array("voting" => array($json)),JSON_PRETTY_PRINT);
?>