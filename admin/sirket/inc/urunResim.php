<?php
session_start();
include '../../../lib/siniflar.php';

if ((isset($_POST["croppedImage"]) && $_POST["croppedImage"] != "") && (isset($_SESSION["cropped"]) && $_SESSION["cropped"]["0"]["thumbnail"]) == true) {
//    var_dump($_POST);
//    echo "<br><br>";
//    var_dump($_SESSION);
//    echo "<br><br>";


    //resim eklem için gerekli değişkenler
    $urunId=$_POST["urun_id"];
    //$resimAdi=$_SESSION["org"].$_SESSION["ext"];
    $resimAdi=$_POST["croppedImage"];
    $klasor=$_SESSION["dirname"]."/";
    echo $resimAdi."<br>".$klasor."<br>";

    $sonuc=Bulut::addProductImages($urunId,$resimAdi,$klasor);

    if($sonuc){
        echo "<script>window.location.href='../../index.php?link=urunler&sonuc=basarili';</script>";
    }
    else{
        echo "<script>window.location.href='../../index.php?link=urunler&sonuc=basarisiz';</script>";
    }

    /****
     * $_POST["croppedImage"] => db ye girilecek dosya yolu
     */

    unset($_SESSION["cropped"]);
}

?>