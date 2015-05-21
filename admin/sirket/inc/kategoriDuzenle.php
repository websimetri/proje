<?php
include '../../../lib/siniflar.php';
if(isset($_POST["guncelle"]) && isset($_POST["kategoriAdi"]) && isset($_POST["kategoriId"])){
    $kategoriAdi=$_POST["kategoriAdi"];
    $id=$_POST["kategoriId"];
    $cevap =Bulut::updateCategory($kategoriAdi,$id);
    //$cevap=Bulut::updateProduct($sirketId,$urunAdi,$kisaAciklama,$urunAciklama,$categories,$urunId,$fiyat,$tip,$kampanya,$kampanyaBaslik,$kampanyaDetay);
    if($cevap != false){//false değilse ürün id dönecek
        echo "<script>window.location.href='../../index.php?link=kategoriler&sonuc=basarili';</script>";
    }
    else{

        echo "<script>window.location.href='../../index.php?link=kategoriler&sonuc=basarisiz';</script>";
    }
}

?>