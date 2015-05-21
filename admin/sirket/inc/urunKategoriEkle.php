<?php
session_start();
$sirketId=$_SESSION['sirketId'];
include '../../../lib/siniflar.php';
if(isset($_POST["kategori_adi"]) && isset($_POST["topCategory"]) && !empty($_POST["kategori_adi"])){
    $catAdi=$_POST["kategori_adi"];
    $topCategory=$_POST["topCategory"];
    $c=Bulut::addCategory($sirketId,$topCategory,$catAdi);
    if($c){
        echo "<script>window.location.href='../../index.php?link=kategoriler&sonuc=basarili';</script>";
    }else{
        echo "<script>window.location.href='../../index.php?link=kategoriler&sonuc=basarisiz';</script>";
    }
}else{
    echo "<script>window.location.href='../../index.php?link=kategoriler&sonuc=basarisiz';</script>";
}



?>

