<?php
include '../../../lib/siniflar.php';
if(isset($_POST["kaydet"]) && isset($_POST["urunAdi"]) && isset($_POST["kisaAciklama"])
    && isset($_POST["urunAciklama"]) && isset($_POST["categories"])&& isset($_POST["sirketId"])
    && isset($_POST["fiyat"]) && isset($_POST["tip"]) && isset($_POST["kampanya"])
    && isset($_POST["kampanyaBaslik"]) && isset($_POST["kampanyaDetay"])) {
    $urunAdi=$_POST["urunAdi"];
    $kisaAciklama=$_POST["kisaAciklama"];
    $urunAciklama=$_POST["urunAciklama"];
    $categories=$_POST["categories"];
    $sirketId=$_POST["sirketId"];
    $fiyat=$_POST["fiyat"];
    $tip=$_POST["tip"];
    $kampanya=$_POST["kampanya"];
    $kampanyaBaslik=$_POST["kampanyaBaslik"];
    $kampanyaDetay=$_POST["kampanyaDetay"];

    $cevap=Bulut::addProduct($sirketId,$urunAdi,$kisaAciklama,$urunAciklama,$categories,$fiyat,$tip,$kampanya,$kampanyaBaslik,$kampanyaDetay);
    if($cevap != false){//false değilse ürün id dönecek
        echo "<script>window.location.href='../../index.php?link=urunler&islem=resim_ekle&id=".$cevap."';</script>";
    }
    else{
        echo "<script>window.location.href='../../index.php?link=urunler&sonuc=basarisiz';</script>";
    }
}
else {
    echo "<script>window.location.href='../../index.php?link=urunler&sonuc=basarisiz';</script>";
}

?>

