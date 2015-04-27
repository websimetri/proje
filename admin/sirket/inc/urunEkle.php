<?php
include '../../../lib/siniflar.php';
if(isset($_POST["kaydet"]) && isset($_POST["urunAdi"]) && isset($_POST["kisaAciklama"])
    && isset($_POST["urunAciklama"]) && isset($_POST["categories"])&& isset($_POST["sirketId"]) ){
    $urunAdi=$_POST["urunAdi"];
    $kisaAciklama=$_POST["kisaAciklama"];
    $urunAciklama=$_POST["urunAciklama"];
    $categories=$_POST["categories"];
    $sirketId=$_POST["sirketId"];
    $cevap=Bulut::addProduct($sirketId,$urunAdi,$kisaAciklama,$urunAciklama,$categories);
    if($cevap != false){//false değilse ürün id dönecek
      //$_FILES["images"]
    }
    else{
        echo "Ürün Eklenemedi";
    }
}

?>

