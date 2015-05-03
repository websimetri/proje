<?php
session_start();
require_once "../../../lib/siniflar.php";


// ekleme işlemi.
if (isset($_POST["ekle"])) {

    // Kontroller.
    if (isset($_SESSION["sirketId"]) and
        isset($_POST["baslik"]) and !empty($_POST["baslik"]) and
        isset($_POST["kisa_aciklama"]) and !empty($_POST["kisa_aciklama"]) and
        isset($_POST["detay"]) and !empty($_POST["detay"]) and
        isset($_POST["durum"])) {

        $islem = Icerik::icerikEkle($_SESSION["sirketId"], $_POST["baslik"], $_POST["kisa_aciklama"], $_POST["detay"], $_POST["durum"]);

        if ($islem) {
            $mesaj = "basarili";
        }
        else {
            $mesaj = "basarisiz";
        }
    }
    else {
        $mesaj = "basarisiz";
    }

}

// silme işlemi.
elseif (isset($_POST["sil"])) {

    if (isset($_SESSION["sirketId"]) and
        isset($_POST["icerikId"]) and !empty($_POST["icerikId"])) {

        $islem = Icerik::icerikSil($_POST["icerikId"], $_SESSION["sirketId"]);

        if ($islem) {
            $mesaj = "basarili";
        }
        else {
            $mesaj = "basarisiz";
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
window.location.href = '../../index.php?link=icerik&sonuc=$mesaj';
</script>";

?>