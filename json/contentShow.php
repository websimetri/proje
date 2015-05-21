<?php
/**
 * PARAMETRELER:
 * =============
 *  1. ref  ve contentId         Firmanın referans kodu ve içerik  ıd si
 *  2. ref ve start veya count   Firmanın referans kode ve başlangıç degeri
 *
 *  ref  ve contentId GİRİP dönenler
 * =========
 *
 *  1. Başarılı
 *      - contentId     int    içerik id
 *      - title         string  "içerik baslik gönderildi."
 *      - summary       string  "içerigin kısa_aciklaması gönderildi."
 *      - details       string  "içerigin datay gönderildi."
 *      - date          datetime  "içerigin eklenme_tarihi gönderildi."
 *      - status        bool  "içerigin durum gönderildi."
 *  2. Başarısız
 *      - durum     bool    false
 *      - mesaj     string  "HATAYA GÖRE GERİ DÖNÜŞLER FARKLI"
 *
 * *ref ve start veya count Girip DÖNENLER:
 * =========
 *  1. Başarılı
 *      - contentId     int    içerik id
 *      - title         string  "içerik baslik gönderildi."
 *      - summary       string  "içerik kısa_aciklaması gönderildi."
 *      - details       string  "içerigin datay gönderildi."
 *      - date          datetime  "içerigin eklenme_tarihi gönderildi."
 *      - status        bool  "içerigin durum gönderildi."
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

        if (isset($_GET["contentId"])) {
            $kulBilgi = BulutJSON::icerikGetir($_GET["contentId"]);
            //referan kodu varsa ve contentId var sa çalısacak kısım


            if ($kulBilgi != false) {
                //contentId var sa çalısacak kısım
                $kulBilgi = $kulBilgi[0];
                if ($kulBilgi["durum"] == "1" and $kulBilgi["sirket_id"] == $sirketId) {
                    // sirkete ait durumları aktif olanlar için çalısacak kısım
                    $JSON = array("durum" => true, "mesaj" => "Giriş Başarılı", "bilgiler" => array(
                        "contentId" => $kulBilgi["id"], "title" => $kulBilgi["baslik"],
                        "summary" => $kulBilgi["kisa_aciklama"], "details" => $kulBilgi["detay"], "date" => $kulBilgi["eklenme_tarihi"], "status" => $kulBilgi["durum"]));
                } else {
                    //contentId var ama durumu 0 ise  calısacak kısım ve şirkete ait degilse id bu hata geri döner
                    $JSON = array("durum" => false, "mesaj" => "Duyurunuz Pasif veya Böyle bir duyurunuz yoktur.");
                }
            } else {
                //contentId yoksa çalısacak kısım
                $JSON = array("durum" => false, "mesaj" => "İçerik Bilgileri Hatalı");
            }
        } else {
            if (isset($_GET["start"]) && (!empty($_GET["start"]) || $_GET["start"] == "0")) {
                //referan kodu var ve start oldugunda çalsacak kısım
                if (isset($_GET["count"]) && !empty($_GET["count"])) {
                    //count var mı boş mu diye bakılan kısım

                    if (is_numeric($_GET["count"])) {
                        //count tu numaric sayı yapılıyor
                        if ($_GET["count"] > 20 || empty($_GET["count"])) {
                            //count 20 den buyuk veya bos ise count ' a 20 atanıyor
                            $count = 20;
                        } else {
                            $count = $_GET["count"];

                        }
                    }
                } else {
                    $count = 20;
                    //else de count yoksa da 20 atanyıro
                }

                $icerikler = BulutJSON::icerikHepsiGetir($sirketId, $_GET["start"], $count);


                $bilgiler = array();
                if ($icerikler != false) {
                    foreach ($icerikler as $icerik) {
                        $temp = array();
                        $temp["contentId"] = $icerik["id"];
                        $temp["title"] = $icerik["baslik"];
                        $temp["summary"] = $icerik["kisa_aciklama"];
                        $temp["details"] = $icerik["detay"];
                        $temp["date"] = $icerik["eklenme_tarihi"];
                        $temp["status"] = $icerik["durum"];

                        array_push($bilgiler, $temp);
                    }

                    $JSON = array(
                        "durum" => true,
                        "mesaj" => "Giriş Başarılı");
                    $JSON["bilgiler"] = $bilgiler;
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
echo json_encode(array("contents" => array($JSON)), JSON_PRETTY_PRINT);

?>