<?php

require_once '../../config.php';

$baslik = $_POST["baslik"];
$kisa_aciklama = $_POST["kisa_aciklama"];
$uzun_aciklama = $_POST["uzun_aciklama"];
$resim = $_FILES["resim"];
$kid = $_POST["kategori_id"];
$id = $_POST["id"];
//var_dump($_POST);

if(isset($_POST["gonder"])){
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
        echo "başarılı";
    }
}
?>
