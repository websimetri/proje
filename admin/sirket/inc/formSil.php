<?php
session_start();
require_once "../../../lib/fonksiyonlar.php";

if (isset($_SESSION["sirketId"]) and isset($_SESSION["kulId"]) and
    isset($_POST["id"]) and !empty($_POST["id"])) {

    $islem = Bulut::formSil($_POST["id"], $_SESSION["sirketId"]);

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
window.location.href = '../../index.php?link=formlar&sonuc=$mesaj';
</script>";


?>