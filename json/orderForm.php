<?php
/**
 * Mobilden tam HTML olarak gelen formun veritabanına yazılması,
 * gerekli
 *
 * PARAMETRELER:
 * =============
 *  1. ref          Firmanın referans kodu.sirket_id
 *  2. customerId   Müşteri id'si
 *  3. productId    Ürün id.
 *  2. html         Form siparisinin dolu hali.
 *
 * DÖNENLER:
 * =========
 *  1. Başarılı
 *      - durum     bool    true
 *      - mesaj     string  "Sipariş formunuz gönderildi."
 *
 *  2. Başarısız
 *      - durum     bool    false
 *      - mesaj     string  "Sipariş formunuz gönderilemedi."
 */

include "../config.php";
include "../lib/siniflar.php";


if (isset($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap) {
        // Referans kodu doğru.

        $sirket_id = $cevap["id"];

        if (isset($_GET["customerId"]) and !empty($_GET["customerId"]) and
            isset($_GET["productId"]) and !empty($_GET["productId"]) and
            isset($_GET["html"]) and !empty($_GET["html"])
        ) {

            $sip = new Siparis();
            $islem = $sip->json_SiparisFormKayit($sirket_id, $_GET["customerId"], $_GET["productId"], $_GET["html"]);

            if ($islem) {
                $JSON = array(
                    "durum" => true,
                    "mesaj" => "Siparişiniz başarı ile ulaştırıldı."
                );
            } else {
                $JSON = array(
                    "durum" => false,
                    "mesaj" => "Siparişinizin kaydı sırasında bir sorun oluştu."
                );

            }

        } else {
            $JSON = array(
                "durum" => false,
                "mesaj" => "Bütün alanları doldurunuz."
            );
        }

    } else {
        // Referans kodu ile şirket bulunamadı.
        $JSON = array(
            "durum" => false,
            "mesaj" => "Referans kodunuz hatalı."
        );
    }
} else {
    // Referans kodu yok.
    $JSON = array(
        "durum" => false,
        "mesaj" => "Referans kodu eksik."
    );

}

header('Content-Type: application/json');
echo json_encode(
    array(
        "order" => array($JSON)
    ), JSON_PRETTY_PRINT);
?>