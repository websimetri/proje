<?php

include "../config.php";
include "../lib/siniflar.php";


if (isset($_GET["ref"])) {

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    $sirketId = $cevap["id"];


    if ($cevap != false) {

        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $haberBilgi = BulutJSON::getnewId($_GET["id"]);

            if ($haberBilgi != false) {

                $haberBilgi = $haberBilgi[0];


                $JSON = array("durum" => true, "mesaj" => "Giriş Başarılı",
                    "Haber_Bilgileri" => array(
                        "news_id" => $haberBilgi["id"],
                        "category_id" => $haberBilgi["kategori_id"],
                        "title" => $haberBilgi["baslik"],
                        "s_description" => $haberBilgi["kisa_aciklama"],
                        "l_description" => $haberBilgi["uzun_aciklama"],
                        "picture" => $haberBilgi["resim"],
                        "date_time" => $haberBilgi["tarih"],
                        "status" => $haberBilgi["durum"],

                    ));

            } else {

                $JSON = array("durum" => false, "mesaj" => "Haber Bilgileri Hatalı");
            }
        } else {
            if (isset($_GET["start"]) && (!empty($_GET["start"]) || $_GET["start"] == 0)) {

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

                $haberler = BulutJSON::getNews($sirketId, $_GET["start"], $count);


                $bilgiler = array();

                foreach ($haberler as $haber) {
                    $temp = array();
                    $temp["id"] = $haber["id"];
                    $temp["category_id"] = $haber["kategori_id"];
                    $temp["title"] = $haber["baslik"];
                    $temp["s_description"] = $haber["kisa_aciklama"];
                    $temp["l_description"] = $haber["uzun_aciklama"];
                    $temp["picture"] = $haber["resim"];
                    $temp["date_time"] = $haber["tarih"];
                    $temp["status"] = $haber["durum"];


                    array_push($bilgiler, $temp);
                }

                $JSON = array(
                    "durum" => true,
                    "mesaj" => "İşlem Başarılı");
                $JSON["Haber_Bilgileri"] = $bilgiler;


            } else {
                $JSON = array("durum" => false, "mesaj" => "Başlangıç değeri bulunamadı");
            }

        }

    } else {
        $JSON = array("durum" => false, "mesaj" => "Referans Kodu Hatalı");
    }
} else {
    $JSON = array("durum" => false, "mesaj" => "Referans Kodu Giriniz");
    //link te ?ref= yazılmadıgında çalıscak kısım

}
header('Content-Type: application/json');
echo json_encode(array("News" => array($JSON)), JSON_PRETTY_PRINT);
?>
