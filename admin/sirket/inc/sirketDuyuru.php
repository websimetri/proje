<?php
session_start();
require_once "../../../lib/siniflar.php";

$duy = new Duyuru();

if (isset($_POST["sil"])) {

    if (isset($_SESSION["sirketId"]) and
        isset($_POST["duyuru_id"]) and !empty($_POST["duyuru_id"])) {

        $islem = $duy->duyuruSil($_POST["duyuru_id"], $_SESSION["sirketId"]);

        if ($islem) {
            $mesaj = "basarili";
        }
        else {
            $mesaj = "basarisiz";
        }
    }

}

elseif (isset($_POST["ekle"])) {

    if (isset($_SESSION["sirketId"]) and
        isset($_POST["baslik"]) and !empty($_POST["baslik"]) and
        isset($_POST["detay"]) and !empty($_POST["detay"])) {

        $islem = $duy->duyuruEkle($_SESSION["sirketId"], $_POST["baslik"], $_POST["detay"], 1);

        if ($islem) {
            $mesaj = "basarili";
        }
        else{
            $mesaj = "basarili";
        }

    }
    else {
        $mesaj = "basarisiz";
    }

}

elseif (isset($_POST["duzenle"])) {

    if (isset($_SESSION["sirketId"]) and
        isset($_POST["duyuru_id"]) and !empty($_POST["duyuru_id"]) and
        isset($_POST["baslik"]) and !empty($_POST["baslik"]) and
        isset($_POST["detay"]) and !empty($_POST["detay"]) and
        isset($_POST["detay"])) {

        $islem = $duy->duyuruDuzenle($_POST["duyuru_id"], $_SESSION["sirketId"], $_POST["baslik"], $_POST["detay"], $_POST["durum"]);

        if ($islem) {
            $mesaj = "basarili";
        }
        else{
            $mesaj = "basarili";
        }

    }
    else {
        $mesaj = "basarisiz";
    }

}

else {
    $mesaj = "basarisiz";
}


echo "
<script>
window.location.href = '../../index.php?link=duyuru&sonuc=$mesaj';
</script>";

?>