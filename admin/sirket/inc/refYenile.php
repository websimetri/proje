<?php
include '../../../lib/siniflar.php';
if(isset($_POST["id"]) && $_POST["adi"]){
   $cevap=Bulut::refUpdate($_POST["id"],$_POST["adi"]);
    if($cevap){
        echo "<script>window.location.href='../../index.php?link=ayarlar';</script>";
    }
    else{
        echo "<script>window.location.href='../../index.php?link=ayarlar&sonuc=basarisiz';</script>";
    }
}
?>