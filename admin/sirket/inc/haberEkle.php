<?php
require_once '../../../config.php';
session_start();



if (isset($_SESSION["sirketId"]) and isset($_POST["durum"]) and !empty($_POST["durum"]) and
    isset($_POST["kategori_id"]) and !empty($_POST["kategori_id"]) and
    isset($_POST["baslik"]) and !empty($_POST["baslik"]) and
    isset($_POST["kisa_aciklama"]) and !empty($_POST["kisa_aciklama"]) and
    isset($_POST["uzun_aciklama"]) and !empty($_POST["uzun_aciklama"])) {

    $sirket_id = $_SESSION["sirketId"];
    $kategori_id = $_POST["kategori_id"];
    $baslik = $_POST["baslik"];
    $kisa_aciklama = $_POST["kisa_aciklama"];
    $uzun_aciklama = $_POST["uzun_aciklama"];
    $durum = $_POST["durum"];

    if (isset($_FILES)) {
        $resim = $_FILES["resim"]["name"];
    }
    else {
        $resim = "";
    }
    echo ":::".$resim;

    $q = "
    INSERT INTO haberler
    VALUES (null, :id_sirket, :kategori_id, :baslik, :kisa_aciklama, :uzun_aciklama, :resim, now(), :durum)
    ";
    $query = $DB->prepare($q);

    $query->bindParam(':id_sirket',$sirket_id);
    $query->bindParam(':kategori_id',$kategori_id);
    $query->bindParam(':baslik',$baslik);
    $query->bindParam(':kisa_aciklama',$kisa_aciklama);
    $query->bindParam(':uzun_aciklama',$uzun_aciklama);
    $query->bindParam(':resim',$resim);
    $query->bindParam(':durum',$durum);
    $query->execute();

    if ($query->rowCount() > 0) {
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