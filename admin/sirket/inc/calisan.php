<?php
session_start();
include "../../../lib/siniflar.php";
include "../../../config.php";


if (isset($_SESSION["sirketId"]) and
    isset($_POST["adi"]) and !empty($_POST["adi"]) and
    isset($_POST["soyadi"]) and !empty($_POST["soyadi"]) and
    isset($_POST["mail"]) and !empty($_POST["mail"]) and
    isset($_POST["mailTekrar"]) and !empty($_POST["mailTekrar"]) and
    $_POST["mail"] == $_POST["mailTekrar"]){


    $islem = Sirket::calisanKayit($_POST["adi"], $_POST["soyadi"], $_POST["mail"], $_SESSION["sirketId"]);

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

echo "
<script>
window.location.href = '../../index.php?link=duyurular&sonuc=$mesaj';
</script>";

?>