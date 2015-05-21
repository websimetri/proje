<?php
/**
 * PARAMETRELER:
 * =============
 *  1. ref              Firmanın referans kodu.sirket_id
 *  2. announcementId   Duyurunun id'si
 *  3. start            Başlangıç değeri
 *  4. count            Gelecek veri değeri
 *
 *  Ref ve start ve count girilince DÖNENLER:
 * =========
 *  1. Başarılı bütün duyurular
 *      - announcementId       int    duyuru id
 *      - announcementtitle    string  "Duyuru baslik gönderildi."
 *      - announcementDetail   string  "Duyurunun detay kısmı gönderildi."
 *      - status               bool     "Duyurunun durumu gönderildi."
 *      - date             datetime     "Duyurunun eklenme tarihi gönderildi."
 *  2. Başarısız
 *      - durum     bool    false
 *      - mesaj     string  "HATAYA GÖRE GERİ DÖNÜŞLER FARKLI"
 *
 * *Ref ve  announcementId Girip DÖNENLER:
 * =========
 *  1. Başarılı
 *      - announcementId       int    duyuru id
 *      - announcementtitle    string  "Duyuru baslik gönderildi."
 *      - announcementDetail   string  "Duyurunun detay kısmı gönderildi."
 *      - status               bool     "Duyurunun durumu gönderildi."
 *      - date             datetime     "Duyurunun eklenme tarihi gönderildi."
 *  2. Başarısız
 *      - durum     bool    false
 *      - mesaj     string  "HATA YA GÖRE GERİ DÖNÜŞLER FARKLIDIR JSON API YONETİMİNDEN BAKA BİLİRSİNİZ"
 */
include "../config.php";
include "../lib/siniflar.php";


if (isset($_GET["ref"])) {
    //?ref kodu var mı
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    //Funksiyonda ref kodu getiriyor
    $sirketId = $cevap["id"];
    //sirket id cekilip  $sirketId ye atanıyor

    if ($cevap != false) {
        //referan kodu varsa çalısacak kısım

        if (isset($_GET["announcementId"]) && !empty($_GET["announcementId"])) {
            $kulBilgi = BulutJSON::getirSirketDuyuru($_GET["announcementId"]);

            //referan kodu varsa ve announcementId var sa çalısacak kısım
            if ($kulBilgi != false) {
                //announcementId var sa çalısacak kısım
                $kulBilgi = $kulBilgi[0];
                if ($kulBilgi["durum"] == "1" and $kulBilgi["sirket_id"] == $sirketId) {
                    // announcementId var ve durumu 1 yani aktif olanları listeleyen kısım
                    $JSON = array("durum" => true, "mesaj" => "Giriş Başarılı", "bilgiler" => array(
                        "announcementId" => $kulBilgi["id"], "announcementtitle" => $kulBilgi["duyuru_baslik"],
                        "announcementDetail" => $kulBilgi["duyuru_detay"], "status" => $kulBilgi["durum"]));
                } else {
                    //announcementId var ama durumu 0 ise  calısacak kısım
                    $JSON = array("durum" => false, "mesaj" => "Duyurunuz Pasif veya Böyle bir duyurunuz yoktur..");
                }
            } else {
                //announcementId yoksa çalısacak kısım
                $JSON = array("durum" => false, "mesaj" => "Duyuru Bilgileri Hatalı");
            }
        } else {
            if (isset($_GET["start"]) && (!empty($_GET["start"]) || $_GET["start"] == "0")) {

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


                $duyurular = BulutJSON::duyuruHepsiGetir($sirketId, $_GET["start"], $count);


                $bilgiler = array();
                if ($duyurular != false) {
                    foreach ($duyurular as $duyuru) {
                        $temp = array();
                        $temp["announcementId"] = $duyuru["id"];
                        $temp["announcementtitle"] = $duyuru["duyuru_baslik"];
                        $temp["announcementDetail"] = $duyuru["duyuru_detay"];
                        $temp["status"] = $duyuru["durum"];
                        $temp["date"] = $duyuru["tarih"];

                        array_push($bilgiler, $temp);
                    }


                    $JSON = array(
                        "durum" => true,
                        "mesaj" => "İşlem Başarılı");
                    $JSON["announcements"] = $bilgiler;
                } else {
                    $JSON = array("durum" => false, "mesaj" => "Başlangıç değeri hatalı");
                }


            } else {
                $JSON = array("durum" => false, "mesaj" => "Sadece referans kodu yeterli değil");
            }

        }
    } else {
        //referans kodu yanlış ise
        $JSON = array("durum" => false, "mesaj" => "Referans Kodu Hatalı");
    }
} else {
    //link te ?ref= yazılmadıgında çalıscak kısım
    $JSON = array("durum" => false, "mesaj" => "Referans Kodu Giriniz");
}
header('Content-Type: application/json');
echo json_encode(array("announcements" => array($JSON)), JSON_PRETTY_PRINT);
?>