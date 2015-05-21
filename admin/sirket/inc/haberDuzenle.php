<?php
require_once '../../../config.php';

if (isset($_POST["baslik"]) and !empty($_POST["baslik"]) and
    isset($_POST["kisa_aciklama"]) and !empty($_POST["kisa_aciklama"]) and
    isset($_POST["uzun_aciklama"]) and !empty($_POST["uzun_aciklama"]) and
    isset($_POST["kategori_id"]) and !empty($_POST["kategori_id"]) and
    isset($_POST["id"]) and !empty($_POST["id"])) {

    $baslik = $_POST["baslik"];
    $kisa_aciklama = $_POST["kisa_aciklama"];
    $uzun_aciklama = $_POST["uzun_aciklama"];
    $resim = $_FILES["resim"];
    $kid = $_POST["kategori_id"];
    $id = $_POST["id"];

    $query = $DB->prepare("
    UPDATE haberler SET kategori_id = :kid , baslik = :baslik , uzun_aciklama = :uzun_aciklama , kisa_aciklama = :kisa_aciklama , resim = :resim  WHERE id = :id
    ");

    $query->bindParam(":id",$id);
    $query->bindParam(":kid",$kid);
    $query->bindParam(":baslik",$baslik);
    $query->bindParam(":uzun_aciklama",$uzun_aciklama);
    $query->bindParam(":kisa_aciklama",$kisa_aciklama);
    $query->bindParam(":resim",$resim["name"]);

    $query->execute();

    if($query->rowCount() > 0){
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
