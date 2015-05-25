<?php

include "../config.php";
include "../lib/siniflar.php";


if (isset($_GET["ref"])) {

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);


    if ($cevap != false) {

        $sirketId = $cevap["id"];

        if (isset($_GET["galleryId"])) {
            if (isset($_GET["imageId"])) {
                $data = BulutJSON::TekilResimGetir($_GET["galleryId"], $_GET["imageId"]);
                if ($data != false) {
                    $JSON = array("durum" => true, "mesaj" => "İşlem Başarılı", "Gallery" => $data);
                } else {
                    $JSON = array("durum" => false, "mesaj" => "Belirtilen ID ye sahip bir resim bulunmamaktadır");
                }
            } else {
                $data = BulutJSON::TekilGaleriGetir($sirketId, $_GET["galleryId"]);
                if ($data != false) {
                    $JSON = array("durum" => true, "mesaj" => "İşlem Başarılı", "Gallery" => $data);
                } else {
                    $JSON = array("durum" => false, "mesaj" => "Belirtilen ID ye sahip aktif bir galeri bulunmamaktadır");
                }
            }
        } else {
            $data = BulutJSON::AktifGalerileriGetir($sirketId);
            if ($data != false) {
                $JSON = array("durum" => true, "mesaj" => "İşlem Başarılı", "Gallery" => $data);
            } else {
                var_dump($data);
                $JSON = array("durum" => false, "mesaj" => "Henüz aktif durumda galeriniz bulunmamaktadır");
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
echo json_encode(array("Galleries" => array($JSON)), JSON_PRETTY_PRINT);
?>