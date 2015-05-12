<?php
/**
 * PARAMETRELER:
 * =============
 *  1. ref          Firmanın referans kodu.sirket_id
 *  2. userId       Duyurunun id'si
 *
 * Sadece Ref Girip DÖNENLER:
 * =========
 *  1. Başarılı
 *      - contentId     int    duyuru id
 *      - title         string  "Duyuru baslik gönderildi."
 *      - summary       string  "Duyurunun kısa_aciklaması gönderildi."
 *      - details       string  "Duyurunun datay gönderildi."
 *      - date          datetime  "Duyurunun eklenme_tarihi gönderildi."
 *      - status        bool  "Duyurunun durum gönderildi."
 *  2. Başarısız
 *      - durum     bool    false
 *      - mesaj     string  "Referans Kodu Hatalı"
 *
 * *Ref ve  Duyuru İd Girip DÖNENLER:
 * =========
 *  1. Başarılı
 *      - contentId     int    duyuru id
 *      - title         string  "Duyuru baslik gönderildi."
 *      - summary       string  "Duyurunun kısa_aciklaması gönderildi."
 *      - details       string  "Duyurunun datay gönderildi."
 *      - date          datetime  "Duyurunun eklenme_tarihi gönderildi."
 *      - status        bool  "Duyurunun durum gönderildi."
 *  2. Başarısız
 *      - durum     bool    false
 *      - mesaj     string  "Kullanıcı Bilgileri Hatalı"
 */
include "../config.php";
include "../lib/siniflar.php";


if(isset($_GET["ref"])) {
    //?ref kodu var mı
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    //Funksiyonda ref kodu getiriyor
    $sirketId = $cevap["id"];
    //sirket id cekilip  $sirketId ye atatnıyor

    if ($cevap != false) {
        //referan kodu varsa çalısacak kısım

        if (isset($_GET["userId"])) {
            $kulBilgi = BulutJSON::icerikGetir($_GET["userId"]);
            //referan kodu varsa ve userId var sa çalısacak kısım


            if ($kulBilgi != false) {
                //userId var sa çalısacak kısım
                $kulBilgi=$kulBilgi[0];
                if($kulBilgi["durum"] == "1") {
                    // userId var ve durumu 1 yani aktif olanları listeleyen kısım
                    $JSON = array("durum" => true,"mesaj" => "Giriş Başarılı", "bilgiler" => array(
                        "contentId" => $kulBilgi["id"], "title" => $kulBilgi["baslik"],
                        "summary" => $kulBilgi["kisa_aciklama"], "details" => $kulBilgi["detay"], "date" => $kulBilgi["eklenme_tarihi"], "status" => $kulBilgi["durum"]));
                }
                else{
                    //userId var ama durumu 0 ise  calısacak kısım
                    $JSON = array("durum" => false, "mesaj" => "Aktif Kullanıcı Bulunamadı");
                }
            } else {
                //userId yoksa çalısacak kısım
                $JSON = array("durum" => false, "mesaj" => "Kullanıcı Bilgileri Hatalı");
            }
        } else {
            //referan kodu var ve userId olmadında çalısacak kısım
            $icerikler = BulutJSON::icerikHepsiGetir($sirketId);


            $bilgiler = array();

            foreach ($icerikler as $icerik){
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
        }

    }
    else {
        //referans kodu yanlış ise
        $JSON = array("durum" => false, "mesaj" => "Referans Kodu Hatalı");
    }
}
else{
    //link te ?ref= yazılmadıgında çalıscak kısım
    $JSON =array( "durum"=>false,"mesaj"=>"Referans Kodu Giriniz" );
}
header('Content-Type: application/json');
echo json_encode(array("contents"=>array($JSON)), JSON_PRETTY_PRINT);
?>