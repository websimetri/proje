<?php
include '../../../lib/siniflar.php';
if(isset($_GET["id"]) && $_GET["adi"]){
   $cevap=Bulut::refUpdate($_GET["id"],$_GET["adi"]);
    if($cevap){
        echo "<script>window.location.href='../../index.php?link=ayarlar';</script>";
    }
    else{
        echo "<script>window.location.href='../../index.php?link=ayarlar&sonuc=basarisiz';</script>";
    }
}
?>