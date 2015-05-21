<?php
require_once '../../../config.php';
session_start();

if (isset($_POST["baslik"]) and !empty($_POST["baslik"]) and
    isset($_SESSION["sirketId"])) {

    $kategori = $_POST["baslik"];
    $sirket_id = $_SESSION["sirketId"];

    $query = $DB->prepare("INSERT INTO haber_kategori VALUES (null,:sirket_id,:adi)");
    $query->bindParam(':sirket_id', $sirket_id);
    $query->bindParam(':adi', $kategori);
    $query->execute();

    if($query->rowCount() > 0) {
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
window.location.href = '../../index.php?link=haberler&sonuc=$mesaj';
</script>";
?>