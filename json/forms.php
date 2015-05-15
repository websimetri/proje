<?php
/**
 * PARAMETRELER:
 * =============
 *  1. ref             Firmanın referans kodu.sirket_id
 *  2. formId          Formun id'si
 *
 * *Ref ve  formId girilince DÖNENLER:
 * =========
 *  1. Başarılı
 *      - formId       int         form id
 *      - formname     string      "From Adı gönderildi."
 *      - formhtml     string      "Form HTML gönderildi."
 *      - formjson     bool        "Form Json gönderildi."
 *      - date        datetime     "Form eklenme tarihi gönderildi."
 *  2. Başarısız
 *      - durum     bool    false
 *      - mesaj     string  "Form Bilgileri Hatalı"
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
        //referans kodu varsa çalısacak kısım

        if (isset($_GET["formId"])) {
            $kulBilgi = BulutJSON::getirSirketForm($_GET["formId"]);
            //referan kodu varsa ve formId var sa çalısacak kısım


            if ($kulBilgi != false) {
                //formId var sa çalısacak kısım
                $kulBilgi = $kulBilgi[0];

                $JSON = array("durum" => true, "mesaj" => "Giriş Başarılı", "bilgiler" => array(
                    "formId" => $kulBilgi["id"], "formname" => $kulBilgi["adi"],
                    "formhtml" => $kulBilgi["html"], "formjson" => $kulBilgi["json"],
                    "date" => $kulBilgi["tarih"]));


            } else {
                //formId yoksa çalısacak kısım
                $JSON = array("durum" => false, "mesaj" => "Form Bilgileri Hatalı");
            }
        } else {


            if (isset($_GET["start"]) && (!empty($_GET["start"])||$_GET["start"]==0 )) {
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

                //referan kodu var ve formId olmadında çalısacak kısım
                $formlar = BulutJSON::formHepsiGetir($sirketId,$_GET["start"],$count);


                $bilgiler = array();

                foreach ($formlar as $form) {
                    $temp = array();
                    $temp["formId"] = $form["id"];
                    $temp["formname"] = $form["adi"];
                    $temp["formhtml"] = $form["html"];
                    $temp["formjson"] = $form["json"];
                    $temp["date"] = $form["tarih"];

                    array_push($bilgiler, $temp);
                }

                $JSON = array(
                    "durum" => true,
                    "mesaj" => "Giriş Başarılı");
                $JSON["bilgiler"] = $bilgiler;


            } else {
                $JSON = array("durum" => false, "mesaj" => "Başlangıç değeri bulunamadı");
            }
        }
    }else {
        //referans kodu yanlış ise
        $JSON = array("durum" => false, "mesaj" => "Referans Kodu Hatalı");
    }


}
else{
    //link te ?ref= yazılmadıgında çalıscak kısım
    $JSON =array( "durum"=>false,"mesaj"=>"Referans Kodu Giriniz" );
}
header('Content-Type: application/json');
echo json_encode(array("forms"=>array($JSON)), JSON_PRETTY_PRINT);
?>