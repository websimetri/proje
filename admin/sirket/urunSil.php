<?php
require_once '../../config.php';

if(isset($_POST["urun_id"]) && !empty($_POST["urun_id"])){

    $sorgu = $DB->prepare("DELETE from urunler where id=?");
    $sonuc = $sorgu->execute(array($_POST["urun_id"]));

    if($sonuc){
        echo "<script>window.location.href='../index.php?link=urunler&sonuc=basarili'</script>";
    }

    else{
        echo "<script>window.location.href='../index.php?link=urunler&sonuc=basarisiz'</script>";
    }
}
else {
    echo "<script>window.location.href='../index.php?link=urunler&sonuc=basarisiz'</script>";
}
?>