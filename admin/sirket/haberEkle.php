<?php
require_once '../../config.php';

$sirket_id = $_POST["sid"];
$kategori_id = $_POST["kid"];
$baslik = $_POST["baslik"];
$kisa_aciklama = $_POST["kisa_aciklama"];
$uzun_aciklama = $_POST["uzun_aciklama"];
$resim = $_FILES["resim"];
$tarih = $_POST["tarih"];

//var_dump($baslik);

if(isset($_POST["sid"]) && isset($_POST["kid"]) ){
    $query = $DB->prepare("INSERT INTO haberler  VALUES (null,:id_sirket,:kategori_id,:baslik,:kisa_aciklama,:uzun_aciklama,:resim,:tarih)
    ");
    $query->bindParam(':id_sirket',$sirket_id);
    $query->bindParam(':kategori_id',$kategori_id);
    $query->bindParam(':baslik',$baslik);
    $query->bindParam(':kisa_aciklama',$kisa_aciklama);
    $query->bindParam(':uzun_aciklama',$uzun_aciklama);
    $query->bindParam(':resim',$resim["name"]);
    $query->bindParam(':tarih',$tarih);
    $query->execute();
}
?>