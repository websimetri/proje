<?php
session_start();
require_once "../../../lib/siniflar.php";

if (isset($_POST["sil"])) {
    if (isset($_SESSION["sirketId"]) and
        isset($_POST["siparisId"]) and !empty($_POST["siparisId"])) {

        $sip = new Siparis();
        $islem = $sip->siparisSil($_SESSION["sirketId"], $_POST["siparisId"]);

        var_dump($islem);

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
window.location.href = '../../index.php?link=siparisler&sonuc=$mesaj';
</script>";
?>