<?php
session_start();
require_once "../../../lib/siniflar.php";
$anket = new Anket();

if (isset($_POST["ekle"])) {

    if (isset($_POST["baslik"]) and !empty($_POST["baslik"]) and
        isset($_SESSION["sirketId"])) {

        $islem = $anket->anketEkle($_SESSION["sirketId"], $_POST["baslik"]);

        if ($islem) {
            $mesaj = "basarili";
        }
        else {
            $mesaj = "basarisiz";
        }
    }
}

elseif (isset($_POST["sil"])) {

    if (isset($_POST["anket_id"]) and !empty($_POST["anket_id"]) and
        isset($_SESSION["sirketId"])) {

        // Hem anketin, hem de ankete ait seçeneklerin silinmesi.
        $anketSil = $anket->anketSil($_POST["anket_id"], $_SESSION["sirketId"]);
        $secenekSil = $anket->anketSecenekSilToplu($_POST["anket_id"], $_SESSION["sirketId"]);

        if ($anketSil) {
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
    echo "...";
}

echo "
<script>
window.location.href = '../../index.php?link=anketler&sonuc=$mesaj';
</script>";
?>