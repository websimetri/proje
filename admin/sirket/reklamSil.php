<?php
require_once '../../config.php';
// TODO: Burada işlemlerde acaba silinen reklamın dosyalarını da mı silsek?

if(isset($_POST["reklam_id"]) && !empty($_POST["reklam_id"])){

    $sorgu = $DB->prepare("DELETE from reklamlar where id=?");
    $sonuc = $sorgu->execute(array($_POST["reklam_id"]));

    if($sonuc){
        echo "<script>window.location.href='../index.php?link=reklam&sonuc=basarili'</script>";
    }

    else{
        echo "<script>window.location.href='../index.php?link=reklam&sonuc=basarisiz'</script>";
    }
}
else {
    echo "<script>window.location.href='../index.php?link=reklam&sonuc=basarisiz'</script>";
}
?>