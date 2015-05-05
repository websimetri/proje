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

elseif (isset($_POST["duzenle"])) {

    if (isset($_POST["anket_id"]) and !empty($_POST["anket_id"]) and
        isset($_POST["anket_baslik"]) and !empty($_POST["anket_baslik"]) and
        isset($_SESSION["sirketId"])) {

        $islem = $anket->anketDuzenle($_POST["anket_id"], $_POST["anket_baslik"]);

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

    $anket_id = $_POST["anket_id"];
    echo "
    <script>
    window.location.href = '../../index.php?link=anketler&id=$anket_id&sonuc=$mesaj';
    </script>
    ";
}


elseif (isset($_POST["secenek_ekle"])) {

    if (isset($_POST["anket_id"]) and !empty($_POST["anket_id"]) and
        isset($_POST["secenek"]) and !empty($_POST["secenek"]) and
        isset($_SESSION["sirketId"])) {

        $islem = $anket->anketSecenekEkle($_SESSION["sirketId"], $_POST["anket_id"], $_POST["secenek"]);

        if ($islem) {
            $mesaj = "basarili";
        }
        else {
            $mesaj = "basarisiz";
        }

        $anket_id = $_POST["anket_id"];

        echo "
        <script>
        window.location.href = '../../index.php?link=anketler&id=$anket_id&sonuc=$mesaj';
        </script>";
    }

}

elseif (isset($_POST["secenek_sil"])) {

    if (isset($_POST["anket_id"]) and !empty($_POST["anket_id"]) and
        isset($_POST["secenek_id"]) and !empty($_POST["secenek_id"]) and
        isset($_SESSION["sirketId"])) {

        $islem = $anket->anketSecenekSil($_POST["secenek_id"], $_SESSION["sirketId"]);

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

    $anket_id = $_POST["anket_id"];

    echo "
        <script>
        window.location.href = '../../index.php?link=anketler&id=$anket_id&sonuc=$mesaj';
        </script>";
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