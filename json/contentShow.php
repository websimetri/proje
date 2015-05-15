<?php
/**
 * PARAMETRELER:
 * =============
 *  1. ref          Firmanın referans kodu.sirket_id
 *  2. contentId       içerigin id'si
 *
 * Sadece Ref Girip DÖNENLER:
 * =========
 *  1. Başarılı
 *      - contentId     int    içerik id
 *      - title         string  "içerik baslik gönderildi."
 *      - summary       string  "içerigin kısa_aciklaması gönderildi."
 *      - details       string  "içerigin datay gönderildi."
 *      - date          datetime  "içerigin eklenme_tarihi gönderildi."
 *      - status        bool  "içerigin durum gönderildi."
 *  2. Başarısız
 *      - durum     bool    false
 *      - mesaj     string  "Referans Kodu Hatalı"
 *
 * *Ref ve  contentId Girip DÖNENLER:
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
 *      - mesaj     string  "Kullanıcı Bilgileri Hatalı"
 */
include "../config.php";
include "../lib/siniflar.php";


if(isset($_GET["ref"])) {
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
                if ($kulBilgi["durum"] == "1") {
                    // contentId var ve durumu 1 yani aktif olanları listeleyen kısım
                    $JSON = array("durum" => true, "mesaj" => "Giriş Başarılı", "bilgiler" => array(
                        "contentId" => $kulBilgi["id"], "title" => $kulBilgi["baslik"],
                        "summary" => $kulBilgi["kisa_aciklama"], "details" => $kulBilgi["detay"], "date" => $kulBilgi["eklenme_tarihi"], "status" => $kulBilgi["durum"]));
                } else {
                    //contentId var ama durumu 0 ise  calısacak kısım
                    $JSON = array("durum" => false, "mesaj" => "Aktif İçerik Bulunamadı");
                }
            } else {
                //contentId yoksa çalısacak kısım
                $JSON = array("durum" => false, "mesaj" => "İçerik Bilgileri Hatalı");
            }
        } else {
            if (isset($_GET["start"]) && !empty($_GET["start"])) {
                //referan kodu var ve contentId olmadında çalısacak kısım
                if (isset($_GET["count"])&& !empty($_GET["count"])) {

                    if (is_numeric($_GET["count"])) {
                        if ($_GET["count"] > 20|| empty($_GET["count"])) {
                            $count = 20;
                        }
                        else {
                            $count=$_GET["count"];
                        } }
                } else {
                    $count = 20;
                }

                $icerikler = BulutJSON::icerikHepsiGetir($sirketId, $_GET["start"],$count);


                $bilgiler = array();

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
                $JSON = array("durum" => false, "mesaj" => "Sadece referans kodu yeterli değil");}
        }

    }else {
        //referans kodu yanlış ise
        $JSON = array("durum" => false, "mesaj" => "Referans Kodu Hatalı");}
}

else{
    //link te ?ref= yazılmadıgında çalıscak kısım
    $JSON =array( "durum"=>false,"mesaj"=>"Referans Kodu Giriniz" );
}
header('Content-Type: application/json');
echo json_encode(array("contents"=>array($JSON)), JSON_PRETTY_PRINT);
?>